<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('hero_title', 255)->nullable()->after('id'); 
            $table->string('hero_tagline', 255)->nullable()->after('hero_title'); 
            $table->string('hero_image', 255)->nullable()->after('hero_tagline');
        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['hero_title', 'hero_tagline', 'hero_image']);
        });
    }
};