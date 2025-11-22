<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">

    <!-- Sidebar -->
    <aside class="fixed top-0 left-0 w-64 h-screen bg-gradient-to-b from-gray-900 to-gray-800 text-white shadow-2xl z-50 flex flex-col">
        
        <!-- Header -->
        <div class="p-6 border-b border-gray-700">
            <h1 class="text-2xl font-bold tracking-wide">ADMIN PANEL</h1>
            <p class="text-xs text-gray-400 mt-1">Management System</p>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 py-6 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-6 py-3.5 hover:bg-gray-700/50 transition-all duration-200 border-l-4 
               {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700/70 border-blue-500' : 'border-transparent' }}">
                <span class="text-xl">📊</span>
                <span class="font-medium">Dashboard</span>
            </a>

            <a href="{{ route('products.index') }}"
               class="flex items-center gap-3 px-6 py-3.5 hover:bg-gray-700/50 transition-all duration-200 border-l-4 
               {{ request()->routeIs('products.*') ? 'bg-gray-700/70 border-blue-500' : 'border-transparent' }}">
                <span class="text-xl">🛒</span>
                <span class="font-medium">Produk</span>
            </a>

            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-3 px-6 py-3.5 hover:bg-gray-700/50 transition-all duration-200 border-l-4 border-transparent">
                <span class="text-xl">👤</span>
                <span class="font-medium">Profile</span>
            </a>
        </nav>

        <!-- Logout Button -->
        <div class="p-4 border-t border-gray-700">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" 
                        class="flex items-center justify-center gap-3 w-full px-6 py-3 bg-red-600 hover:bg-red-700 rounded-lg transition-all duration-200 font-medium shadow-lg hover:shadow-xl">
                    <span class="text-lg">🚪</span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 min-h-screen">
        
        <!-- Top Bar -->
        <div class="bg-white shadow-sm border-b border-gray-200 px-8 py-4 sticky top-0 z-40">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h2>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-600">{{ now()->isoFormat('dddd, D MMMM Y') }}</span>
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold shadow">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="p-8">
            @yield('content')
        </div>
    </main>

</body>
</html>