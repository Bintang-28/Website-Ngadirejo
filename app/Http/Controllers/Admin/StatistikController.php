<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class StatistikController extends Controller
{
    public function index()
    {
        $statistik = Statistik::first();
        
        return view('admin.statistik.index', compact('statistik'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'jumlah_penduduk' => 'required|integer|min:0',
            'kepala_keluarga' => 'required|integer|min:0',
            'jumlah_dusun' => 'required|integer|min:0',
            'jumlah_rt' => 'required|integer|min:0',
            'jumlah_rw' => 'required|integer|min:0',
            'luas_wilayah' => 'required|numeric|min:0',
            'ketinggian' => 'required|integer|min:0',
            'jumlah_laki_laki' => 'nullable|integer|min:0',
            'jumlah_perempuan' => 'nullable|integer|min:0',
            'lahan_pertanian' => 'nullable|numeric|min:0',
            'lahan_non_pertanian' => 'nullable|numeric|min:0',
        ]);

        $statistik = Statistik::firstOrNew();
        $statistik->fill($validated);
        $statistik->save();

        // Clear cache
        Cache::forget('statistik_desa');

        return redirect()->route('admin.statistik.index')
            ->with('success', 'Statistik desa berhasil diperbarui!');
    }

    public function getStatistik()
    {
        // Cache statistik untuk 1 jam
        return Cache::remember('statistik_desa', 3600, function () {
            return Statistik::first() ?? new Statistik([
                'jumlah_penduduk' => 6075,
                'kepala_keluarga' => 345,
                'jumlah_dusun' => 6,
                'jumlah_rt' => 25,
                'jumlah_rw' => 11,
                'luas_wilayah' => 319.64,
                'ketinggian' => 63,
            ]);
        });
    }
}