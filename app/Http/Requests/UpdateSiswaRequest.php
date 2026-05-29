<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ubah ke true agar diizinkan dijalankan
    }

    public function rules(): array
    {
        // Mendapatkan ID siswa yang sedang di-update dari route
        $siswaId = $this->route('siswa')->id;

        return [
            'nama'          => 'required|string|max:255',
            'nis'           => 'required|string|max:50|unique:siswas,nis,' . $siswaId,
            'kelas'         => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:L,P',
            'status'        => 'boolean',
        ];
    }
}