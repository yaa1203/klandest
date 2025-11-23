@extends('admin.layouts.app')

@section('title', 'Edit Kategori')

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-8 max-w-2xl mx-auto">
        <h3 class="text-xl font-bold text-gray-900 mb-6">Edit Kategori: {{ $kategori->nama }}</h3>

        <form action="{{ route('kategori.update', $kategori) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $kategori->nama) }}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('nama') border-red-500 @enderror">
                @error('nama')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" 
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-4">
                <a href="{{ route('kategori.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium">Batal</a>
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">Update</button>
            </div>
        </form>
    </div>
@endsection