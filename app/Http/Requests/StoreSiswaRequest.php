<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ubah ke true agar diizinkan dijalankan
    }

    public function rules(): array
    {
        return [
            'nama'          => 'required|string|max:255',
            'nis'           => 'required|string|unique:siswas,nis|max:50',
            'kelas'         => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:L,P',
            'status'        => 'boolean',
        ];
    }
}