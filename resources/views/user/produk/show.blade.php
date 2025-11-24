{{-- resources/views/user/produk/show.blade.php --}}

@extends('user.layouts.app')

@section('title', $product->nama_produk . ' - Klandest')

@section('content')

    <!-- Back Button -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <a href="{{ url()->previous() }}" 
           class="inline-flex items-center gap-2 text-gray-600 hover:text-black font-medium transition-colors">
            <i class="fas fa-chevron-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    <!-- Product Detail -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="grid lg:grid-cols-2 gap-0">

                <!-- Product Image -->
                <div class="bg-gray-50 p-8 lg:p-12 flex items-center justify-center min-h-[500px]">
                    @if($product->gambar)
                        <img src="{{ asset('storage/'.$product->gambar) }}"
                             alt="{{ $product->nama_produk }}"
                             class="max-w-full max-h-[680px] object-contain rounded-xl shadow-lg hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="flex flex-col items-center justify-center text-center">
                            <i class="fas fa-image text-9xl text-gray-200 mb-6"></i>
                            <span class="text-xl text-gray-500 font-medium">Gambar tidak tersedia</span>
                        </div>
                    @endif
                </div>

                <!-- Product Information -->
                <div class="p-8 lg:p-12 flex flex-col justify-between">

                    <div>
                        <!-- Kategori Badge -->
                        @if($product->kategori)
                            <div class="mb-4">
                                <a href="{{ route('produk.index', ['kategori' => $product->kategori_id]) }}"
                                   class="inline-block bg-black text-white px-5 py-2 rounded-full text-sm font-bold hover:bg-gray-800 transition">
                                    {{ $product->kategori->nama }}
                                </a>
                            </div>
                        @endif

                        <!-- Product Name -->
                        <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-3 leading-tight">
                            {{ $product->nama_produk }}
                        </h1>

                        <!-- Price -->
                        <div class="mb-10">
                            <p class="text-sm text-gray-500 uppercase tracking-widest font-semibold mb-2">Harga</p>
                            <div class="flex items-baseline gap-3">
                                <span class="text-5xl lg:text-6xl font-bold text-black">
                                    Rp {{ number_format($product->harga, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <!-- Description -->
                        @if($product->deskripsi)
                            <div class="mb-10 pb-8 border-b border-gray-200">
                                <h3 class="text-xl font-bold text-gray-900 mb-4">Deskripsi Produk</h3>
                                <div class="prose text-gray-700 leading-relaxed max-w-none">
                                    {!! nl2br(e($product->deskripsi)) !!}
                                </div>
                            </div>
                        @endif

                        <!-- Product Meta -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-600 mb-10">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-tag text-gray-400 w-5"></i>
                                <div>
                                    <span class="text-gray-500">Kode Produk</span><br>
                                    <strong class="text-gray-900">#{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</strong>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-calendar-alt text-gray-400 w-5"></i>
                                <div>
                                    <span class="text-gray-500">Ditambahkan</span><br>
                                    <strong class="text-gray-900">{{ $product->created_at->isoFormat('D MMMM Y') }}</strong>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-sync-alt text-gray-400 w-5"></i>
                                <div>
                                    <span class="text-gray-500">Terakhir diupdate</span><br>
                                    <strong class="text-gray-900">{{ $product->updated_at->diffForHumans() }}</strong>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-check-circle text-green-500 w-5"></i>
                                <div>
                                    <span class="text-gray-500">Status</span><br>
                                    <strong class="text-green-600 font-bold">Tersedia</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Keunggulan -->
                        <div class="mb-10 p-6 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200">
                            <h4 class="font-bold text-gray-900 mb-4 text-lg">Kenapa harus produk ini?</h4>
                            <div class="grid grid-cols-2 gap-3 text-sm">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-check-circle text-black"></i>
                                    <span>Kualitas Premium</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-check-circle text-black"></i>
                                    <span>Bahan Terbaik</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-check-circle text-black"></i>
                                    <span>Desain Eksklusif</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-check-circle text-black"></i>
                                    <span>Fast Response</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-4">
                        <!-- Beli di Shopee (Tombol Utama) -->
                        <a href="{{ $product->shopee_link }}" 
                           target="_blank"
                           class="block w-full text-center bg-orange-500 hover:bg-orange-600 text-white py-5 rounded-xl font-bold text-xl shadow-lg hover:shadow-2xl transition-all duration-300 flex items-center justify-center gap-3 transform hover:scale-105">
                            <i class="fab fa-shopify text-3xl"></i>
                            <span>Beli Sekarang di Shopee</span>
                        </a>

                        <!-- WhatsApp -->
                        <a href="https://wa.me/?text=Halo%20Klandest!%20Saya%20tertarik%20dengan:%0A%0A*{{ urlencode($product->nama_produk) }}*%0AHarga:%20Rp%20{{ number_format($product->harga, 0, ',', '.') }}%0A%0ALink%20Detail:%20{{ route('produk.show', $product->id) }}%0ALink%20Shopee:%20{{ urlencode($product->shopee_link) }}"
                           target="_blank"
                           class="block w-full text-center bg-green-500 hover:bg-green-600 text-white py-5 rounded-xl font-bold text-xl shadow-lg hover:shadow-2xl transition-all duration-300 flex items-center justify-center gap-3 transform hover:scale-105">
                            <i class="fab fa-whatsapp text-3xl"></i>
                            <span>Tanya via WhatsApp</span>
                        </a>

                        <!-- Share Product -->
                        <div class="pt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-600 mb-3 font-medium">Bagikan produk ini:</p>
                            <div class="flex gap-3">
                                <!-- Share via WhatsApp -->
                                <a href="https://wa.me/?text=Cek%20produk%20ini%20di%20Shopee:%0A*{{ urlencode($product->nama_produk) }}*%0AHarga:%20Rp%20{{ number_format($product->harga, 0, ',', '.') }}%0A%0A{{ urlencode($product->shopee_link) }}"
                                   target="_blank"
                                   class="flex-1 bg-green-500 hover:bg-green-600 text-white py-3 rounded-lg transition flex items-center justify-center gap-2">
                                    <i class="fab fa-whatsapp"></i>
                                    <span class="text-sm font-medium">WhatsApp</span>
                                </a>

                                <!-- Copy Link Shopee -->
                                <button onclick="copyShopeeLink()"
                                        class="flex-1 bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-lg transition flex items-center justify-center gap-2">
                                    <i class="fas fa-copy"></i>
                                    <span class="text-sm font-medium">Copy Link Shopee</span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
    function copyShopeeLink() {
        const shopeeLink = "{{ $product->shopee_link }}";
        navigator.clipboard.writeText(shopeeLink).then(() => {
            // Tampilkan notifikasi sukses yang lebih cantik
            showNotification('Link Shopee berhasil disalin!');
        }).catch(err => {
            console.error('Gagal menyalin link: ', err);
            alert('Gagal menyalin link. Silakan coba lagi.');
        });
    }

    function showNotification(message) {
        // Buat elemen notifikasi
        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 flex items-center gap-2 animate-slide-in';
        notification.innerHTML = `
            <i class="fas fa-check-circle"></i>
            <span>${message}</span>
        `;
        
        document.body.appendChild(notification);
        
        // Hapus notifikasi setelah 3 detik
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transition = 'opacity 0.3s ease';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }
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
    </style>

@endsection