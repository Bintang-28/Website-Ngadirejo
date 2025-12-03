<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Pengaturan Website</h2>
                        <p class="text-gray-600 dark:text-gray-400 mt-2">Kelola tampilan dan pengaturan website desa</p>
                    </div>

                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg dark:bg-green-900 dark:border-green-700 dark:text-green-300">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg dark:bg-red-900 dark:border-red-700 dark:text-red-300">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-semibold">Terjadi kesalahan:</span>
                            </div>
                            <ul class="list-disc list-inside ml-7">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-6 mb-6">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 mr-2 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                            </svg>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Logo Website (Global)</h3>
                        </div>

                        <div class="mb-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg dark:bg-yellow-900 dark:border-yellow-700">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 mt-0.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-sm text-yellow-800 dark:text-yellow-300">
                                    <strong>Logo ini akan digunakan di seluruh website:</strong> Favicon (tab browser), Navbar, Hero Section, dan Profil Desa
                                </p>
                            </div>
                        </div>

                        @if($siteLogo && $siteLogo->value)
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Logo Saat Ini:</label>
                                <div class="relative flex justify-center">
                                    <img src="{{ asset('storage/' . $siteLogo->value) }}" 
                                         alt="Logo Website" 
                                         class="h-48 w-48 object-contain rounded-lg shadow-lg border-2 border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 p-4">
                                    <div class="absolute top-2 right-2">
                                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold">Aktif</span>
                                    </div>
                                </div>
                                
                                <form action="{{ route('admin.settings.site-logo.delete') }}" 
                                      method="POST" 
                                      class="mt-4 text-center"
                                      onsubmit="return confirm('Yakin ingin menghapus logo ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition duration-150 ease-in-out">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        Hapus Logo
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg dark:bg-yellow-900 dark:border-yellow-700">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-yellow-600 dark:text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="text-yellow-800 dark:text-yellow-300 font-medium">
                                        Belum ada logo kustom. Logo default sedang digunakan.
                                    </p>
                                </div>
                            </div>
                        @endif

                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 border-2 border-dashed border-gray-300 dark:border-gray-600">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Upload Logo Website</h4>
                            
                            <form action="{{ route('admin.settings.site-logo') }}" 
                                  method="POST" 
                                  enctype="multipart/form-data">
                                @csrf
                                
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Pilih Gambar Logo:
                                    </label>
                                    <input type="file" 
                                           name="site_logo" 
                                           accept="image/jpeg,image/png,image/jpg,image/svg+xml" 
                                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" 
                                           required
                                           onchange="previewImage(event, 'previewSiteLogo', 'imagePreviewSiteLogo')">
                                </div>

                                <div id="imagePreviewSiteLogo" class="hidden mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Preview:</label>
                                    <div class="flex justify-center">
                                        <img id="previewSiteLogo" src="" alt="Preview" class="h-48 w-48 object-contain rounded-lg border-2 border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 p-4">
                                    </div>
                                </div>

                                <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg dark:bg-blue-900 dark:border-blue-700">
                                    <div class="flex">
                                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                        </svg>
                                        <div class="text-sm text-blue-800 dark:text-blue-300">
                                            <p class="font-semibold mb-1">Persyaratan logo:</p>
                                            <ul class="list-disc list-inside space-y-1">
                                                <li>Format: JPG, JPEG, PNG, atau SVG</li>
                                                <li>Ukuran maksimal: 2 MB</li>
                                                <li>Disarankan format PNG dengan background transparan</li>
                                                <li>Ukuran yang disarankan: 512x512 px (square)</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" 
                                        class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg transition duration-150 ease-in-out">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Upload Logo
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-6 mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 mr-2 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                </svg>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Background Hero Section (Slider)</h3>
                            </div>
                            <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Multiple Image</span>
                        </div>

                        @if(isset($heroBackgrounds) && $heroBackgrounds->count() > 0)
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Background Aktif ({{ $heroBackgrounds->count() }}):</label>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    @foreach($heroBackgrounds as $bg)
                                        @php 
                                            // Ambil ID angka dari key (contoh: hero_background_1 => 1)
                                            $keyParts = explode('_', $bg->key);
                                            $bgId = end($keyParts);
                                        @endphp
                                        <div class="relative group">
                                            <img src="{{ asset('storage/' . $bg->value) }}" 
                                                 alt="Hero Background {{ $bgId }}" 
                                                 class="w-full h-40 object-cover rounded-lg shadow-lg border-2 border-gray-300 dark:border-gray-600">
                                            
                                            <form action="{{ route('admin.settings.hero-background.delete', $bgId) }}" 
                                                  method="POST" 
                                                  class="absolute top-2 right-2"
                                                  onsubmit="return confirm('Hapus gambar ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="p-2 bg-red-600 text-white rounded-full hover:bg-red-700 shadow-lg transition duration-150"
                                                        title="Hapus Gambar Ini">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                            <div class="absolute bottom-0 left-0 bg-black/50 text-white text-xs px-2 py-1 rounded-tr-lg">
                                                Slide #{{ $loop->iteration }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <form action="{{ route('admin.settings.hero-background.delete-all') }}" 
                                      method="POST" 
                                      class="mt-4 text-right"
                                      onsubmit="return confirm('Yakin ingin menghapus SEMUA background?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold underline">
                                        Hapus Semua Background
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg dark:bg-yellow-900 dark:border-yellow-700">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-yellow-600 dark:text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="text-yellow-800 dark:text-yellow-300 font-medium">
                                        Belum ada background kustom. Background default sedang digunakan.
                                    </p>
                                </div>
                            </div>
                        @endif

                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 border-2 border-dashed border-gray-300 dark:border-gray-600">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Tambah Background Baru</h4>
                            
                            <form action="{{ route('admin.settings.hero-background') }}" 
                                  method="POST" 
                                  enctype="multipart/form-data">
                                @csrf
                                
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Pilih Gambar (Bisa pilih lebih dari 1):
                                    </label>
                                    <input type="file" 
                                           name="hero_backgrounds[]" 
                                           accept="image/jpeg,image/png,image/jpg" 
                                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" 
                                           required
                                           multiple
                                           onchange="previewMultipleImages(event)">
                                    <p class="text-xs text-gray-500 mt-1">Tahan tombol CTRL (Windows) atau CMD (Mac) untuk memilih banyak file sekaligus.</p>
                                </div>

                                <div id="multiplePreviewContainer" class="hidden mb-4 grid grid-cols-3 gap-2">
                                    </div>

                                <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg dark:bg-blue-900 dark:border-blue-700">
                                    <div class="flex">
                                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                        </svg>
                                        <div class="text-sm text-blue-800 dark:text-blue-300">
                                            <p class="font-semibold mb-1">Persyaratan gambar:</p>
                                            <ul class="list-disc list-inside space-y-1">
                                                <li>Format: JPG, JPEG, atau PNG</li>
                                                <li>Ukuran maksimal: 5 MB per file</li>
                                                <li>Resolusi yang disarankan: 1920x1080 px</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" 
                                        class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-150 ease-in-out">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Upload Background
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-6 mb-6">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 mr-2 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                            </svg>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Teks Hero Section</h3>
                        </div>

                        @php
                            $currentTitle = $heroTitle ? $heroTitle->value : 'NGADIREJO';
                            $currentTagline = $heroTagline ? $heroTagline->value : 'Desa Terindah dan Paling Berkesan';
                        @endphp

                        <div class="mb-6 p-4 bg-white dark:bg-gray-800 rounded-lg border-2 border-gray-300 dark:border-gray-600">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Preview Saat Ini:</label>
                            <div class="text-center py-8">
                                <h1 class="text-5xl font-bold text-gray-900 dark:text-white mb-2">{{ $currentTitle }}</h1>
                                <p class="text-xl text-gray-600 dark:text-gray-400">{{ $currentTagline }}</p>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 border-2 border-dashed border-gray-300 dark:border-gray-600">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Edit Teks Hero</h4>
                            
                            <form action="{{ route('admin.settings.hero-text') }}" 
                                  method="POST">
                                @csrf
                                
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Judul Hero (Judul Utama):
                                    </label>
                                    <input type="text" 
                                           name="hero_title" 
                                           value="{{ $currentTitle }}"
                                           class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                           placeholder="Contoh: NGADIREJO"
                                           maxlength="100"
                                           required>
                                    <p class="text-gray-500 text-sm mt-1">Maksimal 100 karakter</p>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Tagline Hero (Subjudul):
                                    </label>
                                    <input type="text" 
                                           name="hero_tagline" 
                                           value="{{ $currentTagline }}"
                                           class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                           placeholder="Contoh: Desa Terindah dan Paling Berkesan"
                                           maxlength="200"
                                           required>
                                    <p class="text-gray-500 text-sm mt-1">Maksimal 200 karakter</p>
                                </div>

                                <button type="submit" 
                                        class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition duration-150 ease-in-out">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z"></path>
                                    </svg>
                                    Simpan Perubahan
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-6 mb-6">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 mr-2 text-teal-600 dark:text-teal-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1H3a1 1 0 01-1-1V4zM8 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1H9a1 1 0 01-1-1V4zM15 3a1 1 0 00-1 1v12a1 1 0 001 1h2a1 1 0 001-1V4a1 1 0 00-1-1h-2z"/>
                            </svg>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Struktur Organisasi Desa</h3>
                        </div>

                        <div class="mb-4 p-3 bg-teal-50 border border-teal-200 rounded-lg dark:bg-teal-900 dark:border-teal-700">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-teal-600 dark:text-teal-400 mt-0.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-sm text-teal-800 dark:text-teal-300">
                                    <strong>Gambar ini menampilkan struktur organisasi pemerintahan desa</strong> yang akan ditampilkan di halaman "Struktur Organisasi" di website depan
                                </p>
                            </div>
                        </div>

                        @php
                            $strukturOrganisasiImage = App\Models\Setting::where('key', 'struktur_organisasi_image')->first();
                        @endphp

                        @if($strukturOrganisasiImage && $strukturOrganisasiImage->value)
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Gambar Struktur Organisasi Saat Ini:</label>
                                <div class="relative flex justify-center">
                                    <img src="{{ asset('storage/' . $strukturOrganisasiImage->value) }}" 
                                        alt="Struktur Organisasi" 
                                        class="max-h-96 object-contain rounded-lg shadow-lg border-2 border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 p-4">
                                    <div class="absolute top-2 right-2">
                                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold">Aktif</span>
                                    </div>
                                </div>
                                
                                <form action="{{ route('admin.settings.struktur-organisasi.delete') }}" 
                                    method="POST" 
                                    class="mt-4 text-center"
                                    onsubmit="return confirm('Yakin ingin menghapus gambar struktur organisasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition duration-150 ease-in-out">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        Hapus Gambar
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg dark:bg-yellow-900 dark:border-yellow-700">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-yellow-600 dark:text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="text-yellow-800 dark:text-yellow-300 font-medium">
                                        Belum ada gambar struktur organisasi. Gambar default sedang digunakan.
                                    </p>
                                </div>
                            </div>
                        @endif

                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 border-2 border-dashed border-gray-300 dark:border-gray-600">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Upload Gambar Struktur Organisasi</h4>
                            
                            <form action="{{ route('admin.settings.struktur-organisasi') }}" 
                                method="POST" 
                                enctype="multipart/form-data">
                                @csrf
                                
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Pilih Gambar Struktur Organisasi:
                                    </label>
                                    <input type="file" 
                                        name="struktur_organisasi_image" 
                                        accept="image/jpeg,image/png,image/jpg" 
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" 
                                        required
                                        onchange="previewStrukturOrganisasiImage(event)">
                                </div>

                                <div id="strukturOrganisasiImagePreview" class="hidden mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Preview:</label>
                                    <div class="flex justify-center">
                                        <img id="previewStrukturOrganisasiImage" src="" alt="Preview" class="max-h-64 object-contain rounded-lg border-2 border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 p-4">
                                    </div>
                                </div>

                                <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg dark:bg-blue-900 dark:border-blue-700">
                                    <div class="flex">
                                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                        </svg>
                                        <div class="text-sm text-blue-800 dark:text-blue-300">
                                            <p class="font-semibold mb-1">Persyaratan gambar struktur organisasi:</p>
                                            <ul class="list-disc list-inside space-y-1">
                                                <li>Format: JPG, JPEG, atau PNG</li>
                                                <li>Ukuran maksimal: 5 MB</li>
                                                <li>Resolusi yang disarankan: 1920x1080 px atau lebih</li>
                                                <li>Jika upload gambar baru, gambar lama akan otomatis terhapus</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" 
                                        class="inline-flex items-center px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white font-semibold rounded-lg transition duration-150 ease-in-out">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Upload Struktur Organisasi
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-6 mb-6">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 mr-2 text-indigo-600 dark:text-indigo-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v2h8v-2zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-2a4 4 0 00-8 0v2h8z"/>
                            </svg>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Struktur BPD (Badan Permusyawaratan Desa)</h3>
                        </div>

                        <div class="mb-4 p-3 bg-indigo-50 border border-indigo-200 rounded-lg dark:bg-indigo-900 dark:border-indigo-700">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400 mt-0.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-sm text-indigo-800 dark:text-indigo-300">
                                    <strong>Gambar ini menampilkan struktur organisasi BPD</strong> yang akan ditampilkan di halaman "Struktur BPD" di website depan
                                </p>
                            </div>
                        </div>

                        @if($bpdStructureImage && $bpdStructureImage->value)
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Gambar Struktur BPD Saat Ini:</label>
                                <div class="relative flex justify-center">
                                    <img src="{{ asset('storage/' . $bpdStructureImage->value) }}" 
                                        alt="Struktur BPD" 
                                        class="max-h-96 object-contain rounded-lg shadow-lg border-2 border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 p-4">
                                    <div class="absolute top-2 right-2">
                                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold">Aktif</span>
                                    </div>
                                </div>
                                
                                <form action="{{ route('admin.settings.bpd-structure.delete') }}" 
                                    method="POST" 
                                    class="mt-4 text-center"
                                    onsubmit="return confirm('Yakin ingin menghapus gambar struktur BPD ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition duration-150 ease-in-out">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        Hapus Gambar
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg dark:bg-yellow-900 dark:border-yellow-700">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-yellow-600 dark:text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="text-yellow-800 dark:text-yellow-300 font-medium">
                                        Belum ada gambar struktur BPD. Upload gambar sekarang.
                                    </p>
                                </div>
                            </div>
                        @endif

                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 border-2 border-dashed border-gray-300 dark:border-gray-600">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Upload Gambar Struktur BPD</h4>
                            
                            <form action="{{ route('admin.settings.bpd-structure') }}" 
                                method="POST" 
                                enctype="multipart/form-data">
                                @csrf
                                
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Pilih Gambar Struktur BPD:
                                    </label>
                                    <input type="file" 
                                        name="bpd_structure_image" 
                                        accept="image/jpeg,image/png,image/jpg" 
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" 
                                        required
                                        onchange="previewBpdImage(event)">
                                </div>

                                <div id="bpdImagePreview" class="hidden mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Preview:</label>
                                    <div class="flex justify-center">
                                        <img id="previewBpdImage" src="" alt="Preview" class="max-h-64 object-contain rounded-lg border-2 border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 p-4">
                                    </div>
                                </div>

                                <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg dark:bg-blue-900 dark:border-blue-700">
                                    <div class="flex">
                                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                        </svg>
                                        <div class="text-sm text-blue-800 dark:text-blue-300">
                                            <p class="font-semibold mb-1">Persyaratan gambar struktur BPD:</p>
                                            <ul class="list-disc list-inside space-y-1">
                                                <li>Format: JPG, JPEG, atau PNG</li>
                                                <li>Ukuran maksimal: 5 MB</li>
                                                <li>Resolusi yang disarankan: 1920x1080 px atau lebih</li>
                                                <li>Jika upload gambar baru, gambar lama akan otomatis terhapus</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" 
                                        class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition duration-150 ease-in-out">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Upload Struktur BPD
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-6 mb-6">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 mr-2 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Profil Desa</h3>
                        </div>

                        <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg dark:bg-blue-900 dark:border-blue-700">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-sm text-blue-800 dark:text-blue-300">
                                    <strong>Informasi profil desa akan ditampilkan di halaman Profil Desa</strong> di website depan
                                </p>
                            </div>
                        </div>

                        <!-- SECTION: GAMBAR PROFIL DESA -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 border-2 border-dashed border-gray-300 dark:border-gray-600 mb-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Upload Gambar Profil Desa</h4>
                            
                            @if($profilDesaImage && $profilDesaImage->value)
                                <div class="mb-6">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Gambar Profil Desa Saat Ini:</label>
                                    <div class="relative flex justify-center">
                                        <img src="{{ asset('storage/' . $profilDesaImage->value) }}" 
                                            alt="Profil Desa" 
                                            class="max-h-80 object-cover rounded-lg shadow-lg border-2 border-gray-300 dark:border-gray-600">
                                        <div class="absolute top-2 right-2">
                                            <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold">Aktif</span>
                                        </div>
                                    </div>
                                    
                                    <form action="{{ route('admin.settings.profil-desa-image.delete') }}" 
                                        method="POST" 
                                        class="mt-4 text-center"
                                        onsubmit="return confirm('Yakin ingin menghapus gambar profil desa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition duration-150 ease-in-out">
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            Hapus Gambar
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg dark:bg-yellow-900 dark:border-yellow-700">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-yellow-600 dark:text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        <p class="text-yellow-800 dark:text-yellow-300 font-medium">
                                            Belum ada gambar profil desa. Upload gambar sekarang.
                                        </p>
                                    </div>
                                </div>
                            @endif

                            <form action="{{ route('admin.settings.profil-desa-image') }}" 
                                method="POST" 
                                enctype="multipart/form-data"
                                class="mb-6">
                                @csrf
                                
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Pilih Gambar Profil Desa (Balai Desa, Pemandangan, dll):
                                    </label>
                                    <input type="file" 
                                        name="profil_desa_image" 
                                        accept="image/jpeg,image/png,image/jpg" 
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" 
                                        required
                                        onchange="previewProfilDesaImage(event)">
                                </div>

                                <div id="profilDesaImagePreview" class="hidden mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Preview:</label>
                                    <div class="flex justify-center">
                                        <img id="previewProfilDesaImage" src="" alt="Preview" class="max-h-80 object-cover rounded-lg border-2 border-gray-300 dark:border-gray-600">
                                    </div>
                                </div>

                                <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg dark:bg-blue-900 dark:border-blue-700">
                                    <div class="flex">
                                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                        </svg>
                                        <div class="text-sm text-blue-800 dark:text-blue-300">
                                            <p class="font-semibold mb-1">Persyaratan gambar profil desa:</p>
                                            <ul class="list-disc list-inside space-y-1">
                                                <li>Format: JPG, JPEG, atau PNG</li>
                                                <li>Ukuran maksimal: 5 MB</li>
                                                <li>Resolusi yang disarankan: 600x600 px atau lebih</li>
                                                <li>Jika upload gambar baru, gambar lama akan otomatis terhapus</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" 
                                        class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-150 ease-in-out">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Upload Gambar Profil Desa
                                </button>
                            </form>
                        </div>

                        <!-- SECTION: TEKS PROFIL DESA -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 border-2 border-dashed border-gray-300 dark:border-gray-600">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Edit Teks Profil Desa</h4>
                            
                            <form action="{{ route('admin.settings.profil-desa-text') }}" 
                                  method="POST">
                                @csrf
                                
                                <div class="mb-6">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Deskripsi Profil Desa:
                                    </label>
                                    <textarea name="profil_desa_description" 
                                              rows="6"
                                              class="block w-full px-4 py-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                              placeholder="Masukkan deskripsi profil desa Anda..."
                                              maxlength="1000"
                                              required>{{ $profilDesaDescription ? $profilDesaDescription->value : 'Desa Ngadirejo adalah desa yang terletak di Kecamatan Wonoasri, Kabupaten Madiun, Provinsi Jawa Timur. Desa ini memiliki potensi yang besar dalam sektor pertanian, terutama sebagai penghasil padi dan hasil pertanian lainnya.' }}</textarea>
                                    <p class="text-gray-500 text-sm mt-1">Maksimal 1000 karakter</p>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-6 mb-6">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 mr-2 text-indigo-600 dark:text-indigo-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                            </svg>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Visi & Misi Desa</h3>
                        </div>

                        <div class="mb-4 p-3 bg-indigo-50 border border-indigo-200 rounded-lg dark:bg-indigo-900 dark:border-indigo-700">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400 mt-0.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-sm text-indigo-800 dark:text-indigo-300">
                                    <strong>Visi & Misi akan ditampilkan di halaman Visi & Misi</strong> di website depan
                                </p>
                            </div>
                        </div>

                        @php
                            $currentVisi = $visi ? $visi->value : 'Mewujudkan Desa Ngadirejo yang maju, sejahtera, mandiri, dan berbudaya berdasarkan nilai-nilai gotong royong dan kearifan lokal.';
                            $currentMisi = $misi ? json_decode($misi->value, true) : [
                                'Meningkatkan kualitas pelayanan publik',
                                'Mengembangkan potensi ekonomi lokal',
                                'Meningkatkan kualitas pendidikan dan kesehatan',
                                'Melestarikan budaya dan kearifan lokal'
                            ];
                        @endphp

                        <div class="mb-6 p-4 bg-white dark:bg-gray-800 rounded-lg border-2 border-gray-300 dark:border-gray-600">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Preview Saat Ini:</label>
                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-lg font-bold text-indigo-600 mb-2">Visi</h4>
                                    <p class="text-gray-700 dark:text-gray-300">{{ $currentVisi }}</p>
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold text-indigo-600 mb-2">Misi</h4>
                                    <ul class="list-disc list-inside space-y-1 text-gray-700 dark:text-gray-300">
                                        @foreach($currentMisi as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 border-2 border-dashed border-gray-300 dark:border-gray-600">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Edit Visi & Misi</h4>
                            
                            <form action="{{ route('admin.settings.visi-misi') }}" method="POST">
                                @csrf
                                
                                <div class="mb-6">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Visi Desa:
                                    </label>
                                    <textarea name="visi" 
                                            rows="4"
                                            class="block w-full px-4 py-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                            placeholder="Masukkan visi desa..."
                                            maxlength="1000"
                                            required>{{ $currentVisi }}</textarea>
                                    <p class="text-gray-500 text-sm mt-1">Maksimal 1000 karakter</p>
                                </div>

                                <div class="mb-6">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Misi Desa:
                                    </label>
                                    
                                    <div id="misiContainer" class="space-y-3">
                                        @foreach($currentMisi as $index => $item)
                                            <div class="misi-item flex gap-2">
                                                <textarea name="misi[]" 
                                                        rows="2"
                                                        class="flex-1 px-4 py-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                                        placeholder="Masukkan misi ke-{{ $index + 1 }}..."
                                                        maxlength="500"
                                                        required>{{ $item }}</textarea>
                                                <button type="button" 
                                                        onclick="removeMisi(this)"
                                                        class="px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition h-fit">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>

                                    <button type="button" 
                                            onclick="addMisi()"
                                            class="mt-3 inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        Tambah Misi
                                    </button>
                                    
                                    <p class="text-gray-500 text-sm mt-2">Setiap misi maksimal 500 karakter</p>
                                </div>

                                <button type="submit" 
                                        class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition duration-150 ease-in-out">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z"></path>
                                    </svg>
                                    Simpan Visi & Misi
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Untuk Logo (Single)
        function previewImage(event, previewId, containerId) {
            const input = event.target;
            const preview = document.getElementById(previewId);
            const previewContainer = document.getElementById(containerId);
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        // MODIFIKASI: Untuk Hero Background (Multiple)
        function previewMultipleImages(event) {
            const container = document.getElementById('multiplePreviewContainer');
            container.innerHTML = ''; // Clear previous previews
            
            if (event.target.files && event.target.files.length > 0) {
                container.classList.remove('hidden');
                
                Array.from(event.target.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative';
                        
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'w-full h-24 object-cover rounded border';
                        
                        div.appendChild(img);
                        container.appendChild(div);
                    }
                    reader.readAsDataURL(file);
                });
            } else {
                container.classList.add('hidden');
            }
        }
    </script>

    <script>
        // Preview untuk gambar Struktur Organisasi
        function previewStrukturOrganisasiImage(event) {
            const input = event.target;
            const preview = document.getElementById('previewStrukturOrganisasiImage');
            const previewContainer = document.getElementById('strukturOrganisasiImagePreview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        // Preview untuk gambar BPD
        function previewBpdImage(event) {
            const input = event.target;
            const preview = document.getElementById('previewBpdImage');
            const previewContainer = document.getElementById('bpdImagePreview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        // Preview untuk gambar Profil Desa
        function previewProfilDesaImage(event) {
            const input = event.target;
            const preview = document.getElementById('previewProfilDesaImage');
            const previewContainer = document.getElementById('profilDesaImagePreview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        let misiCounter = {{ count($currentMisi) }};

        function addMisi() {
            misiCounter++;
            const container = document.getElementById('misiContainer');
            const misiItem = document.createElement('div');
            misiItem.className = 'misi-item flex gap-2';
            misiItem.innerHTML = `
                <textarea name="misi[]" 
                        rows="2"
                        class="flex-1 px-4 py-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                        placeholder="Masukkan misi ke-${misiCounter}..."
                        maxlength="500"
                        required></textarea>
                <button type="button" 
                        onclick="removeMisi(this)"
                        class="px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition h-fit">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            `;
            container.appendChild(misiItem);
        }

        function removeMisi(button) {
            const container = document.getElementById('misiContainer');
            const items = container.querySelectorAll('.misi-item');
            
            if (items.length > 1) {
                button.closest('.misi-item').remove();
            } else {
                alert('Minimal harus ada 1 misi!');
            }
        }
    </script>
</x-app-layout>