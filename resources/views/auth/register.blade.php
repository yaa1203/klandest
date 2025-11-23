<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar - Klandest</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">

    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md">

            <!-- Header -->
            <div class="text-center mb-8">
                <a href="/" class="text-3xl font-bold tracking-widest text-black inline-block mb-4">
                    KLANDEST
                </a>
                <p class="text-gray-600 text-sm">Buat akun baru Anda</p>
            </div>

            <!-- Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-sm text-red-700 font-medium">Daftar gagal</p>
                        @foreach ($errors->all() as $error)
                            <p class="text-xs text-red-600 mt-1">• {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Success Message (optional) -->
                @if (session('status'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <p class="text-sm text-green-700 font-medium">{{ session('status') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
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
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-black focus:ring-1 focus:ring-black transition-colors"
                            placeholder="Masukkan nama lengkap"
                        >
                        @error('name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email
                        </label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required
                            autocomplete="username"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-black focus:ring-1 focus:ring-black transition-colors"
                            placeholder="nama@email.com"
                        >
                        @error('email')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required
                            autocomplete="new-password"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-black focus:ring-1 focus:ring-black transition-colors"
                            placeholder="Minimal 8 karakter"
                        >
                        @error('password')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Password
                        </label>
                        <input 
                            id="password_confirmation" 
                            type="password" 
                            name="password_confirmation" 
                            required
                            autocomplete="new-password"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-black focus:ring-1 focus:ring-black transition-colors"
                            placeholder="Ketik ulang password"
                        >
                        @error('password_confirmation')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-black text-white py-2.5 rounded-lg font-medium hover:bg-gray-900 transition-colors duration-200"
                    >
                        Daftar Sekarang
                    </button>
                </form>

                <!-- Divider -->
                <div class="my-6 flex items-center">
                    <div class="flex-1 border-t border-gray-200"></div>
                    <span class="px-3 text-sm text-gray-500">atau</span>
                    <div class="flex-1 border-t border-gray-200"></div>
                </div>

                <!-- Login Link -->
                <p class="text-center text-sm text-gray-600">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="font-medium text-black hover:underline">
                        Masuk di sini
                    </a>
                </p>
            </div>

            <!-- Footer -->
            <p class="text-center text-xs text-gray-500 mt-6">
                © {{ date('Y') }} KLANDEST — Hidden But Loud
            </p>
        </div>
    </div>

</body>
</html>