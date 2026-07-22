<?php

namespace App\Http\Livewire\Petugas;

use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Transaksi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $menunggu         = false;
    public $sedang_dipinjam  = false;
    public $selesai_dipinjam = false;
    public $ditolak          = false;
    public $alasan_tolak;
    public $search;

    protected $listeners = [
        'callSetuju'  => 'setuju',
        'callTolak'   => 'tolak',
        'callKembali' => 'kembali',
    ];

    public function format()
    {
        $this->menunggu         = false;
        $this->sedang_dipinjam  = false;
        $this->selesai_dipinjam = false;
        $this->ditolak          = false;
        $this->resetPage();
    }

    public function menungguPersetujuan()  { $this->format(); $this->menunggu         = true; }
    public function sedangDipinjam()       { $this->format(); $this->sedang_dipinjam  = true; }
    public function selesaiDipinjam()      { $this->format(); $this->selesai_dipinjam = true; }
    public function ditolakPeminjaman()    { $this->format(); $this->ditolak          = true; }

    public function setuju($id)
    {
        $peminjaman = Peminjaman::with('detail_peminjaman.buku')->findOrFail($id);

        if ($peminjaman->status !== 1) {
            session()->flash('gagal', 'Peminjaman ini sudah diproses sebelumnya.');
            return;
        }

        foreach ($peminjaman->detail_peminjaman as $detail) {
            if ($detail->buku->stok < 1) {
                session()->flash('gagal', 'Stok buku "' . $detail->buku->judul . '" tidak cukup.');
                return;
            }
            $detail->buku->decrement('stok');
        }

        DB::table('peminjaman')->where('id', $id)->update([
            'petugas_pinjam'  => auth()->id(),
            'status'          => 2,
            'tanggal_pinjam'  => today()->toDateString(),
            'tanggal_kembali' => today()->addDays(7)->toDateString(),
            'updated_at'      => now(),
        ]);

        session()->flash('sukses', 'Peminjaman disetujui — status berubah menjadi Sedang Dipinjam.');
    }

    public function tolak($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 1) {
            session()->flash('gagal', 'Hanya peminjaman berstatus Diajukan yang bisa ditolak.');
            return;
        }

        $peminjaman->update([
            'status'       => 4,
            'alasan_tolak' => $this->alasan_tolak,
        ]);

        $this->alasan_tolak = null;
        session()->flash('sukses', 'Peminjaman berhasil ditolak.');
    }

    public function kembali($id)
    {
        $peminjaman = Peminjaman::with('detail_peminjaman.buku')->findOrFail($id);

        if ($peminjaman->status !== 2) {
            session()->flash('gagal', 'Peminjaman ini tidak sedang dalam status dipinjam.');
            return;
        }

        foreach ($peminjaman->detail_peminjaman as $detail) {
            $detail->buku->increment('stok');
        }

        $tanggalKembaliRaw = DB::table('peminjaman')->where('id', $id)->value('tanggal_kembali');
        $denda = 0;
        if ($tanggalKembaliRaw && Carbon::parse($tanggalKembaliRaw)->lessThan(today())) {
            $denda = Carbon::parse($tanggalKembaliRaw)->diffInDays(today()) * 1000;
        }

        DB::table('peminjaman')->where('id', $id)->update([
            'status'               => 3,
            'petugas_kembali'      => auth()->id(),
            'tanggal_pengembalian' => today()->toDateString(),
            'denda'                => $denda,
            'updated_at'           => now(),
        ]);

        $pesanDenda = $denda > 0
            ? ' Denda: Rp ' . number_format($denda, 0, ',', '.')
            : ' Tidak ada denda.';

        session()->flash('sukses', 'Buku berhasil dikembalikan.' . $pesanDenda);
    }

    public function render()
    {
        $query = Peminjaman::with(['detail_peminjaman.buku.rak', 'anggota', 'user'])
            ->where('status', '!=', 0)
            ->latest();

        if ($this->search) {
            $cari = $this->search;
            $query->where(function ($q) use ($cari) {
                $q->where('kode_pinjam', 'like', "%$cari%")
                  ->orWhereHas('anggota', fn($a) => $a->where('nama', 'like', "%$cari%")
                                                       ->orWhere('nis_nip', 'like', "%$cari%"))
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%$cari%"));
            });
        }

        if ($this->menunggu)          $query->where('status', 1);
        elseif ($this->sedang_dipinjam)   $query->where('status', 2);
        elseif ($this->selesai_dipinjam)  $query->where('status', 3);
        elseif ($this->ditolak)           $query->where('status', 4);

        $transaksi = $query->paginate(10)->through(function ($p) {
            if ($p->anggota) {
                // ✅ Data baru: anggota terdaftar di tabel anggota
                $p->nama_peminjam = $p->anggota->nama;
                $p->sub_peminjam  = $p->anggota->label_jenis . ' · ' . $p->anggota->kode_anggota;
            } elseif ($p->user) {
                // ✅ Data lama: peminjam login via akun user
                $p->nama_peminjam = $p->user->name;
                $p->sub_peminjam  = $p->user->email;
            } elseif ($p->peminjam_id == 0) {
                // ✅ Data lama sebelum ada tabel anggota (anggota_id belum diisi)
                $p->nama_peminjam = 'Anggota #' . $p->id;
                $p->sub_peminjam  = $p->kode_pinjam;
            } else {
                $p->nama_peminjam = '(Akun dihapus)';
                $p->sub_peminjam  = $p->kode_pinjam;
            }
            return $p;
        });

        return view('livewire.petugas.transaksi', compact('transaksi'));
    }
}