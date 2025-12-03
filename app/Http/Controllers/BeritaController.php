<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Berita;
use App\Models\ContentBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BeritaController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {        
        $query = Berita::with('user')->latest();
        
        // Filter berdasarkan role
        if (!Auth::user()->hasRole('admin')) {
            $query->where('user_id', Auth::id());
        }
        
        // Filter search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'LIKE', "%{$search}%")
                ->orWhereHas('user', function($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                });
            });
        }
        
        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $berita = $query->paginate(10)->withQueryString();
        
        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        $this->authorize('create', Berita::class);
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Berita::class);

        $request->validate([
            'judul' => 'required|string|max:255',
            'status' => 'required|in:draft,published',
            'gambar_header' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        
            'blocks' => 'nullable|array',
            
            'blocks.*.tipe' => 'required|in:teks,gambar,pdf',
            'blocks.*.konten' => 'nullable|string|required_if:blocks.*.tipe,teks',
            'blocks.*.file' => 'nullable|file|mimes:jpeg,png,jpg,webp,pdf|max:10240',
        ]);

        $pathThumbnail = null;
        if ($request->hasFile('gambar_header')) {
            $pathThumbnail = $request->file('gambar_header')->store('berita_headers', 'public');
        }

        $berita = Berita::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul) . '-' . time(),
            'status' => $request->status,
            'gambar_header' => $pathThumbnail,
        ]);

        if ($request->has('blocks')) {
            foreach ($request->blocks as $index => $blockData) {
                $konten = null;

                if ($blockData['tipe'] == 'teks') {
                    $konten = $blockData['konten'];
                } 
                elseif (isset($blockData['file'])) {
                    $file = $blockData['file'];
                    $tipe = $blockData['tipe'];
                    
                    // Simpan dengan nama asli file
                    $originalName = $file->getClientOriginalName();
                    $konten = $file->storeAs("berita_blok_{$tipe}", $originalName, 'public');
                }

                if ($konten !== null) {
                    ContentBlock::create([
                        'berita_id' => $berita->id,
                        'urutan' => $index + 1,
                        'tipe' => $blockData['tipe'],
                        'konten' => $konten,
                    ]);
                }
            }
        }

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        $this->authorize('update', $berita);
        $berita->load('blocks'); 
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $this->authorize('update', $berita);

        $request->validate([
            'judul' => 'required|string|max:255',
            'status' => 'required|in:draft,published',
            'gambar_header' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            
            'blocks' => 'nullable|array',
            'blocks.*.tipe' => 'required|in:teks,gambar,pdf',
            'blocks.*.konten' => 'nullable|string|required_if:blocks.*.tipe,teks',
            'blocks.*.file' => 'nullable|file|mimes:jpeg,png,jpg,webp,pdf|max:10240',
            'blocks.*.konten_lama' => 'nullable|string',
        ]);

        // Update data berita
        $dataPath = $request->only('judul', 'status');
        $dataPath['slug'] = Str::slug($request->judul) . '-' . $berita->id;

        if ($request->hasFile('gambar_header')) {
            if ($berita->gambar_header) {
                Storage::disk('public')->delete($berita->gambar_header);
            }
            $dataPath['gambar_header'] = $request->file('gambar_header')->store('berita_headers', 'public');
        }
        $berita->update($dataPath);

        // Simpan file lama yang masih dipakai
        $filesToKeep = [];
        if ($request->has('blocks')) {
            foreach ($request->blocks as $blockData) {
                if (isset($blockData['konten_lama']) && !isset($blockData['file'])) {
                    $filesToKeep[] = $blockData['konten_lama'];
                }
            }
        }

        // Hapus HANYA file yang tidak dipakai lagi
        foreach ($berita->blocks as $oldBlock) {
            if (($oldBlock->tipe == 'gambar' || $oldBlock->tipe == 'pdf') && !in_array($oldBlock->konten, $filesToKeep)) {
                Storage::disk('public')->delete($oldBlock->konten);
            }
        }
        
        // Hapus semua record blok lama dari database
        $berita->blocks()->delete();

        // Buat ulang blok baru
        if ($request->has('blocks')) {
            foreach ($request->blocks as $index => $blockData) {
                $konten = null;

                if ($blockData['tipe'] == 'teks') {
                    $konten = $blockData['konten'];
                } 
                elseif (isset($blockData['file'])) {
                    // Ada file baru yang diupload - simpan dengan nama asli
                    $file = $blockData['file'];
                    $tipe = $blockData['tipe'];
                    $originalName = $file->getClientOriginalName();
                    $konten = $file->storeAs("berita_blok_{$tipe}", $originalName, 'public');
                }
                elseif (isset($blockData['konten_lama'])) {
                    // Pakai file lama
                    $konten = $blockData['konten_lama'];
                }

                if ($konten !== null) {
                    ContentBlock::create([
                        'berita_id' => $berita->id,
                        'urutan' => $index + 1,
                        'tipe' => $blockData['tipe'],
                        'konten' => $konten,
                    ]);
                }
            }
        }

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        $this->authorize('delete', $berita);
        
        if ($berita->gambar_header) {
            Storage::disk('public')->delete($berita->gambar_header);
        }
        
        foreach ($berita->blocks as $block) {
            if ($block->tipe == 'gambar' || $block->tipe == 'pdf') {
                Storage::disk('public')->delete($block->konten);
            }
        }
        
        $berita->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}