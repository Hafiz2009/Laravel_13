<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class LogSiswaBaru implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void 
    {
        // ⛓️ Logika Queue: Menulis catatan ke log sistem Laravel di latar belakang (background)
        Log::info('Sistem Queue Laravel 13 Berhasil: Ada siswa baru terdaftar pada ' . now()->toDateTimeString());
    }
}