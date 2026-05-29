<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    // Menggunakan fitur modern PHP untuk keamanan data
    protected $fillable = [
        'nama',
        'nis',
        'kelas',
        'jenis_kelamin',
        'status'
    ];

    /**
     * Relasi: Satu siswa bisa memiliki banyak catatan presensi harian.
     * Menggunakan tipe data kembalian HasMany untuk dokumentasi kode yang lebih ketat.
     */
    public function presensis(): HasMany
    {
        return $this->hasMany(Presensi::class);
    }
}