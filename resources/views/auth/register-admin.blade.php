<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Admin - Klandest</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @media (min-width: 768px) {
            .left-section {
                max-height: 100vh;
                overflow-y: auto;
            }
            .right-section {
                position: fixed;
                right: 0;
                top: 0;
                height: 100vh;
                width: 50%;
            }
        }
    </style>
</head>
<body class="bg-gray-50">

    <div class="flex flex-col md:flex-row min-h-screen">
        
        <!-- Left Section - Admin Register Form (Scrollable) -->
        <div class="w-full md:w-1/2 left-section">
            <div class="flex items-center justify-center px-4 py-8 md:py-12 md:min-h-screen">
                <div class="w-full max-w-md">
                    
                    <!-- Header -->
                    <div class="text-center mb-6 md:mb-8">
                        <a href="/" class="flex mb-3 md:mb-4">
                            <img src="{{ asset('asset/img/IMG-20251123-WA0003-removebg-preview.png') }}" 
                                 alt="Klandest Logo" 
                                 class="h-20 md:h-24 mx-auto object-contain">
                        </a>
                        <div class="inline-flex items-center gap-2 bg-purple-100 px-4 py-2 rounded-full mb-3">
                            <i class="fas fa-user-shield text-purple-600"></i>
                            <span class="text-sm font-bold text-purple-700">ADMIN REGISTRATION</span>
                        </div>
                        <h1 class="text-2xl md:text-3xl font-bold text-black mb-2">Daftar sebagai Admin</h1>
                        <p class="text-sm md:text-base text-gray-600">Buat akun administrator untuk Klandest</p>
                    </div>

                    <!-- Card -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg border-2 border-purple-200 p-6 md:p-8">

                        <!-- Error Messages -->
                        @if ($errors->any())
                            <div class="mb-4 md:mb-5 p-3 md:p-4 bg-red-50 border-2 border-red-200 rounded-lg">
                                <div class="flex items-start gap-2">
                                    <i class="fas fa-exclamation-circle text-red-600 mt-0.5"></i>
                                    <div class="flex-1">
                                        <p class="text-sm font-bold text-red-800 mb-1">Registrasi Gagal</p>
                                        @foreach ($errors->all() as $error)
                                            <p class="text-xs md:text-sm text-red-700">• {{ $error }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Success Message -->
                        @if (session('status'))
                            <div class="mb-4 md:mb-5 p-3 md:p-4 bg-green-50 border-2 border-green-200 rounded-lg">
                                <div class="flex items-start gap-2">
                                    <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                                    <p class="text-xs md:text-sm text-green-700">{{ session('status') }}</p>
                                </div>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.register.store') }}" class="space-y-4 md:space-y-5">
                            @csrf

                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm md:text-base font-semibold text-gray-900 mb-2">
                                    <i class="fas fa-user text-purple-400 mr-1"></i>
                                    Nama Lengkap
                                </label>
                                <input 
                                    id="name" 
                                    type="text" 
                                    name="name" 
                                    value="{{ old('name') }}" 
                                    required 
                                    autofocus
                                    autocomplete="name"
                                    class="w-full px-4 py-2.5 md:py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-500/10 transition-all text-sm md:text-base"
                                    placeholder="Masukkan nama lengkap"
                                >
                                @error('name')
                                    <p class="mt-1.5 text-xs md:text-sm text-red-600 flex items-center gap-1">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div>
                                <label for="email" class="block text-sm md:text-base font-semibold text-gray-900 mb-2">
                                    <i class="fas fa-envelope text-purple-400 mr-1"></i>
                                    Email Admin
                                </label>
                                <input 
                                    id="email" 
                                    type="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required
                                    autocomplete="username"
                                    class="w-full px-4 py-2.5 md:py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-500/10 transition-all text-sm md:text-base"
                                    placeholder="admin@email.com"
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
                                    <i class="fas fa-lock text-purple-400 mr-1"></i>
                                    Password
                                </label>
                                <div class="relative">
                                    <input 
                                        id="password" 
                                        type="password" 
                                        name="password" 
                                        required
                                        autocomplete="new-password"
                                        class="w-full px-4 py-2.5 md:py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-500/10 transition-all text-sm md:text-base pr-12"
                                        placeholder="Minimal 8 karakter"
                                    >
                                    <button 
                                        type="button" 
                                        onclick="togglePassword('password', 'toggleIcon1')"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-purple-600 transition-colors"
                                    >
                                        <i id="toggleIcon1" class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="mt-1.5 text-xs md:text-sm text-red-600 flex items-center gap-1">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="block text-sm md:text-base font-semibold text-gray-900 mb-2">
                                    <i class="fas fa-lock text-purple-400 mr-1"></i>
                                    Konfirmasi Password
                                </label>
                                <div class="relative">
                                    <input 
                                        id="password_confirmation" 
                                        type="password" 
                                        name="password_confirmation" 
                                        required
                                        autocomplete="new-password"
                                        class="w-full px-4 py-2.5 md:py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-500/10 transition-all text-sm md:text-base pr-12"
                                        placeholder="Ketik ulang password"
                                    >
                                    <button 
                                        type="button" 
                                        onclick="togglePassword('password_confirmation', 'toggleIcon2')"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-purple-600 transition-colors"
                                    >
                                        <i id="toggleIcon2" class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('password_confirmation')
                                    <p class="mt-1.5 text-xs md:text-sm text-red-600 flex items-center gap-1">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="flex items-start gap-2">
                                <input 
                                    id="terms" 
                                    type="checkbox" 
                                    required
                                    class="w-4 h-4 mt-0.5 border-2 border-gray-300 rounded cursor-pointer text-purple-600 focus:ring-purple-500"
                                >
                                <label for="terms" class="text-xs md:text-sm text-gray-700 leading-relaxed">
                                    Saya memahami tanggung jawab sebagai Admin dan menyetujui 
                                    <a href="#" class="text-purple-600 font-medium hover:underline">Syarat & Ketentuan</a> 
                                    serta 
                                    <a href="#" class="text-purple-600 font-medium hover:underline">Kebijakan Privasi</a>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button 
                                type="submit" 
                                class="w-full bg-gradient-to-r from-purple-600 to-purple-700 text-white py-3 md:py-3.5 rounded-lg font-bold hover:from-purple-700 hover:to-purple-800 transition-all duration-200 shadow-md hover:shadow-lg text-sm md:text-base flex items-center justify-center gap-2"
                            >
                                <i class="fas fa-user-shield"></i>
                                <span>Daftar sebagai Admin</span>
                            </button>
                        </form>

                        <!-- Divider -->
                        <div class="my-5 md:my-6 flex items-center">
                            <div class="flex-1 border-t border-gray-300"></div>
                            <span class="px-3 md:px-4 text-xs md:text-sm text-gray-500 font-medium">atau</span>
                            <div class="flex-1 border-t border-gray-300"></div>
                        </div>

                        <!-- User Registration Link -->
                        <div class="text-center mb-3">
                            <p class="text-sm md:text-base text-gray-600 mb-3">
                                Ingin daftar sebagai user biasa?
                            </p>
                            <a 
                                href="{{ route('register') }}" 
                                class="inline-flex items-center justify-center gap-2 w-full border-2 border-gray-400 text-gray-700 px-6 py-2.5 md:py-3 rounded-lg font-bold hover:bg-gray-50 transition-all duration-200 text-sm md:text-base"
                            >
                                <i class="fas fa-user"></i>
                                <span>Daftar sebagai User</span>
                            </a>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center">
                            <p class="text-sm md:text-base text-gray-600 mb-3">
                                Sudah punya akun admin?
                            </p>
                            <a 
                                href="{{ route('login') }}" 
                                class="inline-flex items-center justify-center gap-2 w-full border-2 border-black text-black px-6 py-2.5 md:py-3 rounded-lg font-bold hover:bg-gray-50 transition-all duration-200 text-sm md:text-base"
                            >
                                <i class="fas fa-sign-in-alt"></i>
                                <span>Masuk</span>
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
        </div>

        <!-- Right Section - Admin Hero/Info (Fixed on Desktop) -->
        <div class="hidden md:block md:w-1/2 right-section bg-gradient-to-br from-purple-900 via-purple-800 to-indigo-900">
            <div class="flex flex-col items-center justify-center h-full p-12 text-white">
                
                <!-- Decorative Element -->
                <div class="mb-8 relative">
                    <div class="absolute inset-0 bg-purple-400/20 blur-3xl rounded-full"></div>
                    <i class="fas fa-crown text-8xl relative z-10 opacity-90 text-yellow-300"></i>
                </div>

                <!-- Main Content -->
                <div class="text-center max-w-lg space-y-6">
                    <h2 class="text-4xl font-bold leading-tight">
                        Admin <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-purple-200">Access</span>
                    </h2>
                    
                    <p class="text-lg text-purple-200 leading-relaxed">
                        Dapatkan kendali penuh untuk mengelola platform Klandest dengan hak akses administrator.
                    </p>

                    <!-- Features -->
                    <div class="space-y-4 pt-6">
                        <div class="flex items-start gap-4 text-left">
                            <div class="flex-shrink-0 w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center">
                                <i class="fas fa-chart-line text-yellow-300"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-white mb-1">Dashboard Lengkap</h3>
                                <p class="text-sm text-purple-200">Akses ke semua data dan analytics real-time</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 text-left">
                            <div class="flex-shrink-0 w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center">
                                <i class="fas fa-users-cog text-yellow-300"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-white mb-1">Kelola Pengguna</h3>
                                <p class="text-sm text-purple-200">Kontrol penuh atas manajemen user dan permissions</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 text-left">
                            <div class="flex-shrink-0 w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center">
                                <i class="fas fa-shield-halved text-yellow-300"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-white mb-1">Keamanan Tingkat Tinggi</h3>
                                <p class="text-sm text-purple-200">Two-factor authentication dan audit logs</p>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Badge -->
                    <div class="pt-8 border-t border-white/10">
                        <div class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-sm px-6 py-3 rounded-full">
                            <i class="fas fa-badge-check text-yellow-300 text-xl"></i>
                            <div class="text-left">
                                <div class="text-xs text-purple-200">Status</div>
                                <div class="text-sm font-bold text-white">Administrator Access</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Quote -->
                <div class="mt-12 pt-8 border-t border-white/10">
                    <p class="text-sm text-purple-200 italic">
                        "With great power comes great responsibility"
                    </p>
                </div>
            </div>
        </div>

    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(iconId);
            
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