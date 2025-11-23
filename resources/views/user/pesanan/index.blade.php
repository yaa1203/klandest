{{-- Halaman: Pesanan Saya --}}
@extends('user.layouts.app')
@section('title', 'Pesanan Saya - Klandest')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-12">
    <div class="mb-10">
        <h1 class="text-4xl font-bold text-center mb-3">Pesanan Saya</h1>
        <p class="text-center text-gray-600">Lacak dan kelola semua pesanan kamu di sini</p>
    </div>

    <!-- Tabs Status Pesanan -->
    <div class="flex flex-wrap justify-center gap-4 mb-10 border-b border-gray-200">
        @php
            $statuses = [
                'all' => 'Semua Pesanan',
                'pending' => 'Menunggu Pembayaran',
                'confirmed' => 'Dikonfirmasi',
                'processed' => 'Diproses',
                'shipped' => 'Dikirim',
                'completed' => 'Selesai',
                'canceled' => 'Dibatalkan',
            ];
            $currentStatus = request('status', 'all');
        @endphp

        @foreach($statuses as $key => $label)
            <a href="{{ route('pesanan.index', ['status' => $key === 'all' ? null : $key]) }}"
               class="px-6 py-3 font-medium text-sm rounded-t-lg transition-all
                      {{ $currentStatus === $key || ($currentStatus === null && $key === 'all')
                         ? 'bg-black text-white' : 'text-gray-600 hover:text-black hover:bg-gray-100' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    <!-- Daftar Pesanan -->
    <div class="space-y-6">
        @forelse($orders as $order)
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-shadow">
                <div class="bg-gradient-to-r from-gray-900 to-black text-white p-6">
                    <div class="flex flex-wrap justify-between items-center gap-4">
                        <div>
                            <h3 class="text-xl font-bold">#{{ $order->order_code }}</h3>
                            <p class="text-sm opacity-90">Dibuat pada {{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                            <div class="text-sm opacity-90">{{ strtoupper($order->metode_pembayaran) }}
                                @if($order->isCod()) (Bayar di Tempat) @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid md:grid-cols-3 gap-6 mb-6">
                        <!-- Status Pesanan -->
                        <div>
                            <p class="text-sm text-gray-500 mb-2">Status Pesanan</p>
                            <div class="flex items-center gap-3">
                                {!! $order->status_badge !!}
                                @if(!$order->isCod() && $order->status_pembayaran)
                                    <div>{!! $order->status_pembayaran_badge !!}</div>
                                @endif
                            </div>
                        </div>

                        <!-- Pengiriman -->
                        <div>
                            <p class="text-sm text-gray-500 mb-2">Dikirim ke</p>
                            <p class="font-medium">{{ $order->nama_penerima }}</p>
                            <p class="text-sm text-gray-600">{{ $order->no_hp }}</p>
                        </div>

                        <!-- Aksi -->
                        <div class="flex items-end justify-end gap-3">
                            @if($order->status_pembayaran === 'diterima' || $order->isCod())
                                <span class="px-5 py-3 bg-green-100 text-green-800 rounded-xl font-bold">
                                    Pesanan Diproses
                                </span>
                            @elseif($order->isEwallet() && !$order->bukti_pembayaran)
                                <a href="{{ route('order.payment', $order->order_code) }}"
                                   class="px-6 py-3 bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-xl font-bold hover:from-yellow-600 hover:to-orange-600 transition shadow-lg">
                                    Bayar Sekarang
                                </a>
                            @elseif($order->isEwallet() && $order->status_pembayaran === 'menunggu')
                                <a href="{{ route('order.payment', $order->order_code) }}"
                                   class="px-6 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition">
                                    Lihat Status
                                </a>
                            @elseif($order->status_pembayaran === 'ditolak')
                                <a href="{{ route('order.payment', $order->order_code) }}"
                                   class="px-6 py-3 bg-red-600 text-white rounded-xl font-bold hover:bg-red-700 transition">
                                    Upload Ulang Bukti
                                </a>
                            @else
                                <span class="px-5 py-3 bg-gray-100 text-gray-600 rounded-xl font-medium">
                                    Menunggu Admin
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Produk yang dibeli -->
                    <div class="border-t pt-6">
                        <p class="text-sm text-gray-500 mb-4">Produk ({{ $order->items->count() }} item)</p>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($order->items as $item)
                                <div class="bg-gray-50 rounded-xl p-4 text-center">
                                    <div class="w-full h-32 bg-gray-200 border-2 border-dashed rounded-xl mb-3"></div>
                                    <p class="text-sm font-medium line-clamp-2">{{ $item->nama_produk }}</p>
                                    <p class="text-xs text-gray-600">×{{ $item->quantity }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-20">
                <i class="fas fa-shopping-bag text-9xl text-gray-200 mb-6"></i>
                <h3 class="text-2xl font-bold text-gray-500 mb-3">Belum Ada Pesanan</h3>
                <p class="text-gray-600 mb-8">Yuk, mulai belanja koleksi terbaru!</p>
                <a href="{{ url('/produk') }}" class="inline-flex items-center gap-3 bg-black text-white px-10 py-4 rounded-xl font-bold text-xl hover:bg-gray-800 transition transform hover:scale-105">
                    <i class="fas fa-arrow-right"></i>
                    Mulai Belanja
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($orders->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $orders->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection