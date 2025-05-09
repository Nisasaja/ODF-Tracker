<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penerimas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('desa', ['Salimbatu', 'Sekatak', 'Wonomulyo']);
            $table->enum('kondisi_jamban', ['Tidak Ada', 'Rusak Berat', 'Rusak Ringan']);
            $table->string('kendala');
            $table->integer('jml_penghuni');
            $table->string('pekerjaan');
            $table->string('sumber_air');
            $table->string('no_telepon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerimas');
    }
};
