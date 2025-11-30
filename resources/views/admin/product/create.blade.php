@extends('admin.layouts.app')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk')

@section('content')

<!-- Back Button -->
<div class="mb-6">
    <a href="{{ route('products.index') }}"
       class="inline-flex items-center gap-2 px-4 py-2 bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 rounded-lg transition-all shadow-sm hover:shadow">
        <i class="fas fa-arrow-left"></i>
        <span class="font-medium">Kembali ke Daftar Produk</span>
    </a>
</div>

<!-- Main Form Card -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    
    <!-- Header -->
    <div class="px-4 sm:px-6 py-4 sm:py-5 bg-gradient-to-r from-gray-900 to-gray-800 border-b border-gray-700">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                <i class="fas fa-plus-circle text-white text-lg"></i>
            </div>
            <div class="flex-1">
                <h1 class="text-lg sm:text-xl font-bold text-white">Tambah Produk Baru</h1>
                <p class="text-xs sm:text-sm text-gray-300 mt-1">Isi formulir di bawah untuk menambahkan produk dari Shopee</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="p-4 sm:p-6 space-y-6">
        @csrf

        <!-- Nama Produk -->
        <div>
            <label for="nama_produk" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-tag text-gray-500 mr-1"></i>
                Nama Produk <span class="text-red-500">*</span>
            </label>
            <input type="text" 
                   name="nama_produk" 
                   id="nama_produk"
                   value="{{ old('nama_produk') }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent transition @error('nama_produk') border-red-500 ring-2 ring-red-200 @enderror"
                   placeholder="Contoh: Kaos Polos Premium Cotton"
                   required>
            @error('nama_produk')
                <div class="mt-2 flex items-start gap-2 text-sm text-red-600">
                    <i class="fas fa-exclamation-circle mt-0.5"></i>
                    <span>{{ $message }}</span>
                </div>
            @enderror
        </div>

        <!-- Harga -->
        <div>
            <label for="harga" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-money-bill-wave text-gray-500 mr-1"></i>
                Harga (Rp) <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold text-sm">Rp</span>
                <input type="number" 
                       name="harga" 
                       id="harga"
                       value="{{ old('harga') }}"
                       class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent transition @error('harga') border-red-500 ring-2 ring-red-200 @enderror"
                       placeholder="0"
                       min="0"
                       step="1000"
                       required>
            </div>
            <p class="mt-2 text-xs text-gray-500">
                <i class="fas fa-info-circle"></i>
                Masukkan harga produk dalam Rupiah (tanpa titik atau koma)
            </p>
            @error('harga')
                <div class="mt-2 flex items-start gap-2 text-sm text-red-600">
                    <i class="fas fa-exclamation-circle mt-0.5"></i>
                    <span>{{ $message }}</span>
                </div>
            @enderror
        </div>

        <!-- Link Shopee -->
        <div>
            <label for="shopee_link" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fab fa-shopify text-orange-500 mr-1"></i>
                Link Shopee <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-orange-500">
                    <i class="fas fa-link text-lg"></i>
                </span>
                <input type="url" 
                       name="shopee_link" 
                       id="shopee_link"
                       value="{{ old('shopee_link') }}"
                       class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent transition @error('shopee_link') border-red-500 ring-2 ring-red-200 @enderror"
                       placeholder="https://shopee.co.id/..."
                       required>
            </div>
            <p class="mt-2 text-xs text-gray-500">
                <i class="fas fa-info-circle"></i>
                Salin link produk dari Shopee. Contoh: https://shopee.co.id/product.12345
            </p>
            @error('shopee_link')
                <div class="mt-2 flex items-start gap-2 text-sm text-red-600">
                    <i class="fas fa-exclamation-circle mt-0.5"></i>
                    <span>{{ $message }}</span>
                </div>
            @enderror
        </div>

        <!-- Deskripsi -->
        <div>
            <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-align-left text-gray-500 mr-1"></i>
                Deskripsi
            </label>
            <textarea name="deskripsi" 
                      id="deskripsi"
                      rows="5"
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent transition resize-none @error('deskripsi') border-red-500 ring-2 ring-red-200 @enderror"
                      placeholder="Deskripsi singkat produk (opsional)&#10;&#10;Contoh:&#10;- Bahan: Cotton Combed 30s&#10;- Warna: Hitam, Putih, Abu&#10;- Ukuran: S, M, L, XL">{{ old('deskripsi') }}</textarea>
            <p class="mt-2 text-xs text-gray-500">
                <i class="fas fa-info-circle"></i>
                Deskripsi akan ditampilkan di detail produk (opsional)
            </p>
            @error('deskripsi')
                <div class="mt-2 flex items-start gap-2 text-sm text-red-600">
                    <i class="fas fa-exclamation-circle mt-0.5"></i>
                    <span>{{ $message }}</span>
                </div>
            @enderror
        </div>

        <!-- Gambar -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-image text-gray-500 mr-1"></i>
                Gambar Produk
            </label>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                <!-- Upload Area -->
                <label for="gambar" class="cursor-pointer group">
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 sm:p-8 hover:border-gray-900 hover:bg-gray-50 transition text-center">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center group-hover:bg-gray-200 transition">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 group-hover:text-gray-600 transition"></i>
                            </div>
                            <div>
                                <span class="text-sm font-semibold text-gray-700 block">Klik untuk upload gambar</span>
                                <span class="text-xs text-gray-500 mt-1 block">PNG, JPG, JPEG (Max. 2MB)</span>
                            </div>
                        </div>
                    </div>
                    <input type="file" 
                           name="gambar" 
                           id="gambar"
                           accept="image/png,image/jpg,image/jpeg"
                           class="hidden"
                           onchange="previewImage(event)">
                </label>
                
                <!-- Image Preview -->
                <div id="imagePreview" class="hidden">
                    <div class="relative group">
                        <img src="" 
                             alt="Preview" 
                             class="w-full h-48 sm:h-64 object-cover rounded-lg border-2 border-gray-300 shadow-sm">
                        <button type="button" 
                                onclick="removeImage()"
                                class="absolute top-2 right-2 w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-lg opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center"
                                title="Hapus Gambar">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="absolute bottom-2 left-2 right-2 bg-black/50 backdrop-blur-sm text-white px-3 py-2 rounded-lg text-xs opacity-0 group-hover:opacity-100 transition-opacity">
                            <i class="fas fa-check-circle text-green-400 mr-1"></i>
                            Gambar berhasil dipilih
                        </div>
                    </div>
                </div>
            </div>
            
            <p class="mt-2 text-xs text-gray-500">
                <i class="fas fa-info-circle"></i>
                Rekomendasi ukuran gambar: 800x800px untuk hasil terbaik
            </p>
            @error('gambar')
                <div class="mt-2 flex items-start gap-2 text-sm text-red-600">
                    <i class="fas fa-exclamation-circle mt-0.5"></i>
                    <span>{{ $message }}</span>
                </div>
            @enderror
        </div>

        <!-- Divider -->
        <div class="border-t border-gray-200 pt-6">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start gap-3">
                    <i class="fas fa-lightbulb text-blue-600 mt-0.5"></i>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-blue-900 mb-1">Tips Menambahkan Produk</p>
                        <ul class="text-xs text-blue-800 space-y-1">
                            <li>• Gunakan nama produk yang jelas dan deskriptif</li>
                            <li>• Pastikan link Shopee valid dan aktif</li>
                            <li>• Upload gambar berkualitas tinggi untuk menarik pembeli</li>
                            <li>• Tulis deskripsi lengkap untuk informasi tambahan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
            <button type="submit"
                    class="flex-1 inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-black text-white px-6 py-3 rounded-lg transition-all font-semibold text-sm shadow-sm hover:shadow-md">
                <i class="fas fa-save"></i>
                <span>Simpan Produk</span>
            </button>

            <a href="{{ route('products.index') }}"
               class="flex-1 inline-flex items-center justify-center gap-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-lg transition-all font-semibold text-sm">
                <i class="fas fa-times"></i>
                <span>Batal</span>
            </a>
        </div>

    </form>

