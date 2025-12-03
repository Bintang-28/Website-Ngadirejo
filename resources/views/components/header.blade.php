@php
    $siteLogo = App\Models\Setting::get('site_logo');
    $logoPath = $siteLogo 
        ? asset('storage/' . $siteLogo) 
        : asset('images/logokabmadiun.png');
@endphp

<nav class="fixed top-0 w-full z-50 bg-white shadow-lg">
    <div class="max-w-full mx-auto px-8 sm:px-10 lg:px-12">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center">
                    <img src="{{ $logoPath }}" alt="Logo Desa" class="h-16 w-16 mr-3">
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">DESA NGADIREJO</h1>
                    </div>
                </a>
            </div>
            
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-600 font-semibold text-lg transition">Beranda</a>
                <a href="{{ route('publikasi.index') }}" class="text-gray-700 hover:text-blue-600 font-semibold text-lg transition">Publikasi</a>
            </div>

            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="text-gray-700 focus:outline-none">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
        <div class="px-4 pt-4 pb-4 space-y-3">
            <a href="{{ url('/') }}" class="block text-gray-900 hover:text-blue-600 font-semibold text-base py-2">Beranda</a>
            <a href="{{ url('/#profil') }}" class="block text-gray-700 hover:text-blue-600 font-semibold text-base py-2">Profil</a>
            <a href="{{ url('/#struktur-organisasi') }}" class="block text-gray-700 hover:text-blue-600 font-semibold text-base py-2">Struktur Organisasi</a>
            <a href="{{ url('/#visi-misi') }}" class="block text-gray-700 hover:text-blue-600 font-semibold text-base py-2">Visi Misi</a>
            <a href="{{ url('/#pelayanan') }}" class="block text-gray-700 hover:text-blue-600 font-semibold text-base py-2">Pelayanan</a>
            <a href="{{ route('publikasi.index') }}" class="block text-gray-700 hover:text-blue-600 font-semibold text-base py-2">Publikasi</a>
            <a href="{{ url('/#kontak') }}" class="block text-gray-700 hover:text-blue-600 font-semibold text-base py-2">Kontak</a>
        </div>
    </div>
</nav>

<script>
    // Mobile menu functionality
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });

        // Close mobile menu when clicking a link
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
            });
        });
    }
</script>