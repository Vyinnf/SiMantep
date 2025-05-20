@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width:400px">
    <h3 class="mb-4">Login Dosen</h3>
    <form method="POST" action="{{ route('dosen.login.submit') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email Dosen</label>
            <input type="email" class="form-control" id="email" name="email" required autofocus>
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>
@endsection
