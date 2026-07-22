<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - AmikomEventHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-indigo-900 text-white min-h-screen flex items-center justify-center p-6">

    <div class="max-w-md w-full bg-white text-slate-900 rounded-[2rem] p-8 shadow-2xl">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-indigo-600 rounded-2xl flex items-center justify-center text-white font-bold text-2xl mx-auto mb-4">AH</div>
            <h1 class="text-2xl font-black">Admin Login</h1>
            <p class="text-slate-500">AmikomEventHub Dashboard</p>
        </div>

        {{-- Pesan error dari session --}}
        @if(session('error'))
            <div class="bg-red-100 text-red-600 p-4 rounded-xl mb-6 font-bold text-sm text-center">
                {{ session('error') }}
            </div>
        @endif

        {{-- Pesan error email/password salah --}}
        @if($errors->any())
            <div class="bg-red-100 text-red-600 p-4 rounded-xl mb-6 font-bold text-sm text-center">
                {{ $errors->first('email') }}
            </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium"
                    required
                >
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Password</label>
                <input
                    type="password"
                    name="password"
                    class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium"
                    required
                >
            </div>

            <button type="submit"
                class="w-full py-4 bg-indigo-600 text-white rounded-2xl font-black text-xl shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition">
                Masuk
            </button>
        </form>

        {{-- Tombol Login Google SSO --}}
        <div class="mt-4 text-center">
            <a href="{{ route('google.login') }}" class="w-full py-4 bg-red-600 text-white rounded-2xl font-bold text-lg shadow-lg shadow-red-100 hover:bg-red-700 transition flex items-center justify-center gap-3" style="text-decoration: none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                  <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-7.481h-2.722v-2.9h5.515z"/>
                </svg>
                <span>Masuk dengan Google</span>
            </a>
        </div>
    </div>

</body>
</html>