@extends('admin.layouts.app')  <!-- Asumsi layoutmu bernama app.blade.php -->

@section('title', 'Daftar Kategori')

@section('content')
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-xl font-bold text-gray-900">Daftar Kategori</h3>
            <a href="{{ route('kategori.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                <i class="fas fa-plus mr-2"></i>Tambah Kategori
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($kategoris as $index => $kategori)
                        <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $kategoris->firstItem() + $index }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $kategori->nama }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($kategori->deskripsi, 100) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('kategori.edit', $kategori) }}" class="text-blue-600 hover:text-blue-900 mr-4">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('kategori.destroy', $kategori) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin hapus?')" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada kategori ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-gray-200">
            {{ $kategoris->links('pagination::tailwind') }}
        </div>
    </div>
@endsection