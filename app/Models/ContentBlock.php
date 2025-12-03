<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'berita_id',
        'urutan',
        'tipe',
        'konten',
    ];

    /**
     * Relasi ke Berita
     */
    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }
}