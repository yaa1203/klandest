@extends('admin.layouts.app')
@section('title', 'Pengaturan Kontak & Info')
@section('page-title', 'Pengaturan')

@section('content')
<div class="max-w-5xl">
    <form action="{{ route('settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- WhatsApp Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-green-50 to-emerald-50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                        <i class="fab fa-whatsapp text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">WhatsApp</h3>
                        <p class="text-sm text-gray-600">Pengaturan kontak WhatsApp</p>
                    </div>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-phone mr-2 text-green-500"></i>Nomor WhatsApp
                    </label>
                    <input type="text" name="whatsapp_number" 
                           value="{{ $settings['contact']['whatsapp_number'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                           placeholder="6281234567890" required>
                    <p class="text-xs text-gray-500 mt-1">Format: 62xxx (tanpa tanda +)</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-comment-dots mr-2 text-green-500"></i>Pesan Default WhatsApp
                    </label>
                    <input type="text" name="whatsapp_text" 
                           value="{{ $settings['contact']['whatsapp_text'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                           placeholder="Halo, saya mau tanya..." required>
                </div>
            </div>
        </div>

        <!-- Contact Info Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-address-book text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Informasi Kontak</h3>
                        <p class="text-sm text-gray-600">Email dan nomor telepon</p>
                    </div>
                </div>
            </div>
            <div class="p-6 grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2 text-blue-500"></i>Email
                    </label>
                    <input type="email" name="email" 
                           value="{{ $settings['contact']['email'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="info@klandest.com" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-phone-alt mr-2 text-blue-500"></i>No. Telepon Display
                    </label>
                    <input type="text" name="phone" 
                           value="{{ $settings['contact']['phone'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="+62 812-3456-7890" required>
                </div>
            </div>
        </div>

        <!-- Address & Maps Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-red-50 to-orange-50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-map-marker-alt text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Alamat & Peta</h3>
                        <p class="text-sm text-gray-600">Lokasi toko/kantor</p>
                    </div>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-road mr-2 text-red-500"></i>Alamat Baris 1
                    </label>
                    <input type="text" name="address_line1" 
                           value="{{ $settings['address']['address_line1'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                           placeholder="Jl. Raya Klandest No. 99" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-city mr-2 text-red-500"></i>Alamat Baris 2
                    </label>
                    <input type="text" name="address_line2" 
                           value="{{ $settings['address']['address_line2'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                           placeholder="Jakarta Selatan, DKI Jakarta 12790" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-flag mr-2 text-red-500"></i>Negara
                    </label>
                    <input type="text" name="address_country" 
                           value="{{ $settings['address']['address_country'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                           placeholder="Indonesia" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-map mr-2 text-red-500"></i>Google Maps Embed URL
                    </label>
                    <textarea name="maps_embed_url" rows="3" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 font-mono text-sm"
                              placeholder="https://www.google.com/maps/embed?pb=..." required>{{ $settings['address']['maps_embed_url'] ?? '' }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">
                        <a href="https://www.google.com/maps" target="_blank" class="text-blue-600 hover:underline">
                            <i class="fas fa-external-link-alt mr-1"></i>Dapatkan embed code dari Google Maps
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Social Media Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-purple-50 to-pink-50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-share-alt text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Media Sosial</h3>
                        <p class="text-sm text-gray-600">Link akun sosial media</p>
                    </div>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fab fa-instagram mr-2 text-pink-500"></i>Instagram
                    </label>
                    <input type="url" name="instagram_url" 
                           value="{{ $settings['social']['instagram_url'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                           placeholder="https://instagram.com/klandest">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fab fa-tiktok mr-2 text-gray-900"></i>TikTok
                    </label>
                    <input type="url" name="tiktok_url" 
                           value="{{ $settings['social']['tiktok_url'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-gray-500"
                           placeholder="https://tiktok.com/@klandest">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fab fa-facebook mr-2 text-blue-600"></i>Facebook
                    </label>
                    <input type="url" name="facebook_url" 
                           value="{{ $settings['social']['facebook_url'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="https://facebook.com/klandest">
                </div>
            </div>
        </div>

        <!-- Operating Hours Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-yellow-50 to-amber-50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-yellow-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clock text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Jam Operasional</h3>
                        <p class="text-sm text-gray-600">Waktu buka toko</p>
                    </div>
                </div>
            </div>
            <div class="p-6 grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar-week mr-2 text-yellow-500"></i>Hari Operasional
                    </label>
                    <input type="text" name="operating_days" 
                           value="{{ $settings['hours']['operating_days'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                           placeholder="Senin - Minggu" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-clock mr-2 text-yellow-500"></i>Jam Operasional
                    </label>
                    <input type="text" name="operating_hours" 
                           value="{{ $settings['hours']['operating_hours'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                           placeholder="08:00 - 22:00 WIB" required>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-between bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center gap-3 text-gray-600">
                <i class="fas fa-info-circle text-blue-500"></i>
                <span class="text-sm">Perubahan akan langsung diterapkan di halaman kontak</span>
            </div>
            <button type="submit" 
                    class="px-8 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition-all duration-200 shadow-md hover:shadow-lg flex items-center gap-2">
                <i class="fas fa-save"></i>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection