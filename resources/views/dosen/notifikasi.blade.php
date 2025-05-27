{{-- filepath: resources/views/dosen/notifikasi.blade.php --}}
@extends('layouts.dosen')
@section('title', 'Notifikasi & Riwayat')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Notifikasi & Riwayat</h3>
    @if($notifikasi->isEmpty())
        <div class="alert alert-info">Tidak ada notifikasi atau riwayat terbaru.</div>
    @else
    <ul class="list-group">
        @foreach($notifikasi as $notif)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{ $notif->pesan }}</span>
                <span class="badge bg-secondary">{{ \Carbon\Carbon::parse($notif->created_at)->format('d-m-Y H:i') }}</span>
            </li>
        @endforeach
    </ul>
    @endif
</div>
@endsection
