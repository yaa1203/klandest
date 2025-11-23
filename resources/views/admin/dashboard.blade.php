@extends('admin.layouts.app')
@section('title', 'Dashboard Admin - Klandest')
@section('page-title', 'Dashboard Overview')

@section('content')
<div class="space-y-6 md:space-y-8">

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
        
        <!-- Total Products -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Produk</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($totalProducts) }}</p>
                    <div class="mt-2 flex items-center text-xs text-green-600">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span class="font-medium">12% lebih banyak</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-gray-900 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-box text-2xl text-white"></i>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Pelanggan</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($totalUsers) }}</p>
                    <div class="mt-2 flex items-center text-xs text-green-600">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span class="font-medium">8% lebih banyak</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-users text-2xl text-white"></i>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Pesanan</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($totalOrders) }}</p>
                    <div class="mt-2 flex items-center text-xs text-green-600">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span class="font-medium">15% lebih banyak</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-shopping-bag text-2xl text-white"></i>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Pendapatan</p>
                    <p class="text-2xl md:text-3xl font-bold text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    <div class="mt-2 flex items-center text-xs text-green-600">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span class="font-medium">20% lebih banyak</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-orange-500 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-wallet text-2xl text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Two Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-8">

        <!-- Recent Orders -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-5 bg-gray-50 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Pesanan Terbaru</h3>
                        <p class="text-sm text-gray-600 mt-1">Daftar pesanan yang baru masuk</p>
                    </div>
                    <a href="{{ route('orders.index') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900 flex items-center gap-1">
                        <span>Lihat Semua</span>
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
            
            <div class="p-6">
                @forelse($recentOrders as $order)
                    <div class="flex items-center justify-between py-4 border-b border-gray-100 last:border-0 hover:bg-gray-50 -mx-2 px-2 rounded-lg transition">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-receipt text-white text-sm"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">#{{ $order->order_code }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $order->user?->name ?? 'Guest' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-900 text-sm">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                            <span class="inline-block mt-1 px-2.5 py-1 text-xs font-semibold rounded-md
                                {{ $order->status == 'pending' ? 'bg-orange-100 text-orange-700' : 
                                   ($order->status == 'success' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-inbox text-2xl text-gray-400"></i>
                        </div>
                        <p class="text-gray-600 font-medium">Belum ada pesanan</p>
                        <p class="text-sm text-gray-500 mt-1">Pesanan akan muncul di sini</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Products -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-5 bg-gray-50 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Produk Terbaru</h3>
                        <p class="text-sm text-gray-600 mt-1">Produk yang baru ditambahkan</p>
                    </div>
                    <a href="{{ route('products.index') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900 flex items-center gap-1">
                        <span>Lihat Semua</span>
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
            
            <div class="p-6">
                @forelse($recentProducts as $product)
                    <div class="flex items-center gap-4 py-4 border-b border-gray-100 last:border-0 hover:bg-gray-50 -mx-2 px-2 rounded-lg transition">
                        <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                            @if($product->gambar)
                                <img src="{{ asset('storage/'.$product->gambar) }}" 
                                     alt="{{ $product->nama_produk }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-tshirt text-xl text-gray-400"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-gray-900 truncate">{{ $product->nama_produk }}</p>
                            <p class="text-sm font-medium text-gray-900 mt-1">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex gap-2 flex-shrink-0">
                            <a href="{{ route('products.edit', $product->id) }}" 
                               class="w-8 h-8 flex items-center justify-center bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                                <i class="fas fa-edit text-sm text-gray-600"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-box-open text-2xl text-gray-400"></i>
                        </div>
                        <p class="text-gray-600 font-medium">Belum ada produk</p>
                        <p class="text-sm text-gray-500 mt-1">Tambahkan produk pertama Anda</p>
                        <a href="{{ route('products.create') }}" class="inline-block mt-4 px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-gray-800 transition">
                            <i class="fas fa-plus mr-2"></i>Tambah Produk
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="bg-gradient-to-br from-gray-900 to-black rounded-xl shadow-xl overflow-hidden">
        <div class="p-6 md:p-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div>
                    <h3 class="text-2xl font-bold text-white mb-2">Quick Actions</h3>
                    <p class="text-gray-400">Akses cepat ke fitur utama</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('products.create') }}" 
                   class="bg-white/10 backdrop-blur-sm hover:bg-white/20 rounded-xl p-6 transition group border border-white/10">
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-plus text-2xl text-white"></i>
                    </div>
                    <h4 class="text-white font-bold mb-1">Tambah Produk</h4>
                    <p class="text-gray-400 text-sm">Tambah produk baru</p>
                </a>

                <a href="{{ route('orders.index') }}" 
                   class="bg-white/10 backdrop-blur-sm hover:bg-white/20 rounded-xl p-6 transition group border border-white/10">
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-clipboard-list text-2xl text-white"></i>
                    </div>
                    <h4 class="text-white font-bold mb-1">Kelola Pesanan</h4>
                    <p class="text-gray-400 text-sm">Lihat & kelola pesanan</p>
                </a>

                <a href="{{ route('products.index') }}" 
                   class="bg-white/10 backdrop-blur-sm hover:bg-white/20 rounded-xl p-6 transition group border border-white/10">
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-boxes text-2xl text-white"></i>
                    </div>
                    <h4 class="text-white font-bold mb-1">Semua Produk</h4>
                    <p class="text-gray-400 text-sm">Kelola semua produk</p>
                </a>

                <a href="#" 
                   class="bg-white/10 backdrop-blur-sm hover:bg-white/20 rounded-xl p-6 transition group border border-white/10">
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-chart-bar text-2xl text-white"></i>
                    </div>
                    <h4 class="text-white font-bold mb-1">Laporan</h4>
                    <p class="text-gray-400 text-sm">Lihat statistik & laporan</p>
                </a>
            </div>
        </div>
    </div>

</div>

<style>
.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection