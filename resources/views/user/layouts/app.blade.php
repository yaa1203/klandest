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
    <nav class="sticky top-0 z-50 bg-white border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-[70px]">

                <!-- Logo -->
                <a href="/" class="text-xl font-bold tracking-widest text-black flex items-center gap-2">
                    <span>KLANDEST</span>
                    <span class="w-1.5 h-1.5 bg-black rounded-full"></span>
                </a>

                <!-- Search Bar -->
                <div class="hidden md:flex flex-1 max-w-sm mx-12">
                    <input 
                        type="text" 
                        placeholder="Cari koleksi terbaru..." 
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-black focus:bg-white transition-all"
                    >
                </div>

                <!-- Nav Items -->
                <div class="flex items-center gap-8">
                    
                    <!-- Links -->
                    <div class="hidden lg:flex gap-8">
                        <a href="{{ route('user.dashboard') }}" class="text-sm font-medium text-gray-600 hover:text-black transition-colors">Home</a>
                        <a href= "{{url('produk')}}" class="text-sm font-medium text-gray-600 hover:text-black transition-colors">Produk</a>
                        <a href="{{url('kategoris')}}" class="text-sm font-medium text-gray-600 hover:text-black transition-colors">Kategori</a>
                        <a href="{{ url('kontak') }}" class="text-sm font-medium text-gray-600 hover:text-black transition-colors">Kontak</a>
                    </div>

                    <!-- Icons -->
                    <div class="flex items-center gap-6">
                        <!-- Search Mobile -->
                        <button class="md:hidden p-2 hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-search text-lg text-black"></i>
                        </button>

                        <!-- Wishlist Icon dengan Jumlah Dinamis -->
                        <a href="{{ route('wishlist.index') }}" 
                        class="relative p-2 hover:bg-gray-100 rounded-lg transition-all duration-200 group">
                            
                            <!-- Icon Hati -->
                            <i class="far fa-heart text-xl text-black group-hover:text-red-500 transition-colors"></i>
                            
                            <!-- Badge Jumlah Wishlist (hanya muncul jika > 0) -->
                            @if(auth()->check() && auth()->user()->wishlist()->count() > 0)
                                <span class="absolute -top-1 -right-1 min-w-[20px] h-5 px-1.5 bg-red-600 text-white text-xs font-bold rounded-full flex items-center justify-center animate-pulse shadow-lg border border-white">
                                    {{ auth()->user()->wishlist()->count() }}
                                </span>
                            @endif

                            <!-- Tooltip (muncul saat hover) -->
                            <span class="absolute -bottom-8 left-1/2 -translate-x-1/2 bg-black text-white text-xs px-3 py-1.5 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-10">
                                Wishlist 
                                @if(auth()->check() && auth()->user()->wishlist()->count() > 0)
                                    ({{ auth()->user()->wishlist()->count() }} item)
                                @endif
                            </span>
                        </a>

                        <!-- Cart Icon di Navbar -->
                        <a href="{{ route('cart.index') }}" 
                        class="relative p-2 hover:bg-gray-100 rounded-lg transition-all duration-200 group">
                            
                            <!-- Icon Keranjang -->
                            <i class="fas fa-shopping-bag text-xl text-black group-hover:scale-110 transition-transform"></i>
                            
                            <!-- Badge Jumlah Item (hanya muncul kalau ada item) -->
                            @if(Cart::getTotalQuantity() > 0)
                                <span class="absolute -top-1 -right-1 min-w-[20px] h-5 px-1.5 bg-black text-white text-xs font-bold rounded-full flex items-center justify-center animate-pulse">
                                    {{ Cart::getTotalQuantity() }}
                                </span>
                            @endif

                            <!-- Tooltip (opsional, muncul saat hover) -->
                            <span class="absolute -bottom-8 left-1/2 -translate-x-1/2 bg-black text-white text-xs px-3 py-1.5 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">
                                Keranjang ({{ Cart::getTotalQuantity() }} item)
                            </span>
                        </a>
                    </div>

                    @guest
                        <!-- Auth Buttons (Not Logged In) -->
                        <div class="hidden sm:flex items-center gap-3 ml-2">
                            <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-medium text-black border border-black rounded-lg hover:bg-gray-50 transition-colors">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="px-5 py-2 text-sm font-medium text-white bg-black rounded-lg hover:bg-gray-900 transition-colors">
                                Daftar
                            </a>
                        </div>
                    @endguest

                    @auth
                        <!-- User Profile (Logged In) -->
                        <div class="sm:flex items-center gap-3 ml-2">
                            <div class="flex flex-col">
                                <span class="text-sm font-medium text-black">{{ Auth::user()->name }}</span>
                                <span class="text-xs text-gray-500">Member</span>
                            </div>
                            <div class="relative group">
                                <button class="w-10 h-10 bg-gray-200 rounded-full hover:bg-gray-300 transition-colors flex items-center justify-center">
                                    <i class="fas fa-chevron-down text-xs text-black"></i>
                                </button>
                                <div class="hidden group-hover:block absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-10">
                                    @if(Auth::user()->role === 'admin')
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 border-b">
                                            <i class="fas fa-cog mr-2"></i>Admin Dashboard
                                        </a>
                                    @endif
                                    <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profil Saya</a>
                                    <a href="/pesanan" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Pesanan Saya</a>
                                    <a href="/wishlist" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Wishlist</a>
                                    <hr class="my-2">
                                    <form method="POST" action="{{ route('logout') }}" class="block">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Logout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endauth

                </div>

            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-white py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8 mb-8">
                <!-- About -->
                <div>
                    <h4 class="text-xl font-bold mb-4 flex items-center gap-2">
                        <span class="text-2xl">KLANDEST</span>
                    </h4>
                    <p class="text-gray-400">
                        Platform belanja online terpercaya dengan produk berkualitas dan harga terjangkau.
                    </p>
                </div>
                
                <!-- Links -->
                <div>
                    <h4 class="text-xl font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('produk.index') }}" class="hover:text-white transition">Produk</a></li>
                        <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white transition">Kontak</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h4 class="text-xl font-bold mb-4">Hubungi Kami</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>📧 Email: info@klandest.com</li>
                        <li>📱 WhatsApp: +62 xxx xxxx xxxx</li>
                        <li>📍 Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 text-center text-gray-400">
                <p>© {{ date('Y') }} KLANDEST — Hidden But Loud. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>