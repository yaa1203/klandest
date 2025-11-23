{{-- resources/views/user/checkout/index.blade.php --}}
@extends('user.layouts.app')
@section('title', 'Checkout - Klandest')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold text-center mb-4">Checkout Pesanan</h1>
    <p class="text-center text-gray-600 mb-12">Lengkapi data pengiriman untuk menyelesaikan pesanan</p>

    @if(session('success'))
        <div class="mb-8 p-5 bg-green-50 border border-green-300 rounded-xl text-green-800 text-center font-medium">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-8 p-5 bg-red-50 border border-red-300 rounded-xl text-red-800">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('checkout.process') }}" method="POST" class="space-y-8">
        @csrf

        <!-- Data Pengiriman -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-bold mb-6">Data Pengiriman</h2>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" value="{{ old('nama', auth()->check() ? auth()->user()->name : '') }}" 
                           class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-black focus:border-black transition" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nomor HP (WhatsApp) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', auth()->check() ? auth()->user()->phone : '') }}" 
                           placeholder="081234567890" 
                           class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-black transition" required>
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Alamat Lengkap <span class="text-red-500">*</span>
                </label>
                <textarea name="alamat" rows="4" 
                          class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-black transition" 
                          placeholder="Jalan, RT/RW, Kelurahan, Kecamatan, Kota, Kode Pos" required>{{ old('alamat', auth()->check() ? auth()->user()->address : '') }}</textarea>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan (Opsional)</label>
                <textarea name="catatan" rows="3" 
                          class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-black transition" 
                          placeholder="Contoh: Antar ke rumah warna biru di gang sebelah masjid">{{ old('catatan') }}</textarea>
            </div>
        </div>

        <!-- Metode Pembayaran -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-bold mb-6">Metode Pembayaran</h2>
            <div class="grid md:grid-cols-2 gap-4">
                @foreach([
                    'cod'   => 'COD (Bayar di Tempat)',
                    'ovo'   => 'OVO',
                    'dana'  => 'DANA',
                    'gopay' => 'GoPay'
                ] as $key => $label)
                    <label class="flex items-center p-5 border-2 rounded-xl cursor-pointer transition-all 
                                   {{ old('metode_pembayaran') == $key ? 'border-black bg-black/5 shadow-md' : 'border-gray-300 hover:border-gray-400' }}">
                        <input type="radio" name="metode_pembayaran" value="{{ $key }}" 
                               class="w-5 h-5 text-black focus:ring-black" 
                               {{ old('metode_pembayaran') == $key ? 'checked' : '' }} required>
                        <span class="ml-4 font-medium text-gray-800">{{ $label }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Ringkasan Pesanan -->
        <div class="bg-black text-white rounded-2xl p-8">
            <h2 class="text-2xl font-bold mb-6">Ringkasan Pesanan</h2>
            @foreach(Cart::getContent() as $item)
                <div class="flex justify-between py-2 text-sm md:text-base">
                    <span>{{ $item->name }} × {{ $item->quantity }}</span>
                    <span>Rp {{ number_format($item->getPriceSum(), 0, ',', '.') }}</span>
                </div>
            @endforeach
            <div class="border-t-2 border-white/30 mt-6 pt-6">
                <div class="flex justify-between text-2xl font-bold">
                    <span>Total Belanja</span>
                    <span>Rp {{ number_format(Cart::getTotal(), 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="{{ route('cart.index') }}" 
               class="text-center bg-gray-200 hover:bg-gray-300 text-black py-5 rounded-xl font-bold text-xl transition">
                Kembali ke Keranjang
            </a>

            <button type="submit" 
                    class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 
                           text-white py-5 rounded-xl font-bold text-xl shadow-xl hover:shadow-2xl 
                           transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-3">
                <i class="fas fa-arrow-right"></i>
                <span>Lanjut Checkout</span>
            </button>
        </div>
    </form>
</div>
@endsection