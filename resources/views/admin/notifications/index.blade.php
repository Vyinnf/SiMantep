@extends('layouts.admin')

@section('title', 'Daftar Notifikasi')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Daftar Notifikasi</h3>

    @if($notifikasi->isEmpty())
        <div class="alert alert-info">
            Belum ada notifikasi saat ini.
        </div>
    @else
        <div class="list-group">
            @foreach($notifikasi as $notif)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1 {{ $notif->is_read ? 'text-muted' : '' }}">
                            {{ $notif->pesan }}
                        </p>
                        <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                    </div>
                    <div class="d-flex gap-2">
                        @if(!$notif->is_read)
                        <form action="{{ route('admin.notifications.markAsRead', $notif->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-sm btn-success">Tandai Telah Dibaca</button>
                        </form>
                        @endif
                        <form action="{{ route('admin.notifications.destroy', $notif->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus notifikasi ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
