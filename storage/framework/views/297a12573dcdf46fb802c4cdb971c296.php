<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?> - Admin Panel</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

        <?php
            $siteLogo = App\Models\Setting::get('site_logo');
            $logoPath = $siteLogo 
                ? asset('storage/' . $siteLogo) 
                : asset('images/logokabmadiun.png');
        ?>
        <link rel="icon" href="<?php echo e($logoPath); ?>?v=<?php echo e(time()); ?>">  
              
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
            
            <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <main class="p-4 md:ml-64 h-auto pt-20">
                
                <?php if(isset($header)): ?>
                    <header class="mb-4">
                        <div class="max-w-7xl mx-auto">
                            <?php echo e($header); ?>

                        </div>
                    </header>
                <?php endif; ?>
                
                <?php echo e($slot); ?>


            </main>
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    </body>
</html><?php /**PATH X:\hasil coding\Web-Project-KKN-Ngadirejo\resources\views/layouts/app.blade.php ENDPATH**/ ?>