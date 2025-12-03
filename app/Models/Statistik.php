<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistik extends Model
{
    use HasFactory;

    protected $table = 'statistik';

    protected $fillable = [
        'jumlah_penduduk',
        'kepala_keluarga',
        'jumlah_dusun',
        'jumlah_rt',
        'jumlah_rw',
        'luas_wilayah',
        'ketinggian',
        'jumlah_laki_laki',
        'jumlah_perempuan',
        'lahan_pertanian',
        'lahan_non_pertanian',
    ];

    protected $casts = [
        'jumlah_penduduk' => 'integer',
        'kepala_keluarga' => 'integer',
        'jumlah_dusun' => 'integer',
        'jumlah_rt' => 'integer',
        'jumlah_rw' => 'integer',
        'luas_wilayah' => 'decimal:2',
        'ketinggian' => 'integer',
        'jumlah_laki_laki' => 'integer',
        'jumlah_perempuan' => 'integer',
        'lahan_pertanian' => 'decimal:2',
        'lahan_non_pertanian' => 'decimal:2',
    ];

    public function getRtRwAttribute()
    {
        return "{$this->jumlah_rt}/{$this->jumlah_rw}";
    }

    public function getPersentaseLakiLakiAttribute()
    {
        if ($this->jumlah_penduduk == 0) return 0;
        return round(($this->jumlah_laki_laki / $this->jumlah_penduduk) * 100, 1);
    }

    public function getPersentasePerempuanAttribute()
    {
        if ($this->jumlah_penduduk == 0) return 0;
        return round(($this->jumlah_perempuan / $this->jumlah_penduduk) * 100, 1);
    }
}