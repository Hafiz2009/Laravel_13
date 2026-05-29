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
    Schema::create('presensis', function (Blueprint $table) {
        $table->id();
        // Menghubungkan ke tabel siswas, jika siswa dihapus maka data absennya ikut terhapus
        $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
        $table->date('tanggal');
        // Status menggunakan enum: Hadir, Sakit, Izin, Alfa
        $table->enum('status', ['H', 'S', 'I', 'A'])->default('H');
        $table->text('keterangan')->nullable(); // Untuk mencatat alasan jika sakit/izin
        $table->timestamps();
        
        // Memastikan seorang siswa hanya bisa absen 1 kali dalam sehari (mencegah duplikat absen)
        $table->unique(['siswa_id', 'tanggal']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};
