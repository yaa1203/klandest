{{-- Halaman: Pesanan Saya --}}
@extends('user.layouts.app')
@section('title', 'Pesanan Saya - Klandest')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
    <div class="mb-8 md:mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-center mb-2 md:mb-3 text-gray-900">Pesanan Saya</h1>
        <p class="text-center text-sm md:text-base text-gray-600">Lacak dan kelola semua pesanan kamu di sini</p>
    </div>

    <!-- Tabs Status Pesanan -->
    <div class="mb-8 md:mb-10 overflow-x-auto">
        <div class="flex gap-2 md:gap-3 border-b border-gray-200 min-w-max px-2">
            @php
                $statuses = [
                    'all' => ['label' => 'Semua', 'icon' => 'fa-list'],
                    'pending' => ['label' => 'Menunggu', 'icon' => 'fa-clock'],
                    'confirmed' => ['label' => 'Dikonfirmasi', 'icon' => 'fa-check-circle'],
                    'packed' => ['label' => 'Dikemas', 'icon' => 'fa-box'],
                    'shipped' => ['label' => 'Dikirim', 'icon' => 'fa-shipping-fast'],
                    'completed' => ['label' => 'Selesai', 'icon' => 'fa-check-double'],
                    'canceled' => ['label' => 'Dibatalkan', 'icon' => 'fa-times-circle'],
                ];
                $currentStatus = request('status', 'all');
            @endphp

            @foreach($statuses as $key => $data)
                <a href="{{ route('order.index', ['status' => $key === 'all' ? null : $key]) }}"
                   class="flex items-center gap-2 px-4 md:px-6 py-2.5 md:py-3 font-medium text-xs md:text-sm rounded-t-lg transition-all whitespace-nowrap
                          {{ $currentStatus === $key || (empty($currentStatus) && $key === 'all')
                             ? 'bg-gray-900 text-white' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                    <i class="fas {{ $data['icon'] }} text-xs"></i>
                    <span>{{ $data['label'] }}</span>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Daftar Pesanan -->
    <div class="space-y-4 md:space-y-6">
        @forelse($orders as $order)
            <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                <!-- Header -->
                <div class="bg-gradient-to-r from-gray-900 to-black text-white p-4 md:p-6">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                        <div>
                            <h3 class="text-lg md:text-xl font-bold">#{{ $order->order_code }}</h3>
                            <p class="text-xs md:text-sm opacity-90">{{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div class="text-left sm:text-right">
                            <div class="text-xl md:text-2xl font-bold">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                            <div class="text-xs md:text-sm opacity-90">
                                {{ strtoupper($order->metode_pembayaran) }}
                                @if($order->isCod()) 
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-green-500/20 rounded text-xs">
                                        <i class="fas fa-money-bill-wave"></i>
                                        Bayar di Tempat
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4 md:p-6">
                    <!-- Info Grid -->
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-4 md:mb-6">
                        <!-- Status Pesanan -->
                        <div>
                            <p class="text-xs md:text-sm text-gray-500 mb-2">Status Pesanan</p>
                            <div class="flex flex-wrap items-center gap-2">
                                {!! $order->status_badge !!}
                                @if(!$order->isCod() && $order->status_pembayaran)
                                    {!! $order->status_pembayaran_badge !!}
                                @endif
                            </div>
                        </div>

                        <!-- Pengiriman -->
                        <div>
                            <p class="text-xs md:text-sm text-gray-500 mb-2">Dikirim ke</p>
                            <p class="font-semibold text-sm md:text-base text-gray-900">{{ $order->nama_penerima }}</p>
                            <p class="text-xs md:text-sm text-gray-600">{{ $order->no_hp }}</p>
                        </div>

                        <!-- Aksi -->
                        <div class="flex items-end justify-start lg:justify-end">
                            @if($order->status === 'canceled')
                                <!-- Pesanan Dibatalkan -->
                                <span class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 text-red-700 rounded-lg font-semibold text-sm border border-red-200">
                                    <i class="fas fa-times-circle"></i>
                                    <span>Dibatalkan</span>
                                </span>

                            @elseif($order->status === 'completed')
                                <!-- Pesanan Selesai -->
                                <span class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 text-green-700 rounded-lg font-semibold text-sm border border-green-200">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Selesai</span>
                                </span>

                            @elseif($order->status === 'shipped')
                                <!-- Pesanan Sudah Dikirim - User Konfirmasi Penerimaan -->
                                <form action="{{ route('order.received', $order->order_code) }}" method="POST" 
                                      onsubmit="return confirm('Apakah Anda sudah menerima pesanan ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center gap-2 px-4 md:px-6 py-2 md:py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg font-bold hover:from-green-700 hover:to-green-800 transition shadow-md text-sm">
                                        <i class="fas fa-check-double"></i>
                                        <span>Pesanan Diterima</span>
                                    </button>
                                </form>

                            @elseif($order->isCod())
                                <!-- COD - Langsung diproses setelah order -->
                                @if($order->status === 'pending')
                                    <span class="inline-flex items-center gap-2 px-4 py-2 bg-orange-50 text-orange-700 rounded-lg font-semibold text-sm border border-orange-200">
                                        <i class="fas fa-clock"></i>
                                        <span>Menunggu Konfirmasi</span>
                                    </span>
                                @elseif(in_array($order->status, ['confirmed', 'packed']))
                                    <span class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-700 rounded-lg font-semibold text-sm border border-blue-200">
                                        <i class="fas fa-box"></i>
                                        <span>Sedang Diproses</span>
                                    </span>
                                @endif

                            @elseif($order->isEwallet())
                                <!-- E-Wallet Flow -->
                                @if(!$order->bukti_pembayaran)
                                    <!-- Belum upload bukti -->
                                    <a href="{{ route('order.payment', $order->order_code) }}"
                                       class="inline-flex items-center gap-2 px-4 md:px-6 py-2 md:py-3 bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-lg font-bold hover:from-yellow-600 hover:to-orange-600 transition shadow-md text-sm">
                                        <i class="fas fa-upload"></i>
                                        <span>Upload Bukti</span>
                                    </a>

                                @elseif($order->status_pembayaran === 'menunggu')
                                    <!-- Bukti sudah diupload, menunggu verifikasi admin -->
                                    <a href="{{ route('order.payment', $order->order_code) }}"
                                       class="inline-flex items-center gap-2 px-4 md:px-6 py-2 md:py-3 bg-blue-50 text-blue-700 rounded-lg font-semibold hover:bg-blue-100 transition border border-blue-200 text-sm">
                                        <i class="fas fa-hourglass-half"></i>
                                        <span>Menunggu Verifikasi</span>
                                    </a>

                                @elseif($order->status_pembayaran === 'ditolak')
                                    <!-- Bukti ditolak, perlu upload ulang -->
                                    <a href="{{ route('order.payment', $order->order_code) }}"
                                       class="inline-flex items-center gap-2 px-4 md:px-6 py-2 md:py-3 bg-red-600 text-white rounded-lg font-bold hover:bg-red-700 transition shadow-md text-sm">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <span>Upload Ulang</span>
                                    </a>

                                @elseif($order->status_pembayaran === 'diterima' && in_array($order->status, ['confirmed', 'packed']))
                                    <!-- Pembayaran diterima, pesanan diproses -->
                                    <span class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-700 rounded-lg font-semibold text-sm border border-blue-200">
                                        <i class="fas fa-box"></i>
                                        <span>Sedang Diproses</span>
                                    </span>
                                @endif

                            @else
                                <!-- Default fallback -->
                                <span class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 text-gray-600 rounded-lg font-medium text-sm">
                                    <i class="fas fa-info-circle"></i>
                                    <span>Menunggu</span>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Produk yang dibeli - Table Layout -->
                    <div class="border-t border-gray-200 pt-4 md:pt-6">
                        <p class="text-xs md:text-sm text-gray-500 mb-3 md:mb-4 font-medium">Produk ({{ $order->items->count() }} item)</p>
                        
                        <!-- Mobile: Card Layout -->
                        <div class="block md:hidden space-y-3">
                            @foreach($order->items as $item)
                                <div class="flex gap-3 bg-gray-50 rounded-lg p-3 border border-gray-200">
                                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex-shrink-0 overflow-hidden">
                                        @if($item->product && $item->product->gambar)
                                            <img src="{{ asset('storage/'.$item->product->gambar) }}" 
                                                 alt="{{ $item->nama_produk }}"
                                                 class="w-full h-full object-cover">
                                        @else
                                            <i class="fas fa-image text-xl text-gray-400 flex items-center justify-center h-full"></i>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-900 line-clamp-2 mb-1">{{ $item->nama_produk }}</p>
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs text-gray-600">×{{ $item->quantity }}</span>
                                            <span class="text-sm font-bold text-gray-900">Rp {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Desktop: Table Layout -->
                        <div class="hidden md:block overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50 border-b border-gray-200">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Produk</th>
                                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase w-24">Harga</th>
                                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase w-20">Qty</th>
                                        <th class="px-4 py-3 text-right text-xs font-semibold text-gray-700 uppercase w-32">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($order->items as $item)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-4 py-3">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-12 h-12 bg-gray-200 rounded-lg flex-shrink-0 overflow-hidden">
                                                        @if($item->product && $item->product->gambar)
                                                            <img src="{{ asset('storage/'.$item->product->gambar) }}" 
                                                                 alt="{{ $item->nama_produk }}"
                                                                 class="w-full h-full object-cover">
                                                        @else
                                                            <div class="w-full h-full flex items-center justify-center">
                                                                <i class="fas fa-image text-lg text-gray-400"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <p class="text-sm font-medium text-gray-900 line-clamp-2">{{ $item->nama_produk }}</p>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-center text-sm text-gray-900">
                                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                <span class="inline-flex items-center justify-center w-8 h-8 bg-gray-100 rounded-lg text-sm font-semibold text-gray-900">
                                                    {{ $item->quantity }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-right text-sm font-bold text-gray-900">
                                                Rp {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12 md:py-20">
                <div class="w-24 h-24 md:w-32 md:h-32 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-6">
                    <i class="fas fa-shopping-bag text-4xl md:text-5xl lg:text-6xl text-gray-400"></i>
                </div>
                <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-2 md:mb-3">Belum Ada Pesanan</h3>
                <p class="text-sm md:text-base text-gray-600 mb-6 md:mb-8">Yuk, mulai belanja koleksi terbaru!</p>
                <a href="{{ url('/produk') }}" class="inline-flex items-center gap-2 md:gap-3 bg-gray-900 text-white px-6 md:px-10 py-3 md:py-4 rounded-lg md:rounded-xl font-bold text-sm md:text-base hover:bg-black transition">
                    <i class="fas fa-arrow-right"></i>
                    <span>Mulai Belanja</span>
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($orders->hasPages())
        <div class="mt-8 md:mt-12 flex justify-center">
            {{ $orders->appends(request()->query())->links() }}
        </div>
    @endif
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.aspect-square {
    aspect-ratio: 1 / 1;
}

/* Custom pagination styling */
.pagination {
    display: flex;
    gap: 0.25rem;
    flex-wrap: wrap;
}

.pagination .page-link {
    padding: 0.5rem 0.75rem;
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    color: #374151;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s;
}

.pagination .page-link:hover {
    background-color: #f9fafb;
    border-color: #d1d5db;
}

.pagination .page-item.active .page-link {
    background-color: #111827;
    border-color: #111827;
    color: white;
}

.pagination .page-item.disabled .page-link {
    color: #9ca3af;
    background-color: #f9fafb;
}
</style>
@endsection