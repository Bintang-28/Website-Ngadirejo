<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tulis Berita Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 border border-red-300 dark:border-red-700 rounded-md">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.berita.store') }}" 
                          method="POST" 
                          class="space-y-6" 
                          enctype="multipart/form-data"
                          x-data="{
                              blocks: [],
                              addBlock(tipe) {
                                  this.blocks.push({
                                      id: Date.now(),
                                      tipe: tipe,
                                      konten: '',
                                      file: null
                                  });
                              },
                              removeBlock(id) {
                                  this.blocks = this.blocks.filter(block => block.id !== id);
                              },
                              moveBlock(index, direction) {
                                  if (direction === 'up' && index > 0) {
                                      [this.blocks[index], this.blocks[index - 1]] = [this.blocks[index - 1], this.blocks[index]];
                                  }
                                  if (direction === 'down' && index < this.blocks.length - 1) {
                                      [this.blocks[index], this.blocks[index + 1]] = [this.blocks[index + 1], this.blocks[index]];
                                  }
                              }
                          }">
                        @csrf
                        
                        <div>
                            <x-input-label for="judul" :value="__('Judul Berita')" />
                            <x-text-input id="judul" name="judul" type="text" class="mt-1 block w-full" :value="old('judul')" required />
                        </div>

                        <div>
                            <x-input-label for="gambar_header" :value="__('Gambar Thumbnail (Opsional)')" />
                            <input id="gambar_header" name="gambar_header" type="file" 
                                   class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Ini adalah gambar yang akan muncul di halaman utama.</p>
                        </div>

                        <div>
                            <x-input-label :value="__('Isi Konten')" />
                            
                            <div class="mt-2 space-y-4">
                                <template x-for="(block, index) in blocks" :key="block.id">
                                    <div class="p-4 border border-gray-300 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800 relative pt-8">
                                        <div class="absolute top-2 right-2 flex space-x-1">
                                            <button type="button" @click="moveBlock(index, 'up')" :disabled="index === 0" class="p-1 rounded-full text-gray-500 hover:bg-gray-200 dark:hover:bg-gray-700 disabled:opacity-30">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 17a1 1 0 01-1-1V4.414l-3.293 3.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0l5 5a1 1 0 01-1.414 1.414L11 4.414V16a1 1 0 01-1 1z" clip-rule="evenodd"></path></svg>
                                            </button>
                                            <button type="button" @click="moveBlock(index, 'down')" :disabled="index === blocks.length - 1" class="p-1 rounded-full text-gray-500 hover:bg-gray-200 dark:hover:bg-gray-700 disabled:opacity-30">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v11.586l3.293-3.293a1 1 0 111.414 1.414l-5 5a1 1 0 01-1.414 0l-5-5a1 1 0 111.414-1.414L9 15.586V4a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                            </button>
                                            <button type="button" @click="removeBlock(block.id)" class="p-1 rounded-full text-red-500 hover:bg-red-100 dark:hover:bg-red-900">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                            </button>
                                        </div>

                                        <input type="hidden" :name="`blocks[${index}][tipe]`" :value="block.tipe">
                                        
                                        <div x-show="block.tipe === 'teks'">
                                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" x-text="`Blok Teks #${index + 1}`"></label>
                                            <textarea :name="`blocks[${index}][konten]`" class="mt-1 block w-full h-32 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" x-model="block.konten"></textarea>
                                        </div>

                                        <div x-show="block.tipe === 'gambar' || block.tipe === 'pdf'">
                                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                                <span x-show="block.tipe === 'gambar'" x-text="`Blok Gambar #${index + 1}`"></span>
                                                <span x-show="block.tipe === 'pdf'" x-text="`Blok PDF #${index + 1}`"></span>
                                            </label>
                                            <input type="file" :name="`blocks[${index}][file]`" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                                   :accept="block.tipe === 'gambar' ? 'image/*' : '.pdf'">
                                        </div>
                                    </div>
                                </template>
                            </div>
                            
                            <div class="mt-4 flex items-center space-x-2">
                                <button type="button" @click="addBlock('teks')" class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                    + Tambah Teks
                                </button>
                                <button type="button" @click="addBlock('gambar')" class="px-3 py-2 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-700">
                                    + Tambah Gambar
                                </button>
                                <button type="button" @click="addBlock('pdf')" class="px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700">
                                    + Tambah PDF
                                </button>
                            </div>
                        </div>
                        
                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <select name="status" id="status" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                            <a href="{{ route('admin.berita.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>