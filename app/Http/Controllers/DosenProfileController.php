<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
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
            'nip' => 'nullable|string|max:20',
            'gender' => 'nullable|in:Laki-laki,Perempuan',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->nip = $request->nip;
        $user->gender = $request->gender;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->save();

        return redirect()->route('dosen.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
