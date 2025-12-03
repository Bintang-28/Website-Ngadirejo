<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>{{ $berita->judul }} - Desa Ngadirejo</title>

    @php
        $siteLogo = App\Models\Setting::get('site_logo');
        $logoPath = $siteLogo 
            ? asset('storage/' . $siteLogo) 
            : asset('images/logokabmadiun.png');
    @endphp

    <link rel="icon" href="{{ $logoPath }}">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Custom Prose Styling */
        .article-content {
            font-size: 1.125rem;
            line-height: 1.8;
            color: #374151;
        }
        
        .article-content p {
            margin-bottom: 1.5rem;
        }
        
        .article-content img {
            margin: 2.5rem 0;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .article-content h2 {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1f2937;
            margin-top: 3rem;
            margin-bottom: 1.5rem;
        }
        
        .article-content h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #374151;
            margin-top: 2.5rem;
            margin-bottom: 1.25rem;
        }
        
        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }
        
        /* Share button hover effects */
        .share-btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .share-btn:hover {
            transform: translateY(-3px);
        }
    </style>
</head>
<body class="antialiased font-sans bg-gray-50">
    
        @include('components.header')

        <!-- Hero Image Section -->
        @if($berita->gambar_header)
        <div class="relative h-[500px] md:h-[600px] overflow-hidden bg-gray-900 mt-20 md:mt-20">
            <img src="{{ asset('storage/' . $berita->gambar_header) }}" 
                 alt="{{ $berita->judul }}" 
                 class="w-full h-full object-cover opacity-80">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        </div>
        @endif

        <!-- Main Content -->
        <main class="flex-grow">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-32 relative z-10">
                
                <!-- Breadcrumb -->
                <nav class="mb-8">
                    <a href="/" class="inline-flex items-center text-white hover:text-blue-300 transition-colors duration-300 group">
                        <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span class="font-semibold">Kembali ke Beranda</span>
                    </a>
                </nav>

                <!-- Article Card -->
                <article class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                    
                    <!-- Article Header -->
                    <div class="p-8 md:p-12 pb-8">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight mb-6">
                            {{ $berita->judul }}
                        </h1>
                        
                        <!-- Meta Information -->
                        <div class="flex flex-wrap items-center gap-6 text-gray-600 mb-8 pb-8 border-b border-gray-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Penulis</p>
                                    <p class="font-semibold text-gray-900">{{ $berita->user->name }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Tanggal</p>
                                    <p class="font-semibold text-gray-900">{{ $berita->created_at->format('d F Y') }}</p>
                                </div>
                            </div>
                            
                            <!-- Share Buttons -->
                            <div class="ml-auto flex items-center space-x-3">
                                <span class="text-sm font-semibold text-gray-700">Bagikan:</span>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="share-btn w-10 h-10 rounded-full bg-blue-600 hover:bg-blue-700 flex items-center justify-center shadow-md">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($berita->judul) }}" target="_blank" class="share-btn w-10 h-10 rounded-full bg-sky-500 hover:bg-sky-600 flex items-center justify-center shadow-md">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($berita->judul . ' ' . request()->url()) }}" target="_blank" class="share-btn w-10 h-10 rounded-full bg-green-500 hover:bg-green-600 flex items-center justify-center shadow-md">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Article Content -->
                    <div class="px-8 md:px-12 pb-12">
                        <div class="article-content max-w-none">
                            @foreach($berita->blocks as $block)
                                
                                @if($block->tipe == 'teks')
                                    <div class="mb-6">
                                        {!! nl2br(e($block->konten)) !!}
                                    </div>
                                
                                @elseif($block->tipe == 'gambar')
                                    <figure class="my-10">
                                        <img src="{{ asset('storage/' . $block->konten) }}" 
                                             alt="Gambar konten berita"
                                             class="w-full h-auto rounded-2xl shadow-xl">
                                    </figure>
                                
                                @elseif($block->tipe == 'pdf')
                                    <div class="my-10 bg-gray-50 p-8 rounded-2xl border-2 border-gray-200">
                                        <div class="flex items-center space-x-3 mb-6">
                                            <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                                            </svg>
                                            <h3 class="text-2xl font-bold text-gray-900">Lampiran Dokumen PDF</h3>
                                        </div>
                                        <embed src="{{ asset('storage/' . $block->konten) }}" 
                                               type="application/pdf" 
                                               width="100%" 
                                               height="600px" 
                                               class="rounded-xl shadow-lg mb-4">
                                        <a href="{{ asset('storage/' . $block->konten) }}" 
                                           target="_blank" 
                                           class="inline-flex items-center space-x-2 text-blue-600 hover:text-blue-700 font-semibold transition-colors duration-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                            </svg>
                                            <span>Buka PDF di Tab Baru</span>
                                        </a>
                                    </div>
                                @endif

                            @endforeach
                        </div>
                    </div>

                    <!-- Article Footer -->
                    <div class="px-8 md:px-12 pb-12 pt-8 border-t border-gray-200">
                        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                            <a href="/publikasi" 
                               class="inline-flex items-center space-x-2 text-blue-600 hover:text-blue-700 font-semibold text-lg transition-colors duration-300 group">
                                <svg class="w-6 h-6 transform group-hover:-translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                                </svg>
                                <span>Kembali ke Publikasi</span>
                            </a>
                            
                            <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" 
                                    class="inline-flex items-center space-x-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-full font-semibold transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                </svg>
                                <span>Kembali ke Atas</span>
                            </button>
                        </div>
                    </div>
                </article>
            </div>
        </main>

    <div class="mt-20">
        
    @include('components.footer')

    </div>
</body>
</html>