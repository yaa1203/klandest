@extends('admin.layouts.app')

@section('title', 'Edit Produk')

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
    <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 px-8 py-6">
        <h1 class="text-2xl font-bold text-white flex items-center gap-3">
            <span class="text-3xl">✏️</span>
            <span>Edit Produk</span>
        </h1>
        <p class="text-yellow-100 text-sm mt-1">Perbarui informasi produk: <strong>{{ $product->nama_produk }}</strong></p>
    </div>

    <!-- Form -->
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-8">
        @csrf
        @method('PUT')

        <div class="space-y-6">

            <!-- Nama Produk -->
            <div>
                <label for="nama_produk" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Produk <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="nama_produk" 
                       id="nama_produk"
                       value="{{ old('nama_produk', $product->nama_produk) }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200 @error('nama_produk') border-red-500 @enderror"
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
                           value="{{ old('harga', $product->harga) }}"
                           class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200 @error('harga') border-red-500 @enderror"
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
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200 @error('deskripsi') border-red-500 @enderror"
                          placeholder="Deskripsi produk (opsional)">{{ old('deskripsi', $product->deskripsi ?? '') }}</textarea>
                @error('deskripsi')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <span>⚠️</span>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            <!-- Kategori Produk -->
            <div>
                <label for="kategori_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    Kategori Produk <span class="text-red-500">*</span>
                </label>
                <select name="kategoris_id" id="kategoris_id" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200 @error('kategoris_id') border-red-500 @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}"
                            {{ old('kategoris_id', $product->kategoris_id) == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
                @error('kategoris_id')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        Warning: {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Gambar -->
            <div>
                <label for="gambar" class="block text-sm font-semibold text-gray-700 mb-2">
                    Gambar Produk
                </label>

                <!-- Current Image -->
                @if($product->gambar)
                <div class="mb-4">
                    <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
                    <div class="inline-block relative">
                        <img src="{{ asset('storage/'.$product->gambar) }}"
                             alt="{{ $product->nama_produk }}"
                             class="w-40 h-40 object-cover rounded-lg border-2 border-gray-300 shadow-sm"
                             id="currentImage">
                        <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-30 transition-all duration-200 rounded-lg flex items-center justify-center">
                            <span class="text-white opacity-0 hover:opacity-100 font-medium text-sm">Gambar Lama</span>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Upload New Image -->
                <div class="flex items-start gap-4">
                    <label for="gambar" class="flex-1 cursor-pointer">
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-yellow-500 transition-colors duration-200 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <span class="text-4xl">📷</span>
                                <span class="text-sm font-medium text-gray-700">
                                    {{ $product->gambar ? 'Klik untuk ganti gambar' : 'Klik untuk upload gambar' }}
                                </span>
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
                    
                    <!-- New Image Preview -->
                    <div id="imagePreview" class="hidden">
                        <p class="text-sm text-gray-600 mb-2">Preview gambar baru:</p>
                        <img src="" alt="Preview" class="w-40 h-40 object-cover rounded-lg border-2 border-yellow-500 shadow-md">
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
                    class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 font-semibold">
                <span class="text-lg">💾</span>
                <span>Perbarui Produk</span>
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