<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifikasi; // Asumsi ada model Notifikasi

class AdminNotifikasiController extends Controller
{
    public function index()
    {
        $notifikasi = Notifikasi::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.notifications.index', compact('notifikasi'));
    }
    
    public function markAsRead($id)
    {
        $notif = Notifikasi::findOrFail($id);
        $notif->is_read = true;
        $notif->save();

        return redirect()->route('admin.notifications.index')->with('success', 'Notifikasi ditandai telah dibaca.');
    }

    public function destroy($id)
    {
        $notif = Notifikasi::findOrFail($id);
        $notif->delete();

        return redirect()->route('admin.notifications.index')->with('success', 'Notifikasi berhasil dihapus.');
    }
}
