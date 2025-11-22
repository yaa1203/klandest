@extends('admin.layouts.app')

@section('title', 'Tambah Produk')

@section('content')

<!-- Back Button -->
<div class="mb-6">
    <a href="{{ route('products.index') }}"
       class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 font-medium transition-colors duration-200">
        <span class="text-xl">←</span>
        <span>Kembali ke Daftar Produk</span>
    </a>
</div>

<!-- Main Form Card -->
<div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
    
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6">
        <h1 class="text-2xl font-bold text-white flex items-center gap-3">
            <span class="text-3xl">➕</span>
            <span>Tambah Produk Baru</span>
        </h1>
        <p class="text-blue-100 text-sm mt-1">Isi formulir di bawah untuk menambahkan produk</p>
    </div>

    <!-- Form -->
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
        @csrf

        <div class="space-y-6">

            <!-- Nama Produk -->
            <div>
                <label for="nama_produk" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Produk <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="nama_produk" 
                       id="nama_produk"
                       value="{{ old('nama_produk') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('nama_produk') border-red-500 @enderror"
                       placeholder="Contoh: Laptop ASUS ROG"
                       required>
                @error('nama_produk')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <span>⚠️</span>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            <!-- Harga -->
            <div>
                <label for="harga" class="block text-sm font-semibold text-gray-700 mb-2">
                    Harga (Rp) <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                    <input type="number" 
                           name="harga" 
                           id="harga"
                           value="{{ old('harga') }}"
                           class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('harga') border-red-500 @enderror"
                           placeholder="0"
                           min="0"
                           required>
                </div>
                @error('harga')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <span>⚠️</span>
                        <span>{{ $message }}</span>
                    </p>
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
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('deskripsi') border-red-500 @enderror"
                          placeholder="Deskripsi produk (opsional)">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <span>⚠️</span>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            <!-- Gambar -->
            <div>
                <label for="gambar" class="block text-sm font-semibold text-gray-700 mb-2">
                    Gambar Produk
                </label>
                <div class="flex items-center gap-4">
                    <label for="gambar" class="flex-1 cursor-pointer">
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-blue-500 transition-colors duration-200 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <span class="text-4xl">📷</span>
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
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <span>⚠️</span>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

        </div>

        <!-- Action Buttons -->
        <div class="flex gap-4 mt-8 pt-6 border-t border-gray-200">
            <button type="submit"
                    class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 font-semibold">
                <span class="text-lg">💾</span>
                <span>Simpan Produk</span>
            </button>

            <a href="{{ route('products.index') }}"
               class="flex-1 inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg transition-all duration-200 font-semibold">
                <span class="text-lg">❌</span>
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