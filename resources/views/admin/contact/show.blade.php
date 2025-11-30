@extends('admin.layouts.app')
@section('title', 'Detail Pesan')
@section('page-title', 'Detail Pesan')

@section('content')

<!-- Back Button -->
<div class="mb-6">
    <a href="{{ route('contact.index') }}" 
       class="inline-flex items-center gap-2 px-4 py-2 bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 rounded-lg transition-all shadow-sm hover:shadow">
        <i class="fas fa-arrow-left"></i>
        <span class="font-medium">Kembali ke Daftar Pesan</span>
    </a>
</div>

<!-- Header Section -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl md:text-2xl font-bold text-gray-900">Detail Pesan Pelanggan</h2>
            <p class="text-sm text-gray-600 mt-1">Baca dan balas pesan dari customer</p>
        </div>
        <div class="flex items-center gap-2">
            @if(!$message->is_read)
                <span class="inline-flex items-center gap-1.5 px-3 sm:px-4 py-2 bg-red-50 text-red-700 rounded-lg text-xs sm:text-sm font-semibold border border-red-200">
                    <i class="fas fa-circle text-red-500 text-[6px]"></i>
                    Belum Dibaca
                </span>
            @elseif($message->reply)
                <span class="inline-flex items-center gap-1.5 px-3 sm:px-4 py-2 bg-green-50 text-green-700 rounded-lg text-xs sm:text-sm font-semibold border border-green-200">
                    <i class="fas fa-check-circle"></i>
                    Sudah Dibalas
                </span>
            @else
                <span class="inline-flex items-center gap-1.5 px-3 sm:px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-xs sm:text-sm font-semibold">
                    <i class="fas fa-eye"></i>
                    Sudah Dibaca
                </span>
            @endif
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <!-- Left Column - Message Details -->
    <div class="lg:col-span-2 space-y-6">
        
        <!-- Message Content Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Card Header -->
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center gap-2">
                    <i class="fas fa-envelope text-gray-600"></i>
                    <h3 class="font-semibold text-gray-900 text-sm sm:text-base">Isi Pesan</h3>
                </div>
            </div>

            <!-- Message Subject -->
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-100 bg-blue-50/30">
                <p class="text-xs text-gray-600 uppercase font-semibold mb-1">Subjek Pesan</p>
                <p class="text-base sm:text-lg font-bold text-gray-900">{{ $message->subjek }}</p>
            </div>

            <!-- Message Body -->
            <div class="px-4 sm:px-6 py-4 sm:py-6">
                <p class="text-xs text-gray-600 uppercase font-semibold mb-3">Isi Pesan</p>
                <div class="prose prose-sm max-w-none">
                    <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $message->pesan }}</p>
                </div>
            </div>

            <!-- Message Footer -->
            <div class="px-4 sm:px-6 py-3 sm:py-4 bg-gray-50 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center gap-2 text-xs sm:text-sm text-gray-600">
                    <div class="flex items-center gap-2">
                        <i class="far fa-clock"></i>
                        <span>Dikirim pada <strong class="text-gray-900">{{ $message->created_at->format('d M Y') }}</strong></span>
                    </div>
                    <span class="hidden sm:inline text-gray-400">•</span>
                    <span>Pukul <strong class="text-gray-900">{{ $message->created_at->format('H:i') }} WIB</strong></span>
                    <span class="hidden sm:inline text-gray-400">•</span>
                    <span class="text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>

        <!-- Reply Section -->
        @if($message->reply)
            <!-- Existing Reply -->
            <div class="bg-white rounded-xl shadow-sm border border-green-200 overflow-hidden">
                <div class="px-4 sm:px-6 py-3 sm:py-4 bg-green-50 border-b border-green-200">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-reply text-green-600"></i>
                        <h3 class="font-semibold text-green-900 text-sm sm:text-base">Balasan Anda</h3>
                    </div>
                </div>
                
                <div class="px-4 sm:px-6 py-4 sm:py-6">
                    <div class="prose prose-sm max-w-none">
                        <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $message->reply }}</p>
                    </div>
                </div>

                <div class="px-4 sm:px-6 py-3 sm:py-4 bg-green-50 border-t border-green-200">
                    <div class="flex items-center gap-2 text-xs sm:text-sm text-green-700">
                        <i class="fas fa-check-circle"></i>
                        <span>Dibalas pada <strong>{{ $message->replied_at->format('d M Y H:i') }} WIB</strong></span>
                    </div>
                </div>
            </div>

            <!-- Update Reply Form -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-4 sm:px-6 py-3 sm:py-4 bg-gray-50 border-b border-gray-200">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-edit text-gray-600"></i>
                        <h3 class="font-semibold text-gray-900 text-sm sm:text-base">Perbarui Balasan</h3>
                    </div>
                </div>
                
                <form action="{{ route('contact.reply', $message) }}" method="POST" class="p-4 sm:p-6">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-comment-dots mr-1"></i>
                            Tulis Balasan Baru
                        </label>
                        <textarea 
                            name="reply" 
                            rows="6" 
                            required 
                            placeholder="Tulis balasan di sini... (akan kami kirim via Email)"
                            class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all resize-none text-gray-700 text-sm sm:text-base"
                        ></textarea>
                        <p class="mt-2 text-xs text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>
                            Balasan akan menggantikan balasan sebelumnya
                        </p>
                    </div>
                    
                    <button 
                        type="submit" 
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 sm:px-6 py-2.5 sm:py-3 bg-gray-900 hover:bg-black text-white rounded-lg font-semibold transition-all shadow-sm hover:shadow-md text-sm">
                        <i class="fas fa-paper-plane"></i>
                        <span>Perbarui Balasan</span>
                    </button>
                </form>
            </div>

        @else
            <!-- New Reply Form -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-4 sm:px-6 py-3 sm:py-4 bg-gray-50 border-b border-gray-200">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-reply text-gray-600"></i>
                        <h3 class="font-semibold text-gray-900 text-sm sm:text-base">Balas Pesan</h3>
                    </div>
                </div>
                
                <form action="{{ route('contact.reply', $message) }}" method="POST" class="p-4 sm:p-6">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-comment-dots mr-1"></i>
                            Tulis Balasan
                        </label>
                        <textarea 
                            name="reply" 
                            rows="8" 
                            required 
                            placeholder="Tulis balasan di sini... (akan kami kirim via WhatsApp)"
                            class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all resize-none text-gray-700 text-sm sm:text-base"
                        ></textarea>
                        <p class="mt-2 text-xs text-gray-500">
                            <i class="fab fa-whatsapp text-green-600 mr-1"></i>
                            Balasan akan dikirim ke WhatsApp pelanggan: <strong>{{ $message->whatsapp }}</strong>
                        </p>
                    </div>
                    
                    <button 
                        type="submit" 
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 sm:px-6 py-2.5 sm:py-3 bg-gray-900 hover:bg-black text-white rounded-lg font-semibold transition-all shadow-sm hover:shadow-md text-sm">
                        <i class="fas fa-paper-plane"></i>
                        <span>Kirim Balasan</span>
                    </button>
                </form>
            </div>
        @endif

    </div>

    <!-- Right Column - Sender Info -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden lg:sticky lg:top-24">
            
            <!-- Card Header -->
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center gap-2">
                    <i class="fas fa-user text-gray-600"></i>
                    <h3 class="font-semibold text-gray-900 text-sm sm:text-base">Info Pengirim</h3>
                </div>
            </div>

            <!-- Sender Avatar -->
            <div class="px-4 sm:px-6 py-4 sm:py-6 border-b border-gray-100">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-gray-800 to-gray-900 rounded-full flex items-center justify-center mb-3 shadow-lg">
                        <i class="fas fa-user text-2xl sm:text-3xl text-white"></i>
                    </div>
                    <h4 class="text-base sm:text-lg font-bold text-gray-900">{{ $message->nama }}</h4>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1">Pelanggan</p>
                </div>
            </div>

            <!-- Contact Details -->
            <div class="px-4 sm:px-6 py-4 space-y-4">
                
                <!-- WhatsApp -->
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fab fa-whatsapp text-green-600 text-lg"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs text-gray-600 uppercase font-semibold mb-1">WhatsApp</p>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->whatsapp) }}" 
                           target="_blank"
                           class="text-xs sm:text-sm font-semibold text-gray-900 hover:text-green-600 transition-colors break-all">
                            {{ $message->whatsapp }}
                        </a>
                    </div>
                </div>

                <!-- Email -->
                @if($message->email)
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-envelope text-blue-600"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs text-gray-600 uppercase font-semibold mb-1">Email</p>
                        <a href="mailto:{{ $message->email }}" 
                           class="text-xs sm:text-sm font-semibold text-gray-900 hover:text-blue-600 transition-colors break-all">
                            {{ $message->email }}
                        </a>
                    </div>
                </div>
                @endif

                <!-- Message Time -->
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="far fa-clock text-purple-600"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs text-gray-600 uppercase font-semibold mb-1">Waktu Kirim</p>
                        <p class="text-xs sm:text-sm font-semibold text-gray-900">{{ $message->created_at->format('d M Y') }}</p>
                        <p class="text-xs text-gray-600">{{ $message->created_at->format('H:i') }} WIB</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $message->created_at->diffForHumans() }}</p>
                    </div>
                </div>

            </div>

            <!-- Quick Actions -->
            <div class="px-4 sm:px-6 py-4 bg-gray-50 border-t border-gray-200">
                <p class="text-xs text-gray-600 uppercase font-semibold mb-3">Aksi Cepat</p>
                <div class="space-y-2">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->whatsapp) }}" 
                       target="_blank"
                       class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-all font-medium text-xs sm:text-sm shadow-sm">
                        <i class="fab fa-whatsapp"></i>
                        <span>Hubungi via WhatsApp</span>
                    </a>
                    
                    @if($message->email)
                    <a href="mailto:{{ $message->email }}" 
                       class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-all font-medium text-xs sm:text-sm shadow-sm">
                        <i class="fas fa-envelope"></i>
                        <span>Kirim Email</span>
                    </a>
                    @endif
                </div>
            </div>

        </div>
    </div>

</div>

@endsection