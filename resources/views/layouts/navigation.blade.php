<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo -->
            <a href="/" class="text-2xl font-bold tracking-wide">
                KLANDEST
            </a>

            <div class="hidden md:flex space-x-6">
                <a href="/" class="text-gray-700 hover:text-black font-medium">Home</a>
                <a href="#" class="text-gray-700 hover:text-black font-medium">Produk</a>
                <a href="#" class="text-gray-700 hover:text-black font-medium">Tentang</a>
                <a href="#" class="text-gray-700 hover:text-black font-medium">Kontak</a>
            </div>

            <!-- Auth Menu -->
            <div class="flex items-center space-x-4">
                @auth
                    <div class="text-gray-700 font-medium">{{ Auth::user()->name }}</div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="px-4 py-2 text-sm bg-black text-white rounded">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm border rounded">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm bg-black text-white rounded">Register</a>
                @endauth
            </div>

        </div>
    </div>
</nav>
