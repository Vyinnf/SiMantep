<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenProfileController extends Controller
{
    public function show()
    {
        return view('dosen.profile');
    }

    public function edit()
    {
        return view('dosen.profile-edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            // Tambahkan validasi lain jika ada field tambahan
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('dosen.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
