@extends('admin.layouts.app')

@section('title', 'Profil Admin')
@section('page-title', 'Profil Saya')

@section('content')

<!-- Success Messages -->
@if(session('status') === 'profile-updated')
<div class="mb-6 bg-green-50 border border-green-200 text-green-800 rounded-xl p-4">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
            <i class="fas fa-check-circle text-green-600"></i>
        </div>
        <p class="font-semibold">Profil berhasil diperbarui!</p>
    </div>
</div>
@endif

@if(session('status') === 'password-updated')
<div class="mb-6 bg-green-50 border border-green-200 text-green-800 rounded-xl p-4">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
            <i class="fas fa-check-circle text-green-600"></i>
        </div>
        <p class="font-semibold">Password berhasil diperbarui!</p>
    </div>
</div>
@endif

<!-- Profile Header Card -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
    <div class="flex items-center gap-6">
        <div class="w-20 h-20 bg-gradient-to-br from-gray-900 to-gray-700 rounded-xl flex items-center justify-center shadow-lg">
            <i class="fas fa-user-shield text-white text-3xl"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-900">{{ Auth::user()->name }}</h2>
            <p class="text-gray-600 mt-1">{{ Auth::user()->email }}</p>
            <div class="mt-2 inline-flex items-center gap-2 bg-gray-100 px-3 py-1 rounded-lg">
                <i class="fas fa-crown text-yellow-600 text-xs"></i>
                <span class="text-xs font-semibold text-gray-700">Administrator</span>
            </div>
        </div>
    </div>
</div>

<!-- Tab Navigation -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-2 mb-6">
    <div class="grid grid-cols-3 gap-2">
        <button onclick="switchTab('info-profil')" class="tab-button active px-4 py-3 rounded-lg font-semibold text-sm transition-all">
            <i class="fas fa-user-circle mr-2"></i>
            <span class="hidden sm:inline">Info </span>Profil
        </button>
        <button onclick="switchTab('ubah-password')" class="tab-button px-4 py-3 rounded-lg font-semibold text-sm transition-all">
            <i class="fas fa-lock mr-2"></i>
            <span class="hidden sm:inline">Ubah </span>Password
        </button>
        <button onclick="switchTab('hapus-akun')" class="tab-button px-4 py-3 rounded-lg font-semibold text-sm transition-all">
            <i class="fas fa-trash-alt mr-2"></i>
            <span class="hidden sm:inline">Hapus </span>Akun
        </button>
    </div>
</div>

