@extends('user.layouts.app')

@section('title', 'Keranjang Belanja - Klandest')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">

    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Keranjang Belanja</h1>
        <p class="text-gray-600 mt-2">Anda memiliki {{ Cart::getTotalQuantity() }} item</p>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if (Cart::isEmpty())
        <!-- Kosong -->
        <div class="text-center py-16 bg-gray-50 rounded-xl">
            <i class="fas fa-shopping-cart text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-2xl font-bold text-gray-600 mb-2">Keranjang Kosong</h3>
            <p class="text-gray-500 mb-6">Belum ada produk di keranjang.</p>
            <a href="{{ route('produk.index') }}" class="bg-black text-white px-6 py-3 rounded-lg font-bold">
                Lanjut Belanja
            </a>
        </div>
    @else
        <!-- Isi Keranjang -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            @foreach (Cart::getContent() as $item)
                <div class="p-6 border-b last:border-b-0 flex items-center gap-4">
                    <!-- Gambar -->
                    <img src="{{ $item->attributes->gambar ? asset('storage/' . $item->attributes->gambar) : 'https://via.placeholder.com/80' }}" 
                         alt="{{ $item->name }}" class="w-20 h-20 object-cover rounded-lg">

                    <!-- Detail -->
                    <div class="flex-1">
                        <h4 class="font-bold text-lg">{{ $item->name }}</h4>
                        <p class="text-2xl font-bold text-black">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                    </div>

                    <!-- Quantity -->
                    <div class="flex items-center gap-2">
                        <form action="{{ route('cart.update') }}" method="POST" class="flex">
                            @csrf
                            <input type="hidden" name="id[]" value="{{ $item->id }}">
                            <input type="hidden" name="quantity[]" value="{{ $item->quantity - 1 }}" 
                                   id="qty-{{ $item->id }}" onchange="updateQty('{{ $item->id }}')">
                            <button type="button" onclick="updateQty('{{ $item->id }}', -1)" 
                                    class="w-8 h-8 bg-gray-200 rounded flex items-center justify-center text-sm">-</button>
                        </form>

                        <span class="w-8 text-center font-bold">{{ $item->quantity }}</span>

                        <form action="{{ route('cart.update') }}" method="POST" class="flex">
                            @csrf
                            <input type="hidden" name="id[]" value="{{ $item->id }}">
                            <input type="hidden" name="quantity[]" value="{{ $item->quantity + 1 }}" 
                                   id="qty-{{ $item->id }}" onchange="updateQty('{{ $item->id }}')">
                            <button type="button" onclick="updateQty('{{ $item->id }}', 1)" 
                                    class="w-8 h-8 bg-gray-200 rounded flex items-center justify-center text-sm">+</button>
                        </form>
                    </div>

                    <!-- Subtotal -->
                    <div class="text-right min-w-[120px]">
                        <p class="text-xl font-bold">Rp {{ number_format($item->getPriceSum(), 0, ',', '.') }}</p>
                    </div>

                    <!-- Hapus -->
                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="ml-4">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Hapus item ini?')">
                            <i class="fas fa-trash text-xl"></i>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <!-- Total & Checkout -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold">Total Belanja</h3>
                <p class="text-3xl font-bold text-black">Rp {{ number_format(Cart::getTotal(), 0, ',', '.') }}</p>
            </div>

            <div class="flex gap-4">
                <a href="https://wa.me/6281234567890?text={{ urlencode('Halo! Saya mau checkout: ' . Cart::getContent()->map(fn($i) => $i->name . ' x' . $i->quantity . ' = Rp ' . number_format($i->getPriceSum(), 0, ',', '.'))->implode(', ') . '. Total: Rp ' . number_format(Cart::getTotal(), 0, ',', '.')) }}" 
                   target="_blank" 
                   class="flex-1 bg-green-600 text-white text-center py-4 rounded-xl font-bold text-lg hover:bg-green-700">
                    <i class="fab fa-whatsapp mr-2"></i> Checkout WhatsApp
                </a>
                <form action="{{ route('cart.clear') }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full bg-gray-300 text-gray-700 py-4 rounded-xl font-bold hover:bg-gray-400">
                        Kosongkan Keranjang
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>

<script>
function updateQty(id, change = 0) {
    const input = document.getElementById('qty-' + id);
    let newQty = parseInt(input.value) + (change || 0);
    if (newQty < 1) newQty = 1;
    input.value = newQty;
    input.closest('form').submit();
}
</script>
@endsection