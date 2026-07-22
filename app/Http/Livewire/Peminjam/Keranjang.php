<?php

namespace App\Http\Livewire\Peminjam;

use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use Livewire\Component;

class Keranjang extends Component
{
    // Property untuk modal konfirmasi kosongkan keranjang
    public $showKosongkanModal = false;

    public function hapus(Peminjaman $peminjaman, DetailPeminjaman $detail_peminjaman)
    {
        if ($peminjaman->detail_peminjaman->count() == 1) {
            $detail_peminjaman->delete();
            $peminjaman->delete();
            session()->flash('sukses', 'Buku berhasil dihapus dari keranjang.');
            return $this->redirect('/keranjang');
        } else {
            $detail_peminjaman->delete();
            session()->flash('sukses', 'Buku berhasil dihapus dari keranjang.');
            $this->emit('kurangiKeranjang');
        }
    }

    // Tampilkan modal konfirmasi kosongkan
    public function konfirmasiKosongkan()
    {
        $this->showKosongkanModal = true;
    }

    // Tutup modal tanpa action
    public function batalKosongkan()
    {
        $this->showKosongkanModal = false;
    }

    public function hapusMasal()
    {
        $this->showKosongkanModal = false;

        $keranjang = Peminjaman::latest()
            ->where('peminjam_id', auth()->user()->id)
            ->where('status', 0)
            ->first();

        if (!$keranjang) {
            return $this->redirect('/keranjang');
        }

        foreach ($keranjang->detail_peminjaman as $detail) {
            $detail->delete();
        }
        $keranjang->delete();
        session()->flash('sukses', 'Semua buku berhasil dihapus dari keranjang.');
        return $this->redirect('/keranjang');
    }

    public function ajukan(Peminjaman $keranjang)
    {
        $keranjang->update([
            'status' => 1,
        ]);

        session()->flash('sukses', 'Peminjaman berhasil diajukan! Silakan datang ke perpustakaan dengan kode peminjaman Anda.');
        return $this->redirect('/dashboard-peminjam');
    }

    public function render()
    {
        $keranjang = Peminjaman::latest()
            ->where('peminjam_id', auth()->user()->id)
            ->where('status', 0)
            ->first();

        $riwayat = Peminjaman::where('peminjam_id', auth()->user()->id)
            ->whereIn('status', [1, 2, 3, 4])
            ->latest()
            ->get();

        return view('livewire.peminjam.keranjang', [
            'keranjang' => $keranjang,
            'riwayat'   => $riwayat,
        ]);
    }
}
