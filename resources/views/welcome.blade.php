<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Ngadirejo</title>

    @php
        $siteLogo = App\Models\Setting::get('site_logo');
        $logoPath = $siteLogo 
            ? asset('storage/' . $siteLogo) 
            : asset('images/logokabmadiun.png');
            
        $rawBackgrounds = App\Models\Setting::getHeroBackgrounds();
            
        if (empty($rawBackgrounds)) {
            $heroBackgrounds = [asset('images/IMG_0339.jpg')];
        } else {
            $heroBackgrounds = array_map(function($path) {
                return asset('storage/' . $path);
            }, $rawBackgrounds);
        }
    @endphp

    <link rel="icon" href="{{ $logoPath }}">

    <script src="https://cdn.tailwindcss.com"></script>
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

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        .float-animation {
            animation: float 3s ease-in-out infinite;
        }

        .gradient-text {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            padding-bottom: 0.125rem;
            line-height: 1.3;
        }

        .stat-number {
            font-variant-numeric: tabular-nums;
        }

        .overlay-gradient {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, transparent 100%);
        }
        
        .hero-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
            z-index: 0;
        }
        .hero-slide.active {
            opacity: 1;
            z-index: 1;
        }
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
            z-index: 2;
        }
        .hero-content {
            position: relative;
            z-index: 10;
        }
        
        /* Slider Thumbnail Navigation */
        .slider-thumbnails {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 15;
            display: flex;
            gap: 0.5rem;
        }
        
        .slider-thumbnail {
            width: 60px;
            height: 40px;
            border-radius: 6px;
            background-size: cover;
            background-position: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 3px solid rgba(255, 255, 255, 0.5);
            opacity: 0.7;
        }
        
        .slider-thumbnail:hover {
            opacity: 1;
            transform: scale(1.05);
            border-color: rgba(255, 255, 255, 0.8);
        }
        
        .slider-thumbnail.active {
            opacity: 1;
            border-color: white;
            transform: scale(1.1);
        }
        
        @media (max-width: 768px) {
            .slider-thumbnails {
                bottom: 1rem;
                gap: 0.375rem;
            }
            
            .slider-thumbnail {
                width: 50px;
                height: 35px;
            }
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
    </style>
</head>
<body>
    
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
                    <a href="#profil" class="nav-link text-white hover:text-blue-400 font-semibold text-lg transition">Profil</a>
                    <div class="relative group">
                        <a href="#struktur-organisasi" class="nav-link text-white hover:text-blue-400 font-semibold text-lg transition flex items-center gap-1">
                            Struktur Organisasi
                            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="py-2">
                                <a href="#struktur-organisasi" class="block px-4 py-2 text-gray-700 hover:text-blue-400 transition">
                                    Struktur Desa
                                </a>
                                <a href="#struktur-bpd" class="block px-4 py-2 text-gray-700 hover:text-blue-400 transition">
                                    Struktur BPD
                                </a>
                            </div>
                        </div>
                    </div>             
                    <a href="#visi-misi" class="nav-link text-white hover:text-blue-400 font-semibold text-lg transition">Visi Misi</a>
                    <a href="#pelayanan" class="nav-link text-white hover:text-blue-400 font-semibold text-lg transition">Pelayanan</a>
                    <a href="{{ route('publikasi.index') }}" class="nav-link text-white hover:text-blue-400 font-semibold text-lg transition">Publikasi</a>
                    <a href="#kontak" class="nav-link text-white hover:text-blue-400 font-semibold text-lg transition">Kontak</a>
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
                <a href="#profil" class="block text-gray-700 hover:text-blue-600 font-semibold text-base py-2">Profil</a>
                <div class="relative group">
                        <a href="#struktur-organisasi" class="nav-link text-white hover:text-blue-400 font-semibold text-lg transition flex items-center gap-1">
                            Struktur Organisasi
                            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="py-2">
                                <a href="#struktur-organisasi" class="block px-4 py-2 text-gray-700 hover:text-blue-400 transition">
                                    Struktur Desa
                                </a>
                                <a href="#struktur-bpd" class="block px-4 py-2 text-gray-700 hover:text-blue-400 transition">
                                    Struktur BPD
                                </a>
                            </div>
                        </div>
                    </div>                
                <a href="#visi-misi" class="block text-gray-700 hover:text-blue-600 font-semibold text-base py-2">Visi Misi</a>
                <a href="#pelayanan" class="block text-gray-700 hover:text-blue-600 font-semibold text-base py-2">Pelayanan</a>
                <a href="#publikasi" class="block text-gray-700 hover:text-blue-600 font-semibold text-base py-2">Publikasi</a>
                <a href="#kontak" class="block text-gray-700 hover:text-blue-600 font-semibold text-base py-2">Kontak</a>
            </div>
        </div>
    </nav>

    <section class="min-h-screen flex items-center justify-center relative overflow-hidden">
        
        <div id="hero-slider" class="absolute inset-0 w-full h-full">
            @foreach($heroBackgrounds as $index => $bg)
                <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" 
                     style="background-image: url('{{ $bg }}');">
                </div>
            @endforeach
        </div>

        <div class="hero-overlay"></div>

        <div class="text-center text-white px-4 hero-content">
            @php
                $heroTitle = App\Models\Setting::get('hero_title', 'NGADIREJO');
                $heroTagline = App\Models\Setting::get('hero_tagline', 'Desa Terindah dan Paling Berkesan');
            @endphp
            
            <img src="{{ $logoPath }}" 
                 alt="Logo Desa" 
                 class="mx-auto mb-6 h-48 w-48 drop-shadow-2xl">
            <h1 class="text-6xl md:text-7xl font-bold mb-4 drop-shadow-lg">{{ $heroTitle }}</h1>
            <p class="text-xl md:text-2xl font-medium drop-shadow-lg">{{ $heroTagline }}</p>
        </div>

        <!-- Slider Thumbnails -->
        @if(count($heroBackgrounds) > 1)
        <div class="slider-thumbnails">
            @foreach($heroBackgrounds as $index => $bg)
                <div class="slider-thumbnail {{ $index === 0 ? 'active' : '' }}" 
                     style="background-image: url('{{ $bg }}');"
                     onclick="goToSlide({{ $index }})"></div>
            @endforeach
        </div>
        @endif
    </section>

    <section class="py-20 bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-white rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-white rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    </div>

    <div class="absolute inset-0 opacity-5" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16 fade-in">
            <div class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full mb-4">
                <span class="text-white font-semibold text-sm">📊 Data Terkini</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">
                Statistik Desa Ngadirejo
            </h2>
            <p class="text-xl text-blue-100 max-w-2xl mx-auto">
                Data demografi dan geografis terbaru wilayah kami
            </p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="fade-in group" style="animation-delay: 0.1s;">
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-8 hover:bg-white/20 transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                        </div>
                        <div class="text-white/60">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-5xl font-bold text-white mb-2 stat-number">
                        {{ number_format($statistik->jumlah_penduduk ?? 6075) }}
                    </div>
                    <div class="text-blue-100 font-medium text-lg">Jumlah Penduduk</div>
                    <div class="mt-3 pt-3 border-t border-white/20">
                        <span class="text-xs text-blue-200">Total jiwa di wilayah desa</span>
                    </div>
                </div>
            </div>

            <div class="fade-in group" style="animation-delay: 0.2s;">
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-8 hover:bg-white/20 transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-green-400 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="text-white/60">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-5xl font-bold text-white mb-2 stat-number">
                        {{ number_format($statistik->kepala_keluarga ?? 345) }}
                    </div>
                    <div class="text-blue-100 font-medium text-lg">Kepala Keluarga</div>
                    <div class="mt-3 pt-3 border-t border-white/20">
                        <span class="text-xs text-blue-200">Jumlah KK terdaftar</span>
                    </div>
                </div>
            </div>

            <div class="fade-in group" style="animation-delay: 0.3s;">
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-8 hover:bg-white/20 transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-400 to-pink-500 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                            </svg>
                        </div>
                        <div class="text-white/60">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 3.636a1 1 0 010 1.414 7 7 0 000 9.9 1 1 0 11-1.414 1.414 9 9 0 010-12.728 1 1 0 011.414 0zm9.9 0a1 1 0 011.414 0 9 9 0 010 12.728 1 1 0 11-1.414-1.414 7 7 0 000-9.9 1 1 0 010-1.414zM7.879 6.464a1 1 0 010 1.414 3 3 0 000 4.243 1 1 0 11-1.415 1.414 5 5 0 010-7.07 1 1 0 011.415 0zm4.242 0a1 1 0 011.415 0 5 5 0 010 7.072 1 1 0 01-1.415-1.415 3 3 0 000-4.242 1 1 0 010-1.415zM10 9a1 1 0 011 1v.01a1 1 0 11-2 0V10a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-5xl font-bold text-white mb-2 stat-number">
                        {{ $statistik->jumlah_dusun ?? 6 }}
                    </div>
                    <div class="text-blue-100 font-medium text-lg">Dusun</div>
                    <div class="mt-3 pt-3 border-t border-white/20">
                        <span class="text-xs text-blue-200">Wilayah administratif</span>
                    </div>
                </div>
            </div>

            <div class="fade-in group" style="animation-delay: 0.4s;">
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-8 hover:bg-white/20 transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-cyan-400 to-blue-500 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="text-white/60">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-5xl font-bold text-white mb-2 stat-number">
                        {{ ($statistik->jumlah_rt ?? 25) }}/{{ ($statistik->jumlah_rw ?? 11) }}
                    </div>
                    <div class="text-blue-100 font-medium text-lg">RT/RW</div>
                    <div class="mt-3 pt-3 border-t border-white/20">
                        <span class="text-xs text-blue-200">Rukun Tetangga & Warga</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <div class="fade-in bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-6 hover:bg-white/10 transition-all" style="animation-delay: 0.5s;">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-white/10 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="text-3xl font-bold text-white">{{ $statistik->luas_wilayah ?? '319.64' }} Ha</div>
                        <div class="text-blue-200 text-sm">Luas Wilayah</div>
                    </div>
                </div>
            </div>

            <div class="fade-in bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-6 hover:bg-white/10 transition-all" style="animation-delay: 0.6s;">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-white/10 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="text-3xl font-bold text-white">{{ $statistik->ketinggian ?? 63 }} mdpl</div>
                        <div class="text-blue-200 text-sm">Ketinggian Wilayah</div>
                    </div>
                </div>
            </div>

            <div class="fade-in bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-6" style="animation-delay: 0.7s;">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-white/10 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="text-lg font-bold text-white">Data Terkini</div>
                        <div class="text-blue-200 text-sm">Diperbarui: {{ now()->format('d M Y') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 right-0" style="margin-bottom: -1px;">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
            <path d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
        </svg>
    </div>
</section>

<style>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in {
    animation: fadeInUp 0.8s ease-out forwards;
    opacity: 0;
}

.stat-number {
    font-variant-numeric: tabular-nums;
    background: linear-gradient(135deg, #ffffff 0%, #e0e7ff 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
</style>

<section id="profil" class="py-24 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-bold mb-4 gradient-text pb-2">Profil Desa</h2>
                <div class="w-24 h-1 bg-blue-600 mx-auto rounded-full"></div>
            </div>
            
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="prose prose-lg max-w-none">
                        <p class="text-xl text-gray-700 leading-relaxed text-justify">
                            @php
                                $profilDescription = App\Models\Setting::where('key', 'profil_desa_description')->first();
                                echo $profilDescription ? $profilDescription->value : 'Desa Ngadirejo adalah desa yang terletak di Kecamatan Wonoasri, Kabupaten Madiun, Provinsi Jawa Timur. Desa ini memiliki potensi yang besar dalam sektor pertanian, terutama sebagai penghasil padi dan hasil pertanian lainnya.';
                            @endphp
                        </p>
        
                        <div class="grid grid-cols-2 gap-6 mt-8">
                            <div class="bg-blue-50 p-6 rounded-xl">
                                <div class="text-3xl font-bold text-blue-600 mb-2">
                                    @php
                                        $luasWilayah = App\Models\Setting::where('key', 'profil_desa_luas_wilayah')->first();
                                        echo $luasWilayah ? $luasWilayah->value : '319,64 Ha';
                                    @endphp
                                </div>
                                <div class="text-gray-600">Luas Wilayah</div>
                            </div>
                            <div class="bg-blue-50 p-6 rounded-xl">
                                <div class="text-3xl font-bold text-blue-600 mb-2">
                                    @php
                                        $ketinggian = App\Models\Setting::where('key', 'profil_desa_ketinggian')->first();
                                        echo $ketinggian ? $ketinggian->value : '63 mdpl';
                                    @endphp
                                </div>
                                <div class="text-gray-600">Ketinggian</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="order-1 lg:order-2">
                    <div class="relative">
                        <div class="absolute -inset-4 bg-gradient-to-r from-blue-600 to-blue-400 rounded-2xl opacity-20 blur-2xl"></div>
                        @php
                            $profilDesaImage = App\Models\Setting::where('key', 'profil_desa_image')->first();
                        @endphp
                        @if($profilDesaImage && $profilDesaImage->value)
                            <img src="{{ asset('storage/' . $profilDesaImage->value) }}" 
                                 alt="Profil Desa Ngadirejo" 
                                 class="relative rounded-2xl shadow-2xl w-full h-auto object-cover">
                        @else
                            <div class="relative rounded-2xl shadow-2xl w-full h-96 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-gray-600 font-semibold">Gambar profil desa belum diatur</p>
                                    <p class="text-gray-500 text-sm">Admin dapat menambahkan gambar di pengaturan situs</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="struktur-organisasi" class="py-24 relative overflow-hidden">
                @php
                    $visiMisiBackground = App\Models\Setting::where('key', 'visi_misi_background')->first();
                    $visiMisiBgPath = $visiMisiBackground && $visiMisiBackground->value 
                        ? asset('storage/' . $visiMisiBackground->value) 
                        : asset('images/IMG_0339.jpg');
                @endphp
                
                <!-- Background Image with Blue Overlay -->
                <div class="absolute inset-0 z-0">
                    <div class="absolute inset-0 bg-cover bg-center bg-fixed" style="background-image: url('{{ $visiMisiBgPath }}');"></div>
                    <div class="absolute inset-0 bg-blue-900/90"></div>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="text-center mb-16">
                        <h2 class="text-5xl font-bold mb-4 text-white drop-shadow-lg">Struktur Organisasi</h2>
                        <div class="w-24 h-1 bg-white mx-auto rounded-full mb-6"></div>
                        <p class="text-xl text-blue-100 max-w-2xl mx-auto">
                            Susunan pemerintahan Desa Ngadirejo yang solid dan kompeten untuk melayani masyarakat
                        </p>
                    </div>
                    
                    <!-- Circular Frame Design -->
                    <div class="flex justify-center items-center mb-12">
                        <div class="relative w-full max-w-6xl">
                            <!-- Outer Circle Ring -->
                            <div class="absolute -inset-8 rounded-full bg-gradient-to-br from-white/20 to-white/10 blur-2xl"></div>
                            
                            <!-- Middle Circle Ring -->
                            <div class="absolute -inset-4 rounded-full border-2 border-white/30"></div>
                            
                            <!-- Main Content Circle -->
                            <div class="relative bg-white/10 backdrop-blur-md border-2 border-white/40 rounded-full p-12 md:p-16 shadow-2xl">
                                <!-- Inner decorative circle -->
                                <div class="absolute inset-0 rounded-full bg-gradient-to-b from-white/5 to-transparent"></div>
                                
                                <!-- Content -->
                                <div class="relative z-10">
                                    @php
                                        $strukturOrganisasiImage = App\Models\Setting::where('key', 'struktur_organisasi_image')->first();
                                    @endphp
                                    
                                    @if($strukturOrganisasiImage && $strukturOrganisasiImage->value)
                                        <img src="{{ asset('storage/' . $strukturOrganisasiImage->value) }}" 
                                            alt="Struktur Organisasi Desa Ngadirejo" 
                                            class="w-full h-auto rounded-2xl shadow-2xl">
                                    @else
                                        <img src="{{ asset('images/struktur-organisasi.jpg') }}" 
                                            alt="Struktur Organisasi Desa Ngadirejo" 
                                            class="w-full h-auto rounded-2xl shadow-2xl">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="struktur-bpd" class="py-24 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-bold mb-4 gradient-text pb-2">Struktur BPD</h2>
                <div class="w-24 h-1 bg-blue-600 mx-auto rounded-full mb-6"></div>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Susunan Badan Permusyawaratan Desa Ngadirejo yang bertugas mewakili kepentingan masyarakat
                </p>
            </div>
            
            <div class="bg-gradient-to-br from-gray-50 to-blue-50 p-8 md:p-12 rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                @php
                    $bpdStructureImage = App\Models\Setting::where('key', 'bpd_structure_image')->first();
                @endphp
                
                @if($bpdStructureImage && $bpdStructureImage->value)
                    <img src="{{ asset('storage/' . $bpdStructureImage->value) }}" 
                        alt="Struktur Organisasi BPD Desa Ngadirejo" 
                        class="w-full h-auto rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300">
                    <p class="text-center text-sm text-gray-500 mt-4">
                        Struktur Organisasi BPD Desa Ngadirejo
                    </p>
                @else
                    <div class="bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl h-96 flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-gray-600 font-semibold text-lg">Gambar struktur BPD belum diatur</p>
                            <p class="text-gray-500 text-sm mt-2">Admin dapat menambahkan gambar di pengaturan situs</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Info Tambahan -->
            <div class="grid md:grid-cols-2 gap-8 mt-12">
                <div class="bg-white p-8 rounded-xl shadow-lg border-l-4 border-blue-600 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-start mb-4">
                        <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v2h8v-2zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-2a4 4 0 00-8 0v2h8z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Fungsi BPD</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Mewakili kepentingan masyarakat, melakukan pengawasan terhadap kinerja Kepala Desa, dan memberikan pertimbangan dalam pengambilan keputusan desa.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg border-l-4 border-purple-600 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-start mb-4">
                        <div class="w-14 h-14 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Keanggotaan</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Terdiri dari wakil masyarakat dan tokoh-tokoh masyarakat yang dipilih melalui musyawarah yang melibatkan seluruh lapisan masyarakat desa.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section id="visi-misi" class="py-24 relative overflow-hidden">
        @php
            $visiMisiBackground = App\Models\Setting::where('key', 'visi_misi_background')->first();
            $visiMisiBgPath = $visiMisiBackground && $visiMisiBackground->value 
                ? asset('storage/' . $visiMisiBackground->value) 
                : asset('images/IMG_0339.jpg');
        @endphp
        
        <!-- Background Image with Blue Overlay -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-cover bg-center bg-fixed" style="background-image: url('{{ $visiMisiBgPath }}');"></div>
            <div class="absolute inset-0 bg-blue-900/90"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-bold mb-4 text-white drop-shadow-lg">
                    Visi & Misi Desa Ngadirejo
                </h2>
                <div class="w-24 h-1 bg-white mx-auto rounded-full mb-6"></div>
                <p class="text-xl text-blue-100 max-w-2xl mx-auto">
                    Komitmen kami untuk membangun desa yang lebih baik dan sejahtera
                </p>
            </div>
            
            @php
                $visiSetting = App\Models\Setting::where('key', 'visi')->first();
                $misiSetting = App\Models\Setting::where('key', 'misi')->first();
                
                $visi = $visiSetting 
                    ? $visiSetting->value 
                    : 'Mewujudkan Desa Ngadirejo yang maju, sejahtera, mandiri, dan berbudaya berdasarkan nilai-nilai gotong royong dan kearifan lokal.';
                
                $misi = $misiSetting 
                    ? json_decode($misiSetting->value, true) 
                    : [
                        'Meningkatkan kualitas pelayanan publik',
                        'Mengembangkan potensi ekonomi lokal',
                        'Meningkatkan kualitas pendidikan dan kesehatan',
                        'Melestarikan budaya dan kearifan lokal'
                    ];
            @endphp
            
            <!-- VISI Section -->
            <div class="mb-10">
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-10 md:p-12 shadow-2xl">
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl shadow-lg mb-6">
                            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-4xl font-bold text-white drop-shadow-lg">VISI</h3>
                    </div>
                    
                    <div class="max-w-4xl mx-auto">
                        <p class="text-2xl md:text-3xl leading-relaxed text-white font-medium text-center">
                            "{{ $visi }}"
                        </p>
                    </div>
                </div>
            </div>

            <!-- MISI Section -->
            <div>
                <div class="bg-white/95 backdrop-blur-md rounded-3xl p-10 md:p-12 shadow-2xl">
                    <div class="text-center mb-10">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg mb-6">
                            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-4xl font-bold text-gray-900">MISI</h3>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6 max-w-6xl mx-auto">
                        @foreach($misi as $index => $item)
                            <div class="bg-gradient-to-br from-blue-50 to-white p-6 rounded-2xl border-2 border-blue-100 hover:border-blue-400 hover:shadow-xl transition-all duration-300">
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                                        <span class="text-white font-bold text-lg">{{ $index + 1 }}</span>
                                    </div>
                                    <div class="flex-grow">
                                        <p class="text-lg text-gray-800 leading-relaxed font-medium">{{ $item }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="pelayanan" class="py-24 bg-gradient-to-br from-blue-50 to-indigo-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-bold mb-4 gradient-text pb-2">Pelayanan Desa</h2>
                <div class="w-24 h-1 bg-blue-600 mx-auto rounded-full mb-6"></div>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Berbagai layanan untuk kemudahan dan kesejahteraan masyarakat
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 card-hover group">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-900">Administrasi Kependudukan</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">Pelayanan KTP, KK, Akta Kelahiran, dan surat-surat lainnya</p>
                    <div class="pt-4 border-t border-gray-100">
                        <span class="text-blue-600 font-semibold text-sm">Senin - Jumat • 08:00 - 15:00</span>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 card-hover group">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-xl mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-900">Kesehatan</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">Posyandu, Polindes, dan program kesehatan masyarakat</p>
                    <div class="pt-4 border-t border-gray-100">
                        <span class="text-green-600 font-semibold text-sm">Setiap Hari • 24 Jam</span>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 card-hover group">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-900">Lembaga Kemasyarakatan</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">LPMD (Lembaga Pemberdayaan Masyarakat Desa), Kelompok Tani, Karang Taruna, Rukun Tetangga, Rukun Warga, Posyandu, PKK</p>
                    <div class="pt-4 border-t border-gray-100">
                        <span class="text-purple-600 font-semibold text-sm">Konsultasi Gratis</span>
                    </div>
                </div>

                <!-- Card Pendidikan & Kebudayaan -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 card-hover group">
                    <div class="w-16 h-16 bg-yellow-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Pendidikan & Kebudayaan</h3>
                    
                    <p class="text-gray-600 mb-6">
                    Penyelenggaraan Pendidikan Anak Usia Dini, Kelompok Kesenian Dongkrek, Reog, Jaranan
                    </p>
                    
                    <p class="text-yellow-600 font-semibold">Senin - Jumat • 08:00 - 15:00</p>
                </div>

                <!-- Card Lain-lain -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 card-hover group">
                    <div class="w-16 h-16 bg-gray-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Lain-lain</h3>
                    
                    <p class="text-gray-600 mb-6">
                        Layanan administrasi umum dan pelayanan publik lainnya
                    </p>
                    
                    <p class="text-gray-600 font-semibold">Senin - Jumat • 08:00 - 15:00</p>
                </div>
            </div>
        </div>
    </section>

    <section id="publikasi" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-bold mb-4 gradient-text pb-2">Berita Terbaru</h2>
                <div class="w-24 h-1 bg-blue-600 mx-auto rounded-full mb-6"></div>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Update terkini seputar kegiatan dan perkembangan Desa Ngadirejo
                </p>
            </div>
            
            @if($beritaTerbaru->count() > 0)
                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($beritaTerbaru as $berita)
                        <article class="news-card bg-white rounded-2xl shadow-lg overflow-hidden group cursor-pointer" onclick="window.location='{{ route('berita.show', $berita->slug) }}'">
                            <div class="relative overflow-hidden h-56">
                                @if($berita->gambar_header)
                                    <img src="{{ asset('storage/' . $berita->gambar_header) }}" 
                                         alt="{{ $berita->judul }}" 
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
                                    <span>{{ $berita->user->name }}</span>
                                    <span class="mx-2">•</span>
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>{{ $berita->created_at->format('d M Y') }}</span>
                                </div>
                                
                                <h3 class="text-xl font-bold mb-3 text-gray-900 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                    {{ $berita->judul }}
                                </h3>
                                
                                <p class="text-gray-600 mb-4 line-clamp-3 text-sm leading-relaxed">
                                    {{ Str::limit(strip_tags($berita->konten), 120) }}
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
                
                <div class="text-center mt-12">
                    <a href="{{ route('publikasi.index') }}" class="read-more-btn inline-flex items-center px-6 py-3 rounded-full text-white font-semibold">
                        <span>Lihat Semua Berita</span>
                        <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>
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

    <section class="py-20 bg-gradient-to-r from-blue-600 to-blue-800 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/2 translate-y-1/2"></div>
        </div>
        
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Butuh Layanan Administrasi?
            </h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Kami siap melayani kebutuhan administrasi kependudukan Anda dengan cepat dan profesional
            </p>
            <a href="#kontak" class="inline-flex items-center px-8 py-4 bg-white text-blue-600 font-bold rounded-full hover:bg-blue-50 transition-all shadow-xl hover:shadow-2xl hover:scale-105">
                <span>Hubungi Kami Sekarang</span>
                <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </a>
        </div>
    </section>

    <section id="kontak" class="py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-bold mb-4 gradient-text pb-2">Kontak Kami</h2>
                <div class="w-24 h-1 bg-blue-600 mx-auto rounded-full mb-6"></div>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Hubungi kami untuk informasi lebih lanjut atau konsultasi</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Alamat Kantor</h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Kantor Desa Ngadirejo<br>
                            Kecamatan Wonoasri<br>
                            Kabupaten Madiun, Jawa Timur
                        </p>
                        <a href="https://maps.app.goo.gl/c8pe1887kWP8RMSv8" target="_blank" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold text-sm group mt-2">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Lihat di Maps</span>
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Email & Sosial Media</h3>
                        <div class="space-y-2 mb-4">
                            <p class="text-gray-600">
                                <span class="font-semibold text-gray-900">Email:</span><br>
                                <a href="mailto:desangadirejo@gmail.com" class="text-blue-600 hover:text-blue-700">desangadirejo@gmail.com</a>
                            </p>
                            <p class="text-gray-600">
                                <span class="font-semibold text-gray-900">Instagram:</span><br>
                                <a href="https://instagram.com/pemdes_ngadirejo" target="_blank" class="text-blue-600 hover:text-blue-700">@pemdes_ngadirejo</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12 1.586l-4 4v12.828l4-4V1.586zM3.707 3.293A1 1 0 002 4v10a1 1 0 00.293.707L6 18.414V5.586L3.707 3.293zM17.707 5.293L14 1.586v12.828l2.293 2.293A1 1 0 0018 16V6a1 1 0 00-.293-.707z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Batas Wilayah</h3>
                        <div class="text-left space-y-1">
                            <p class="text-gray-600 text-sm">
                                <span class="font-semibold text-gray-900">Utara:</span> Desa Banyukambang & Jatirejo
                            </p>
                            <p class="text-gray-600 text-sm">
                                <span class="font-semibold text-gray-900">Timur:</span> Tanah Perhutani
                            </p>
                            <p class="text-gray-600 text-sm">
                                <span class="font-semibold text-gray-900">Selatan:</span> Desa Dimong
                            </p>
                            <p class="text-gray-600 text-sm">
                                <span class="font-semibold text-gray-900">Barat:</span> Desa Kebonagung
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                <div class="bg-white p-2 rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="relative w-full h-[500px] rounded-xl overflow-hidden">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.8935607847547!2d111.52168007500942!3d-7.698726592334498!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79be2ae9e9e26f%3A0x8e9f3c7c0e3e2f6d!2sKantor%20Desa%20Ngadirejo!5e0!3m2!1sen!2sid!4v1703000000000!5m2!1sen!2sid"
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            class="rounded-xl">
                        </iframe>
                        <a href="https://maps.app.goo.gl/c8pe1887kWP8RMSv8" target="_blank" 
                           class="absolute bottom-4 right-4 bg-white px-4 py-2 rounded-lg shadow-lg hover:shadow-xl transition-all flex items-center space-x-2 group">
                            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">Buka di Google Maps</span>
                        </a>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-10 rounded-2xl shadow-2xl text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32"></div>
                    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-5 rounded-full -ml-24 -mb-24"></div>
                    <div class="relative z-10">
                        <div class="inline-block p-4 bg-white/20 rounded-2xl mb-6 backdrop-blur-sm">
                            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold mb-8">Jam Pelayanan</h3>
                        <div class="space-y-6">
                            <div class="flex justify-between items-center pb-5 border-b border-white/20">
                                <div>
                                    <div class="text-xl font-semibold mb-1">Senin - Kamis</div>
                                    <div class="text-sm opacity-80">Hari Kerja Normal</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-bold">08.00 - 15.00</div>
                                    <div class="text-sm opacity-80">WIB</div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center pb-5 border-b border-white/20">
                                <div>
                                    <div class="text-xl font-semibold mb-1">Jumat</div>
                                    <div class="text-sm opacity-80">Jam Pendek</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-bold">08.00 - 11.30</div>
                                    <div class="text-sm opacity-80">WIB</div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center pb-5">
                                <div>
                                    <div class="text-xl font-semibold mb-1">Sabtu - Minggu</div>
                                    <div class="text-sm opacity-80">Akhir Pekan</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-bold text-red-300">Libur</div>
                                    <div class="text-sm opacity-80">Tutup</div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8 p-6 bg-white/10 rounded-xl backdrop-blur-sm border border-white/20">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-semibold mb-1">Catatan Penting</p>
                                    <p class="text-sm leading-relaxed opacity-90">Untuk pelayanan di luar jam kerja, silakan hubungi kontak darurat kami terlebih dahulu.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-white">
    
    @include('components.footer')

    </footer>

    <button id="scrollToTop" class="fixed bottom-8 right-8 w-14 h-14 bg-blue-600 text-white rounded-full shadow-2xl hover:bg-blue-700 transition-all opacity-0 pointer-events-none z-40 flex items-center justify-center">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"/>
        </svg>
    </button>

    <script>
        // Logic Slider dengan Kontrol Manual
        const slides = document.querySelectorAll('.hero-slide');
        const thumbnails = document.querySelectorAll('.slider-thumbnail');
        let currentSlide = 0;
        const slideInterval = 5000;
        let autoSlideTimer;

        function updateSlider() {
            slides.forEach((slide, index) => {
                slide.classList.remove('active');
                if (thumbnails[index]) {
                    thumbnails[index].classList.remove('active');
                }
            });
            
            slides[currentSlide].classList.add('active');
            if (thumbnails[currentSlide]) {
                thumbnails[currentSlide].classList.add('active');
            }
        }

        function nextSlide() {
            if(slides.length < 2) return;
            currentSlide = (currentSlide + 1) % slides.length;
            updateSlider();
        }

        function goToSlide(index) {
            if(slides.length < 2) return;
            currentSlide = index;
            updateSlider();
            resetAutoSlide();
        }

        function resetAutoSlide() {
            clearInterval(autoSlideTimer);
            if(slides.length > 1) {
                autoSlideTimer = setInterval(nextSlide, slideInterval);
            }
        }

        // Start auto slide
        if(slides.length > 1) {
            autoSlideTimer = setInterval(nextSlide, slideInterval);
        }

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

        // Intersection Observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>

</body>
</html>