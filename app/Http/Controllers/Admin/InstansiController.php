<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    public function index()
    {
        $instansi = Instansi::all();
        return view('admin.instansi.index', compact('instansi'));
    }

    public function create()
    {
        return view('admin.instansi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'nullable|string|max:100',
        ]);

        Instansi::create($request->only('nama_instansi', 'alamat', 'kontak'));

        return redirect()->route('admin.instansi.index')->with('success', 'Instansi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $instansi = Instansi::findOrFail($id);
        return view('admin.instansi.edit', compact('instansi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:100',
        ]);

        $instansi = Instansi::findOrFail($id);
        $instansi->update($request->only('nama', 'alamat', 'kontak'));

        return redirect()->route('admin.instansi.index')->with('success', 'Instansi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $instansi = Instansi::findOrFail($id);
        $instansi->delete();

        return redirect()->route('admin.instansi.index')->with('success', 'Instansi berhasil dihapus.');
    }
}
