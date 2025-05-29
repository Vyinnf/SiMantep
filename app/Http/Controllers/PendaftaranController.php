<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Instansi;
use App\Models\Dosen;
use App\Models\Admin;
use App\Notifications\PendaftaranBaruNotification;
use Illuminate\Support\Facades\Notification;

class PendaftaranController extends Controller
{
    public function create()
    {
        $instansiList = Instansi::all();

        // Ambil data mahasiswa yang terkait user login
        $mahasiswa = auth()->user()->mahasiswa;

        return view('mahasiswa.pendaftaran', compact('instansiList', 'mahasiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:20',
            'prodi' => 'required|string|max:100',
            'semester' => 'required|integer|min:1|max:14',
            'alamat_mahasiswa' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'instansi_id' => 'required',
            'nama_instansi_manual' => 'nullable|required_if:instansi_id,other|string|max:255',
            'alamat_instansi_manual' => 'nullable|required_if:instansi_id,other|string',
        ]);

        // Update data Mahasiswa jika ada
        $mahasiswa = auth()->user()->mahasiswa;
        if ($mahasiswa) {
            $mahasiswa->update([
                'nim' => $request->nim,
                'prodi' => $request->prodi,
                'semester' => $request->semester,
                'alamat' => $request->alamat_mahasiswa,
                'no_hp' => $request->no_hp,
            ]);
        }

        // Proses instansi
        if ($request->instansi_id === 'other') {
            $instansi = Instansi::create([
                'nama_instansi' => $request->nama_instansi_manual,
                'alamat' => $request->alamat_instansi_manual,
            ]);
            $instansiId = $instansi->id;
            $alamatInstansi = $request->alamat_instansi_manual;
        } else {
            $instansiId = $request->instansi_id;
            $instansi = Instansi::find($instansiId);
            $alamatInstansi = $instansi ? $instansi->alamat : null;
        }

        // Buat data pendaftaran dan simpan ke variable $pendaftaran
        $pendaftaran = Pendaftaran::create([
            'user_id' => auth()->id(),
            'instansi_id' => $instansiId,
            'nim' => $request->nim,
            'prodi' => $request->prodi,
            'semester' => $request->semester,
            'alamat_mahasiswa' => $request->alamat_mahasiswa,
            'no_hp' => $request->no_hp,
            'alamat_instansi' => $alamatInstansi,
        ]);

        // Kirim notifikasi ke dosen dan admin
        $dosens = Dosen::all();
        $admins = Admin::all();

        Notification::send($dosens, new PendaftaranBaruNotification($pendaftaran));
        Notification::send($admins, new PendaftaranBaruNotification($pendaftaran));

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Pendaftaran PKL berhasil dikirim.');
    }
}
