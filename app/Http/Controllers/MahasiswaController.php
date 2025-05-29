<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    /* Menampilkan halaman edit profil mahasiswa. */
    public function editProfil()
    {
        $user = Auth::user();

        // Cari atau buat data mahasiswa berdasarkan user_id
        $mahasiswa = Mahasiswa::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nama' => 'Nama Belum Diisi',
                'nim' => '-',
                'semester' => 1,
                'prodi' => '-',
                'ttl' => '-',
                'alamat' => '-',
                'email' => $user->email ?? 'email@kosong.com',
            ],
        );

        // Pisahkan ttl jadi tempat_lahir dan tanggal_lahir
        $ttl = explode(', ', $mahasiswa->ttl);
        $tempat_lahir = $ttl[0] ?? '';
        $tanggal_lahir = $ttl[1] ?? '';

        return view('mahasiswa.edit', compact('mahasiswa', 'tempat_lahir', 'tanggal_lahir'));
    }

    /**
     * Menyimpan update profil mahasiswa.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'semester' => 'required|integer|min:1|max:14',
            'prodi' => 'required|string|max:100',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Gabungkan TTL
        $validated['ttl'] = $validated['tempat_lahir'] . '. ' . $validated['tanggal_lahir'];
        unset($validated['tempat_lahir'], $validated['tanggal_lahir']);

        // Update email di tabel users
        $user->email = $validated['email'];
        $user->save();

        // Simpan email juga di tabel mahasiswa (jika memang ada kolom email di tabel mahasiswa)
        $validated['email'] = $user->email;

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFoto = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('uploads/foto'), $namaFoto);
            // Hapus foto lama jika ada
            if ($mahasiswa->foto && file_exists(public_path('uploads/foto/' . $mahasiswa->foto))) {
                @unlink(public_path('uploads/foto/' . $mahasiswa->foto));
            }
            $validated['foto'] = $namaFoto;
        }

        // Update data mahasiswa
        $mahasiswa->update($validated);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function show()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        return view('mahasiswa.profile', compact('mahasiswa'));
    }

}
