<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Header Section -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Kelola Statistik Desa</h2>
                        <p class="text-gray-600 dark:text-gray-400 mt-2">Kelola data statistik dan informasi desa Anda</p>
                    </div>

                    <!-- Alert Success -->
                    <?php if(session('success')): ?>
                        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg dark:bg-green-900 dark:border-green-700 dark:text-green-300">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span><?php echo e(session('success')); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php
                        // Set default values if statistik is null
                        if (!$statistik) {
                            $statistik = new \App\Models\Statistik([
                                'jumlah_penduduk' => 6075,
                                'kepala_keluarga' => 345,
                                'jumlah_dusun' => 6,
                                'jumlah_rt' => 25,
                                'jumlah_rw' => 11,
                                'luas_wilayah' => 319.64,
                                'ketinggian' => 63,
                            ]);
                        }
                    ?>

                    <form action="<?php echo e(route('admin.statistik.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <!-- Statistik Utama Section -->
                        <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-6 mb-6">
                            <div class="flex items-center mb-6">
                                <svg class="w-6 h-6 mr-2 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                                </svg>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Statistik Utama</h3>
                            </div>

                            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 border-2 border-dashed border-gray-300 dark:border-gray-600">
                                <div class="grid md:grid-cols-2 gap-6">
                                    <!-- Jumlah Penduduk -->
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                            Jumlah Penduduk
                                        </label>
                                        <input type="number" 
                                               name="jumlah_penduduk" 
                                               value="<?php echo e(old('jumlah_penduduk', $statistik->jumlah_penduduk ?? 6075)); ?>"
                                               class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                               required>
                                        <?php $__errorArgs = ['jumlah_penduduk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <!-- Kepala Keluarga -->
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                            Kepala Keluarga
                                        </label>
                                        <input type="number" 
                                               name="kepala_keluarga" 
                                               value="<?php echo e(old('kepala_keluarga', $statistik->kepala_keluarga ?? 345)); ?>"
                                               class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                               required>
                                        <?php $__errorArgs = ['kepala_keluarga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <!-- Jumlah Dusun -->
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                            Jumlah Dusun
                                        </label>
                                        <input type="number" 
                                               name="jumlah_dusun" 
                                               value="<?php echo e(old('jumlah_dusun', $statistik->jumlah_dusun ?? 6)); ?>"
                                               class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                               required>
                                        <?php $__errorArgs = ['jumlah_dusun'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <!-- Jumlah RT & RW -->
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                                Jumlah RT
                                            </label>
                                            <input type="number" 
                                                   name="jumlah_rt" 
                                                   value="<?php echo e(old('jumlah_rt', $statistik->jumlah_rt ?? 25)); ?>"
                                                   class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                                   required>
                                            <?php $__errorArgs = ['jumlah_rt'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                                Jumlah RW
                                            </label>
                                            <input type="number" 
                                                   name="jumlah_rw" 
                                                   value="<?php echo e(old('jumlah_rw', $statistik->jumlah_rw ?? 11)); ?>"
                                                   class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                                   required>
                                            <?php $__errorArgs = ['jumlah_rw'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    <!-- Luas Wilayah & Ketinggian -->
                                    <div class="grid grid-cols-2 gap-4 md:col-span-2">
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                                Luas Wilayah (Ha)
                                            </label>
                                            <input type="number" 
                                                   step="0.01" 
                                                   name="luas_wilayah" 
                                                   value="<?php echo e(old('luas_wilayah', $statistik->luas_wilayah ?? 319.64)); ?>"
                                                   class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                                   required>
                                            <?php $__errorArgs = ['luas_wilayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                                Ketinggian (mdpl)
                                            </label>
                                            <input type="number" 
                                                   name="ketinggian" 
                                                   value="<?php echo e(old('ketinggian', $statistik->ketinggian ?? 63)); ?>"
                                                   class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                                   required>
                                            <?php $__errorArgs = ['ketinggian'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Statistik Detail Section -->
                        <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-6 mb-6">
                            <div class="flex items-center mb-6">
                                <svg class="w-6 h-6 mr-2 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                                </svg>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Statistik Detail (Opsional)</h3>
                            </div>

                            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 border-2 border-dashed border-gray-300 dark:border-gray-600">
                                <div class="grid md:grid-cols-2 gap-6">
                                    <!-- Gender Statistics -->
                                    <div class="grid grid-cols-2 gap-4 md:col-span-2">
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                                Penduduk Laki-laki
                                            </label>
                                            <input type="number" 
                                                   name="jumlah_laki_laki" 
                                                   value="<?php echo e(old('jumlah_laki_laki', $statistik->jumlah_laki_laki ?? null)); ?>"
                                                   class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                                Penduduk Perempuan
                                            </label>
                                            <input type="number" 
                                                   name="jumlah_perempuan" 
                                                   value="<?php echo e(old('jumlah_perempuan', $statistik->jumlah_perempuan ?? null)); ?>"
                                                   class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>
                                    </div>

                                    <!-- Land Statistics -->
                                    <div class="grid grid-cols-2 gap-4 md:col-span-2">
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                                Lahan Pertanian (Ha)
                                            </label>
                                            <input type="number" 
                                                   step="0.01" 
                                                   name="lahan_pertanian" 
                                                   value="<?php echo e(old('lahan_pertanian', $statistik->lahan_pertanian ?? null)); ?>"
                                                   class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                                Lahan Non-Pertanian (Ha)
                                            </label>
                                            <input type="number" 
                                                   step="0.01" 
                                                   name="lahan_non_pertanian" 
                                                   value="<?php echo e(old('lahan_non_pertanian', $statistik->lahan_non_pertanian ?? null)); ?>"
                                                   class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Preview Section -->
                        <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-6 mb-6">
                            <div class="flex items-center mb-6">
                                <svg class="w-6 h-6 mr-2 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Preview Tampilan</h3>
                            </div>

                            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 border-2 border-gray-300 dark:border-gray-600">
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 p-6 rounded-lg text-center border border-blue-200 dark:border-blue-700">
                                        <div class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-2" id="preview-penduduk">
                                            <?php echo e(number_format(old('jumlah_penduduk', $statistik->jumlah_penduduk ?? 6075))); ?>

                                        </div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Jumlah Penduduk</div>
                                    </div>

                                    <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 p-6 rounded-lg text-center border border-green-200 dark:border-green-700">
                                        <div class="text-3xl font-bold text-green-600 dark:text-green-400 mb-2" id="preview-kk">
                                            <?php echo e(number_format(old('kepala_keluarga', $statistik->kepala_keluarga ?? 345))); ?>

                                        </div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Kepala Keluarga</div>
                                    </div>

                                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 p-6 rounded-lg text-center border border-purple-200 dark:border-purple-700">
                                        <div class="text-3xl font-bold text-purple-600 dark:text-purple-400 mb-2" id="preview-dusun">
                                            <?php echo e(number_format(old('jumlah_dusun', $statistik->jumlah_dusun ?? 6))); ?>

                                        </div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Jumlah Dusun</div>
                                    </div>

                                    <div class="bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 p-6 rounded-lg text-center border border-orange-200 dark:border-orange-700">
                                        <div class="text-3xl font-bold text-orange-600 dark:text-orange-400 mb-2" id="preview-wilayah">
                                            <?php echo e(number_format(old('luas_wilayah', $statistik->luas_wilayah ?? 319.64), 2)); ?>

                                        </div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Luas Wilayah (Ha)</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end space-x-4">
                            <a href="<?php echo e(route('admin.dashboard')); ?>" 
                               class="inline-flex items-center px-6 py-3 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 font-semibold rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition duration-150 ease-in-out">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                                Batal
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-150 ease-in-out">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z"></path>
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk Real-time Preview -->
    <script>
        // Real-time preview update untuk semua field
        const previewFields = {
            'jumlah_penduduk': 'preview-penduduk',
            'kepala_keluarga': 'preview-kk',
            'jumlah_dusun': 'preview-dusun',
            'luas_wilayah': 'preview-wilayah'
        };

        Object.keys(previewFields).forEach(fieldName => {
            const input = document.querySelector(`input[name="${fieldName}"]`);
            if (input) {
                input.addEventListener('input', function() {
                    const value = parseFloat(this.value) || 0;
                    const previewId = previewFields[fieldName];
                    const previewElement = document.getElementById(previewId);
                    
                    if (previewElement) {
                        if (fieldName === 'luas_wilayah') {
                            previewElement.textContent = value.toLocaleString('id-ID', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });
                        } else {
                            previewElement.textContent = value.toLocaleString('id-ID');
                        }
                    }
                });
            }
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH X:\hasil coding\Web-Project-KKN-Ngadirejo\resources\views/admin/statistik/index.blade.php ENDPATH**/ ?>