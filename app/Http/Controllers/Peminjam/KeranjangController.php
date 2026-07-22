<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function __invoke(Request $request)
    {
        $keranjang = Peminjaman::where('peminjam_id', auth()->user()->id)
            ->where('status', 0)
            ->first();

    

        return view('peminjam/keranjang/index');
    }
}