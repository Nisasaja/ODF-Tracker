<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporansTable extends Migration
{
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penerima');
            $table->date('tgl_laporan');
            $table->string('status')->default('baru mulai');
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->string('judul_laporan');
            $table->string('foto')->nullable();
            $table->text('isi_laporan');
            $table->timestamps();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Foreign key constraint
            $table->foreign('id_penerima')->references('id')->on('penerimas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }
}
