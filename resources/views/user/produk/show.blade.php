<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->nama_produk }} - Detail Produk</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <span class="text-3xl">🛒</span>
                    <h1 class="text-2xl font-bold text-gray-800">Toko Online</h1>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center gap-6">
                    <a href="{{ route('catalog') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">
                        Produk
                    </a>
                    
                    @auth
                        @if(auth()->user()->role === 'admin')
                        <a href="{{ route('products.index') }}" 
                           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition font-medium">
                            <span>⚙️</span>
                            <span>Admin Panel</span>
                        </a>
                        @endif
                        
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-red-600 font-medium transition">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Back Button -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <a href="{{ route('catalog') }}"
           class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 font-medium transition-colors duration-200">
            <span class="text-xl">←</span>
            <span>Kembali ke Katalog</span>
        </a>
    </div>

    <!-- Product Detail -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="grid md:grid-cols-2 gap-0">
                
                <!-- Product Image -->
                <div class="bg-gray-100 p-8 flex items-center justify-center min-h-[500px]">
                    @if($product->gambar)
                        <img src="{{ asset('storage/'.$product->gambar) }}"
                             alt="{{ $product->nama_produk }}"
                             class="max-w-full max-h-[600px] object-contain rounded-lg shadow-2xl">
                    @else
                        <div class="flex flex-col items-center justify-center">
                            <span class="text-9xl mb-4">📦</span>
                            <span class="text-gray-500 font-medium text-lg">Tidak ada gambar</span>
                        </div>
                    @endif
                </div>

                <!-- Product Information -->
                <div class="p-8 lg:p-12 flex flex-col justify-between">
                    
                    <div>
                        <!-- Product Name -->
                        <h1 class="text-4xl font-bold text-gray-800 mb-6">
                            {{ $product->nama_produk }}
                        </h1>

                        <!-- Price -->
                        <div class="mb-8">
                            <p class="text-sm text-gray-500 mb-2 uppercase tracking-wide font-semibold">Harga</p>
                            <div class="flex items-baseline gap-2">
                                <span class="text-5xl font-bold text-green-600">
                                    Rp {{ number_format($product->harga, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <!-- Description -->
                        @if($product->deskripsi)
                        <div class="mb-8 pb-8 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-800 mb-3">Deskripsi Produk</h3>
                            <p class="text-gray-700 leading-relaxed text-justify">
                                {{ $product->deskripsi }}
                            </p>
                        </div>
                        @endif

                        <!-- Product Info -->
                        <div class="space-y-3 mb-8">
                            <div class="flex items-center gap-3 text-gray-600">
                                <span class="text-xl">📅</span>
                                <span>Ditambahkan: <strong>{{ $product->created_at->isoFormat('D MMMM Y') }}</strong></span>
                            </div>
                            <div class="flex items-center gap-3 text-gray-600">
                                <span class="text-xl">🔄</span>
                                <span>Terakhir update: <strong>{{ $product->updated_at->diffForHumans() }}</strong></span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-4">
                        
                        <!-- WhatsApp Button -->
                        <a href="https://wa.me/?text=Halo, saya tertarik dengan produk *{{ $product->nama_produk }}* seharga Rp {{ number_format($product->harga, 0, ',', '.') }}"
                           target="_blank"
                           class="block w-full text-center bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-200">
                            <span class="inline-flex items-center gap-3">
                                <span class="text-2xl">💬</span>
                                <span>Hubungi via WhatsApp</span>
                            </span>
                        </a>

                        <!-- Buy Button -->
                        <button onclick="alert('Fitur pembelian akan segera tersedia!')"
                                class="block w-full text-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-200">
                            <span class="inline-flex items-center gap-3">
                                <span class="text-2xl">🛍️</span>
                                <span>Beli Sekarang</span>
                            </span>
                        </button>

                        <!-- Back to Catalog -->
                        <a href="{{ route('catalog') }}"
                           class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 py-4 rounded-xl font-bold text-lg transition-all duration-200">
                            <span class="inline-flex items-center gap-3">
                                <span class="text-2xl">🔙</span>
                                <span>Lihat Produk Lainnya</span>
                            </span>
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-400">© {{ date('Y') }} Toko Online. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>