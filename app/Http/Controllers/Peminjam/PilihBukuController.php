<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class PilihBukuController extends Controller
{
    /**
     * Tampilkan halaman pilih buku.
     * Guard: jika belum identifikasi, kembalikan ke form identifikasi.
     */
    public function index(Request $request)
    {
        if (!session('peminjam_identifikasi')) {
            return redirect()->route('pinjam.identifikasi')
                ->with('info', 'Silakan isi identitas terlebih dahulu.');
        }

        $query = Buku::with(['kategori', 'rak'])
            ->orderBy('judul');

        // Filter pencarian judul
        if ($request->filled('cari')) {
            $query->where('judul', 'like', '%' . $request->cari . '%');
        }

        // Filter kategori
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        $buku      = $query->get();
        $kategori  = Kategori::orderBy('nama')->get();
        $keranjang = session('keranjang_pinjam', []);

        return view('peminjam.pilih-buku.index', compact('buku', 'kategori', 'keranjang'));
    }

    /**
     * Tambah buku ke keranjang session (maks. 2).
     */
    public function tambah(Request $request)
    {
        $request->validate(['buku_id' => 'required|integer|exists:buku,id']);

        $keranjang = session('keranjang_pinjam', []);

        if (count($keranjang) >= 2) {
            return back()->with('error', 'Maksimal 2 buku dalam sekali peminjaman.');
        }

        $buku = Buku::find($request->buku_id);

        if ($buku->stok < 1) {
            return back()->with('error', 'Maaf, stok buku ini sedang habis.');
        }

        // Cegah duplikasi
        foreach ($keranjang as $item) {
            if ($item['id'] == $buku->id) {
                return back()->with('info', 'Buku ini sudah ada di pilihan kamu.');
            }
        }

        $keranjang[] = [
            'id'     => $buku->id,
            'judul'  => $buku->judul,
            'penulis'=> $buku->penulis,
            'sampul' => $buku->sampul,
        ];

        session(['keranjang_pinjam' => $keranjang]);

        return back()->with('success', "\"$buku->judul\" berhasil dipilih!");
    }

    /**
     * Hapus buku dari keranjang session.
     */
    public function hapus(Request $request)
    {
        $request->validate(['buku_id' => 'required|integer']);

        $keranjang = session('keranjang_pinjam', []);
        $keranjang = array_values(
            array_filter($keranjang, fn($item) => $item['id'] != $request->buku_id)
        );

        session(['keranjang_pinjam' => $keranjang]);

        return back()->with('info', 'Buku dihapus dari pilihan.');
    }
}
