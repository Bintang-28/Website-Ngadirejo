<?php

namespace App\Policies;

use App\Models\Berita;
use App\Models\User;

class BeritaPolicy
{
    /**
     * Izinkan Admin melakukan apa saja.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        return null; // Lanjutkan ke pengecekan method lain jika bukan admin
    }

    /**
     * Siapa yang bisa melihat daftar berita di admin panel.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('penulis');
    }

    /**
     * Siapa yang bisa melihat detail berita.
     */
    public function view(User $user, Berita $berita): bool
    {
        // Admin bisa (via 'before'), Penulis hanya bisa lihat miliknya
        return $user->id === $berita->user_id;
    }

    /**
     * Siapa yang bisa membuat berita.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('penulis');
    }

    /**
     * Siapa yang bisa update berita.
     */
    public function update(User $user, Berita $berita): bool
    {
        // Admin bisa (via 'before'), Penulis hanya bisa update miliknya
        return $user->id === $berita->user_id;
    }

    /**
     * Siapa yang bisa hapus berita.
     */
    public function delete(User $user, Berita $berita): bool
    {
        // Admin bisa (via 'before'), Penulis hanya bisa hapus miliknya
        return $user->id === $berita->user_id;
    }
}