</div>

<!-- Preview Info Box (Mobile) -->
<div class="mt-6 bg-gradient-to-r from-orange-50 to-orange-100 border border-orange-200 rounded-xl p-4 sm:p-6">
    <div class="flex items-start gap-3">
        <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center flex-shrink-0">
            <i class="fab fa-shopify text-white text-lg"></i>
        </div>
        <div class="flex-1">
            <h3 class="font-bold text-orange-900 mb-1">Integrasi Shopee</h3>
            <p class="text-sm text-orange-800">Produk yang ditambahkan akan terhubung langsung dengan link Shopee Anda. Pastikan link aktif agar customer dapat langsung mengunjungi toko Anda.</p>
        </div>
    </div>
</div>

<script>
// Preview Image Function
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');
    const previewImg = preview.querySelector('img');
    
    if (file) {
        // Validate file size (2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar! Maksimal 2MB');
            event.target.value = '';
            return;
        }
        
        // Validate file type
        const validTypes = ['image/png', 'image/jpg', 'image/jpeg'];
        if (!validTypes.includes(file.type)) {
            alert('Format file tidak valid! Gunakan PNG, JPG, atau JPEG');
            event.target.value = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}

// Remove Image Function
function removeImage() {
    const preview = document.getElementById('imagePreview');
    const fileInput = document.getElementById('gambar');
    
    preview.classList.add('hidden');
    fileInput.value = '';
}

// Format price input with thousand separator (optional enhancement)
const hargaInput = document.getElementById('harga');
if (hargaInput) {
    hargaInput.addEventListener('blur', function() {
        if (this.value) {
            // Remove any non-digit characters
            let value = this.value.replace(/\D/g, '');
            this.value = value;
        }
    });
}

// Auto-validate Shopee link
const shopeeInput = document.getElementById('shopee_link');
if (shopeeInput) {
    shopeeInput.addEventListener('blur', function() {
        const url = this.value.trim();
        if (url && !url.includes('shopee.co.id')) {
            const confirmChange = confirm('Link ini bukan dari Shopee Indonesia. Apakah Anda yakin?');
            if (!confirmChange) {
                this.focus();
            }
        }
    });
}
</script>

@endsection