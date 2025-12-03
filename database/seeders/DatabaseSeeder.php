<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        // 1 user admin untuk login
        $adminUser = User::factory()->create([
            'name' => 'Admin Desa',
            'email' => 'admin@desa.id',
            'password' => bcrypt('AdMin1256'), // Ganti 'password'
        ]);

        // role 'admin' ke user
        $adminUser->assignRole('admin');

        // 1 user penulis untuk data awal
        $penulisUser = User::factory()->create([
            'name' => 'Penulis',
            'email' => 'penulis@desa.id',
            'password' => bcrypt('PenUlis2367'), // Ganti 'password'
        ]);
        $penulisUser->assignRole('penulis');
    }
}