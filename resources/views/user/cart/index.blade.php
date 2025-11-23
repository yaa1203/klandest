@extends('user.layouts.app')
@section('title', 'Keranjang Belanja - Klandest')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-12">

    <!-- Header -->
    <div class="text-center mb-10">
        <h1 class="text-5xl font-bold text-gray-900 mb-3">Keranjang Belanja</h1>
        <p class="text-xl text-gray-600">Kamu memiliki <strong>{{ Cart::getTotalQuantity() }}</strong> item</p>
    </div>

    @if(session('success'))
        <div class="mb-8 p-5 bg-green-50 border border-green-200 rounded-xl text-green-700 text-center font-medium">
            {{ session('success') }}
        </div>
    @endif

    @if(Cart::isEmpty())
        <div class="text-center py-20 bg-gray-50 rounded-3xl">
            <i class="fas fa-shopping-cart text-9xl text-gray-200 mb-8"></i>
            <h3 class="text-3xl font-bold text-gray-700 mb-4">Keranjang Kosong</h3>
            <p class="text-gray-500 mb-8">Yuk isi keranjangmu dengan koleksi terbaru!</p>
            <a href="{{ url('produk') }}" class="inline-block bg-black text-white px-10 py-5 rounded-xl font-bold text-lg hover:bg-gray-900 transition">
                Mulai Belanja
            </a>
        </div>
    @else
        <div class="grid lg:grid-cols-3 gap-10">
            <!-- Daftar Item -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    @foreach(Cart::getContent() as $item)
                        <div class="p-6 border-b last:border-0 flex items-center gap-6 hover:bg-gray-50 transition">
                            <!-- Gambar -->
                            <div class="w-28 h-28 bg-gray-100 rounded-xl overflow-hidden flex-shrink-0">
                                @if($item->attributes->gambar)
                                    <img src="{{ asset('storage/' . $item->attributes->gambar) }}" 
                                         alt="{{ $item->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-tshirt text-4xl text-gray-300"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Detail -->
                            <div class="flex-1">
                                <h4 class="text-xl font-bold text-gray-900">{{ $item->name }}</h4>
                                <p class="text-2xl font-bold text-black mt-2">
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </p>
                            </div>

                            <!-- Quantity -->
                            <div class="flex items-center gap-3">
                                <form action="{{ route('cart.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id[]" value="{{ $item->id }}">
                                    <input type="hidden" name="quantity[]" value="{{ max(1, $item->quantity - 1) }}">
                                    <button type="submit" class="w-10 h-10 bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                                        -
                                    </button>
                                </form>

                                <span class="w-12 text-center font-bold text-lg">{{ $item->quantity }}</span>

                                <form action="{{ route('cart.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id[]" value="{{ $item->id }}">
                                    <input type="hidden" name="quantity[]" value="{{ $item->quantity + 1 }}">
                                    <button type="submit" class="w-10 h-10 bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                                        +
                                    </button>
                                </form>
                            </div>

                            <!-- Subtotal & Hapus -->
                            <div class="text-right">
                                <p class="text-xl font-bold mb-3">
                                    Rp {{ number_format($item->getPriceSum(), 0, ',', '.') }}
                                </p>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-red-500 hover:text-red-700 transition" 
                                            onclick="return confirm('Hapus item ini dari keranjang?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Ringkasan & Checkout -->
            <div class="lg:col-span-1">
                <div class="bg-gradient-to-br from-black to-gray-900 text-white rounded-2xl shadow-2xl p-8 sticky top-6">
                    <h3 class="text-2xl font-bold mb-8 text-center">Ringkasan Belanja</h3>

                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-lg">
                            <span>Subtotal ({{ Cart::getTotalQuantity() }} item)</span>
                            <span class="font-bold">Rp {{ number_format(Cart::getTotal(), 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-lg">
                            <span>Ongkir</span>
                            <span class="text-green-400">Gratis*</span>
                        </div>
                        <hr class="border-white/20">
                        <div class="flex justify-between text-2xl font-bold">
                            <span>Total</span>
                            <span>Rp {{ number_format(Cart::getTotal(), 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <a href="{{ route('checkout.index') }}" 
                           class="block w-full bg-white text-black text-center py-5 rounded-xl font-bold text-xl hover:bg-gray-100 transition shadow-lg transform hover:scale-105">
                            Lanjut ke Checkout
                        </a>

                        <form action="{{ route('cart.clear') }}" method="POST" class="text-center">
                            @csrf
                            <button type="submit" class="text-gray-400 hover:text-white transition text-sm">
                                Kosongkan Keranjang
                            </button>
                        </form>
                    </div>

                    <p class="text-center text-xs mt-8 opacity-70">
                        *Gratis ongkir untuk pembelian di atas Rp 500.000
                    </p>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection