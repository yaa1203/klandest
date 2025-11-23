@extends('admin.layouts.app')
@section('title', 'Kelola Pesanan - Admin')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Kelola Pesanan</h1>
    <p class="text-gray-600 mt-1">Konfirmasi pembayaran & proses pesanan pelanggan</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Total Pesanan</p>
                <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Order::count() }}</p>
            </div>
            <i class="fas fa-receipt text-4xl text-blue-500 opacity-20"></i>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Menunggu Konfirmasi</p>
                <p class="text-3xl font-bold text-yellow-600">{{ \App\Models\Order::where('status', 'pending')->count() }}</p>
            </div>
            <i class="fas fa-clock text-4xl text-yellow-500 opacity-20"></i>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Pembayaran Ditunggu</p>
                <p class="text-3xl font-bold text-orange-600">{{ \App\Models\Order::waitingPayment()->count() }}</p>
            </div>
            <i class="fas fa-money-check-alt text-4xl text-orange-500 opacity-20"></i>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Selesai Hari Ini</p>
                <p class="text-3xl font-bold text-green-600">{{ \App\Models\Order::where('status', 'completed')->whereDate('updated_at', today())->count() }}</p>
            </div>
            <i class="fas fa-check-circle text-4xl text-green-500 opacity-20"></i>
        </div>
    </div>
</div>

<!-- Tabel Pesanan -->
<div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Kode</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Pelanggan</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Metode</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Bukti</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-5 font-bold text-gray-900">
                        #{{ $order->order_code }}
                        <p class="text-xs text-gray-500 mt-1">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                    </td>
                    <td class="px-6 py-5">
                        <div>
                            <p class="font-medium text-gray-900">{{ $order->nama_penerima }}</p>
                            <p class="text-sm text-gray-500">{{ $order->no_hp }}</p>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        @if($order->isCod())
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">COD</span>
                        @else
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-bold">
                                {{ strtoupper($order->metode_pembayaran) }}
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-5 font-bold text-gray-900">
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-5">
                        {!! $order->status_badge !!}
                        @if(!$order->isCod())
                            <div class="mt-2">{!! $order->status_pembayaran_badge !!}</div>
                        @endif
                    </td>
                    <td class="px-6 py-5 text-center">
                        @if($order->bukti_pembayaran)
                            <a href="{{ $order->bukti_url }}" target="_blank"
                               class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                                <i class="fas fa-image"></i> Lihat Bukti
                            </a>
                        @else
                            <span class="text-gray-400 text-sm">—</span>
                        @endif
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex flex-wrap gap-2">
                            @if($order->status === 'pending' && $order->isEwallet() && $order->status_pembayaran === 'menunggu')
                                <!-- Khusus e-wallet: approve pembayaran dulu -->
                                <form action="{{ route('orders.confirm', $order) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <button class="px-3 py-1.5 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition">
                                        Konfirmasi Bayar
                                    </button>
                                </form>
                            @endif

                            @if(in_array($order->status, ['pending', 'confirmed']))
                                <form action="{{ route('orders.pack', $order) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <button class="px-3 py-1.5 bg-indigo-600 text-white text-xs rounded hover:bg-indigo-700 transition">
                                        Dikemas
                                    </button>
                                </form>
                            @endif

                            @if($order->status === 'packed')
                                <form action="{{ route('orders.ship', $order) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <button class="px-3 py-1.5 bg-purple-600 text-white text-xs rounded hover:bg-purple-700 transition">
                                        Kirim
                                    </button>
                                </form>
                            @endif

                            @if($order->status === 'shipped')
                                <form action="{{ route('orders.complete', $order) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <button class="px-3 py-1.5 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition">
                                        Selesai
                                    </button>
                                </form>
                            @endif

                            @if(!in_array($order->status, ['completed', 'canceled']))
                                <form action="{{ route('orders.cancel', $order) }}" method="POST" class="inline" onsubmit="return confirm('Yakin batalkan?')">
                                    @csrf @method('PATCH')
                                    <button class="px-3 py-1.5 bg-red-600 text-white text-xs rounded hover:bg-red-700 transition">
                                        Batalkan
                                    </button>
                                </form>
                            @endif

                            @if(in_array($order->status, ['completed', 'canceled']))
                                <span class="text-xs text-gray-500 font-medium">Selesai diproses</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-inbox text-6xl mb-4 opacity-20"></i>
                        <p class="text-lg">Belum ada pesanan</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
        {{ $orders->links() }}
    </div>
</div>
@endsection