<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard - Klandest')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50">

    <!-- Sidebar -->
    <aside class="fixed top-0 left-0 w-72 h-screen bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900 text-white shadow-2xl z-50 flex flex-col border-r border-slate-700">
        
        <!-- Header -->
        <div class="p-6 border-b border-slate-700">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-cog text-lg"></i>
                </div>
                <h1 class="text-xl font-bold tracking-tight">KLANDEST</h1>
            </div>
            <p class="text-xs text-slate-400">Admin Dashboard</p>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 py-8 overflow-y-auto space-y-2 px-3">
            
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-4 px-4 py-3.5 rounded-lg transition-all duration-200 font-medium
               {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                <i class="fas fa-chart-line text-lg w-5"></i>
                <span>Dashboard</span>
                @if(request()->routeIs('admin.dashboard'))
                <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                @endif
            </a>

            <!-- Products -->
            <a href="{{ route('products.index') }}"
               class="flex items-center gap-4 px-4 py-3.5 rounded-lg transition-all duration-200 font-medium
               {{ request()->routeIs('products.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                <i class="fas fa-box text-lg w-5"></i>
                <span>Produk</span>
                @if(request()->routeIs('products.*'))
                <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                @endif
            </a>

            <!-- kategori -->
            <a href="{{ route('kategori.index') }}"
               class="flex items-center gap-4 px-4 py-3.5 rounded-lg transition-all duration-200 font-medium
               {{ request()->routeIs('kategori.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                <i class="fas fa-box text-lg w-5"></i>
                <span>Kategori</span>
                @if(request()->routeIs('kategori.*'))
                <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                @endif
            </a>

            <!-- Orders -->
            <a href="{{ route('orders.index') }}"
            class="flex items-center gap-4 px-4 py-3.5 rounded-lg transition-all duration-200 font-medium
            {{ request()->routeIs('orders.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                <i class="fas fa-receipt text-lg w-5"></i>
                <span>Pesanan</span>
                @if(request()->routeIs('orders.*'))
                <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                @endif
            </a>

            <!-- contact -->
            <a href="{{ route('contact.index') }}"
            class="flex items-center gap-4 px-4 py-3.5 rounded-lg transition-all duration-200 font-medium
            {{ request()->routeIs('contact.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                <i class="fas fa-receipt text-lg w-5"></i>
                <span>Kontak</span>
                @if(request()->routeIs('contact.*'))
                <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                @endif
            </a>

            <!-- Settings -->
            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-4 px-4 py-3.5 rounded-lg transition-all duration-200 font-medium
               {{ request()->routeIs('profile.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                <i class="fas fa-sliders-h text-lg w-5"></i>
                <span>Pengaturan</span>
                @if(request()->routeIs('profile.*'))
                <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                @endif
            </a>
        </nav>

        <!-- Footer -->
        <div class="p-4 border-t border-slate-700 space-y-3">
            <!-- User Info -->
            <div class="flex items-center gap-3 px-2 py-2">
                <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-blue-500 rounded-lg flex items-center justify-center text-white font-bold text-sm shadow">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <!-- Logout Button -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" 
                        class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-all duration-200 font-medium shadow-md hover:shadow-lg">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="ml-72 min-h-screen">
        
        <!-- Top Bar -->
        <div class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-40">
            <div class="px-8 py-5 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">@yield('title', 'Dashboard')</h2>
                    <p class="text-sm text-gray-500 mt-1">
                        <i class="far fa-calendar-alt mr-1"></i>
                        {{ now()->isoFormat('dddd, D MMMM Y') }}
                    </p>
                </div>
                
                <div class="flex items-center gap-6">

                    <!-- User Dropdown -->
                    <div class="flex items-center gap-3 pl-6 border-l border-gray-200">
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">Administrator</p>
                        </div>
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-blue-600 rounded-lg flex items-center justify-center text-white font-bold shadow">
                            {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="p-8">
            <!-- Alerts -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-exclamation-circle text-red-600 mt-0.5"></i>
                        <div>
                            <h3 class="font-semibold text-red-900">Terjadi Kesalahan</h3>
                            <ul class="mt-2 space-y-1 text-sm text-red-800">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle text-green-600"></i>
                        <span class="text-green-900 font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

</body>
</html>