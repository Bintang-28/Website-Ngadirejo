<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class PublikasiController extends Controller
{
    /**
     * Menampilkan daftar berita untuk publik (tidak memerlukan login/otorisasi).
     * Rute: /publikasi
     */
    public function index(Request $request)
    {
        $query = Berita::with('user')
            // Wajib: Hanya tampilkan berita yang sudah di-publish
            ->where('status', 'published') 
            ->latest();

        // Logika filter search untuk publik
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('judul', 'LIKE', "%{$search}%");
        }
        
        // Ambil data dan tampilkan di view publik
        $berita = $query->paginate(9)->withQueryString(); 

        // View ini adalah halaman Index Publik
        return view('publikasi.index', compact('berita'));
    }
    
    // Note: Metode show() tidak diperlukan di sini karena sudah dihandle di web.php
}