<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenNotifikasiController extends Controller
{
    public function index()
    {
        // Contoh: ambil notifikasi dari tabel notifikasi, filter untuk dosen yang sedang login
        $notifikasi = \App\Models\Notifikasi::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dosen.notifikasi', compact('notifikasi'));
    }
}
