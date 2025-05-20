<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Dosen - SiMantep</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/dosen-login.css') }}" rel="stylesheet">
</head>
<body>
    <div class="login-box">
        <h3 class="login-title text-center">Login Dosen</h3>
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
        <a href="{{ url('/') }}" class="btn btn-link w-100 mt-3">← Kembali ke Beranda</a>
    </div>
</body>
</html>
