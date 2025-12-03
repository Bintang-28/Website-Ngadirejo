<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        // PERBAIKAN: Mengambil data dulu baru diurutkan menggunakan PHP (Support PostgreSQL)
        $heroBackgrounds = Setting::where('key', 'LIKE', 'hero_background_%')
            ->get()
            ->sortBy(function ($setting) {
                // Ambil angka dari string "hero_background_1" => 1
                return (int) filter_var($setting->key, FILTER_SANITIZE_NUMBER_INT);
            });
            
        $siteLogo = Setting::where('key', 'site_logo')->first();
        $heroTitle = Setting::where('key', 'hero_title')->first();
        $heroTagline = Setting::where('key', 'hero_tagline')->first();
        $bpdStructureImage = Setting::where('key', 'bpd_structure_image')->first();
        
        // BARU: Profil Desa settings
        $profilDesaImage = Setting::where('key', 'profil_desa_image')->first();
        $profilDesaDescription = Setting::where('key', 'profil_desa_description')->first();
        $profilDesaLuasWilayah = Setting::where('key', 'profil_desa_luas_wilayah')->first();
        $profilDesaKetinggian = Setting::where('key', 'profil_desa_ketinggian')->first();
        $strukturOrganisasiImage = Setting::where('key', 'struktur_organisasi_image')->first();
        $visi = Setting::where('key', 'visi')->first();
        $misi = Setting::where('key', 'misi')->first();
        
        // PERBAIKAN: Ganti path view ke admin.settings.index
        return view('admin.settings.index', compact(
            'heroBackgrounds', 
            'siteLogo', 
            'heroTitle', 
            'heroTagline',
            'bpdStructureImage',
            'profilDesaImage',
            'profilDesaDescription',
            'profilDesaLuasWilayah',
            'profilDesaKetinggian',
            'strukturOrganisasiImage',
            'visi',
            'misi'
        ));
    }

    public function updateHeroBackground(Request $request)
    {
        $request->validate([
            'hero_backgrounds' => 'required|array|min:1',
            'hero_backgrounds.*' => 'required|image|mimes:jpeg,png,jpg|max:5120'
        ], [
            'hero_backgrounds.required' => 'Pilih minimal 1 gambar background.',
            'hero_backgrounds.*.image' => 'File harus berupa gambar.',
            'hero_backgrounds.*.mimes' => 'Format file harus JPG, JPEG, atau PNG.',
            'hero_backgrounds.*.max' => 'Ukuran file maksimal 5 MB.'
        ]);

        // Hitung jumlah background yang sudah ada
        $existingCount = Setting::where('key', 'LIKE', 'hero_background_%')->count();
        $newCount = count($request->file('hero_backgrounds'));
        
        if ($existingCount + $newCount > 10) {
            return redirect()->back()->withErrors(['hero_backgrounds' => 'Total maksimal 10 gambar slide.']);
        }

        // Upload semua gambar baru
        $uploadedPaths = [];
        foreach ($request->file('hero_backgrounds') as $file) {
            $path = $file->store('hero-backgrounds', 'public');
            $uploadedPaths[] = $path;
        }

        // PERBAIKAN: Cari index tertinggi menggunakan PHP
        $allKeys = Setting::where('key', 'LIKE', 'hero_background_%')->pluck('key');
        $maxIndex = 0;
        
        foreach ($allKeys as $key) {
            $num = (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT);
            if ($num > $maxIndex) {
                $maxIndex = $num;
            }
        }
            
        $startIndex = $maxIndex + 1;

        foreach ($uploadedPaths as $index => $path) {
            Setting::set('hero_background_' . ($startIndex + $index), $path, 'image');
        }

        return redirect()->back()->with('success', count($uploadedPaths) . ' background hero berhasil ditambahkan!');
    }

    public function deleteHeroBackground($id)
    {
        $key = 'hero_background_' . $id;
        $setting = Setting::where('key', $key)->first();
        
        if ($setting && $setting->value) {
            Storage::disk('public')->delete($setting->value);
            $setting->delete();
        }

        return redirect()->back()->with('success', 'Background hero berhasil dihapus!');
    }

    public function deleteAllHeroBackgrounds()
    {
        $settings = Setting::where('key', 'LIKE', 'hero_background_%')->get();
        
        foreach ($settings as $setting) {
            if ($setting->value) {
                Storage::disk('public')->delete($setting->value);
            }
            $setting->delete();
        }

        return redirect()->back()->with('success', 'Semua background hero berhasil dihapus!');
    }

    public function updateSiteLogo(Request $request)
    {
        $request->validate([
            'site_logo' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ], [
            'site_logo.mimes' => 'Format file harus JPG, JPEG, PNG, atau SVG.'
        ]);

        $oldSetting = Setting::where('key', 'site_logo')->first();
        
        if ($oldSetting && $oldSetting->value) {
            Storage::disk('public')->delete($oldSetting->value);
        }

        $path = $request->file('site_logo')->store('site-logos', 'public');
        Setting::set('site_logo', $path, 'image');

        return redirect()->back()->with('success', 'Logo website berhasil diperbarui!');
    }

    public function deleteSiteLogo()
    {
        $setting = Setting::where('key', 'site_logo')->first();
        
        if ($setting && $setting->value) {
            Storage::disk('public')->delete($setting->value);
            $setting->delete();
        }

        return redirect()->back()->with('success', 'Logo website berhasil dihapus!');
    }

    public function updateHeroText(Request $request)
    {
        $request->validate([
            'hero_title' => 'required|string|max:100',
            'hero_tagline' => 'required|string|max:200'
        ]);

        Setting::set('hero_title', $request->hero_title, 'text');
        Setting::set('hero_tagline', $request->hero_tagline, 'text');

        return redirect()->back()->with('success', 'Teks hero berhasil diperbarui!');
    }

    // ============================================================
    // FITUR: Struktur BPD
    // ============================================================
    
    public function updateBpdStructure(Request $request)
    {
        $request->validate([
            'bpd_structure_image' => 'required|image|mimes:jpeg,png,jpg|max:5120'
        ], [
            'bpd_structure_image.image' => 'File harus berupa gambar.',
            'bpd_structure_image.mimes' => 'Format file harus JPG, JPEG, atau PNG.',
            'bpd_structure_image.max' => 'Ukuran file maksimal 5 MB.'
        ]);

        // Hapus gambar lama jika ada
        $oldSetting = Setting::where('key', 'bpd_structure_image')->first();
        if ($oldSetting && $oldSetting->value) {
            Storage::disk('public')->delete($oldSetting->value);
            $oldSetting->delete();
        }

        // Upload gambar baru
        $path = $request->file('bpd_structure_image')->store('bpd-structure', 'public');
        Setting::set('bpd_structure_image', $path, 'image');

        return redirect()->back()->with('success', 'Gambar struktur BPD berhasil diperbarui!');
    }

    public function deleteBpdStructure()
    {
        $setting = Setting::where('key', 'bpd_structure_image')->first();
        
        if ($setting && $setting->value) {
            Storage::disk('public')->delete($setting->value);
            $setting->delete();
        }

        return redirect()->back()->with('success', 'Gambar struktur BPD berhasil dihapus!');
    }

    // ============================================================
    // FITUR BARU: Profil Desa
    // ============================================================
    
    public function updateProfilDesaImage(Request $request)
    {
        $request->validate([
            'profil_desa_image' => 'required|image|mimes:jpeg,png,jpg|max:5120'
        ], [
            'profil_desa_image.image' => 'File harus berupa gambar.',
            'profil_desa_image.mimes' => 'Format file harus JPG, JPEG, atau PNG.',
            'profil_desa_image.max' => 'Ukuran file maksimal 5 MB.'
        ]);

        // Hapus gambar lama jika ada
        $oldSetting = Setting::where('key', 'profil_desa_image')->first();
        if ($oldSetting && $oldSetting->value) {
            Storage::disk('public')->delete($oldSetting->value);
            $oldSetting->delete();
        }

        // Upload gambar baru
        $path = $request->file('profil_desa_image')->store('profil-desa', 'public');
        Setting::set('profil_desa_image', $path, 'image');

        return redirect()->back()->with('success', 'Gambar profil desa berhasil diperbarui!');
    }

    public function deleteProfilDesaImage()
    {
        $setting = Setting::where('key', 'profil_desa_image')->first();
        
        if ($setting && $setting->value) {
            Storage::disk('public')->delete($setting->value);
            $setting->delete();
        }

        return redirect()->back()->with('success', 'Gambar profil desa berhasil dihapus!');
    }

    public function updateProfilDesaText(Request $request)
    {
        $request->validate([
            'profil_desa_description' => 'required|string|min:10|max:1000',
            'profil_desa_luas_wilayah' => 'required|string|max:50',
            'profil_desa_ketinggian' => 'required|string|max:50'
        ], [
            'profil_desa_description.required' => 'Deskripsi profil desa harus diisi.',
            'profil_desa_description.min' => 'Deskripsi minimal 10 karakter.',
            'profil_desa_description.max' => 'Deskripsi maksimal 1000 karakter.',
            'profil_desa_luas_wilayah.required' => 'Luas wilayah harus diisi.',
            'profil_desa_luas_wilayah.max' => 'Luas wilayah maksimal 50 karakter.',
            'profil_desa_ketinggian.required' => 'Ketinggian harus diisi.',
            'profil_desa_ketinggian.max' => 'Ketinggian maksimal 50 karakter.'
        ]);

        Setting::set('profil_desa_description', $request->profil_desa_description, 'text');
        Setting::set('profil_desa_luas_wilayah', $request->profil_desa_luas_wilayah, 'text');
        Setting::set('profil_desa_ketinggian', $request->profil_desa_ketinggian, 'text');

        return redirect()->back()->with('success', 'Teks profil desa berhasil diperbarui!');
    }

    public function updateStrukturOrganisasi(Request $request)
    {
        $request->validate([
            'struktur_organisasi_image' => 'required|image|mimes:jpeg,png,jpg|max:5120'
        ], [
            'struktur_organisasi_image.image' => 'File harus berupa gambar.',
            'struktur_organisasi_image.mimes' => 'Format file harus JPG, JPEG, atau PNG.',
            'struktur_organisasi_image.max' => 'Ukuran file maksimal 5 MB.'
        ]);

        // Hapus gambar lama jika ada
        $oldSetting = Setting::where('key', 'struktur_organisasi_image')->first();
        if ($oldSetting && $oldSetting->value) {
            Storage::disk('public')->delete($oldSetting->value);
            $oldSetting->delete();
        }

        // Upload gambar baru
        $path = $request->file('struktur_organisasi_image')->store('struktur-organisasi', 'public');
        Setting::set('struktur_organisasi_image', $path, 'image');

        return redirect()->back()->with('success', 'Gambar struktur organisasi berhasil diperbarui!');
    }

    public function deleteStrukturOrganisasi()
    {
        $setting = Setting::where('key', 'struktur_organisasi_image')->first();
        
        if ($setting && $setting->value) {
            Storage::disk('public')->delete($setting->value);
            $setting->delete();
        }

        return redirect()->back()->with('success', 'Gambar struktur organisasi berhasil dihapus!');
    }

    public function updateVisiMisi(Request $request)
    {
        $request->validate([
            'visi' => 'required|string|min:10|max:1000',
            'misi' => 'required|array|min:1',
            'misi.*' => 'required|string|max:500'
        ], [
            'visi.required' => 'Visi harus diisi.',
            'visi.min' => 'Visi minimal 10 karakter.',
            'visi.max' => 'Visi maksimal 1000 karakter.',
            'misi.required' => 'Misi harus diisi.',
            'misi.min' => 'Minimal harus ada 1 misi.',
            'misi.*.required' => 'Setiap misi harus diisi.',
            'misi.*.max' => 'Setiap misi maksimal 500 karakter.'
        ]);

        // Simpan Visi
        Setting::set('visi', $request->visi, 'text');
        
        // Simpan Misi sebagai JSON
        Setting::set('misi', json_encode($request->misi), 'text');

        return redirect()->back()->with('success', 'Visi & Misi berhasil diperbarui!');
    }
}