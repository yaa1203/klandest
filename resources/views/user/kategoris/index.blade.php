{{-- Halaman Daftar Semua Kategori untuk User --}}

@extends('user.layouts.app')

@section('title', 'Kategori Produk - Klandest')

@section('content')

<!-- Hero Section -->
<div class="bg-gradient-to-r from-black via-gray-900 to-black text-white py-24">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl md:text-6xl font-bold mb-4">Pilih Kategori</h1>
        <p class="text-xl text-gray-300">Temukan koleksi terbaik sesuai gaya Anda</p>
    </div>
</div>

<!-- Categories Grid -->
<div class="max-w-7xl mx-auto px-4 py-16">
    <div class="text-center mb-12">
        <h2 class="text-4xl font-bold text-gray-900 mb-3">Semua Kategori</h2>
        <p class="text-lg text-gray-600">Kami memiliki <strong>{{ $kategoris->count() }}</strong> kategori produk</p>
    </div>

    @if($kategoris->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach($kategoris as $kategori)
                <a href="{{ route('kategori.detail', $kategori->id) }}"
                   class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 transform hover:-translate-y-3">
                    
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 bg-gradient-to-br from-black/5 to-transparent opacity-0 group-hover:opacity-100 transition"></div>
                    
                    <!-- Category Info -->
                    <div class="p-8 text-center relative z-10">
                        <!-- Icon (bisa diganti gambar nanti) -->
                        <div class="w-20 h-20 mx-auto mb-4 bg-black/10 rounded-full flex items-center justify-center group-hover:bg-black/20 transition">
                            <i class="fas fa-tshirt text-3xl text-black"></i>
                        </div>
                        
                        <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-black">
                            {{ $kategori->nama }}
                        </h3>
                        
                        <p class="text-sm text-gray-600">
                            <strong class="text-black">{{ $kategori->products_count }}</strong> produk
                        </p>
                    </div>

                    <!-- Hover Overlay -->
                    <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition"></div>
                </a>
            @endforeach
        </div>
    @else
        <div class="text-center py-20 bg-gray-50 rounded-2xl">
            <i class="fas fa-folder-open text-8xl text-gray-200 mb-6"></i>
            <h3 class="text-2xl font-bold text-gray-900 mb-3">Belum Ada Kategori</h3>
            <p class="text-gray-600">Kategori akan segera ditambahkan oleh admin.</p>
        </div>
    @endif
</div>

<!-- CTA -->
<div class="bg-black text-white py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h3 class="text-3xl font-bold mb-4">Tidak Menemukan yang Dicari?</h3>
        <p class="text-gray-300 mb-8">Hubungi kami langsung untuk custom order!</p>
        <a href="https://wa.me/6281234567890" target="_blank"
           class="inline-flex items-center gap-3 bg-green-500 hover:bg-green-600 px-8 py-4 rounded-xl font-bold text-lg transition shadow-xl">
            <i class="fab fa-whatsapp text-2xl"></i>
            <span>Chat via WhatsApp</span>
        </a>
    </div>
</div>

@endsection