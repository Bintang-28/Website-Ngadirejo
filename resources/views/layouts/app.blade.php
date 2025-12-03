<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin Panel</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @php
            $siteLogo = App\Models\Setting::get('site_logo');
            $logoPath = $siteLogo 
                ? asset('storage/' . $siteLogo) 
                : asset('images/logokabmadiun.png');
        @endphp
        <link rel="icon" href="{{ $logoPath }}?v={{ time() }}">  
              
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js" defer></script>

        
        <script>
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>
    </head>
    
    <body class="font-sans antialiased"
          x-data="{ 
              darkMode: localStorage.theme === 'dark',
              toggle() {
                  this.darkMode = !this.darkMode;
                  localStorage.theme = this.darkMode ? 'dark' : 'light';
                  if (this.darkMode) {
                      document.documentElement.classList.add('dark');
                  } else {
                      document.documentElement.classList.remove('dark');
                  }
              }
          }">
        
        <div class="antialiased bg-gray-100 dark:bg-gray-900 min-h-screen">
            
            @include('layouts.navigation')

            <main class="p-4 md:ml-64 h-auto pt-20">
                
                @if (isset($header))
                    <header class="mb-4">
                        <div class="max-w-7xl mx-auto">
                            {{ $header }}
                        </div>
                    </header>
                @endif
                
                {{ $slot }}

            </main>
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    </body>
</html>