<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'type'];

    public static function get($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    // MODIFIKASI: Sorting dengan PHP Collection (Support PostgreSQL)
    public static function getHeroBackgrounds()
    {
        return self::where('key', 'LIKE', 'hero_background_%')
            ->get()
            ->sortBy(function ($setting) {
                return (int) filter_var($setting->key, FILTER_SANITIZE_NUMBER_INT);
            })
            ->pluck('value')
            ->values()
            ->toArray();
    }

    public static function set($key, $value, $type = 'text')
    {
        return self::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type]
        );
    }
}