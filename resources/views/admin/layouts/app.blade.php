<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard - Klandest')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Sidebar Transition */
        .sidebar {
            transition: transform 0.3s ease-in-out;
        }
        @media (max-width: 1024px) {
            .sidebar.mobile-hidden {
                transform: translateX(-100%);
            }
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- Mobile Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 lg:hidden hidden"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar fixed top-0 left-0 w-72 h-screen bg-white text-gray-900 shadow-xl z-50 flex flex-col border-r border-gray-200">
        
        <!-- Header -->
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-900 to-gray-800">
            <div class="flex items-center justify-between mb-2">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-lg">
                        <i class="fas fa-store text-lg text-gray-900"></i>
                    </div>
                    <h1 class="text-xl font-bold tracking-tight text-white">KLANDEST</h1>
                </div>
                <!-- Mobile Close Button -->
                <button id="close-sidebar" class="lg:hidden w-8 h-8 flex items-center justify-center text-white hover:bg-white/10 rounded-lg transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <p class="text-xs text-gray-300">Admin Dashboard</p>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 py-6 overflow-y-auto px-4 space-y-1">
            
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 font-medium group
               {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900 text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-gray-200' }}">
                    <i class="fas fa-chart-line text-sm {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-gray-700' }}"></i>
                </div>
                <span class="flex-1">Dashboard</span>
                @if(request()->routeIs('admin.dashboard'))
                <div class="w-1.5 h-1.5 bg-green-400 rounded-full"></div>
                @endif
            </a>

            <!-- Products -->
            <a href="{{ route('products.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 font-medium group
               {{ request()->routeIs('products.*') ? 'bg-gray-900 text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('products.*') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-gray-200' }}">
                    <i class="fas fa-box text-sm {{ request()->routeIs('products.*') ? 'text-white' : 'text-gray-700' }}"></i>
                </div>
                <span class="flex-1">Produk</span>
                @if(request()->routeIs('products.*'))
                <div class="w-1.5 h-1.5 bg-green-400 rounded-full"></div>
                @endif
            </a>

            <!-- Contact -->
            <a href="{{ route('contact.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 font-medium group
            {{ request()->routeIs('contact.*') ? 'bg-gray-900 text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('contact.*') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-gray-200' }}">
                    <i class="fas fa-envelope text-sm {{ request()->routeIs('contact.*') ? 'text-white' : 'text-gray-700' }}"></i>
                </div>
                <span class="flex-1">Kontak</span>
                @if(request()->routeIs('contact.*'))
                <div class="w-1.5 h-1.5 bg-green-400 rounded-full"></div>
                @endif
            </a>

            <!-- Divider -->
            <div class="my-4 border-t border-gray-200"></div>

            <!-- Settings -->
            <a href="{{ route('settings.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 font-medium group
               {{ request()->routeIs('settings.*') ? 'bg-gray-900 text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('settings.*') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-gray-200' }}">
                    <i class="fas fa-cog text-sm {{ request()->routeIs('settings.*') ? 'text-white' : 'text-gray-700' }}"></i>
                </div>
                <span class="flex-1">Pengaturan</span>
                @if(request()->routeIs('settings.*'))
                <div class="w-1.5 h-1.5 bg-green-400 rounded-full"></div>
                @endif
            </a>

            <!-- profile -->
            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 font-medium group
               {{ request()->routeIs('profile.*') ? 'bg-gray-900 text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('profile.*') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-gray-200' }}">
                    <i class="fas fa-cog text-sm {{ request()->routeIs('profile.*') ? 'text-white' : 'text-gray-700' }}"></i>
                </div>
                <span class="flex-1">Pengaturan</span>
                @if(request()->routeIs('profile.*'))
                <div class="w-1.5 h-1.5 bg-green-400 rounded-full"></div>
                @endif
            </a>
        </nav>

        <!-- Footer -->
        <div class="p-4 border-t border-gray-200 bg-gray-50 space-y-3">
            <!-- User Info -->
            <div class="flex items-center gap-3 px-3 py-2 bg-white rounded-lg border border-gray-200">
                <div class="w-10 h-10 bg-gradient-to-br from-gray-800 to-gray-900 rounded-lg flex items-center justify-center text-white font-bold text-sm shadow-md">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <!-- Logout Button -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" 
                        class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-gray-900 hover:bg-gray-800 text-white rounded-lg transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                    <i class="fas fa-sign-out-alt text-sm"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="lg:ml-72 min-h-screen">
        
        <!-- Top Bar -->
        <div class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30">
            <div class="px-4 sm:px-6 lg:px-8 py-4 sm:py-5 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" class="lg:hidden w-10 h-10 flex items-center justify-center text-gray-700 hover:bg-gray-100 rounded-lg transition">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                    
                    <div>
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h2>
                        <p class="text-xs sm:text-sm text-gray-500 mt-1 hidden sm:block">
                            <i class="far fa-calendar-alt mr-1"></i>
                            {{ now()->isoFormat('dddd, D MMMM Y') }}
                        </p>
                    </div>
                </div>
                
                <!-- Desktop User Info -->
                <div class="hidden sm:flex items-center gap-4">
                    <div class="flex items-center gap-3 pl-4 border-l border-gray-200">
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">Administrator</p>
                        </div>
                        <div class="w-10 h-10 bg-gradient-to-br from-gray-800 to-gray-900 rounded-lg flex items-center justify-center text-white font-bold shadow-md">
                            {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                        </div>
                    </div>
                </div>

                <!-- Mobile User Avatar -->
                <div class="sm:hidden w-10 h-10 bg-gradient-to-br from-gray-800 to-gray-900 rounded-lg flex items-center justify-center text-white font-bold shadow-md">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="p-4 sm:p-6 lg:p-8">
            <!-- Alerts -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-600"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-red-900 mb-1">Terjadi Kesalahan</h3>
                            <ul class="space-y-1 text-sm text-red-800">
                                @foreach ($errors->all() as $error)
                                    <li class="flex items-start gap-2">
                                        <span class="text-red-600 mt-0.5">•</span>
                                        <span>{{ $error }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-check-circle text-green-600"></i>
                        </div>
                        <span class="text-green-900 font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-600"></i>
                        </div>
                        <span class="text-red-900 font-medium">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script>
        // Mobile Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const closeSidebarBtn = document.getElementById('close-sidebar');

        function openSidebar() {
            sidebar.classList.remove('mobile-hidden');
            sidebarOverlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.add('mobile-hidden');
            sidebarOverlay.classList.add('hidden');
            document.body.style.overflow = '';
        }

        mobileMenuBtn?.addEventListener('click', openSidebar);
        closeSidebarBtn?.addEventListener('click', closeSidebar);
        sidebarOverlay?.addEventListener('click', closeSidebar);

        // Close sidebar on window resize to desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                closeSidebar();
            }
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('[class*="bg-green-50"], [class*="bg-red-50"]');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.3s ease-out';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);
    </script>

</body>
</html> 