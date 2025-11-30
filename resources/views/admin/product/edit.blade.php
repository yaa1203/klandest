@extends('admin.layouts.app')

@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')

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
    <div class="px-4 sm:px-6 py-4 sm:py-5 bg-gradient-to-r from-yellow-500 to-yellow-600 border-b border-yellow-700">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                <i class="fas fa-edit text-white text-lg"></i>
            </div>
            <div class="flex-1">
                <h1 class="text-lg sm:text-xl font-bold text-white">Edit Produk</h1>
                <p class="text-xs sm:text-sm text-yellow-100 mt-1">Perbarui informasi produk: <strong>{{ $product->nama_produk }}</strong></p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-4 sm:p-6 space-y-6">
        @csrf
        @method('PUT')

        <!-- Nama Produk -->
        <div>
            <label for="nama_produk" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-tag text-gray-500 mr-1"></i>
                Nama Produk <span class="text-red-500">*</span>
            </label>
            <input type="text" 
                   name="nama_produk" 
                   id="nama_produk"
                   value="{{ old('nama_produk', $product->nama_produk) }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition @error('nama_produk') border-red-500 ring-2 ring-red-200 @enderror"
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
                       value="{{ old('harga', $product->harga) }}"
                       class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition @error('harga') border-red-500 ring-2 ring-red-200 @enderror"
                       placeholder="0"
                       min="0"
                       step="1000"
                       required>
            </div>
            <p class="mt-2 text-xs text-gray-500">
                <i class="fas fa-info-circle"></i>
                Harga saat ini: <strong class="text-gray-900">Rp {{ number_format($product->harga, 0, ',', '.') }}</strong>
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
                       value="{{ old('shopee_link', $product->shopee_link) }}"
                       class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition @error('shopee_link') border-red-500 ring-2 ring-red-200 @enderror"
                       placeholder="https://shopee.co.id/..."
                       required>
            </div>
            <div class="mt-2 flex items-center gap-2">
                <a href="{{ $product->shopee_link }}" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="inline-flex items-center gap-1 text-xs text-orange-600 hover:text-orange-700 font-medium">
                    <i class="fas fa-external-link-alt"></i>
                    <span>Lihat link saat ini</span>
                </a>
            </div>
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
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition resize-none @error('deskripsi') border-red-500 ring-2 ring-red-200 @enderror"
                      placeholder="Deskripsi singkat produk (opsional)">{{ old('deskripsi', $product->deskripsi ?? '') }}</textarea>
            <p class="mt-2 text-xs text-gray-500">
                <i class="fas fa-info-circle"></i>
                Kosongkan jika tidak ingin mengubah deskripsi
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
                
                <!-- Current Image -->
                @if($product->gambar)
                <div>
                    <p class="text-xs font-medium text-gray-600 mb-2">Gambar Saat Ini</p>
                    <div class="relative group">
                        <img src="{{ asset('storage/'.$product->gambar) }}"
                             alt="{{ $product->nama_produk }}"
                             class="w-full h-48 sm:h-64 object-cover rounded-lg border-2 border-gray-300 shadow-sm"
                             id="currentImage">
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                            <div class="text-white text-center">
                                <i class="fas fa-image text-3xl mb-2"></i>
                                <p class="text-sm font-medium">Gambar Aktif</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Upload New Image -->
                <div>
                    <p class="text-xs font-medium text-gray-600 mb-2">
                        {{ $product->gambar ? 'Upload Gambar Baru (Opsional)' : 'Upload Gambar Produk' }}
                    </p>
                    <label for="gambar" class="cursor-pointer group block">
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 sm:p-8 hover:border-yellow-500 hover:bg-yellow-50 transition text-center h-48 sm:h-64 flex flex-col items-center justify-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center group-hover:bg-yellow-100 transition">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 group-hover:text-yellow-600 transition"></i>
                                </div>
                                <div>
                                    <span class="text-sm font-semibold text-gray-700 block">Klik untuk upload</span>
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
                </div>

                <!-- New Image Preview -->
                <div id="imagePreview" class="hidden {{ $product->gambar ? 'md:col-span-2' : '' }}">
                    <p class="text-xs font-medium text-gray-600 mb-2">Preview Gambar Baru</p>
                    <div class="relative group">
                        <img src="" 
                             alt="Preview" 
                             class="w-full h-48 sm:h-64 object-cover rounded-lg border-2 border-yellow-500 shadow-sm">
                        <button type="button" 
                                onclick="removeImage()"
                                class="absolute top-2 right-2 w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-lg opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center"
                                title="Hapus Gambar">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="absolute bottom-2 left-2 right-2 bg-black/50 backdrop-blur-sm text-white px-3 py-2 rounded-lg text-xs">
                            <i class="fas fa-check-circle text-green-400 mr-1"></i>
                            Gambar baru akan menggantikan gambar lama
                        </div>
                    </div>
                </div>
            </div>

            <p class="mt-3 text-xs text-gray-500">
                <i class="fas fa-info-circle"></i>
                {{ $product->gambar ? 'Upload gambar baru jika ingin mengganti gambar saat ini' : 'Rekomendasi ukuran: 800x800px' }}
            </p>
            @error('gambar')
                <div class="mt-2 flex items-start gap-2 text-sm text-red-600">
                    <i class="fas fa-exclamation-circle mt-0.5"></i>
                    <span>{{ $message }}</span>
                </div>
            @enderror
        </div>

        <!-- Info Box -->
        <div class="border-t border-gray-200 pt-6">
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex items-start gap-3">
                    <i class="fas fa-exclamation-triangle text-yellow-600 mt-0.5"></i>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-yellow-900 mb-1">Perhatian Sebelum Update</p>
                        <ul class="text-xs text-yellow-800 space-y-1">
                            <li>• Pastikan semua informasi sudah benar sebelum menyimpan</li>
                            <li>• Link Shopee harus valid dan masih aktif</li>
                            <li>• Gambar baru akan menggantikan gambar lama secara permanen</li>
                            <li>• Perubahan akan langsung terlihat di website</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
            <button type="submit"
                    class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white px-6 py-3 rounded-lg transition-all font-semibold text-sm shadow-sm hover:shadow-md">
                <i class="fas fa-save"></i>
                <span>Perbarui Produk</span>
            </button>

            <a href="{{ route('products.index') }}"
               class="flex-1 inline-flex items-center justify-center gap-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-lg transition-all font-semibold text-sm">
                <i class="fas fa-times"></i>
                <span>Batal</span>
            </a>
        </div>

    </form>

