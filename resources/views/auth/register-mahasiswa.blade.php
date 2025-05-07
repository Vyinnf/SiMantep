<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register Mahasiswa</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/register-mahasiswa.css') }}">
</head>
<body>
  <div class="register-container">
    <form method="POST" action="{{ route('mahasiswa.register.submit') }}" class="register-form">
      @csrf

      <h2 class="title">Registrasi Mahasiswa</h2>
      <p class="subtitle">Silakan isi data Anda untuk membuat akun.</p>

      <input type="text" name="name" placeholder="Nama Lengkap" required class="input" value="{{ old('name') }}">
      @error('name')<small class="error">{{ $message }}</small>@enderror

      <input type="email" name="email" placeholder="Email" required class="input" value="{{ old('email') }}">
      @error('email')<small class="error">{{ $message }}</small>@enderror

      <input type="password" name="password" placeholder="Password" required class="input">
      @error('password')<small class="error">{{ $message }}</small>@enderror

      <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required class="input">

      <button type="submit" class="submit-btn">Daftar</button>

      <a href="{{ route('mahasiswa.login.form') }}" class="back-link">← Sudah punya akun? Login</a>
    </form>
  </div>
</body>
</html>
