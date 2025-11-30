@extends('admin.layouts.app')
@section('title', 'Pesan Masuk')
@section('page-title', 'Pesan Masuk')

@section('content')

<!-- Alert Unread Messages -->
@if($unreadCount > 0)
<div class="mb-6 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl p-4 sm:p-5 shadow-lg">
    <div class="flex items-center gap-3 sm:gap-4">
        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
            <i class="fas fa-exclamation-circle text-xl sm:text-2xl"></i>
        </div>
        <div>
            <h3 class="font-bold text-base sm:text-lg">Pesan Belum Dibaca!</h3>
            <p class="text-xs sm:text-sm text-red-100">Ada {{ $unreadCount }} pesan baru yang perlu segera ditanggapi</p>
        </div>
    </div>
</div>
@endif

<!-- Header Section -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl md:text-2xl font-bold text-gray-900">Pesan dari Pelanggan</h2>
            <p class="text-sm text-gray-600 mt-1">Kelola dan tanggapi pesan dari customer</p>
        </div>
        <div class="flex flex-wrap items-center gap-2 sm:gap-3">
            <div class="flex items-center gap-2 bg-gray-100 px-3 sm:px-4 py-2 rounded-lg">
                <i class="fas fa-envelope text-gray-600 text-sm"></i>
                <span class="text-xs sm:text-sm font-semibold text-gray-900">Total: {{ $messages->total() }}</span>
            </div>
            @if($unreadCount > 0)
            <div class="flex items-center gap-2 bg-red-50 px-3 sm:px-4 py-2 rounded-lg border border-red-200">
                <i class="fas fa-bell text-red-600 text-sm"></i>
                <span class="text-xs sm:text-sm font-semibold text-red-600">Baru: {{ $unreadCount }}</span>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center flex-shrink-0">
                <i class="fas fa-inbox text-blue-600"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Total Pesan</p>
                <p class="text-2xl font-bold text-gray-900">{{ $messages->total() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center flex-shrink-0">
                <i class="fas fa-envelope text-red-600"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Belum Dibaca</p>
                <p class="text-2xl font-bold text-gray-900">{{ $unreadCount }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center flex-shrink-0">
                <i class="fas fa-check-circle text-green-600"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Sudah Dibalas</p>
                <p class="text-2xl font-bold text-gray-900">{{ $messages->where('reply', '!=', null)->count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Desktop Table View -->
<div class="hidden lg:block bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    
    <!-- Table Header -->
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
        <div class="flex items-center gap-2">
            <i class="fas fa-list text-gray-600"></i>
            <h3 class="font-semibold text-gray-900">Daftar Pesan</h3>
            <span class="px-2 py-1 bg-gray-200 text-gray-700 text-xs font-medium rounded-full">
                {{ $messages->total() }}
            </span>
        </div>
    </div>

    <!-- Table Wrapper -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Pengirim
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Subjek & Pesan
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Waktu
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($messages as $msg)
                <tr class="hover:bg-gray-50 transition-colors {{ !$msg->is_read ? 'bg-blue-50/50' : '' }}">
                    
                    <!-- Pengirim -->
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="font-semibold text-gray-900 truncate">{{ $msg->nama }}</p>
                                <p class="text-sm text-gray-600 flex items-center gap-1 mt-0.5">
                                    <i class="fab fa-whatsapp text-green-600"></i>
                                    {{ $msg->whatsapp }}
                                </p>
                                @if($msg->email)
                                <p class="text-xs text-gray-500 flex items-center gap-1 mt-0.5">
                                    <i class="fas fa-envelope"></i>
                                    {{ $msg->email }}
                                </p>
                                @endif
                            </div>
                        </div>
                    </td>

                    <!-- Subjek & Pesan -->
                    <td class="px-6 py-4">
                        <div class="max-w-md">
                            <p class="font-semibold text-gray-900 mb-1">{{ $msg->subjek }}</p>
                            <p class="text-sm text-gray-600 line-clamp-2">{{ Str::limit($msg->pesan, 80) }}</p>
                        </div>
                    </td>

                    <!-- Waktu -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm">
                            <p class="text-gray-900 font-medium">{{ $msg->created_at->format('d M Y') }}</p>
                            <p class="text-gray-500">{{ $msg->created_at->format('H:i') }} WIB</p>
                            <p class="text-xs text-gray-400 mt-1">{{ $msg->created_at->diffForHumans() }}</p>
                        </div>
                    </td>

                    <!-- Status -->
                    <td class="px-6 py-4">
                        @if(!$msg->is_read)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-700 rounded-lg text-xs font-semibold border border-red-200">
                                <i class="fas fa-circle text-red-500 text-[6px]"></i>
                                Belum Dibaca
                            </span>
                        @elseif($msg->reply)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-50 text-green-700 rounded-lg text-xs font-semibold border border-green-200">
                                <i class="fas fa-check-circle"></i>
                                Sudah Dibalas
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg text-xs font-semibold">
                                <i class="fas fa-eye"></i>
                                Sudah Dibaca
                            </span>
                        @endif
                    </td>

                    <!-- Aksi -->
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('contact.show', $msg) }}" 
                               class="inline-flex items-center gap-2 px-4 py-2 bg-gray-900 hover:bg-black text-white rounded-lg transition-all text-sm font-medium shadow-sm hover:shadow-md">
                                <i class="fas fa-eye"></i>
                                <span>Lihat & Balas</span>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center gap-4">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-inbox text-4xl text-gray-400"></i>
                            </div>
                            <div>
                                <p class="text-gray-900 font-semibold mb-1">Tidak Ada Pesan</p>
                                <p class="text-sm text-gray-500">Belum ada pesan masuk dari pelanggan</p>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($messages->hasPages())
    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-sm text-gray-600">
                Menampilkan <span class="font-semibold text-gray-900">{{ $messages->firstItem() }}</span> 
                sampai <span class="font-semibold text-gray-900">{{ $messages->lastItem() }}</span> 
                dari <span class="font-semibold text-gray-900">{{ $messages->total() }}</span> pesan
            </div>
            <div>
                {{ $messages->links() }}
            </div>
        </div>
    </div>
    @endif

</div>

<!-- Mobile Card View -->
<div class="lg:hidden space-y-4">
    @forelse($messages as $msg)
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden {{ !$msg->is_read ? 'border-blue-300 ring-2 ring-blue-100' : '' }}">
        
        <!-- Card Header -->
        <div class="p-4 border-b border-gray-100 {{ !$msg->is_read ? 'bg-blue-50/50' : 'bg-gray-50' }}">
            <div class="flex items-start justify-between gap-3">
                <div class="flex items-center gap-3 flex-1 min-w-0">
                    <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-user text-white text-sm"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-gray-900 truncate">{{ $msg->nama }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">{{ $msg->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                
                <!-- Status Badge -->
                @if(!$msg->is_read)
                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-red-500 text-white rounded-full text-xs font-semibold flex-shrink-0">
                        <i class="fas fa-circle text-[6px]"></i>
                        <span>Baru</span>
                    </span>
                @elseif($msg->reply)
                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-500 text-white rounded-full text-xs font-semibold flex-shrink-0">
                        <i class="fas fa-check"></i>
                        <span>Dibalas</span>
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-gray-500 text-white rounded-full text-xs font-semibold flex-shrink-0">
                        <i class="fas fa-eye"></i>
                        <span>Dibaca</span>
                    </span>
                @endif
            </div>
        </div>

        <!-- Card Body -->
        <div class="p-4">
            <!-- Subject -->
            <div class="mb-3">
                <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Subjek</p>
                <p class="font-semibold text-gray-900">{{ $msg->subjek }}</p>
            </div>

            <!-- Message Preview -->
            <div class="mb-3">
                <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Pesan</p>
                <p class="text-sm text-gray-700 line-clamp-3">{{ $msg->pesan }}</p>
            </div>

            <!-- Contact Info -->
            <div class="grid grid-cols-1 gap-2 mb-3">
                <div class="flex items-center gap-2 text-sm">
                    <i class="fab fa-whatsapp text-green-600 w-4"></i>
                    <span class="text-gray-700">{{ $msg->whatsapp }}</span>
                </div>
                @if($msg->email)
                <div class="flex items-center gap-2 text-sm">
                    <i class="fas fa-envelope text-blue-600 w-4"></i>
                    <span class="text-gray-700 truncate">{{ $msg->email }}</span>
                </div>
                @endif
            </div>

            <!-- Timestamp -->
            <div class="flex items-center gap-2 text-xs text-gray-500 mb-3 pb-3 border-b border-gray-100">
                <i class="far fa-clock"></i>
                <span>{{ $msg->created_at->format('d M Y, H:i') }} WIB</span>
            </div>

            <!-- Action Button -->
            <a href="{{ route('contact.show', $msg) }}" 
               class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-gray-900 hover:bg-black text-white rounded-lg transition-all text-sm font-medium shadow-sm">
                <i class="fas fa-eye"></i>
                <span>Lihat Detail & Balas</span>
            </a>
        </div>

    </div>
    @empty
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
        <div class="flex flex-col items-center gap-4 text-center">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center">
                <i class="fas fa-inbox text-4xl text-gray-400"></i>
            </div>
            <div>
                <p class="text-gray-900 font-semibold mb-1">Tidak Ada Pesan</p>
                <p class="text-sm text-gray-500">Belum ada pesan masuk dari pelanggan</p>
            </div>
        </div>
    </div>
    @endforelse

    <!-- Pagination Mobile -->
    @if($messages->hasPages())
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <div class="text-sm text-gray-600 text-center mb-3">
            Menampilkan <span class="font-semibold text-gray-900">{{ $messages->firstItem() }}</span> 
            sampai <span class="font-semibold text-gray-900">{{ $messages->lastItem() }}</span> 
            dari <span class="font-semibold text-gray-900">{{ $messages->total() }}</span> pesan
        </div>
        <div class="flex justify-center">
            {{ $messages->links() }}
        </div>
    </div>
    @endif
</div>

<style>
/* Line clamp utility */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Custom pagination styling */
.pagination {
    display: flex;
    gap: 0.25rem;
    flex-wrap: wrap;
    justify-content: center;
}

.pagination .page-link {
    padding: 0.5rem 0.75rem;
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    color: #374151;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s;
}

.pagination .page-link:hover {
    background-color: #f9fafb;
    border-color: #d1d5db;
}

.pagination .page-item.active .page-link {
    background-color: #111827;
    border-color: #111827;
    color: white;
}

.pagination .page-item.disabled .page-link {
    color: #9ca3af;
    background-color: #f9fafb;
}

@media (max-width: 640px) {
    .pagination .page-link {
        padding: 0.375rem 0.625rem;
        font-size: 0.8125rem;
    }
}
</style>

@endsection