</div>

<!-- Product History Info (Optional) -->
<div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
    <div class="flex items-start gap-3">
        <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center flex-shrink-0">
            <i class="fas fa-info-circle text-blue-600 text-lg"></i>
        </div>
        <div class="flex-1">
            <h3 class="font-bold text-gray-900 mb-1">Informasi Produk</h3>
            <div class="text-sm text-gray-600 space-y-1">
                <p><i class="fas fa-calendar-plus text-gray-400 mr-2"></i>Ditambahkan: <strong>{{ $product->created_at->format('d M Y, H:i') }} WIB</strong></p>
                @if($product->updated_at && $product->updated_at != $product->created_at)
                <p><i class="fas fa-calendar-check text-gray-400 mr-2"></i>Terakhir diupdate: <strong>{{ $product->updated_at->format('d M Y, H:i') }} WIB</strong></p>
                @endif
            </div>
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

// Format price input
const hargaInput = document.getElementById('harga');
if (hargaInput) {
    hargaInput.addEventListener('blur', function() {
        if (this.value) {
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

// Confirm before leaving if form is modified
let formModified = false;
const form = document.querySelector('form');
const formInputs = form.querySelectorAll('input, textarea');

formInputs.forEach(input => {
    input.addEventListener('change', () => {
        formModified = true;
    });
});

window.addEventListener('beforeunload', (e) => {
    if (formModified) {
        e.preventDefault();
        e.returnValue = '';
    }
});

form.addEventListener('submit', () => {
    formModified = false;
});
</script>

@endsection