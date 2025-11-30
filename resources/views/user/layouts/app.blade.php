<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Klandest - Premium Clothing Store')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    @stack('styles')
</head>
<body class="bg-white">

    <!-- NAVBAR -->
    <nav class="sticky top-0 z-50 bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex justify-between items-center h-20">

                <!-- Logo -->
                <a href="{{ Auth::check() ? url('user/dashboard') : url('/') }}" class="flex items-center flex-shrink-0">
                    <img src="{{ asset('asset/img/IMG-20251123-WA0003-removebg-preview.png') }}" 
                        alt="Klandest Logo" 
                        class="h-20 w-auto object-contain">
                </a>

                @auth
                <!-- Search Bar - Desktop (Only for logged in users) -->
                <div class="hidden lg:flex flex-1 max-w-xl mx-8">
                    <div class="relative w-full">
                        <input 
                            type="text" 
                            placeholder="Cari koleksi terbaru..." 
                            class="w-full px-4 py-3 pl-11 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:border-black focus:bg-white transition-all"
                        >
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>
                @endauth

                <!-- Nav Items -->
                <div class="flex items-center gap-6">
                    
                    @auth
                    <!-- Links - Desktop (Only for logged in users) -->
                    <div class="hidden lg:flex items-center gap-8">
                        <a href="{{ route('user.dashboard') }}" 
                           class="text-sm font-semibold text-gray-700 hover:text-black transition-colors relative group">
                            Home
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-black transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <a href="{{url('produk')}}" 
                           class="text-sm font-semibold text-gray-700 hover:text-black transition-colors relative group">
                            Produk
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-black transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <a href="{{ url('kontak') }}" 
                           class="text-sm font-semibold text-gray-700 hover:text-black transition-colors relative group">
                            Kontak
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-black transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    </div>

                    <!-- Icons (Only for logged in users) -->
                    <div class="flex items-center gap-2">
                        <!-- Search Mobile -->
                        <button class="lg:hidden p-2.5 hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-search text-lg text-black"></i>
                        </button>

                        <!-- Wishlist Icon -->
                        <a href="{{ route('wishlist.index') }}" 
                           class="relative p-2.5 hover:bg-gray-100 rounded-lg transition-all duration-200 group">
                            <i class="far fa-heart text-xl text-black group-hover:text-red-500 transition-colors"></i>
                            
                            @if(auth()->user()->wishlist()->count() > 0)
                                <span class="absolute -top-1 -right-1 min-w-[20px] h-5 px-1.5 bg-red-600 text-white text-xs font-bold rounded-full flex items-center justify-center shadow-lg border-2 border-white">
                                    {{ auth()->user()->wishlist()->count() }}
                                </span>
                            @endif

                            <span class="absolute -bottom-10 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs px-3 py-1.5 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none shadow-lg">
                                Wishlist 
                                @if(auth()->user()->wishlist()->count() > 0)
                                    ({{ auth()->user()->wishlist()->count() }})
                                @endif
                            </span>
                        </a>

                        <!-- Cart Icon -->
                        <a href="{{ route('cart.index') }}" 
                           class="relative p-2.5 hover:bg-gray-100 rounded-lg transition-all duration-200 group">
                            <i class="fas fa-shopping-bag text-xl text-black group-hover:scale-110 transition-transform"></i>
                            
                            @if(Cart::getTotalQuantity() > 0)
                                <span class="absolute -top-1 -right-1 min-w-[20px] h-5 px-1.5 bg-black text-white text-xs font-bold rounded-full flex items-center justify-center shadow-lg border-2 border-white">
                                    {{ Cart::getTotalQuantity() }}
                                </span>
                            @endif

                            <span class="absolute -bottom-10 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs px-3 py-1.5 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none shadow-lg">
                                Keranjang ({{ Cart::getTotalQuantity() }})
                            </span>
                        </a>

                        <!-- User Profile Dropdown (Logged In) - Desktop -->
                        <div class="hidden sm:flex items-center gap-3 ml-4 pl-4 border-l border-gray-200">
                            <div class="hidden md:flex flex-col">
                                <span class="text-sm font-semibold text-black">{{ Auth::user()->name }}</span>
                                <span class="text-xs text-gray-500">Member</span>
                            </div>
                            
                            <!-- Dropdown Button -->
                            <div class="relative">
                                <button onclick="toggleDropdown()" id="dropdownButton"
                                        class="w-10 h-10 bg-gradient-to-br from-gray-800 to-black rounded-full hover:shadow-lg transition-all flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </button>
                                
                                <!-- Dropdown Menu -->
                                <div id="dropdownMenu" 
                                     class="hidden absolute right-0 mt-3 w-64 bg-white border border-gray-200 rounded-xl shadow-2xl overflow-hidden z-50">
                                    
                                    <!-- Header -->
                                    <div class="bg-gradient-to-r from-black to-gray-900 text-white p-4">
                                        <p class="font-bold text-sm">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-gray-300 truncate">{{ Auth::user()->email }}</p>
                                    </div>
                                    
                                    <!-- Menu Items -->
                                    <div class="py-2">
                                        @if(Auth::user()->role === 'admin')
                                            <a href="{{ route('admin.dashboard') }}" 
                                               class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-cog text-purple-600"></i>
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-gray-900">Admin Dashboard</p>
                                                    <p class="text-xs text-gray-500">Kelola website</p>
                                                </div>
                                            </a>
                                        @endif
                                        
                                        <a href="/profile" 
                                           class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-user text-blue-600"></i>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-900">Profil Saya</p>
                                                <p class="text-xs text-gray-500">Edit informasi akun</p>
                                            </div>
                                        </a>
                                        
                                        <a href="{{ route('wishlist.index') }}" 
                                           class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                            <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-heart text-red-600"></i>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-900">Wishlist</p>
                                                <p class="text-xs text-gray-500">{{ auth()->user()->wishlist()->count() }} produk</p>
                                            </div>
                                        </a>
                                        
                                        <a href="{{ route('cart.index') }}" 
                                           class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-shopping-cart text-green-600"></i>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-900">Keranjang</p>
                                                <p class="text-xs text-gray-500">{{ Cart::getTotalQuantity() }} item</p>
                                            </div>
                                        </a>
                                    </div>
                                    
                                    <!-- Logout -->
                                    <div class="border-t border-gray-200">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" 
                                                    class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors font-semibold">
                                                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-sign-out-alt text-red-600"></i>
                                                </div>
                                                <span>Logout</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile Menu Button for Logged In Users -->
                        <button class="sm:hidden p-2.5 hover:bg-gray-100 rounded-lg transition-colors" onclick="toggleMobileMenu()">
                            <i class="fas fa-bars text-lg text-black"></i>
                        </button>
                    </div>
                    @endauth

                    @guest
                        <!-- Auth Buttons (Not Logged In) - Desktop -->
                        <div class="hidden sm:flex items-center gap-3 ml-2">
                            <a href="{{ route('login') }}" 
                               class="px-6 py-2.5 text-sm font-semibold text-black border-2 border-black rounded-lg hover:bg-gray-50 transition-all">
                                Login
                            </a>
                            <a href="{{ route('register') }}" 
                               class="px-6 py-2.5 text-sm font-semibold text-white bg-black rounded-lg hover:bg-gray-800 transition-all shadow-md hover:shadow-lg">
                                Daftar
                            </a>
                        </div>
                        
                        <!-- Mobile Menu Button for Guest -->
                        <button class="sm:hidden p-2.5 hover:bg-gray-100 rounded-lg transition-colors" onclick="toggleMobileMenu()">
                            <i class="fas fa-bars text-lg text-black"></i>
                        </button>
                    @endguest

                </div>

            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden lg:hidden border-t border-gray-200 bg-white">
            <div class="px-4 py-3 space-y-2">
                
                @auth
                <!-- Search Mobile (Only for logged in users) -->
                <div class="relative mb-3">
                    <input 
                        type="text" 
                        placeholder="Cari koleksi..." 
                        class="w-full px-4 py-2.5 pl-10 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-black"
                    >
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                </div>
                
                <!-- Links (Only for logged in users) -->
                <a href="{{ route('user.dashboard') }}" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg transition">
                    <i class="fas fa-home mr-2"></i>Home
                </a>
                <a href="{{url('produk')}}" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg transition">
                    <i class="fas fa-box mr-2"></i>Produk
                </a>
                <a href="{{ url('kontak') }}" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg transition">
                    <i class="fas fa-envelope mr-2"></i>Kontak
                </a>
                
                <hr class="my-2">
                <a href="/profile" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg transition">
                    <i class="fas fa-user mr-2"></i>Profil Saya
                </a>
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg transition">
                        <i class="fas fa-cog mr-2"></i>Admin Dashboard
                    </a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg transition">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </form>
                @endauth
                
                @guest
                <!-- Auth Buttons for Guest - Mobile -->
                <a href="{{ route('login') }}" class="block px-4 py-2.5 text-sm font-medium text-center bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </a>
                <a href="{{ route('register') }}" class="block px-4 py-2.5 text-sm font-medium text-center bg-black text-white hover:bg-gray-800 rounded-lg transition">
                    <i class="fas fa-user-plus mr-2"></i>Daftar
                </a>
                @endguest
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-white py-8 md:py-12 mt-12 md:mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8 mb-6 md:mb-8">
                <!-- About -->
                <div>
                    <h4 class="text-lg md:text-xl font-bold mb-3 md:mb-4">
                        <span class="text-xl md:text-2xl">KLANDEST</span>
                    </h4>
                    <p class="text-sm md:text-base text-gray-400 mb-3 md:mb-4">
                        Platform belanja online terpercaya dengan produk berkualitas dan harga terjangkau.
                    </p>
                    
                    <!-- Social Media Icons -->
                    <div class="flex gap-2 md:gap-3 mt-3 md:mt-4">
                        @if(setting('instagram_url'))
                        <a href="{{ setting('instagram_url') }}" target="_blank" 
                           class="w-8 h-8 md:w-9 md:h-9 bg-gray-800 hover:bg-pink-600 rounded-full flex items-center justify-center transition-all duration-300">
                            <i class="fab fa-instagram text-sm md:text-base"></i>
                        </a>
                        @endif
                        
                        @if(setting('tiktok_url'))
                        <a href="{{ setting('tiktok_url') }}" target="_blank" 
                           class="w-8 h-8 md:w-9 md:h-9 bg-gray-800 hover:bg-gray-700 rounded-full flex items-center justify-center transition-all duration-300">
                            <i class="fab fa-tiktok text-sm md:text-base"></i>
                        </a>
                        @endif
                        
                        @if(setting('facebook_url'))
                        <a href="{{ setting('facebook_url') }}" target="_blank" 
                           class="w-8 h-8 md:w-9 md:h-9 bg-gray-800 hover:bg-blue-600 rounded-full flex items-center justify-center transition-all duration-300">
                            <i class="fab fa-facebook-f text-sm md:text-base"></i>
                        </a>
                        @endif
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg md:text-xl font-bold mb-3 md:mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm md:text-base text-gray-400">
                        <li><a href="{{ route('user.dashboard') }}" class="hover:text-white transition flex items-center gap-2">
                            <i class="fas fa-home text-xs"></i> Home
                        </a></li>
                        <li><a href="{{ route('produk.index') }}" class="hover:text-white transition flex items-center gap-2">
                            <i class="fas fa-box text-xs"></i> Produk
                        </a></li>
                        <li><a href="{{ url('kontak') }}" class="hover:text-white transition flex items-center gap-2">
                            <i class="fas fa-envelope text-xs"></i> Kontak
                        </a></li>
                        @auth
                        <li><a href="{{ route('cart.index') }}" class="hover:text-white transition flex items-center gap-2">
                            <i class="fas fa-shopping-cart text-xs"></i> Keranjang
                        </a></li>
                        @endauth
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg md:text-xl font-bold mb-3 md:mb-4">Hubungi Kami</h4>
                    <ul class="space-y-2 md:space-y-3 text-sm md:text-base text-gray-400">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-envelope text-green-500 mt-1 text-xs md:text-sm"></i>
                            <a href="mailto:{{ setting('email', 'info@klandest.com') }}" class="hover:text-white transition break-all">
                                {{ setting('email', 'info@klandest.com') }}
                            </a>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fab fa-whatsapp text-green-500 mt-1 text-xs md:text-sm"></i>
                            <a href="https://wa.me/{{ setting('whatsapp_number', '6281234567890') }}" target="_blank" class="hover:text-white transition">
                                {{ setting('phone', '+62 812-3456-7890') }}
                            </a>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-map-marker-alt text-red-500 mt-1 text-xs md:text-sm flex-shrink-0"></i>
                            <span class="text-sm md:text-base">
                                {{ setting('address_line1', 'Jl. Raya Klandest No. 99') }}<br>
                                {{ setting('address_line2', 'Jakarta Selatan, DKI Jakarta 12790') }}
                            </span>
                        </li>
                    </ul>
                </div>

                <!-- Operating Hours -->
                <div>
                    <h4 class="text-lg md:text-xl font-bold mb-3 md:mb-4">Jam Operasional</h4>
                    <div class="text-sm md:text-base text-gray-400 space-y-2">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-calendar-alt text-yellow-500 text-xs md:text-sm"></i>
                            <span>{{ setting('operating_days', 'Senin - Minggu') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-clock text-yellow-500 text-xs md:text-sm"></i>
                            <span>{{ setting('operating_hours', '08:00 - 22:00 WIB') }}</span>
                        </div>
                    </div>
                    
                    <!-- WhatsApp Button -->
                    <a href="https://wa.me/{{ setting('whatsapp_number', '6281234567890') }}?text={{ urlencode(setting('whatsapp_text', 'Halo Klandest, saya mau tanya...')) }}" 
                       target="_blank"
                       class="mt-3 md:mt-4 inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-3 md:px-4 py-2 md:py-2.5 rounded-lg text-sm md:text-base font-semibold transition-all duration-300 shadow-lg hover:shadow-xl">
                        <i class="fab fa-whatsapp text-base md:text-lg"></i>
                        <span>Chat WhatsApp</span>
                    </a>
                </div>
            </div>
            
            <!-- Bottom Footer -->
            <div class="border-t border-gray-800 pt-6 md:pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-3 md:gap-4">
                    <p class="text-gray-400 text-xs md:text-sm text-center md:text-left">
                        © {{ date('Y') }} KLANDEST — Hidden But Loud. All rights reserved.
                    </p>
                    
                    <!-- Payment Methods -->
                    <div class="flex items-center gap-2 md:gap-3 text-gray-500">
                        <span class="text-xs">We Accept:</span>
                        <i class="fab fa-cc-visa text-xl md:text-2xl"></i>
                        <i class="fab fa-cc-mastercard text-xl md:text-2xl"></i>
                        <i class="fas fa-money-bill-wave text-lg md:text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Toggle Dropdown - Lebih mudah diklik
        let dropdownOpen = false;
        
        function toggleDropdown() {
            const menu = document.getElementById('dropdownMenu');
            dropdownOpen = !dropdownOpen;
            
            if (dropdownOpen) {
                menu.classList.remove('hidden');
            } else {
                menu.classList.add('hidden');
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('dropdownMenu');
            const button = document.getElementById('dropdownButton');
            
            if (menu && button && !menu.contains(event.target) && !button.contains(event.target)) {
                menu.classList.add('hidden');
                dropdownOpen = false;
            }
        });

        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('mobileMenu');
            const button = event.target.closest('button');
            
            if (!menu.contains(event.target) && !button?.onclick?.toString().includes('toggleMobileMenu')) {
                menu.classList.add('hidden');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>