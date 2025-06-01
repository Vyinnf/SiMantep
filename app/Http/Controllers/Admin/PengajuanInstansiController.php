<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanInstansi;
use App\Models\Instansi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanInstansiController extends Controller
{
    public function index()
    {
        $pengajuanInstansis = PengajuanInstansi::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.instansi_diminta.index', compact('pengajuanInstansis'));
    }

    public function approve(Request $request, PengajuanInstansi $pengajuanInstansi)
    {
        if ($pengajuanInstansi->status !== 'pending') {
            return redirect()->route('admin.instansi.diminta.index')->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }

        $pengajuanInstansi->status = 'approved';
        $pengajuanInstansi->catatan_admin = $request->input('catatan_admin', 'Disetujui oleh ' . Auth::user()->name);
        $pengajuanInstansi->save();

        $existingInstansi = Instansi::where('nama_instansi', 'ILIKE', $pengajuanInstansi->nama_instansi)
                                    ->where('alamat', 'ILIKE', $pengajuanInstansi->alamat_instansi)
                                    ->first();
        if (!$existingInstansi) {
            Instansi::create([
                'nama_instansi' => $pengajuanInstansi->nama_instansi,
                'alamat' => $pengajuanInstansi->alamat_instansi,
                'kontak' => $pengajuanInstansi->kontak_instansi,
            ]);
        }

        return redirect()->route('admin.instansi.diminta.index')->with('success', 'Pengajuan instansi untuk "' . $pengajuanInstansi->nama_instansi . '" berhasil disetujui.');
    }

    public function reject(Request $request, PengajuanInstansi $pengajuanInstansi)
    {
        if ($pengajuanInstansi->status !== 'pending') {
            return redirect()->route('admin.instansi.diminta.index')->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }

        $request->validate([
            'catatan_admin' => 'required|string|min:5|max:500',
        ]);

        $pengajuanInstansi->status = 'rejected';
        $pengajuanInstansi->catatan_admin = $request->input('catatan_admin');
        $pengajuanInstansi->save();

        return redirect()->route('admin.instansi.diminta.index')->with('success', 'Pengajuan instansi untuk "' . $pengajuanInstansi->nama_instansi . '" telah ditolak.');
    }

    public function destroy(PengajuanInstansi $pengajuanInstansi)
    {
        $namaInstansi = $pengajuanInstansi->nama_instansi;
        $pengajuanInstansi->delete();
        return redirect()->route('admin.instansi.diminta.index')->with('success', 'Data pengajuan instansi "' . $namaInstansi . '" berhasil dihapus.');
    }
}
