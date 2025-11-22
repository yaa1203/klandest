<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk - Toko Online</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <!-- Logo -->
                <a href="{{ route('catalog') }}" class="flex items-center gap-3 hover:opacity-80 transition">
                    <span class="text-3xl">🛒</span>
                    <h1 class="text-2xl font-bold text-gray-800">Toko Online</h1>
                </a>

                <!-- Navigation Links -->
                <div class="flex items-center gap-6">
                    <a href="{{ route('catalog') }}" class="text-blue-600 hover:text-blue-700 font-semibold transition border-b-2 border-blue-600">
                        Produk
                    </a>
                    
                    @auth
                        @if(auth()->user()->role === 'admin')
                        <a href="{{ route('products.index') }}" 
                           class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-2 rounded-lg transition font-medium shadow-md">
                            <span>⚙️</span>
                            <span>Admin Panel</span>
                        </a>
                        @endif
                        
                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-600">Hi, <strong>{{ auth()->user()->name }}</strong></span>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-700 font-medium transition">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition font-medium">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-purple-600 text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-5xl font-bold mb-4 animate-fade-in">Selamat Datang di Toko Kami! 🎉</h2>
            <p class="text-xl text-blue-100 mb-8">Temukan produk terbaik dengan harga terjangkau</p>
            <div class="flex justify-center gap-4">
                <a href="#produk" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-bold hover:bg-blue-50 transition shadow-lg">
                    Lihat Produk
                </a>
                <a href="https://wa.me/" target="_blank" class="bg-green-500 text-white px-8 py-3 rounded-lg font-bold hover:bg-green-600 transition shadow-lg flex items-center gap-2">
                    <span>💬</span>
                    <span>Hubungi Kami</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div id="produk" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        <!-- Section Header -->
        <div class="mb-10 text-center">
            <h3 class="text-4xl font-bold text-gray-800 mb-3">Katalog Produk Kami</h3>
            <p class="text-lg text-gray-600">Menampilkan <strong class="text-blue-600">{{ $products->total() }}</strong> produk terbaik untuk Anda</p>
        </div>

        <!-- Products Grid -->
        @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
            @foreach($products as $product)
            <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden group transform hover:-translate-y-2">
                
                <!-- Product Image -->
                <div class="relative h-64 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                    @if($product->gambar)
                        <img src="{{ asset('storage/'.$product->gambar) }}"
                             alt="{{ $product->nama_produk }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center">
                            <span class="text-7xl mb-3">📦</span>
                            <span class="text-gray-400 font-semibold">No Image</span>
                        </div>
                    @endif
                    
                    <!-- Badge -->
                    <div class="absolute top-4 right-4">
                        <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                            ✨ Terbaru
                        </span>
                    </div>
                    
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>

                <!-- Product Info -->
                <div class="p-6">
                    <!-- Product Name -->
                    <h4 class="text-lg font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-blue-600 transition min-h-[3.5rem]">
                        {{ $product->nama_produk }}
                    </h4>

                    <!-- Price -->
                    <div class="mb-4">
                        <p class="text-3xl font-bold bg-gradient-to-r from-green-600 to-green-500 bg-clip-text text-transparent">
                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                        </p>
                    </div>

                    <!-- Description Preview -->
                    @if($product->deskripsi)
                    <p class="text-sm text-gray-600 mb-5 line-clamp-2 min-h-[2.5rem]">
                        {{ $product->deskripsi }}
                    </p>
                    @else
                    <div class="mb-5 h-[2.5rem]"></div>
                    @endif

                    <!-- Action Button -->
                    <a href="{{ route('catalog.detail', $product->id) }}"
                       class="block w-full text-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white py-3 rounded-xl font-bold transition-all duration-200 shadow-md hover:shadow-xl transform hover:scale-105">
                        Lihat Detail 👉
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $products->links() }}
        </div>

        @else
        <!-- Empty State -->
        <div class="text-center py-20 bg-white rounded-2xl shadow-md">
            <span class="text-9xl mb-6 block">🛍️</span>
            <h3 class="text-3xl font-bold text-gray-800 mb-3">Belum Ada Produk</h3>
            <p class="text-gray-600 text-lg mb-6">Produk akan segera tersedia. Silakan cek kembali nanti!</p>
            @auth
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('products.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg font-bold transition shadow-lg">
                    <span>➕</span>
                    <span>Tambah Produk Pertama</span>
                </a>
                @endif
            @endauth
        </div>
        @endif

    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-purple-600 to-blue-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-3xl font-bold mb-4">Ada Pertanyaan? Hubungi Kami! 💬</h3>
            <p class="text-lg text-purple-100 mb-8">Tim kami siap membantu Anda 24/7</p>
            <a href="https://wa.me/" target="_blank" class="inline-flex items-center gap-3 bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-xl font-bold transition shadow-2xl text-lg">
                <span class="text-2xl">📱</span>
                <span>Chat via WhatsApp</span>
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8 mb-8">
                <!-- About -->
                <div>
                    <h4 class="text-xl font-bold mb-4 flex items-center gap-2">
                        <span>🛒</span>
                        <span>Toko Online</span>
                    </h4>
                    <p class="text-gray-400">
                        Platform belanja online terpercaya dengan produk berkualitas dan harga terjangkau.
                    </p>
                </div>
                
                <!-- Links -->
                <div>
                    <h4 class="text-xl font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('catalog') }}" class="hover:text-white transition">Produk</a></li>
                        <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white transition">Kontak</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h4 class="text-xl font-bold mb-4">Hubungi Kami</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>📧 Email: info@tokoonline.com</li>
                        <li>📱 WhatsApp: +62 xxx xxxx xxxx</li>
                        <li>📍 Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 text-center text-gray-400">
                <p>© {{ date('Y') }} Toko Online. All rights reserved. Made with ❤️</p>
            </div>
        </div>
    </footer>

</body>
</html>