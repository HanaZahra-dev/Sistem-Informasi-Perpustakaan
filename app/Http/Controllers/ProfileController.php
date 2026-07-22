<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        if(auth()->user()->hasRole('peminjam')){
            return view('profile-peminjam');
        }
    
        return view('profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('foto-profile', 'public');
            $user->foto = $foto;
        }

        $user->name = $request->name;
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}