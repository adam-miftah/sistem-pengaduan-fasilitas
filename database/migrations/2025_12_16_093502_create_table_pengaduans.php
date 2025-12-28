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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->cascadeOnDelete();
            $table->foreignId('kategori_id')->constrained('kategori_fasilitas')->cascadeOnDelete();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('lokasi');
            $table->string('foto')->nullable();
            $table->enum('status', ['diajukan', 'diproses', 'selesai'])->default('diajukan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_pengaduans');
    }
};
