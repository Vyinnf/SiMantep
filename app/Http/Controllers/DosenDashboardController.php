<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Laporan;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenDashboardController extends Controller
{
    public function index()
    {
        $dosenId = Auth::id();

        $totalMahasiswa = Pendaftaran::where('dosen_id', $dosenId)
            ->where('status', 'diterima')
            ->count();

        $totalPendaftaran = 0;

        $mahasiswaIds = Pendaftaran::where('dosen_id', $dosenId)
            ->where('status', 'diterima')
            ->pluck('user_id');

        $totalLaporan = Laporan::whereIn('mahasiswa_id', $mahasiswaIds)
            ->where('status', 'diajukan')
            ->count();

        return view('dosen.dashboard', compact(
            'totalMahasiswa',
            'totalPendaftaran',
            'totalLaporan'
        ));
    }

    public function mahasiswa()
    {
        $dosenId = Auth::id();

        $pendaftaran = Pendaftaran::with(['user.mahasiswa'])
            ->where('dosen_id', $dosenId)
            ->where('status', 'diterima')
            ->get();

        return view('dosen.mahasiswa', compact('pendaftaran'));
    }
}
