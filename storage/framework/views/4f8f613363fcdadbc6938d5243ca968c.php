<?php
    $siteLogo = App\Models\Setting::get('site_logo');
    $logoPath = $siteLogo 
        ? asset('storage/' . $siteLogo) 
        : asset('images/logokabmadiun.png');
?>

<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid md:grid-cols-4 gap-8 mb-8">
            <div class="md:col-span-2">
                <div class="flex items-center mb-4">
                    <img src="<?php echo e($logoPath); ?>" alt="Logo Desa" class="h-12 w-12 mr-3">
                    <div>
                        <h3 class="text-xl font-bold">DESA NGADIREJO</h3>
                        <p class="text-sm text-gray-400">Kecamatan Wonoasri</p>
                    </div>
                </div>
                <p class="text-gray-400 leading-relaxed mb-4">
                    Desa Ngadirejo berkomitmen untuk memberikan pelayanan terbaik kepada masyarakat dan membangun desa yang lebih maju dan sejahtera.
                </p>
                <div class="flex space-x-4">
                    <!-- Social media icons -->
                </div>
            </div>

            <div>
                <h4 class="text-lg font-bold mb-4">Menu Cepat</h4>
                <ul class="space-y-2">
                    <li><a href="<?php echo e(url('/#profil')); ?>" class="text-gray-400 hover:text-white transition-colors">Profil Desa</a></li>
                    <li><a href="<?php echo e(url('/#visi-misi')); ?>" class="text-gray-400 hover:text-white transition-colors">Visi & Misi</a></li>
                    <li><a href="<?php echo e(url('/#pelayanan')); ?>" class="text-gray-400 hover:text-white transition-colors">Pelayanan</a></li>
                    <li><a href="<?php echo e(route('publikasi.index')); ?>" class="text-gray-400 hover:text-white transition-colors">Publikasi</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-bold mb-4">Kontak</h4>
                <ul class="space-y-2 text-gray-400">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Desa Ngadirejo, Kec. Wonoasri, Kab. Madiun</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                        </svg>
                        <span>(0351) 123456</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                        <span>desangadirejo@gmail.com</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-8 text-center">
            <p class="text-gray-400">
                © <?php echo e(date('Y')); ?> Desa Ngadirejo. All rights reserved. 
            </p>
        </div>
    </div>
</footer><?php /**PATH X:\hasil coding\Web-Project-KKN-Ngadirejo\resources\views/components/footer.blade.php ENDPATH**/ ?>