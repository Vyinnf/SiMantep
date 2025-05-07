<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Lupa Password</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('assets/css/forgot-password.css') }}">
</head>
<body>
  <div class="forgot-container">
    <form method="POST" action="{{ route('password.email') }}" class="forgot-form">
      @csrf
      <h2 class="title">Lupa Password</h2>
      <p class="subtitle">Masukkan email Anda dan kami akan kirimkan link reset password.</p>
      
      <input type="email" name="email" placeholder="Email" required class="input" />

      <button type="submit" class="submit-btn">Kirim Link</button>

      <a href="{{ url('/login/mahasiswa') }}" class="back-link">← Kembali ke Login</a>
    </form>
  </div>
</body>
</html>
