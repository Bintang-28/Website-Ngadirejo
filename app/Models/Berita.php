<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'user_id',
        'judul',
        'slug',
        'status',
        'gambar_header',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke ContentBlock
     * PENTING: Tanpa ini blocks tidak akan bisa diakses!
     */
    public function blocks()
    {
        return $this->hasMany(ContentBlock::class, 'berita_id')->orderBy('urutan');
    }
}