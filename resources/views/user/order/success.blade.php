@extends('user.layouts.app')
@section('title', 'Pesanan Berhasil - Klandest')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16 text-center">
    <i class="fas fa-check-circle text-9xl text-green-500 mb-8"></i>
    <h1 class="text-5xl font-bold mb-4">Pesanan Berhasil!</h1>
    <p class="text-xl text-gray-600 mb-8">
        Terima kasih telah berbelanja di Klandest.<br>
        Pesanan kamu dengan kode <strong class="text-black">#{{ $order->order_code }}</strong> sudah kami terima.
    </p>

    <div class="bg-white rounded-2xl shadow-lg p-8 max-w-2xl mx-auto text-left">
        <h3 class="text-2xl font-bold mb-6">Detail Pesanan</h3>
        <p><strong>Nama:</strong> {{ $order->nama_penerima }}</p>
        <p><strong>No. HP:</strong> {{ $order->no_hp }}</p>
        <p><strong>Metode:</strong> <span class="text-green-600 font-bold">Bayar di Tempat (COD)</span></p>
        <p><strong>Total:</strong> Rp {{ number_format($order->total, 0, ',', '.') }}</p>
    </div>

    <div class="mt-12">
        <a href="{{ route('produk.index') }}" class="bg-black text-white px-10 py-4 rounded-xl font-bold text-xl hover:bg-gray-800 transition">
            Lanjut Belanja
        </a>
    </div>
</div>
@endsection