{{-- resources/views/user/order/payment.blade.php --}}
@extends('user.layouts.app')
@section('title', 'Pembayaran - ' . $order->order_code)

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="text-center mb-12">
        {{-- Kalau sudah di-approve → ikon sukses --}}
        @if($order->status_pembayaran === 'diterima')
            <i class="fas fa-check-circle text-9xl text-green-500 mb-6"></i>
            <h1 class="text-5xl font-bold mb-4 text-green-700">Pembayaran Selesai!</h1>
            <p class="text-xl text-gray-700">
                Terima kasih! Pesanan kamu dengan kode <strong class="text-black">#{{ $order->order_code }}</strong> sudah kami konfirmasi.
            </p>
        @else
            <i class="fas fa-clock text-8xl text-yellow-500 mb-6"></i>
            <h1 class="text-4xl font-bold mb-4">Menunggu Pembayaran</h1>
            <p class="text-xl text-gray-600">
                Kode Pesanan: <strong class="text-black">#{{ $order->order_code }}</strong>
            </p>
        @endif
    </div>

    {{-- Status: Sudah Upload Bukti --}}
    @if($order->bukti_pembayaran && $order->status_pembayaran === 'menunggu')
        <div class="bg-yellow-50 border border-yellow-300 rounded-xl p-6 text-center mb-8">
            <i class="fas fa-hourglass-half text-5xl text-yellow-600 mb-4"></i>
            <p class="text-xl font-bold text-yellow-800">Bukti transfer sudah dikirim!</p>
            <p class="text-gray-700">Sedang menunggu konfirmasi admin (maks. 1×24 jam)</p>
        </div>
    @endif

    {{-- Status: Pembayaran Ditolak --}}
    @if($order->status_pembayaran === 'ditolak')
        <div class="bg-red-50 border border-red-300 rounded-xl p-6 text-center mb-8">
            <i class="fas fa-times-circle text-6xl text-red-600 mb-4"></i>
            <p class="text-xl font-bold text-red-800">Pembayaran Ditolak</p>
            <p class="text-gray-700">Silakan hubungi admin atau upload ulang bukti transfer yang benar.</p>
        </div>
    @endif

    {{-- Kalau sudah DI-APPROVE → Tampilkan pesan sukses + detail --}}
    @if($order->status_pembayaran === 'diterima')
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-300 rounded-2xl p-10 text-center mb-8">
            <div class="inline-flex items-center gap-4 bg-green-600 text-white px-8 py-4 rounded-full text-xl font-bold shadow-lg">
                <i class="fas fa-check-double text-3xl"></i>
                <span>Pembayaran Terverifikasi</span>
            </div>
            <div class="mt-8 space-y-4 text-lg text-gray-700">
                <p>Pesanan kamu sedang kami proses</p>
                <p>Kami akan segera menghubungi kamu via WhatsApp untuk konfirmasi pengiriman</p>
            </div>
        </div>

        <!-- Detail Ringkasan -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h3 class="text-2xl font-bold mb-6 text-center">Ringkasan Pesanan</h3>
            <div class="space-y-4 text-left">
                <div class="flex justify-between"><span class="font-medium">Kode Pesanan</span> <span class="font-bold">#{{ $order->order_code }}</span></div>
                <div class="flex justify-between"><span class="font-medium">Metode Pembayaran</span> <span class="text-purple-600 font-bold">{{ strtoupper($order->metode_pembayaran) }}</span></div>
                <div class="flex justify-between"><span class="font-medium">Total Bayar</span> <span class="text-2xl font-bold text-green-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span></div>
                <div class="flex justify-between"><span class="font-medium">Status</span> <span class="text-green-600 font-bold">Dikonfirmasi</span></div>
            </div>
        </div>

        <div class="mt-10 text-center">
            <a href="{{ route('produk.index') }}" class="inline-flex items-center gap-3 bg-black text-white px-10 py-5 rounded-xl font-bold text-xl hover:bg-gray-800 transition transform hover:scale-105">
                <i class="fas fa-shopping-bag"></i>
                Lanjut Belanja
            </a>
        </div>

    @else
        {{-- Kalau BELUM di-approve → tetap tampilkan info pembayaran & upload --}}
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Info Transfer -->
            <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                <h3 class="text-2xl font-bold mb-6">Transfer ke:</h3>
                <img src="{{ asset('images/qris.jpg') }}" alt="QRIS" class="w-64 h-64 mx-auto rounded-xl shadow-md mb-6">

                <div class="text-left space-y-4 text-lg bg-gray-50 p-6 rounded-xl">
                    <div class="flex justify-between"><strong>OVO / DANA / GoPay</strong> <span class="font-mono">0812-3456-7890</span></div>
                    <div class="flex justify-between"><strong>a.n.</strong> <span>Klandest Official</span></div>
                    <div class="flex justify-between text-2xl font-bold text-green-600 pt-4 border-t border-gray-300">
                        <span>Jumlah Transfer</span>
                        <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Upload Bukti Transfer -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h3 class="text-2xl font-bold mb-6">Upload Bukti Transfer</h3>

                @if(!$order->bukti_pembayaran || $order->status_pembayaran === 'ditolak')
                    <form action="{{ route('order.upload-proof', $order->order_code) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-10 text-center hover:border-gray-400 transition">
                            <i class="fas fa-cloud-upload-alt text-7xl text-gray-400 mb-4"></i>
                            <p class="text-gray-600 mb-6 text-lg">Klik untuk upload bukti transfer (JPG/PNG maks. 2MB)</p>
                            <input type="file" name="bukti" accept="image/*" required 
                                   class="block w-full text-sm text-gray-900 file:mr-4 file:py-4 file:px-8 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-black file:text-white hover:file:bg-gray-800 cursor-pointer">
                        </div>
                        <button type="submit" class="mt-8 w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white py-5 rounded-xl font-bold text-xl shadow-lg transform hover:scale-105 transition">
                            Kirim Bukti Transfer
                        </button>
                    </form>
                @else
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $order->bukti_pembayaran) }}" alt="Bukti Transfer" class="w-full rounded-xl shadow-md">
                        <p class="mt-4 text-green-600 font-bold">Bukti sudah dikirim</p>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection