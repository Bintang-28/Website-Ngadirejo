<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class HeroSettingsSeeder extends Seeder
{
    public function run()
    {
        Setting::create([
            'key' => 'hero_title',
            'value' => 'NGADIREJO',
            'type' => 'text'
        ]);

        Setting::create([
            'key' => 'hero_tagline',
            'value' => 'Desa Terindah dan Paling Berkesan',
            'type' => 'text'
        ]);
    }
}