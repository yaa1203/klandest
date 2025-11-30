@extends('admin.layouts.app')
@section('title', 'Pengaturan Website')
@section('page-title', 'Pengaturan')

@section('content')

@if(session('success'))
<div class="mb-6 bg-green-50 border border-green-200 text-green-800 rounded-xl p-4">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
            <i class="fas fa-check-circle text-green-600"></i>
        </div>
        <p class="font-semibold">{{ session('success') }}</p>
    </div>
</div>
@endif

<div class="max-w-5xl">
    <form action="{{ route('settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- WhatsApp Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6 overflow-hidden">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-900 to-black">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center border border-white/20">
                        <i class="fab fa-whatsapp text-green-400 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">WhatsApp</h3>
                        <p class="text-sm text-gray-300">Pengaturan kontak WhatsApp untuk customer</p>
                    </div>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fas fa-phone mr-2 text-gray-600"></i>Nomor WhatsApp
                    </label>
                    <input type="text" name="whatsapp_number" 
                           value="{{ $settings['contact']['whatsapp_number'] ?? '' }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm"
                           placeholder="6281234567890" required>
                    <p class="text-xs text-gray-500 mt-1.5">
                        <i class="fas fa-info-circle mr-1"></i>
                        Format: 62xxx (tanpa tanda +). Contoh: 6281234567890
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fas fa-comment-dots mr-2 text-gray-600"></i>Pesan Default WhatsApp
                    </label>
                    <input type="text" name="whatsapp_text" 
                           value="{{ $settings['contact']['whatsapp_text'] ?? '' }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm"
                           placeholder="Halo, saya mau tanya tentang produk..." required>
                    <p class="text-xs text-gray-500 mt-1.5">
                        <i class="fas fa-info-circle mr-1"></i>
                        Pesan yang akan muncul otomatis saat customer menghubungi via WhatsApp
                    </p>
                </div>
            </div>
        </div>

        <!-- Contact Info Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6 overflow-hidden">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-900 to-black">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center border border-white/20">
                        <i class="fas fa-address-book text-blue-400 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">Informasi Kontak</h3>
                        <p class="text-sm text-gray-300">Email dan nomor telepon untuk ditampilkan</p>
                    </div>
                </div>
            </div>
            <div class="p-6 grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fas fa-envelope mr-2 text-gray-600"></i>Email
                    </label>
                    <input type="email" name="email" 
                           value="{{ $settings['contact']['email'] ?? '' }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm"
                           placeholder="info@klandest.com" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fas fa-phone-alt mr-2 text-gray-600"></i>No. Telepon Display
                    </label>
                    <input type="text" name="phone" 
                           value="{{ $settings['contact']['phone'] ?? '' }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm"
                           placeholder="+62 812-3456-7890" required>
                </div>
            </div>
        </div>

        <!-- Address & Maps Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6 overflow-hidden">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-900 to-black">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center border border-white/20">
                        <i class="fas fa-map-marker-alt text-red-400 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">Alamat & Peta</h3>
                        <p class="text-sm text-gray-300">Lokasi toko atau kantor</p>
                    </div>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fas fa-road mr-2 text-gray-600"></i>Alamat Baris 1
                    </label>
                    <input type="text" name="address_line1" 
                           value="{{ $settings['address']['address_line1'] ?? '' }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm"
                           placeholder="Jl. Raya Klandest No. 99" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fas fa-city mr-2 text-gray-600"></i>Alamat Baris 2
                    </label>
                    <input type="text" name="address_line2" 
                           value="{{ $settings['address']['address_line2'] ?? '' }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm"
                           placeholder="Jakarta Selatan, DKI Jakarta 12790" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fas fa-flag mr-2 text-gray-600"></i>Negara
                    </label>
                    <input type="text" name="address_country" 
                           value="{{ $settings['address']['address_country'] ?? '' }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm"
                           placeholder="Indonesia" required>
                </div>
                
                <!-- Google Maps dengan 2 pilihan -->
                <div class="border-2 border-gray-200 rounded-lg p-4 bg-gray-50">
                    <label class="block text-sm font-semibold text-gray-900 mb-3">
                        <i class="fas fa-map mr-2 text-gray-600"></i>Pilih Cara Input Google Maps
                    </label>
                    
                    <!-- Tab Selector -->
                    <div class="flex gap-2 mb-4">
                        <button type="button" onclick="switchMapInput('share')" id="btn-share"
                                class="map-tab-btn active flex-1 px-4 py-2 rounded-lg text-sm font-semibold transition-all">
                            <i class="fas fa-share-alt mr-2"></i>Pakai Link Share (Mudah)
                        </button>
                        <button type="button" onclick="switchMapInput('embed')" id="btn-embed"
                                class="map-tab-btn flex-1 px-4 py-2 rounded-lg text-sm font-semibold transition-all">
                            <i class="fas fa-code mr-2"></i>Pakai Embed Code
                        </button>
                    </div>

                    <!-- Option 1: Share Link (Mudah) -->
                    <div id="map-share" class="map-input-section">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-3">
                            <h4 class="font-semibold text-blue-900 mb-2 flex items-center gap-2">
                                <i class="fas fa-lightbulb"></i>Cara Mudah (Recommended):
                            </h4>
                            <ol class="text-sm text-blue-800 space-y-1 ml-5 list-decimal">
                                <li>Buka <a href="https://maps.google.com" target="_blank" class="underline font-semibold">Google Maps</a></li>
                                <li>Cari lokasi toko Anda</li>
                                <li>Klik tombol <strong>"Share"</strong> atau <strong>"Bagikan"</strong></li>
                                <li>Copy link yang muncul (contoh: https://maps.app.goo.gl/xxxxx)</li>
                                <li>Paste link tersebut di kolom bawah ini</li>
                            </ol>
                        </div>
                        <input type="text" name="maps_share_link" id="maps_share_link"
                               value="{{ $settings['address']['maps_share_link'] ?? '' }}"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm font-mono"
                               placeholder="https://maps.app.goo.gl/xxxxx atau https://goo.gl/maps/xxxxx">
                        <p class="text-xs text-gray-600 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Link pendek dari Google Maps (lebih mudah!)
                        </p>
                    </div>

                    <!-- Option 2: Embed Code (Advanced) -->
                    <div id="map-embed" class="map-input-section hidden">
                        <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 mb-3">
                            <h4 class="font-semibold text-amber-900 mb-2 flex items-center gap-2">
                                <i class="fas fa-code"></i>Cara Embed Code:
                            </h4>
                            <ol class="text-sm text-amber-800 space-y-1 ml-5 list-decimal">
                                <li>Buka <a href="https://maps.google.com" target="_blank" class="underline font-semibold">Google Maps</a></li>
                                <li>Cari lokasi toko Anda</li>
                                <li>Klik tombol <strong>"Share"</strong> → Pilih tab <strong>"Embed a map"</strong></li>
                                <li>Klik <strong>"Copy HTML"</strong></li>
                                <li>Paste kode HTML atau URL embed di kolom bawah</li>
                            </ol>
                        </div>
                        <textarea name="maps_embed_url" id="maps_embed_url" rows="3" 
                                  class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm font-mono"
                                  placeholder='https://www.google.com/maps/embed?pb=... atau <iframe src="..."></iframe>'>{{ $settings['address']['maps_embed_url'] ?? '' }}</textarea>
                        <p class="text-xs text-gray-600 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Bisa paste URL embed atau kode iframe lengkap
                        </p>
                    </div>

                    <!-- Preview Map -->
                    @if(!empty($settings['address']['maps_embed_url']) || !empty($settings['address']['maps_share_link']))
                    <div class="mt-4">
                        <p class="text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-eye mr-2"></i>Preview Peta Saat Ini:
                        </p>
                        <div class="border-2 border-gray-300 rounded-lg overflow-hidden">
                            <iframe 
                                src="{{ $settings['address']['maps_embed_url'] ?? '' }}" 
                                width="100%" 
                                height="300" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Social Media Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6 overflow-hidden">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-900 to-black">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center border border-white/20">
                        <i class="fas fa-share-alt text-purple-400 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">Media Sosial</h3>
                        <p class="text-sm text-gray-300">Link akun sosial media Klandest</p>
                    </div>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fab fa-instagram mr-2 text-pink-500"></i>Instagram
                    </label>
                    <input type="url" name="instagram_url" 
                           value="{{ $settings['social']['instagram_url'] ?? '' }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm"
                           placeholder="https://instagram.com/klandest">
                    <p class="text-xs text-gray-500 mt-1.5">Kosongkan jika tidak digunakan</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fab fa-tiktok mr-2 text-gray-900"></i>TikTok
                    </label>
                    <input type="url" name="tiktok_url" 
                           value="{{ $settings['social']['tiktok_url'] ?? '' }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm"
                           placeholder="https://tiktok.com/@klandest">
                    <p class="text-xs text-gray-500 mt-1.5">Kosongkan jika tidak digunakan</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fab fa-facebook mr-2 text-blue-600"></i>Facebook
                    </label>
                    <input type="url" name="facebook_url" 
                           value="{{ $settings['social']['facebook_url'] ?? '' }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm"
                           placeholder="https://facebook.com/klandest">
                    <p class="text-xs text-gray-500 mt-1.5">Kosongkan jika tidak digunakan</p>
                </div>
            </div>
        </div>

        <!-- Operating Hours Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6 overflow-hidden">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-900 to-black">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center border border-white/20">
                        <i class="fas fa-clock text-yellow-400 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">Jam Operasional</h3>
                        <p class="text-sm text-gray-300">Waktu buka toko</p>
                    </div>
                </div>
            </div>
            <div class="p-6 grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fas fa-calendar-week mr-2 text-gray-600"></i>Hari Operasional
                    </label>
                    <input type="text" name="operating_days" 
                           value="{{ $settings['hours']['operating_days'] ?? '' }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm"
                           placeholder="Senin - Minggu" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fas fa-clock mr-2 text-gray-600"></i>Jam Operasional
                    </label>
                    <input type="text" name="operating_hours" 
                           value="{{ $settings['hours']['operating_hours'] ?? '' }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm"
                           placeholder="08:00 - 22:00 WIB" required>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center gap-3 text-gray-600">
                <i class="fas fa-info-circle text-gray-900"></i>
                <span class="text-sm">Perubahan akan langsung diterapkan di halaman kontak</span>
            </div>
            <button type="submit" 
                    class="w-full sm:w-auto px-8 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-black transition-all duration-200 shadow-sm hover:shadow-lg flex items-center justify-center gap-2">
                <i class="fas fa-save"></i>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<script>
function switchMapInput(type) {
    // Hide all sections
    document.getElementById('map-share').classList.add('hidden');
    document.getElementById('map-embed').classList.add('hidden');
    
    // Remove active class from all buttons
    document.getElementById('btn-share').classList.remove('active');
    document.getElementById('btn-embed').classList.remove('active');
    
    // Show selected section and activate button
    if (type === 'share') {
        document.getElementById('map-share').classList.remove('hidden');
        document.getElementById('btn-share').classList.add('active');
        // Clear embed field
        document.getElementById('maps_embed_url').value = '';
    } else {
        document.getElementById('map-embed').classList.remove('hidden');
        document.getElementById('btn-embed').classList.add('active');
        // Clear share field
        document.getElementById('maps_share_link').value = '';
    }
}

// Initialize: Show share by default if both are empty, or show the one that has value
document.addEventListener('DOMContentLoaded', function() {
    const shareLink = document.getElementById('maps_share_link').value;
    const embedUrl = document.getElementById('maps_embed_url').value;
    
    if (embedUrl && !shareLink) {
        switchMapInput('embed');
    } else {
        switchMapInput('share');
    }
});
</script>

<style>
.map-tab-btn {
    background: #f3f4f6;
    color: #6b7280;
    border: 2px solid transparent;
}

.map-tab-btn.active {
    background: #111827;
    color: white;
    border-color: #111827;
}

.map-tab-btn:hover:not(.active) {
    background: #e5e7eb;
    color: #111827;
}

.map-input-section {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

@endsection