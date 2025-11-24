{{-- resources/views/user/order/payment.blade.php --}}
@extends('user.layouts.app')
@section('title', 'Pembayaran - ' . $order->order_code)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
    
    <!-- Header Status -->
    <div class="text-center mb-8 md:mb-12">
        @if($order->status_pembayaran === 'diterima')
            <!-- Pembayaran Berhasil -->
            <div class="w-20 h-20 md:w-24 md:h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-6">
                <i class="fas fa-check-circle text-5xl md:text-6xl text-green-500"></i>
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-3 md:mb-4 text-green-700">Pembayaran Berhasil!</h1>
            <p class="text-base md:text-lg lg:text-xl text-gray-700">
                Terima kasih! Pesanan <strong class="text-gray-900">#{{ $order->order_code }}</strong> sudah dikonfirmasi.
            </p>
        @elseif($order->status_pembayaran === 'ditolak')
            <!-- Pembayaran Ditolak -->
            <div class="w-20 h-20 md:w-24 md:h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-6">
                <i class="fas fa-times-circle text-5xl md:text-6xl text-red-500"></i>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold mb-3 md:mb-4 text-red-700">Pembayaran Ditolak</h1>
            <p class="text-base md:text-lg text-gray-700">
                Silakan upload ulang bukti transfer yang benar.
            </p>
        @elseif($order->bukti_pembayaran && $order->status_pembayaran === 'menunggu')
            <!-- Menunggu Verifikasi -->
            <div class="w-20 h-20 md:w-24 md:h-24 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-6">
                <i class="fas fa-hourglass-half text-5xl md:text-6xl text-blue-500"></i>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold mb-3 md:mb-4 text-blue-700">Menunggu Verifikasi</h1>
            <p class="text-base md:text-lg text-gray-700">
                Kode Pesanan: <strong class="text-gray-900">#{{ $order->order_code }}</strong>
            </p>
        @else
            <!-- Belum Bayar -->
            <div class="w-20 h-20 md:w-24 md:h-24 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-6">
                <i class="fas fa-clock text-5xl md:text-6xl text-orange-500"></i>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold mb-3 md:mb-4 text-gray-900">Menunggu Pembayaran</h1>
            <p class="text-base md:text-lg text-gray-700">
                Kode Pesanan: <strong class="text-gray-900">#{{ $order->order_code }}</strong>
            </p>
        @endif
    </div>

    <!-- Alert Status -->
    @if($order->bukti_pembayaran && $order->status_pembayaran === 'menunggu')
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 md:p-6 text-center mb-6 md:mb-8">
            <i class="fas fa-info-circle text-3xl md:text-4xl text-blue-600 mb-3 md:mb-4"></i>
            <p class="text-base md:text-lg font-bold text-blue-900 mb-2">Bukti transfer sudah dikirim!</p>
            <p class="text-sm md:text-base text-blue-800">Sedang menunggu konfirmasi admin (maks. 1×24 jam)</p>
        </div>
    @endif

    @if($order->status_pembayaran === 'ditolak')
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 md:p-6 text-center mb-6 md:mb-8">
            <i class="fas fa-exclamation-triangle text-3xl md:text-4xl text-red-600 mb-3 md:mb-4"></i>
            <p class="text-base md:text-lg font-bold text-red-900 mb-2">Bukti Transfer Tidak Valid</p>
            <p class="text-sm md:text-base text-red-800">Silakan hubungi admin atau upload ulang bukti yang benar.</p>
        </div>
    @endif

    <!-- Jika Pembayaran DITERIMA -->
    @if($order->status_pembayaran === 'diterima')
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-300 rounded-xl md:rounded-2xl p-6 md:p-10 text-center mb-6 md:mb-8">
            <div class="inline-flex items-center gap-3 bg-green-600 text-white px-6 md:px-8 py-3 md:py-4 rounded-full text-base md:text-xl font-bold shadow-lg">
                <i class="fas fa-check-double text-2xl md:text-3xl"></i>
                <span>Pembayaran Terverifikasi</span>
            </div>
            <div class="mt-6 md:mt-8 space-y-3 md:space-y-4 text-sm md:text-base lg:text-lg text-gray-700">
                <p class="flex items-center justify-center gap-2">
                    <i class="fas fa-box text-green-600"></i>
                    <span>Pesanan kamu sedang kami proses</span>
                </p>
                <p class="flex items-center justify-center gap-2">
                    <i class="fab fa-whatsapp text-green-600"></i>
                    <span>Kami akan segera menghubungi kamu via WhatsApp</span>
                </p>
            </div>
        </div>

        <!-- Ringkasan Pesanan -->
        <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-6 md:p-8 mb-6 md:mb-8">
            <h3 class="text-xl md:text-2xl font-bold mb-4 md:mb-6 text-center">Ringkasan Pesanan</h3>
            <div class="space-y-3 md:space-y-4">
                <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                    <span class="text-sm md:text-base text-gray-600">Kode Pesanan</span>
                    <span class="text-sm md:text-base font-bold text-gray-900">#{{ $order->order_code }}</span>
                </div>
                <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                    <span class="text-sm md:text-base text-gray-600">Metode Pembayaran</span>
                    <span class="text-sm md:text-base font-bold text-purple-600">{{ strtoupper($order->metode_pembayaran) }}</span>
                </div>
                <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                    <span class="text-sm md:text-base text-gray-600">Total Bayar</span>
                    <span class="text-lg md:text-2xl font-bold text-green-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm md:text-base text-gray-600">Status</span>
                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs md:text-sm font-bold border border-green-200">
                        <i class="fas fa-check-circle"></i>
                        <span>Dikonfirmasi</span>
                    </span>
                </div>
            </div>
        </div>

        <div class="text-center space-y-3">
            <a href="{{ route('order.index') }}" class="block sm:inline-flex items-center justify-center gap-2 md:gap-3 bg-gray-900 text-white px-6 md:px-10 py-3 md:py-4 rounded-lg md:rounded-xl font-bold text-sm md:text-base hover:bg-black transition">
                <i class="fas fa-list"></i>
                <span>Lihat Pesanan Saya</span>
            </a>
            <a href="{{ route('produk.index') }}" class="block sm:inline-flex items-center justify-center gap-2 md:gap-3 bg-white text-gray-900 border-2 border-gray-900 px-6 md:px-10 py-3 md:py-4 rounded-lg md:rounded-xl font-bold text-sm md:text-base hover:bg-gray-50 transition">
                <i class="fas fa-shopping-bag"></i>
                <span>Lanjut Belanja</span>
            </a>
        </div>

    @else
        <!-- Jika BELUM Dikonfirmasi - Tampilkan Form -->
        <div class="grid md:grid-cols-2 gap-6 md:gap-8">
            <!-- Info Transfer -->
            <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-6 md:p-8">
                <h3 class="text-xl md:text-2xl font-bold mb-4 md:mb-6 text-center">Transfer ke:</h3>
                
                <div class="bg-gray-50 p-4 rounded-xl mb-6">
                    <img src="{{ asset('images/qris.jpg') }}" alt="QRIS" class="w-48 md:w-64 h-48 md:h-64 mx-auto rounded-xl shadow-md object-contain">
                </div>

                <div class="space-y-3 md:space-y-4 text-sm md:text-base bg-gray-50 p-4 md:p-6 rounded-xl">
                    <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                        <strong class="text-gray-700">OVO / DANA / GoPay</strong>
                        <span class="font-mono text-gray-900 font-semibold">0812-3456-7890</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                        <strong class="text-gray-700">a.n.</strong>
                        <span class="text-gray-900 font-semibold">Klandest Official</span>
                    </div>
                    <div class="flex justify-between items-center pt-2">
                        <span class="text-base md:text-lg font-bold text-gray-900">Jumlah Transfer</span>
                        <span class="text-lg md:text-2xl font-bold text-green-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="mt-4 md:mt-6 p-3 md:p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <p class="text-xs md:text-sm text-yellow-800 flex items-start gap-2">
                        <i class="fas fa-exclamation-triangle mt-0.5 flex-shrink-0"></i>
                        <span>Transfer sesuai nominal <strong>persis</strong> agar mudah diverifikasi</span>
                    </p>
                </div>
            </div>

            <!-- Upload Bukti Transfer -->
            <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-6 md:p-8">
                <h3 class="text-xl md:text-2xl font-bold mb-4 md:mb-6">Upload Bukti Transfer</h3>

                @if(!$order->bukti_pembayaran || $order->status_pembayaran === 'ditolak')
                    <form action="{{ route('order.upload-proof', $order->order_code) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 md:p-10 text-center hover:border-gray-400 transition mb-4 md:mb-6">
                            <i class="fas fa-cloud-upload-alt text-5xl md:text-6xl text-gray-400 mb-3 md:mb-4"></i>
                            <p class="text-sm md:text-base text-gray-600 mb-4 md:mb-6">Upload screenshot bukti transfer</p>
                            <p class="text-xs md:text-sm text-gray-500 mb-4">JPG/PNG maks. 2MB</p>
                            <input type="file" name="bukti" accept="image/*" required 
                                   class="block w-full text-xs md:text-sm text-gray-900 file:mr-4 file:py-2 md:file:py-3 file:px-4 md:file:px-6 file:rounded-lg file:border-0 file:text-xs md:file:text-sm file:font-medium file:bg-gray-900 file:text-white hover:file:bg-black cursor-pointer">
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white py-3 md:py-4 rounded-lg md:rounded-xl font-bold text-sm md:text-base shadow-lg transition">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Kirim Bukti Transfer
                        </button>
                    </form>
                @else
                    <div class="text-center">
                        <div class="bg-gray-50 p-4 rounded-xl mb-4">
                            <img src="{{ asset('storage/' . $order->bukti_pembayaran) }}" 
                                 alt="Bukti Transfer" 
                                 class="w-full max-h-96 object-contain rounded-lg shadow-md mx-auto">
                        </div>
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 text-green-700 rounded-lg font-bold border border-green-200">
                            <i class="fas fa-check-circle"></i>
                            <span class="text-sm md:text-base">Bukti sudah dikirim</span>
                        </div>
                        <p class="text-xs md:text-sm text-gray-600 mt-3">Menunggu verifikasi admin</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Help Section -->
        <div class="mt-8 md:mt-10 bg-gray-50 rounded-xl p-6 md:p-8 text-center">
            <h4 class="text-lg md:text-xl font-bold text-gray-900 mb-3 md:mb-4">Butuh Bantuan?</h4>
            <p class="text-sm md:text-base text-gray-600 mb-4 md:mb-6">Hubungi kami jika ada kendala dalam pembayaran</p>
            <a href="https://wa.me/6281234567890" target="_blank" 
               class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-6 md:px-8 py-3 rounded-lg font-bold text-sm md:text-base transition shadow-lg">
                <i class="fab fa-whatsapp text-xl"></i>
                <span>Chat WhatsApp</span>
            </a>
        </div>
    @endif
</div>
@endsection