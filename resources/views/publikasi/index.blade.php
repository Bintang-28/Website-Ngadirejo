<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publikasi - Desa Ngadirejo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    @php
        $siteLogo = App\Models\Setting::get('site_logo');
        $logoPath = $siteLogo 
            ? asset('storage/' . $siteLogo) 
            : asset('images/logokabmadiun.png');
    @endphp
    
    <link rel="icon" href="{{ $logoPath }}">
    <style>
        html {
            scroll-behavior: smooth;
        }
        
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .news-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
        }
        
        .news-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .news-image {
            transition: transform 0.7s ease;
        }
        
        .news-card:hover .news-image {
            transform: scale(1.1);
        }
        
        .news-overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .news-card:hover .news-overlay {
            opacity: 1;
        }
        
        .read-more-btn {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            transition: all 0.3s ease;
        }
        
        .read-more-btn:hover {
            transform: translateX(5px);
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
        }
        
        .news-tag {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            color: #3b82f6;
            z-index: 10;
        }

        .gradient-text {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            padding-bottom: 0.125rem;
            line-height: 1.3;
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav id="navbar" class="fixed top-0 w-full z-50 transition-all duration-300">
    <div class="max-w-full mx-auto px-8 sm:px-10 lg:px-12">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <img src="{{ $logoPath }}" alt="Logo Desa" class="h-16 w-16 mr-3">
                    <div>
                        <h1 class="text-xl font-bold text-white transition-colors duration-300" id="logo-text">DESA NGADIREJO</h1>
                    </div>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ url('/') }}" class="nav-link text-white hover:text-blue-400 font-semibold text-lg transition">Beranda</a>
                    <a href="{{ route('publikasi.index') }}" class="nav-link text-white hover:text-blue-400 font-semibold text-lg transition">Publikasi</a>
                 </div>

                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-white focus:outline-none">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <div id="mobile-menu" class="hidden md:hidden bg-white/95 backdrop-blur-sm border-t">
            <div class="px-4 pt-4 pb-4 space-y-3">
                <a href="{{ url('/') }}" class="block text-gray-900 hover:text-blue-600 font-semibold text-base py-2">Beranda</a>
                <a href="#publikasi" class="block text-gray-700 hover:text-blue-600 font-semibold text-base py-2">Publikasi</a>
            </div>
        </div>
    </nav>
        
    <!-- Hero Section dengan Background -->
    <section class="pt-24 pb-20 relative overflow-hidden min-h-screen flex items-center">
        @php
            $rawBackgrounds = App\Models\Setting::getHeroBackgrounds();
            
            if (empty($rawBackgrounds)) {
                $heroBg = asset('images/IMG_0339.jpg');
            } else {
                $heroBg = asset('storage/' . $rawBackgrounds[0]);
            }
        @endphp

        <!-- Background Image with Blue Overlay -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-cover bg-center bg-fixed" style="background-image: url('{{ $heroBg }}');"></div>
            <div class="absolute inset-0 bg-blue-900/85"></div>
        </div>

        <!-- Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="text-center py-20">
                <div class="inline-block px-4 py-2 bg-blue-400/20 backdrop-blur-sm rounded-full mb-4 border border-blue-300/30">
                    <span class="text-blue-100 font-semibold text-sm">📰 KABAR DESA</span>
                </div>
                <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 drop-shadow-lg">
                    Jelajahi Berita & <span class="text-blue-300">Informasi Terkini</span>
                </h1>
                <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto drop-shadow-lg leading-relaxed">
                    Temukan update terbaru mengenai pembangunan, kegiatan masyarakat, dan pengumuman resmi Desa Ngadirejo.
                </p>
                
                <!-- Search Bar -->
                <div class="mt-12 flex justify-center">
                    <form class="w-full max-w-2xl" method="GET" action="{{ route('publikasi.index') }}">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <input type="text" name="search" placeholder="Cari berita, pengumuman, atau artikel..." 
                                class="w-full pl-12 pr-4 py-4 rounded-full bg-white/95 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-lg"
                                value="{{ request('search') ?? '' }}">
                            <button type="submit" class="absolute right-1 top-1/2 -translate-y-1/2 px-6 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-full hover:shadow-lg transition-all">
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Wave Divider -->
        <div class="absolute bottom-0 left-0 right-0" style="margin-bottom: -1px;">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
            </svg>
        </div>
    </section>

    <!-- Berita Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-bold mb-4 gradient-text pb-2">Berita & Pengumuman</h2>
                <div class="w-24 h-1 bg-blue-600 mx-auto rounded-full mb-6"></div>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Koleksi lengkap berita dan informasi terbaru dari Desa Ngadirejo
                </p>
            </div>
            
            @if($berita->count() > 0)
                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($berita as $item)
                        <article class="news-card bg-white rounded-2xl shadow-lg overflow-hidden group cursor-pointer" onclick="window.location='{{ route('berita.show', $item->slug) }}'">
                            <div class="relative overflow-hidden h-56">
                                @if($item->gambar_header)
                                    <img src="{{ asset('storage/' . $item->gambar_header) }}" 
                                         alt="{{ $item->judul }}" 
                                         class="news-image w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="news-overlay absolute inset-0"></div>
                                <div class="news-tag">Berita</div>
                            </div>
                            
                            <div class="p-6">
                                <div class="flex items-center text-sm text-gray-500 mb-3">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>{{ $item->user->name ?? 'Admin' }}</span>
                                    <span class="mx-2">•</span>
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>{{ $item->created_at->format('d M Y') }}</span>
                                </div>
                                
                                <h3 class="text-xl font-bold mb-3 text-gray-900 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                    {{ $item->judul }}
                                </h3>
                                
                                <p class="text-gray-600 mb-4 line-clamp-3 text-sm leading-relaxed">
                                    {{ Str::limit(strip_tags($item->konten), 120) }}
                                </p>
                                
                                <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                                    <span class="text-blue-600 font-semibold text-sm group-hover:underline">Baca Selengkapnya</span>
                                    <svg class="w-5 h-5 text-blue-600 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($berita->hasPages())
                    <div class="mt-12">
                        {{ $berita->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-16">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"/>
                        <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z"/>
                    </svg>
                    <p class="text-xl text-gray-500">Belum ada berita tersedia saat ini</p>
                </div>
            @endif
        </div>
    </section>

    @include('components.footer')

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="fixed bottom-8 right-8 w-14 h-14 bg-blue-600 text-white rounded-full shadow-2xl hover:bg-blue-700 transition-all opacity-0 pointer-events-none z-40 flex items-center justify-center">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"/>
        </svg>
    </button>

    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        const logoText = document.getElementById('logo-text');
        const navLinks = document.querySelectorAll('.nav-link');
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const scrollToTopBtn = document.getElementById('scrollToTop');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 100) {
                navbar.classList.add('bg-white', 'shadow-lg');
                navbar.classList.remove('bg-transparent');
                logoText.classList.remove('text-white');
                logoText.classList.add('text-gray-900');
                
                navLinks.forEach(link => {
                    link.classList.remove('text-white', 'hover:text-blue-400');
                    link.classList.add('text-gray-700', 'hover:text-blue-600');
                });

                mobileMenuButton.classList.remove('text-white');
                mobileMenuButton.classList.add('text-gray-700');

                scrollToTopBtn.classList.remove('opacity-0', 'pointer-events-none');
                scrollToTopBtn.classList.add('opacity-100', 'pointer-events-auto');
            } else {
                navbar.classList.remove('bg-white', 'shadow-lg');
                navbar.classList.add('bg-transparent');
                logoText.classList.add('text-white');
                logoText.classList.remove('text-gray-900');
                
                navLinks.forEach(link => {
                    link.classList.add('text-white', 'hover:text-blue-400');
                    link.classList.remove('text-gray-700', 'hover:text-blue-600');
                });

                mobileMenuButton.classList.add('text-white');
                mobileMenuButton.classList.remove('text-gray-700');

                scrollToTopBtn.classList.add('opacity-0', 'pointer-events-none');
                scrollToTopBtn.classList.remove('opacity-100', 'pointer-events-auto');
            }
        });

        // Mobile menu toggle
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });

        // Close mobile menu when clicking a link
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
            });
        });

        // Scroll to top functionality
        scrollToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>

</body>
</html>