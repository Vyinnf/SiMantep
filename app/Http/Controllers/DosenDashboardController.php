<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Laporan;
use App\Models\Notifikasi;

class DosenDashboardController extends Controller
{
    public function index()
    {
        // Total mahasiswa bimbingan (contoh: mahasiswa yang statusnya magang)
        $totalMahasiswa = Mahasiswa::where('status', 'magang')->count();

        // Total pendaftaran PKL yang perlu diverifikasi
        $totalPendaftaran = Pendaftaran::where('status', 'menunggu')->count();

        // Total laporan yang perlu dikoreksi
        $totalLaporan = Laporan::where('status', 'diajukan')->count();

        // Total notifikasi untuk dosen login
        $totalNotifikasi = Notifikasi::where('user_id', Auth::id())->count();

        return view('dosen.dashboard', compact(
            'totalMahasiswa',
            'totalPendaftaran',
            'totalLaporan',
            'totalNotifikasi'
        ));
    }
}
