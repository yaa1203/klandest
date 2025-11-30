@extends('user.layouts.app')

@section('title', 'Profil Saya - Klandest')

@section('content')

<!-- Hero Section with Profile Card -->
<div class="bg-gradient-to-br from-black via-gray-900 to-black text-white py-12 md:py-20 relative overflow-hidden">
    <!-- Decorative Elements -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
    </div>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10">
        <div class="text-center mb-8">
            <div class="inline-block">
                <div class="w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-white to-gray-200 rounded-full flex items-center justify-center mx-auto mb-4 shadow-2xl ring-4 ring-white/20">
                    <i class="fas fa-user text-4xl md:text-5xl text-black"></i>
                </div>
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full border border-white/20">
                    <i class="fas fa-crown text-yellow-400 text-sm"></i>
                    <span class="text-sm font-semibold">Member Premium</span>
                </div>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold mt-6 mb-2">{{ Auth::user()->name }}</h1>
            <p class="text-lg text-gray-300">{{ Auth::user()->email }}</p>
        </div>
    </div>
</div>

<!-- Success Messages -->
<div class="max-w-4xl mx-auto px-4 sm:px-6 -mt-6 relative z-20">
    @if(session('status') === 'profile-updated')
        <div class="mb-6 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl p-5 shadow-xl transform transition-all">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <p class="text-base font-semibold">Profil berhasil diperbarui!</p>
            </div>
        </div>
    @endif

    @if(session('status') === 'password-updated')
        <div class="mb-6 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl p-5 shadow-xl transform transition-all">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <p class="text-base font-semibold">Password berhasil diperbarui!</p>
            </div>
        </div>
    @endif
</div>

