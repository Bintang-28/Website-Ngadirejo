<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('statistik', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_penduduk')->default(6075);
            $table->integer('kepala_keluarga')->default(345);
            $table->integer('jumlah_dusun')->default(6);
            $table->integer('jumlah_rt')->default(25);
            $table->integer('jumlah_rw')->default(11);
            $table->decimal('luas_wilayah', 10, 2)->default(319.64);
            $table->integer('ketinggian')->default(63);
            $table->integer('jumlah_laki_laki')->nullable();
            $table->integer('jumlah_perempuan')->nullable();
            $table->decimal('lahan_pertanian', 10, 2)->nullable();
            $table->decimal('lahan_non_pertanian', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistik');
    }
};
