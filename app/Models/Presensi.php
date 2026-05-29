<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Presensi extends Model
{
    protected $fillable = [
        'siswa_id',
        'tanggal',
        'status',
        'keterangan'
    ];

    /**
     * Relasi balik: Setiap data absen pasti dimiliki oleh seorang siswa.
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }
}