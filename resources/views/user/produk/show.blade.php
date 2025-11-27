{{-- resources/views/user/produk/show.blade.php --}}

@extends('user.layouts.app')

@section('title', $product->nama_produk . ' - Klandest')

@section('content')

    <!-- Breadcrumb & Back -->
    <div class="bg-gray-50 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3">
            <a href="{{ url()->previous() }}" 
               class="inline-flex items-center gap-2 text-gray-600 hover:text-black font-medium transition-colors text-sm">
                <i class="fas fa-chevron-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    <!-- Product Detail -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 md:py-6">
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="grid lg:grid-cols-5 gap-4 md:gap-6 p-4 md:p-6">

                <!-- Product Image - 2 kolom -->
                <div class="lg:col-span-2">
                    <div class="lg:sticky lg:top-4">
                        @if($product->gambar)
                            <img src="{{ asset('storage/'.$product->gambar) }}"
                                 alt="{{ $product->nama_produk }}"
                                 class="w-full h-auto object-contain rounded-lg border border-gray-200">
                        @else
                            <div class="aspect-square flex flex-col items-center justify-center bg-gray-50 rounded-lg border border-gray-200">
                                <i class="fas fa-image text-4xl md:text-6xl text-gray-300 mb-2 md:mb-3"></i>
                                <span class="text-gray-500 font-medium text-sm md:text-base">Gambar tidak tersedia</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Product Information - 3 kolom -->
                <div class="lg:col-span-3">

                    <!-- Product Name -->
                    <h1 class="text-xl md:text-2xl lg:text-3xl font-bold text-gray-900 mb-2 leading-tight">
                        {{ $product->nama_produk }}
                    </h1>

                    <!-- Price -->
                    <div class="mb-3 md:mb-4 pb-3 md:pb-4 border-b border-gray-200">
                        <div class="flex items-baseline gap-2">
                            <span class="text-2xl md:text-3xl lg:text-4xl font-bold text-black">
                                Rp {{ number_format($product->harga, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <!-- Product Meta -->
                    <div class="mb-3 md:mb-4 pb-3 md:pb-4 border-b border-gray-200">
                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div class="flex items-start gap-2">
                                <i class="fas fa-tag text-gray-400 mt-1 text-xs md:text-sm"></i>
                                <div>
                                    <span class="text-gray-500 block text-xs md:text-sm">Kode Produk</span>
                                    <strong class="text-gray-900 text-sm md:text-base">#{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</strong>
                                </div>
                            </div>
                            <div class="flex items-start gap-2">
                                <i class="fas fa-check-circle text-green-500 mt-1 text-xs md:text-sm"></i>
                                <div>
                                    <span class="text-gray-500 block text-xs md:text-sm">Status</span>
                                    <strong class="text-green-600 text-sm md:text-base">Tersedia</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    @if($product->deskripsi)
                        <div class="mb-3 md:mb-4 pb-3 md:pb-4 border-b border-gray-200">
                            <h3 class="font-bold text-gray-900 mb-2 text-sm md:text-base">Deskripsi Produk</h3>
                            <div class="text-gray-700 text-xs md:text-sm leading-relaxed">
                                {!! nl2br(e($product->deskripsi)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- Keunggulan -->
                    <div class="mb-3 md:mb-4 pb-3 md:pb-4 border-b border-gray-200">
                        <h3 class="font-bold text-gray-900 mb-2 md:mb-3 text-sm md:text-base">Kenapa Pilih Produk Ini?</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs md:text-sm">
                            <div class="flex items-center gap-2 bg-gray-50 px-3 py-2 rounded-lg border border-gray-200">
                                <i class="fas fa-check-circle text-black text-sm"></i>
                                <span class="text-gray-800 font-medium">Kualitas Premium</span>
                            </div>
                            <div class="flex items-center gap-2 bg-gray-50 px-3 py-2 rounded-lg border border-gray-200">
                                <i class="fas fa-check-circle text-black text-sm"></i>
                                <span class="text-gray-800 font-medium">Bahan Terbaik</span>
                            </div>
                            <div class="flex items-center gap-2 bg-gray-50 px-3 py-2 rounded-lg border border-gray-200">
                                <i class="fas fa-check-circle text-black text-sm"></i>
                                <span class="text-gray-800 font-medium">Desain Eksklusif</span>
                            </div>
                            <div class="flex items-center gap-2 bg-gray-50 px-3 py-2 rounded-lg border border-gray-200">
                                <i class="fas fa-check-circle text-black text-sm"></i>
                                <span class="text-gray-800 font-medium">Fast Response</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-2 md:space-y-3 mb-3 md:mb-4">
                        <!-- Beli di Shopee (Primary Action) -->
                        <a href="{{ $product->shopee_link }}" 
                           target="_blank"
                           class="block w-full text-center bg-orange-500 hover:bg-orange-600 text-white py-3 md:py-3.5 rounded-lg font-bold shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2 text-sm md:text-base">
                            <i class="fab fa-shopify text-lg md:text-xl"></i>
                            <span>Beli di Shopee</span>
                        </a>

                        <!-- Grid untuk 2 Tombol -->
                        <div class="grid grid-cols-2 gap-2 md:gap-3">
                            <!-- Tambah ke Keranjang -->
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit"
                                        class="w-full text-center bg-black hover:bg-gray-800 text-white py-3 md:py-3.5 rounded-lg font-bold shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-1.5 md:gap-2 text-xs md:text-base">
                                    <i class="fas fa-shopping-cart text-sm md:text-base"></i>
                                    <span>Keranjang</span>
                                </button>
                            </form>

                            <!-- Wishlist Button -->
                            @auth
                                @if($product->isWishlistedBy(auth()->user()))
                                    <form action="{{ route('wishlist.remove', $product) }}" method="POST" class="w-full">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="w-full text-center bg-red-500 hover:bg-red-600 text-white py-3 md:py-3.5 rounded-lg font-bold shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-1.5 md:gap-2 text-xs md:text-base">
                                            <i class="fas fa-heart text-sm md:text-base"></i>
                                            <span>Wishlist</span>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('wishlist.add', $product) }}" method="POST" class="w-full">
                                        @csrf
                                        <button type="submit"
                                                class="w-full text-center bg-gray-700 hover:bg-gray-800 text-white py-3 md:py-3.5 rounded-lg font-bold shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-1.5 md:gap-2 border-2 border-gray-700 text-xs md:text-base">
                                            <i class="far fa-heart text-sm md:text-base"></i>
                                            <span>Wishlist</span>
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}"
                                   class="w-full text-center bg-gray-700 hover:bg-gray-800 text-white py-3 md:py-3.5 rounded-lg font-bold shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-1.5 md:gap-2 text-xs md:text-base">
                                    <i class="far fa-heart text-sm md:text-base"></i>
                                    <span>Wishlist</span>
                                </a>
                            @endauth
                        </div>

                        <!-- WhatsApp -->
                        <a href="https://wa.me/{{ setting('whatsapp_number', '6281234567890') }}?text=Halo%20Klandest!%20Saya%20tertarik%20dengan:%0A%0A*{{ urlencode($product->nama_produk) }}*%0AHarga:%20Rp%20{{ number_format($product->harga, 0, ',', '.') }}%0A%0ALink%20Detail:%20{{ route('produk.show', $product->id) }}%0ALink%20Shopee:%20{{ urlencode($product->shopee_link) }}"
                           target="_blank"
                           class="block w-full text-center bg-green-500 hover:bg-green-600 text-white py-3 md:py-3.5 rounded-lg font-bold shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2 text-sm md:text-base">
                            <i class="fab fa-whatsapp text-lg md:text-xl"></i>
                            <span>Chat via WhatsApp</span>
                        </a>
                    </div>

                    <!-- Share Section -->
                    <div class="pt-3 border-t border-gray-200">
                        <p class="text-xs md:text-sm text-gray-600 mb-2 font-medium">Bagikan:</p>
                        <div class="flex gap-2">
                            <!-- Share via WhatsApp -->
                            <a href="https://wa.me/?text=Cek%20produk%20ini:%0A*{{ urlencode($product->nama_produk) }}*%0ARp%20{{ number_format($product->harga, 0, ',', '.') }}%0A%0A{{ urlencode($product->shopee_link) }}"
                               target="_blank"
                               class="flex-1 bg-green-50 hover:bg-green-100 text-green-700 py-2 md:py-2.5 rounded-lg transition flex items-center justify-center gap-1.5 md:gap-2 border border-green-200">
                                <i class="fab fa-whatsapp text-sm md:text-base"></i>
                                <span class="text-xs md:text-sm font-medium">WhatsApp</span>
                            </a>

                            <!-- Copy Link -->
                            <button onclick="copyShopeeLink()"
                                    class="flex-1 bg-gray-50 hover:bg-gray-100 text-gray-700 py-2 md:py-2.5 rounded-lg transition flex items-center justify-center gap-1.5 md:gap-2 border border-gray-200">
                                <i class="fas fa-copy text-sm md:text-base"></i>
                                <span class="text-xs md:text-sm font-medium">Salin Link</span>
                            </button>
                        </div>
                    </div>

                    <!-- Product Info Footer -->
                    <div class="mt-3 md:mt-4 pt-3 border-t border-gray-100">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 text-xs text-gray-500">
                            <div class="flex items-center gap-1.5">
                                <i class="fas fa-calendar-alt"></i>
                                <span>{{ $product->created_at->isoFormat('D MMM Y') }}</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <i class="fas fa-sync-alt"></i>
                                <span>{{ $product->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Additional Info Section -->
        <div class="mt-4 md:mt-6 bg-white rounded-lg shadow-sm p-4 md:p-6">
            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-3 md:mb-4">Informasi Tambahan</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 md:gap-4">
                <div class="bg-gradient-to-br from-orange-50 to-orange-100 p-3 md:p-4 rounded-lg border border-orange-200">
                    <div class="flex items-center gap-2 md:gap-3 mb-2">
                        <i class="fas fa-shipping-fast text-xl md:text-2xl text-orange-600"></i>
                        <h4 class="font-bold text-gray-900 text-sm md:text-base">Pengiriman Cepat</h4>
                    </div>
                    <p class="text-xs md:text-sm text-gray-700">Pesanan diproses dan dikirim dengan cepat melalui Shopee</p>
                </div>
                
                <div class="bg-gradient-to-br from-green-50 to-green-100 p-3 md:p-4 rounded-lg border border-green-200">
                    <div class="flex items-center gap-2 md:gap-3 mb-2">
                        <i class="fas fa-shield-alt text-xl md:text-2xl text-green-600"></i>
                        <h4 class="font-bold text-gray-900 text-sm md:text-base">Garansi Kualitas</h4>
                    </div>
                    <p class="text-xs md:text-sm text-gray-700">Produk berkualitas premium dengan jaminan kepuasan</p>
                </div>
                
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-3 md:p-4 rounded-lg border border-blue-200">
                    <div class="flex items-center gap-2 md:gap-3 mb-2">
                        <i class="fas fa-headset text-xl md:text-2xl text-blue-600"></i>
                        <h4 class="font-bold text-gray-900 text-sm md:text-base">Customer Support</h4>
                    </div>
                    <p class="text-xs md:text-sm text-gray-700">Siap membantu Anda 24/7 melalui WhatsApp</p>
                </div>
            </div>
        </div>

        <!-- Info Keranjang -->
        <div class="mt-4 md:mt-6 bg-blue-50 border border-blue-200 rounded-lg p-3 md:p-4">
            <div class="flex items-start gap-2 md:gap-3">
                <i class="fas fa-info-circle text-blue-600 text-lg md:text-xl mt-0.5 flex-shrink-0"></i>
                <div class="flex-1">
                    <h4 class="font-bold text-blue-900 mb-1 text-sm md:text-base">Tentang Keranjang Belanja</h4>
                    <p class="text-xs md:text-sm text-blue-800 leading-relaxed">
                        Keranjang digunakan untuk menyimpan produk favorit Anda. 
                        Untuk melakukan pembelian, klik <strong>"Beli di Shopee"</strong> pada masing-masing produk di keranjang atau langsung dari halaman ini.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
    function copyShopeeLink() {
        const shopeeLink = "{{ $product->shopee_link }}";
        navigator.clipboard.writeText(shopeeLink).then(() => {
            showNotification('Link Shopee berhasil disalin!', 'success');
        }).catch(err => {
            console.error('Gagal menyalin link: ', err);
            showNotification('Gagal menyalin link. Silakan coba lagi.', 'error');
        });
    }

    function showNotification(message, type = 'success') {
        const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 ${bgColor} text-white px-4 py-3 rounded-lg shadow-xl z-50 flex items-center gap-2 animate-slide-in max-w-sm`;
        notification.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
            <span class="text-sm font-medium">${message}</span>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transition = 'opacity 0.3s ease';
            setTimeout(() => {
                if (notification.parentNode) {
                    document.body.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }

    // Auto show notification when added to cart (from session)
    @if(session('success'))
        showNotification("{{ session('success') }}", 'success');
    @endif
    @if(session('error'))
        showNotification("{{ session('error') }}", 'error');
    @endif
    </script>

    <style>
    @keyframes slide-in {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    .animate-slide-in {
        animation: slide-in 0.3s ease;
    }

    /* Responsive notification */
    @media (max-width: 640px) {
        .animate-slide-in {
            top: 1rem;
            right: 1rem;
            left: 1rem;
            max-width: calc(100% - 2rem);
        }
    }
    </style>

@endsection