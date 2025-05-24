<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\Dosen;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function storeDosen(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:dosens,email',
        'password' => 'required|min:6',
    ]);

    \App\Models\Dosen::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => \Hash::make($request->password),
    ]);

    return redirect()->route('admin.dosen.create')->with('success', 'Akun dosen berhasil ditambahkan!');
}
}
