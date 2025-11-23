@extends('user.layouts.app')
@section('title', 'Kontak Kami - Klandest')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-16">

    <!-- Hero Section Kontak -->
    <div class="text-center mb-16">
        <h1 class="text-5xl font-bold text-gray-900 mb-4">Hubungi Kami</h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            Ada pertanyaan? Butuh bantuan? Tim kami siap membantu 24/7
        </p>
    </div>

    <div class="grid lg:grid-cols-2 gap-12">

        <!-- Bagian Kiri: Info Kontak & Maps -->
        <div class="space-y-10">

            <!-- WhatsApp Langsung (Paling Penting!) -->
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="flex items-center gap-5 mb-4">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fab fa-whatsapp text-3xl"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold">Chat WhatsApp</h3>
                        <p class="opacity-90">Fast response • 24 Jam</p>
                    </div>
                </div>
                <p class="text-lg mb-6">+62 812-3456-7890</p>
                <a href="https://wa.me/6281234567890?text=Halo%20Klandest%20%F0%9F%91%8B%20Saya%20mau%20tanya%20tentang..." 
                   target="_blank"
                   class="inline-flex items-center gap-3 bg-white text-green-600 px-8 py-4 rounded-xl font-bold hover:bg-gray-100 transition shadow-lg">
                    <i class="fab fa-whatsapp text-2xl"></i>
                    Chat Sekarang
                </a>
            </div>

            <!-- Info Kontak Lain -->
            <div class="grid sm:grid-cols-2 gap-6">
                <div class="bg-gray-50 rounded-xl p-6 text-center hover:bg-gray-100 transition">
                    <i class="fas fa-envelope text-4xl text-black mb-4"></i>
                    <h4 class="font-bold text-lg mb-2">Email</h4>
                    <p class="text-gray-600">info@klandest.com</p>
                    <a href="mailto:info@klandest.com" class="text-sm text-black underline hover:no-underline">Kirim Email</a>
                </div>

                <div class="bg-gray-50 rounded-xl p-6 text-center hover:bg-gray-100 transition">
                    <i class="fas fa-clock text-4xl text-black mb-4"></i>
                    <h4 class="font-bold text-lg mb-2">Jam Operasional</h4>
                    <p class="text-gray-600">Senin - Minggu</p>
                    <p class="font-semibold">08:00 - 22:00 WIB</p>
                </div>
            </div>

            <!-- Alamat & Maps -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
                <div class="p-6 bg-black text-white">
                    <h3 class="text-2xl font-bold flex items-center gap-3">
                        <i class="fas fa-map-marker-alt"></i>
                        Kunjungi Kami
                    </h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 mb-4 leading-relaxed">
                        Jl. Raya Klandest No. 99<br>
                        Jakarta Selatan, DKI Jakarta 12790<br>
                        Indonesia
                    </p>
                    <div class="aspect-w-16 aspect-h-9 rounded-xl overflow-hidden shadow-md">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.074!2d106.791!3d-6.259!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTUnMzIuNCI!5e0!3m2!1sid!2sid!4v1234567890" 
                            width="100%" 
                            height="300" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="bg-gradient-to-r from-black to-gray-900 text-white rounded-2xl p-8">
                <h3 class="text-2xl font-bold mb-6 text-center">Follow Kami</h3>
                <div class="flex justify-center gap-6">
                    <a href="https://instagram.com/klandest" target="_blank" class="w-14 h-14 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition">
                        <i class="fab fa-instagram text-2xl"></i>
                    </a>
                    <a href="https://tiktok.com/@klandest" target="_blank" class="w-14 h-14 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition">
                        <i class="fab fa-tiktok text-2xl"></i>
                    </a>
                    <a href="https://facebook.com/klandest" target="_blank" class="w-14 h-14 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition">
                        <i class="fab fa-facebook-f text-2xl"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Bagian Kanan: Form Kontak -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-200">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Kirim Pesan</h2>
            <p class="text-gray-600 mb-8">Kami akan balas dalam 1×24 jam</p>

            <form action="{{ route('kontak.store') }}" method="POST">
                @csrf
                <div class="grid sm:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition"
                               placeholder="John Doe">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition"
                               placeholder="john@example.com">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">No. WhatsApp</label>
                    <input type="text" name="whatsapp" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition"
                           placeholder="081234567890">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Subjek</label>
                    <select name="subjek" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black">
                        <option value="">Pilih subjek</option>
                        <option>Pertanyaan Produk</option>
                        <option>Komplain / Refund</option>
                        <option>Kerjasama / Reseller</option>
                        <option>Lainnya</option>
                    </select>
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
                    <textarea name="pesan" rows="6" required 
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black transition resize-none"
                              placeholder="Tulis pesan kamu di sini..."></textarea>
                </div>

                <button type="submit" 
                        class="w-full bg-black text-white py-4 rounded-xl font-bold text-lg hover:bg-gray-900 transition shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    Kirim Pesan
                </button>
            </form>
        </div>
    </div>

    <!-- FAQ Singkat -->
    <div class="mt-20 bg-gray-50 rounded-3xl p-10 text-center">
        <h2 class="text-3xl font-bold mb-6">Pertanyaan yang Sering Diajukan</h2>
        <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <div class="bg-white p-6 rounded-2xl shadow">
                <h4 class="font-bold mb-3">Berapa lama pengiriman?</h4>
                <p class="text-gray-600">1-3 hari kerja untuk Jabodetabek, 3-7 hari luar kota</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow">
                <h4 class="font-bold mb-3">Bisa COD?</h4>
                <p class="text-gray-600">Bisa! COD tersedia untuk seluruh Indonesia</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow">
                <h4 class="font-bold mb-3">Ada garansi?</h4>
                <p class="text-gray-600">100% original • 7 hari retur jika cacat</p>
            </div>
        </div>
    </div>
</div>
@endsection