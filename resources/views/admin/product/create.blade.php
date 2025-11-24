@extends('admin.layouts.app')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk')

@section('content')

<!-- Back Button -->
<div class="mb-6">
    <a href="{{ route('products.index') }}"
       class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 font-medium transition">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali ke Daftar Produk</span>
    </a>
</div>

<!-- Main Form Card -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    
    <!-- Header -->
    <div class="px-6 py-5 bg-gray-50 border-b border-gray-200">
        <h1 class="text-xl font-bold text-gray-900 flex items-center gap-2">
            <i class="fas fa-plus-circle text-gray-700"></i>
            <span>Tambah Produk Baru</span>
        </h1>
        <p class="text-sm text-gray-600 mt-1">Isi formulir di bawah untuk menambahkan produk dari Shopee</p>
    </div>

    <!-- Form -->
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
        @csrf

        <!-- Nama Produk -->
        <div>
            <label for="nama_produk" class="block text-sm font-semibold text-gray-700 mb-2">
                Nama Produk <span class="text-red-500">*</span>
            </label>
            <input type="text" 
                   name="nama_produk" 
                   id="nama_produk"
                   value="{{ old('nama_produk') }}"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition @error('nama_produk') border-red-500 @enderror"
                   placeholder="Contoh: Kaos Polos Premium Cotton"
                   required>
            @error('nama_produk')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Harga -->
        <div>
            <label for="harga" class="block text-sm font-semibold text-gray-700 mb-2">
                Harga (Rp) <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium text-sm">Rp</span>
                <input type="number" 
                       name="harga" 
                       id="harga"
                       value="{{ old('harga') }}"
                       class="w-full pl-12 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition @error('harga') border-red-500 @enderror"
                       placeholder="0"
                       min="0"
                       required>
            </div>
            @error('harga')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Link Shopee -->
        <div>
            <label for="shopee_link" class="block text-sm font-semibold text-gray-700 mb-2">
                Link Shopee <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-orange-500">
                    <i class="fab fa-shopify text-lg"></i>
                </span>
                <input type="url" 
                       name="shopee_link" 
                       id="shopee_link"
                       value="{{ old('shopee_link') }}"
                       class="w-full pl-12 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition @error('shopee_link') border-red-500 @enderror"
                       placeholder="https://shopee.co.id/..."
                       required>
            </div>
            <p class="mt-2 text-xs text-gray-500">
                <i class="fas fa-info-circle"></i>
                Salin link produk dari Shopee. Contoh: https://shopee.co.id/product.12345
            </p>
            @error('shopee_link')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Deskripsi -->
        <div>
            <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                Deskripsi
            </label>
            <textarea name="deskripsi" 
                      id="deskripsi"
                      rows="4"
                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition @error('deskripsi') border-red-500 @enderror"
                      placeholder="Deskripsi singkat produk (opsional)">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Kategori Produk -->
        <div>
            <label for="kategori_id" class="block text-sm font-semibold text-gray-700 mb-2">
                Kategori Produk <span class="text-red-500">*</span>
            </label>
            <select name="kategori_id" id="kategori_id" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition @error('kategori_id') border-red-500 @enderror">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Gambar -->
        <div>
            <label for="gambar" class="block text-sm font-semibold text-gray-700 mb-2">
                Gambar Produk
            </label>
            <div class="flex flex-col sm:flex-row gap-4">
                <label for="gambar" class="flex-1 cursor-pointer">
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-gray-900 transition text-center">
                        <div class="flex flex-col items-center gap-2">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                            <span class="text-sm font-medium text-gray-700">Klik untuk upload gambar</span>
                            <span class="text-xs text-gray-500">PNG, JPG, JPEG (Max. 2MB)</span>
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
                    <img src="" alt="Preview" class="w-32 h-32 object-cover rounded-lg border-2 border-gray-300 shadow-sm">
                </div>
            </div>
            @error('gambar')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
            <button type="submit"
                    class="flex-1 inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-black text-white px-6 py-3 rounded-lg transition font-semibold text-sm">
                <i class="fas fa-save"></i>
                <span>Simpan Produk</span>
            </button>

            <a href="{{ route('products.index') }}"
               class="flex-1 inline-flex items-center justify-center gap-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-lg transition font-semibold text-sm">
                <i class="fas fa-times"></i>
                <span>Batal</span>
            </a>
        </div>

    </form>

</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');
    const previewImg = preview.querySelector('img');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>

@endsection