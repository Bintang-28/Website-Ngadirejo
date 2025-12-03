<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?> - Login</title>

        <?php
            $siteLogo = App\Models\Setting::get('site_logo');
            $logoPath = $siteLogo 
                ? asset('storage/' . $siteLogo) 
                : asset('images/logokabmadiun.png');
            
            $heroBackground = App\Models\Setting::get('hero_background');
            $backgroundImage = $heroBackground 
                ? asset('storage/' . $heroBackground) 
                : asset('images/IMG_0339.jpg');
        ?>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

        <link rel="icon" href="<?php echo e($logoPath); ?>?v=<?php echo e(time()); ?>">

        <style>
            /* Background with overlay */
            .bg-hero-login {
                background-image: 
                    linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                    url('<?php echo e($backgroundImage); ?>');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            }

            /* Animated gradient border */
            @keyframes gradient-border {
                0%, 100% {
                    background-position: 0% 50%;
                }
                50% {
                    background-position: 100% 50%;
                }
            }

            .gradient-border {
                background: linear-gradient(90deg, #3b82f6, #06b6d4, #8b5cf6, #3b82f6);
                background-size: 300% 300%;
                animation: gradient-border 3s ease infinite;
            }

            /* Floating animation for logo */
            @keyframes float {
                0%, 100% {
                    transform: translateY(0px);
                }
                50% {
                    transform: translateY(-10px);
                }
            }

            .float-animation {
                animation: float 3s ease-in-out infinite;
            }

            /* Glass morphism effect */
            .glass-effect {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
            }

            /* Smooth input focus */
            .input-focus:focus {
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
            }

            /* Pattern overlay */
            .pattern-dots {
                background-image: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
                background-size: 20px 20px;
            }
        </style>

    </head>
    <body class="font-sans antialiased">
        
        <div class="relative min-h-screen flex bg-hero-login">
            
            <!-- Pattern Overlay -->
            <div class="absolute inset-0 pattern-dots"></div>

            <!-- Left Side - Branding (Hidden on mobile) -->
            <div class="hidden lg:flex lg:w-1/2 relative items-center justify-center p-12">
                <div class="max-w-md text-white z-10">
                    <div class="mb-8 float-animation">
                        <img src="<?php echo e($logoPath); ?>" alt="Logo Desa" class="h-32 w-32 mx-auto drop-shadow-2xl rounded-2xl bg-white/10 p-4 backdrop-blur-sm">
                    </div>
                    
                    <h1 class="text-5xl font-bold mb-6 leading-tight drop-shadow-lg">
                        Selamat Datang di<br>
                        <span class="text-blue-400">Desa Ngadirejo</span>
                    </h1>
                    
                    <p class="text-xl text-gray-200 mb-8 leading-relaxed">
                        Sistem Informasi Manajemen Desa yang modern dan terintegrasi untuk melayani masyarakat dengan lebih baik.
                    </p>

                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                        </div>
                        <div class="flex items-center space-x-3">
                        </div>
                        <div class="flex items-center space-x-3">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 relative z-10">
                <div class="w-full max-w-md">
                    
                    <!-- Mobile Logo (Visible only on mobile) -->
                    <div class="lg:hidden flex justify-center mb-8">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4">
                            <img src="<?php echo e($logoPath); ?>" alt="Logo Desa" class="h-20 w-20 drop-shadow-lg">
                        </div>
                    </div>

                    <!-- Login Card -->
                    <div class="glass-effect rounded-3xl shadow-2xl overflow-hidden">
                        <!-- Gradient Border Top -->
                        <div class="h-2 gradient-border"></div>
                        
                        <div class="p-8 sm:p-10">
                            <!-- Header -->
                            <div class="text-center mb-8">
                                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                                    Masuk ke Akun Anda
                                </h2>
                                <p class="text-gray-600 dark:text-gray-400">
                                    Silakan masuk dengan kredensial Anda
                                </p>
                            </div>

                            <!-- Login Form -->
                            <?php echo e($slot); ?>


                            <!-- Back to Home -->
                            <div class="mt-8 text-center">
                                <a href="/" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold transition-colors duration-300 group">
                                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Kembali ke Beranda
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Info -->
                    <div class="mt-6 text-center text-white text-sm">
                        <p class="mb-2">© <?php echo e(date('Y')); ?> Desa Ngadirejo. All rights reserved.</p>
                        <p class="text-gray-300">Sistem Informasi Manajemen Desa</p>
                    </div>

                </div>
            </div>

        </div>

    </body>
</html><?php /**PATH X:\hasil coding\Web-Project-KKN-Ngadirejo\resources\views/layouts/guest.blade.php ENDPATH**/ ?>