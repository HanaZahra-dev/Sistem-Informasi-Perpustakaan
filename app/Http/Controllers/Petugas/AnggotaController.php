<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('petugas/anggota/index');
    }
}