<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-tr from-blue-900 to-indigo-900 min-h-screen flex items-center justify-center">

    <div class="bg-white/10 backdrop-blur-md p-8 rounded-2xl shadow-xl w-full max-w-md border border-white/20">
        <h2 class="text-3xl font-bold text-white text-center mb-6">Login Mahasiswa</h2>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('mahasiswa.login') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-white text-sm mb-1" for="email">Email</label>
                <input type="email" id="email" name="email" required
                    class="w-full px-4 py-2 rounded-lg bg-white/20 text-white border border-white/30 focus:outline-none focus:ring-2 focus:ring-white/40 placeholder-white/60"
                    placeholder="email@student.ac.id">
            </div>

            <div class="mb-6">
                <label class="block text-white text-sm mb-1" for="password">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2 rounded-lg bg-white/20 text-white border border-white/30 focus:outline-none focus:ring-2 focus:ring-white/40 placeholder-white/60"
                    placeholder="********">
            </div>

            <button type="submit"
                class="w-full py-2 bg-white/20 text-white font-semibold rounded-lg hover:bg-white/30 transition">
                Masuk
            </button>
        </form>

        <p class="text-white text-center text-sm mt-6">
            Belum punya akun?
            <a href="{{ route('mahasiswa.register') }}" class="underline hover:text-blue-300">Daftar di sini</a>
        </p>
    </div>

</body>
</html>