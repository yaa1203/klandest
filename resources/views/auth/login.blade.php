<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Klandest</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">

    <div class="min-h-screen flex items-center justify-center px-4 py-8 md:py-12">
        <div class="w-full max-w-md">
            
            <!-- Header -->
            <div class="text-center mb-6 md:mb-8">
                <a href="/" class="inline-block mb-3 md:mb-4">
                    <img src="{{ asset('asset/img/IMG-20251123-WA0003-removebg-preview.png') }}" 
                         alt="Klandest Logo" 
                         class="h-20 md:h-24 mx-auto object-contain">
                </a>
                <h1 class="text-2xl md:text-3xl font-bold text-black mb-2">Selamat Datang Kembali</h1>
                <p class="text-sm md:text-base text-gray-600">Masuk ke akun Klandest Anda</p>
            </div>

            <!-- Card -->
            <div class="bg-white rounded-xl md:rounded-2xl shadow-lg border border-gray-200 p-6 md:p-8">

                <!-- Session Status -->
                @if ($errors->any())
                    <div class="mb-4 md:mb-5 p-3 md:p-4 bg-red-50 border-2 border-red-200 rounded-lg">
                        <div class="flex items-start gap-2">
                            <i class="fas fa-exclamation-circle text-red-600 mt-0.5"></i>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-red-800 mb-1">Login Gagal</p>
                                @foreach ($errors->all() as $error)
                                    <p class="text-xs md:text-sm text-red-700">• {{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('status'))
                    <div class="mb-4 md:mb-5 p-3 md:p-4 bg-green-50 border-2 border-green-200 rounded-lg">
                        <div class="flex items-start gap-2">
                            <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                            <p class="text-xs md:text-sm text-green-700">{{ session('status') }}</p>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4 md:space-y-5">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm md:text-base font-semibold text-gray-900 mb-2">
                            <i class="fas fa-envelope text-gray-400 mr-1"></i>
                            Email
                        </label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus 
                            autocomplete="username"
                            class="w-full px-4 py-2.5 md:py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-black focus:ring-2 focus:ring-black/10 transition-all text-sm md:text-base"
                            placeholder="nama@email.com"
                        >
                        @error('email')
                            <p class="mt-1.5 text-xs md:text-sm text-red-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm md:text-base font-semibold text-gray-900 mb-2">
                            <i class="fas fa-lock text-gray-400 mr-1"></i>
                            Password
                        </label>
                        <div class="relative">
                            <input 
                                id="password" 
                                type="password" 
                                name="password" 
                                required 
                                autocomplete="current-password"
                                class="w-full px-4 py-2.5 md:py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-black focus:ring-2 focus:ring-black/10 transition-all text-sm md:text-base pr-12"
                                placeholder="••••••••"
                            >
                            <button 
                                type="button" 
                                onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
                            >
                                <i id="toggleIcon" class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1.5 text-xs md:text-sm text-red-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Login Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-black text-white py-3 md:py-3.5 rounded-lg font-bold hover:bg-gray-800 transition-all duration-200 shadow-md hover:shadow-lg text-sm md:text-base flex items-center justify-center gap-2"
                    >
                        <span>Masuk</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <!-- Divider -->
                <div class="my-5 md:my-6 flex items-center">
                    <div class="flex-1 border-t border-gray-300"></div>
                    <span class="px-3 md:px-4 text-xs md:text-sm text-gray-500 font-medium">atau</span>
                    <div class="flex-1 border-t border-gray-300"></div>
                </div>

                <!-- Register Link -->
                <div class="text-center">
                    <p class="text-sm md:text-base text-gray-600 mb-3">
                        Belum punya akun?
                    </p>
                    <a 
                        href="{{ route('register') }}" 
                        class="inline-flex items-center justify-center gap-2 w-full border-2 border-black text-black px-6 py-2.5 md:py-3 rounded-lg font-bold hover:bg-gray-50 transition-all duration-200 text-sm md:text-base"
                    >
                        <i class="fas fa-user-plus"></i>
                        <span>Daftar Sekarang</span>
                    </a>
                </div>

                <!-- Back to Home -->
                <div class="mt-4 md:mt-5 text-center">
                    <a 
                        href="/" 
                        class="inline-flex items-center gap-2 text-xs md:text-sm text-gray-600 hover:text-black transition-colors font-medium"
                    >
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali ke Beranda</span>
                    </a>
                </div>
            </div>

            <!-- Footer -->
            <p class="text-center text-xs md:text-sm text-gray-500 mt-6 md:mt-8">
                © {{ date('Y') }} KLANDEST — Hidden But Loud. All rights reserved.
            </p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>

</body>
</html> 