<!-- Main Content -->
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-8 md:py-12">
    
    <!-- Tab Navigation -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-2 mb-8 sticky top-4 z-30">
        <div class="grid grid-cols-3 gap-2">
            <button onclick="switchTab('info-profil')" class="tab-button active px-4 py-3 rounded-xl font-semibold text-sm md:text-base transition-all">
                <i class="fas fa-user-circle mr-2"></i>
                <span class="hidden sm:inline">Info </span>Profil
            </button>
            <button onclick="switchTab('ubah-password')" class="tab-button px-4 py-3 rounded-xl font-semibold text-sm md:text-base transition-all">
                <i class="fas fa-lock mr-2"></i>
                <span class="hidden sm:inline">Ubah </span>Password
            </button>
            <button onclick="switchTab('hapus-akun')" class="tab-button px-4 py-3 rounded-xl font-semibold text-sm md:text-base transition-all">
                <i class="fas fa-trash-alt mr-2"></i>
                <span class="hidden sm:inline">Hapus </span>Akun
            </button>
        </div>
    </div>

    <!-- Tab Contents -->
    <div class="space-y-8">

        <!-- Update Profile Information -->
        <div id="info-profil" class="tab-content bg-white rounded-2xl shadow-xl border border-gray-100 p-6 md:p-10 transform transition-all">
            <div class="flex items-start gap-4 mb-8">
                <div class="w-12 h-12 bg-gradient-to-br from-black to-gray-700 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-user-edit text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Informasi Profil</h2>
                    <p class="text-base text-gray-600">Perbarui informasi profil dan alamat email akun Anda.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('PATCH')

                <!-- Name -->
                <div class="group">
                    <label for="name" class="block text-base font-bold text-gray-900 mb-3">
                        Nama Lengkap
                    </label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-black transition-colors">
                            <i class="fas fa-user"></i>
                        </div>
                        <input 
                            id="name" 
                            type="text" 
                            name="name" 
                            value="{{ old('name', Auth::user()->name) }}" 
                            required
                            class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-black focus:ring-4 focus:ring-black/5 transition-all text-base bg-gray-50 focus:bg-white"
                            placeholder="Masukkan nama lengkap"
                        >
                    </div>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-2">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="group">
                    <label for="email" class="block text-base font-bold text-gray-900 mb-3">
                        Alamat Email
                    </label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-black transition-colors">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email', Auth::user()->email) }}" 
                            required
                            class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-black focus:ring-4 focus:ring-black/5 transition-all text-base bg-gray-50 focus:bg-white"
                            placeholder="nama@email.com"
                        >
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-2">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror

                    @if (Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! Auth::user()->hasVerifiedEmail())
                        <div class="mt-3 p-4 bg-amber-50 border-2 border-amber-200 rounded-xl">
                            <p class="text-sm text-amber-800">
                                <i class="fas fa-info-circle mr-1"></i>
                                Email Anda belum diverifikasi.
                                <button form="send-verification" class="underline font-semibold hover:text-amber-900">
                                    Klik di sini untuk mengirim ulang email verifikasi.
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 text-sm text-green-700 font-medium">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Link verifikasi baru telah dikirim ke email Anda.
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button 
                        type="submit" 
                        class="w-full sm:w-auto bg-gradient-to-r from-black to-gray-800 text-white px-8 py-4 rounded-xl font-bold hover:from-gray-800 hover:to-black transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 text-base flex items-center justify-center gap-3"
                    >
                        <i class="fas fa-save text-lg"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Update Password -->
        <div id="ubah-password" class="tab-content hidden bg-white rounded-2xl shadow-xl border border-gray-100 p-6 md:p-10 transform transition-all">
            <div class="flex items-start gap-4 mb-8">
                <div class="w-12 h-12 bg-gradient-to-br from-black to-gray-700 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-shield-alt text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Ubah Password</h2>
                    <p class="text-base text-gray-600">Pastikan akun Anda menggunakan password yang kuat dan aman.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Current Password -->
                <div class="group">
                    <label for="current_password" class="block text-base font-bold text-gray-900 mb-3">
                        Password Saat Ini
                    </label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-black transition-colors">
                            <i class="fas fa-lock"></i>
                        </div>
                        <input 
                            id="current_password" 
                            type="password" 
                            name="current_password" 
                            required
                            class="w-full pl-12 pr-14 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-black focus:ring-4 focus:ring-black/5 transition-all text-base bg-gray-50 focus:bg-white"
                            placeholder="Masukkan password saat ini"
                        >
                        <button 
                            type="button" 
                            onclick="togglePasswordVisibility('current_password', 'toggleIcon1')"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-black transition-colors"
                        >
                            <i id="toggleIcon1" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('current_password', 'updatePassword')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-2">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="group">
                    <label for="password" class="block text-base font-bold text-gray-900 mb-3">
                        Password Baru
                    </label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-black transition-colors">
                            <i class="fas fa-key"></i>
                        </div>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required
                            class="w-full pl-12 pr-14 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-black focus:ring-4 focus:ring-black/5 transition-all text-base bg-gray-50 focus:bg-white"
                            placeholder="Minimal 8 karakter"
                        >
                        <button 
                            type="button" 
                            onclick="togglePasswordVisibility('password', 'toggleIcon2')"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-black transition-colors"
                        >
                            <i id="toggleIcon2" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password', 'updatePassword')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-2">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="group">
                    <label for="password_confirmation" class="block text-base font-bold text-gray-900 mb-3">
                        Konfirmasi Password Baru
                    </label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-black transition-colors">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <input 
                            id="password_confirmation" 
                            type="password" 
                            name="password_confirmation" 
                            required
                            class="w-full pl-12 pr-14 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-black focus:ring-4 focus:ring-black/5 transition-all text-base bg-gray-50 focus:bg-white"
                            placeholder="Ketik ulang password baru"
                        >
                        <button 
                            type="button" 
                            onclick="togglePasswordVisibility('password_confirmation', 'toggleIcon3')"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-black transition-colors"
                        >
                            <i id="toggleIcon3" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password_confirmation', 'updatePassword')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-2">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button 
                        type="submit" 
                        class="w-full sm:w-auto bg-gradient-to-r from-black to-gray-800 text-white px-8 py-4 rounded-xl font-bold hover:from-gray-800 hover:to-black transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 text-base flex items-center justify-center gap-3"
                    >
                        <i class="fas fa-save text-lg"></i>
                        <span>Ubah Password</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Delete Account -->
        <div id="hapus-akun" class="tab-content hidden bg-gradient-to-br from-red-50 to-pink-50 rounded-2xl shadow-xl border-2 border-red-200 p-6 md:p-10 transform transition-all">
            <div class="flex items-start gap-4 mb-8">
                <div class="w-12 h-12 bg-gradient-to-br from-red-600 to-red-700 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-red-600 mb-2">Zona Berbahaya</h2>
                    <p class="text-base text-gray-700">
                        Setelah akun Anda dihapus, semua data dan informasi akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 mb-6 border-2 border-red-100">
                <h3 class="font-bold text-lg text-gray-900 mb-3 flex items-center gap-2">
                    <i class="fas fa-info-circle text-red-500"></i>
                    Yang Akan Terjadi:
                </h3>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-times-circle text-red-500 mt-1"></i>
                        <span>Semua data pribadi akan dihapus permanen</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-times-circle text-red-500 mt-1"></i>
                        <span>Riwayat aktivitas tidak dapat dipulihkan</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-times-circle text-red-500 mt-1"></i>
                        <span>Akses ke semua layanan akan dicabut</span>
                    </li>
                </ul>
            </div>

            <button 
                onclick="openDeleteModal()"
                class="w-full sm:w-auto bg-gradient-to-r from-red-600 to-red-700 text-white px-8 py-4 rounded-xl font-bold hover:from-red-700 hover:to-red-800 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 text-base flex items-center justify-center gap-3"
            >
                <i class="fas fa-trash-alt text-lg"></i>
                <span>Hapus Akun Permanen</span>
            </button>
        </div>

    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 transform transition-all scale-95 modal-enter">
        <div class="text-center mb-6">
            <div class="w-20 h-20 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-xl">
                <i class="fas fa-exclamation-triangle text-4xl text-white"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-3">Konfirmasi Penghapusan</h3>
            <p class="text-base text-gray-600">
                Masukkan password Anda untuk mengkonfirmasi penghapusan akun. Tindakan ini tidak dapat dibatalkan.
            </p>
        </div>

        <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-5">
            @csrf
            @method('DELETE')

            <div class="group">
                <label for="password_delete" class="block text-sm font-bold text-gray-900 mb-2">
                    Password Anda
                </label>
                <div class="relative">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input 
                        id="password_delete" 
                        type="password" 
                        name="password" 
                        required
                        class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-500/10 transition-all text-base"
                        placeholder="Masukkan password Anda"
                    >
                </div>
                @error('password', 'userDeletion')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-2">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-3 pt-2">
                <button 
                    type="button"
                    onclick="closeDeleteModal()"
                    class="bg-gray-100 text-gray-700 px-6 py-3.5 rounded-xl font-bold hover:bg-gray-200 transition-all text-base"
                >
                    Batal
                </button>
                <button 
                    type="submit"
                    class="bg-gradient-to-r from-red-600 to-red-700 text-white px-6 py-3.5 rounded-xl font-bold hover:from-red-700 hover:to-red-800 transition-all text-base shadow-lg"
                >
                    Hapus
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function switchTab(tabId) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active class from all buttons
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active');
    });
    
    // Show selected tab content
    document.getElementById(tabId).classList.remove('hidden');
    
    // Add active class to clicked button
    event.target.closest('.tab-button').classList.add('active');
}

function togglePasswordVisibility(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

function openDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    setTimeout(() => {
        modal.querySelector('.modal-enter').classList.add('scale-100');
        modal.querySelector('.modal-enter').classList.remove('scale-95');
    }, 10);
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.querySelector('.modal-enter').classList.remove('scale-100');
    modal.querySelector('.modal-enter').classList.add('scale-95');
    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }, 200);
}

// Close modal when clicking outside
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});

// Handle ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDeleteModal();
    }
});
</script>

<style>
.tab-button {
    color: #6b7280;
    background: transparent;
}

.tab-button.active {
    background: linear-gradient(135deg, #000000 0%, #1f2937 100%);
    color: white;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.tab-button:hover:not(.active) {
    background: #f3f4f6;
    color: #111827;
}

.modal-enter {
    transition: transform 0.2s ease-out;
}

html {
    scroll-behavior: smooth;
}
</style>

@endsection