<!-- Tab Contents -->
<div class="space-y-6">

    <!-- Update Profile Information -->
    <div id="info-profil" class="tab-content bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-start gap-4 mb-6">
            <div class="w-12 h-12 bg-gray-900 rounded-lg flex items-center justify-center">
                <i class="fas fa-user-edit text-white"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900 mb-1">Informasi Profil</h3>
                <p class="text-sm text-gray-600">Perbarui informasi profil dan alamat email akun admin Anda.</p>
            </div>
        </div>

        <form method="POST" action="{{ route('profil.update') }}" class="space-y-5">
            @csrf
            @method('PATCH')

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">
                    Nama Lengkap
                </label>
                <div class="relative">
                    <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fas fa-user text-sm"></i>
                    </div>
                    <input 
                        id="name" 
                        type="text" 
                        name="name" 
                        value="{{ old('name', Auth::user()->name) }}" 
                        required
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm"
                        placeholder="Masukkan nama lengkap"
                    >
                </div>
                @error('name')
                    <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1.5">
                        <i class="fas fa-exclamation-circle text-xs"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">
                    Alamat Email
                </label>
                <div class="relative">
                    <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fas fa-envelope text-sm"></i>
                    </div>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email', Auth::user()->email) }}" 
                        required
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm"
                        placeholder="admin@example.com"
                    >
                </div>
                @error('email')
                    <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1.5">
                        <i class="fas fa-exclamation-circle text-xs"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button 
                    type="submit" 
                    class="inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-gray-800 text-white px-6 py-2.5 rounded-lg shadow-sm hover:shadow-md transition-all font-medium text-sm"
                >
                    <i class="fas fa-save"></i>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Update Password -->
    <div id="ubah-password" class="tab-content hidden bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-start gap-4 mb-6">
            <div class="w-12 h-12 bg-gray-900 rounded-lg flex items-center justify-center">
                <i class="fas fa-shield-alt text-white"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900 mb-1">Ubah Password</h3>
                <p class="text-sm text-gray-600">Pastikan akun admin Anda menggunakan password yang kuat dan aman.</p>
            </div>
        </div>

        <form method="POST" action="{{ route('profil.password.update') }}" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Current Password -->
            <div>
                <label for="current_password" class="block text-sm font-semibold text-gray-900 mb-2">
                    Password Saat Ini
                </label>
                <div class="relative">
                    <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fas fa-lock text-sm"></i>
                    </div>
                    <input 
                        id="current_password" 
                        type="password" 
                        name="current_password" 
                        required
                        class="w-full pl-10 pr-12 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm"
                        placeholder="Masukkan password saat ini"
                    >
                    <button 
                        type="button" 
                        onclick="togglePasswordVisibility('current_password', 'toggleIcon1')"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
                    >
                        <i id="toggleIcon1" class="fas fa-eye text-sm"></i>
                    </button>
                </div>
                @error('current_password', 'updatePassword')
                    <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1.5">
                        <i class="fas fa-exclamation-circle text-xs"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- New Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-900 mb-2">
                    Password Baru
                </label>
                <div class="relative">
                    <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fas fa-key text-sm"></i>
                    </div>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        required
                        class="w-full pl-10 pr-12 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm"
                        placeholder="Minimal 8 karakter"
                    >
                    <button 
                        type="button" 
                        onclick="togglePasswordVisibility('password', 'toggleIcon2')"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
                    >
                        <i id="toggleIcon2" class="fas fa-eye text-sm"></i>
                    </button>
                </div>
                @error('password', 'updatePassword')
                    <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1.5">
                        <i class="fas fa-exclamation-circle text-xs"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-900 mb-2">
                    Konfirmasi Password Baru
                </label>
                <div class="relative">
                    <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fas fa-check-circle text-sm"></i>
                    </div>
                    <input 
                        id="password_confirmation" 
                        type="password" 
                        name="password_confirmation" 
                        required
                        class="w-full pl-10 pr-12 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm"
                        placeholder="Ketik ulang password baru"
                    >
                    <button 
                        type="button" 
                        onclick="togglePasswordVisibility('password_confirmation', 'toggleIcon3')"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
                    >
                        <i id="toggleIcon3" class="fas fa-eye text-sm"></i>
                    </button>
                </div>
                @error('password_confirmation', 'updatePassword')
                    <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1.5">
                        <i class="fas fa-exclamation-circle text-xs"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button 
                    type="submit" 
                    class="inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-gray-800 text-white px-6 py-2.5 rounded-lg shadow-sm hover:shadow-md transition-all font-medium text-sm"
                >
                    <i class="fas fa-save"></i>
                    <span>Ubah Password</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Delete Account -->
    <div id="hapus-akun" class="tab-content hidden bg-red-50 rounded-xl shadow-sm border-2 border-red-200 p-6">
        <div class="flex items-start gap-4 mb-6">
            <div class="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-exclamation-triangle text-white"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-red-600 mb-1">Zona Berbahaya</h3>
                <p class="text-sm text-gray-700">
                    Setelah akun admin dihapus, semua data dan akses akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
        </div>

        <div class="bg-white rounded-lg p-5 mb-5 border border-red-200">
            <h4 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                <i class="fas fa-info-circle text-red-500"></i>
                Yang Akan Terjadi:
            </h4>
            <ul class="space-y-2 text-sm text-gray-700">
                <li class="flex items-start gap-2">
                    <i class="fas fa-times-circle text-red-500 mt-0.5"></i>
                    <span>Semua data admin akan dihapus permanen</span>
                </li>
                <li class="flex items-start gap-2">
                    <i class="fas fa-times-circle text-red-500 mt-0.5"></i>
                    <span>Akses ke panel admin akan dicabut</span>
                </li>
                <li class="flex items-start gap-2">
                    <i class="fas fa-times-circle text-red-500 mt-0.5"></i>
                    <span>Riwayat aktivitas tidak dapat dipulihkan</span>
                </li>
            </ul>
        </div>

        <button 
            onclick="openDeleteModal()"
            class="inline-flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white px-6 py-2.5 rounded-lg shadow-sm hover:shadow-md transition-all font-medium text-sm"
        >
            <i class="fas fa-trash-alt"></i>
            <span>Hapus Akun Permanen</span>
        </button>
    </div>

</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6 transform transition-all scale-95 modal-enter">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-red-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-3xl text-red-600"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Konfirmasi Penghapusan</h3>
            <p class="text-sm text-gray-600">
                Masukkan password Anda untuk mengkonfirmasi penghapusan akun admin. Tindakan ini tidak dapat dibatalkan.
            </p>
        </div>

        <form method="POST" action="{{ route('profil.destroy') }}" class="space-y-4">
            @csrf
            @method('DELETE')

            <div>
                <label for="password_delete" class="block text-sm font-semibold text-gray-900 mb-2">
                    Password Anda
                </label>
                <div class="relative">
                    <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fas fa-lock text-sm"></i>
                    </div>
                    <input 
                        id="password_delete" 
                        type="password" 
                        name="password" 
                        required
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all text-sm"
                        placeholder="Masukkan password Anda"
                    >
                </div>
                @error('password', 'userDeletion')
                    <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1.5">
                        <i class="fas fa-exclamation-circle text-xs"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-3 pt-2">
                <button 
                    type="button"
                    onclick="closeDeleteModal()"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2.5 rounded-lg font-semibold transition-all text-sm"
                >
                    Batal
                </button>
                <button 
                    type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2.5 rounded-lg font-semibold transition-all text-sm shadow-sm"
                >
                    Hapus Akun
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
    background: #111827;
    color: white;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
}

.tab-button:hover:not(.active) {
    background: #f3f4f6;
    color: #111827;
}

.modal-enter {
    transition: transform 0.2s ease-out;
}
</style>

@endsection