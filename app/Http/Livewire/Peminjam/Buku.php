<?php

namespace App\Http\Livewire\Peminjam;

use App\Models\Buku as ModelsBuku;
use App\Models\DetailPeminjaman;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Livewire\Component;
use Livewire\WithPagination;

class Buku extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['pilihKategori', 'semuaKategori'];

    public $kategori_id, $pilih_kategori, $buku_id, $detail_buku, $search;

    public function pilihKategori($id)
    {
        $this->format();
        $this->kategori_id = $id;
        $this->pilih_kategori = true;
        $this->updatingSearch();
    }

    public function semuaKategori()
    {
        $this->format();
        $this->pilih_kategori = false;
        $this->updatingSearch();
    }

    public function detailBuku($id)
    {
        $this->format();
        $this->detail_buku = true;
        $this->buku_id = $id;
    }

    public function keranjang(ModelsBuku $buku)
    {
        // Harus login
        if (!auth()->user()) {
            session()->flash('gagal', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }

        // Harus role peminjam
        if (!auth()->user()->hasRole('peminjam')) {
            session()->flash('gagal', 'Role user Anda bukan peminjam');
            return;
        }

        // ── PERBAIKAN UTAMA ──
        // Ambil HANYA keranjang status 0 (draft) milik user ini.
        // Bug lama: query pakai status != 3, sehingga buku di peminjaman
        // yang sedang "Menunggu" (1) atau "Dipinjam" (2) juga ikut dihitung,
        // menyebabkan keranjang baru tidak pernah bisa dibuat.
        $keranjang = Peminjaman::where('peminjam_id', auth()->user()->id)
            ->where('status', 0)
            ->first();

        if ($keranjang) {
            // Keranjang sudah ada — cek kondisi

            // Cek buku sudah ada di keranjang (bug lama: hanya cek [0]->buku_id)
            $sudahAda = $keranjang->detail_peminjaman
                ->where('buku_id', $buku->id)
                ->count() > 0;

            if ($sudahAda) {
                session()->flash('gagal', 'Buku ini sudah ada di keranjang');
                return;
            }

            // Cek maksimal 2 buku
            if ($keranjang->detail_peminjaman->count() >= 2) {
                session()->flash('gagal', 'Keranjang sudah penuh. Maksimal 2 buku per pengajuan');
                return;
            }

            // Tambahkan buku ke keranjang yang sudah ada
            DetailPeminjaman::create([
                'peminjaman_id' => $keranjang->id,
                'buku_id'       => $buku->id,
            ]);

        } else {
            // Keranjang belum ada — buat baru
            // Perbaikan kode_pinjam: format PINJ-TAHUN-XXXX lebih rapi daripada random int
            $urutan = Peminjaman::whereYear('created_at', date('Y'))->count() + 1;
            $kode   = 'PINJ-' . date('Y') . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT);

            $keranjang_baru = Peminjaman::create([
                'kode_pinjam' => $kode,
                'peminjam_id' => auth()->user()->id,
                'status'      => 0,
            ]);

            DetailPeminjaman::create([
                'peminjaman_id' => $keranjang_baru->id,
                'buku_id'       => $buku->id,
            ]);
        }

        $this->emit('tambahKeranjang');
        session()->flash('sukses', 'Buku berhasil ditambahkan ke keranjang');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if ($this->pilih_kategori) {
            if ($this->search) {
                $buku = ModelsBuku::latest()
                    ->where('judul', 'like', '%' . $this->search . '%')
                    ->where('kategori_id', $this->kategori_id)
                    ->paginate(12);
            } else {
                $buku = ModelsBuku::latest()
                    ->where('kategori_id', $this->kategori_id)
                    ->paginate(12);
            }
            $title = Kategori::find($this->kategori_id)->nama;

        } elseif ($this->detail_buku) {
            $buku  = ModelsBuku::find($this->buku_id);
            $title = 'Detail Buku';

        } else {
            if ($this->search) {
                $buku = ModelsBuku::latest()
                    ->where('judul', 'like', '%' . $this->search . '%')
                    ->paginate(12);
            } else {
                $buku = ModelsBuku::latest()->paginate(12);
            }
            $title = 'Semua Buku';
        }

        return view('livewire.peminjam.buku', compact('buku', 'title'));
    }

    public function format()
    {
        $this->detail_buku   = false;
        $this->pilih_kategori = false;
        unset($this->buku_id);
        unset($this->kategori_id);
    }
}
