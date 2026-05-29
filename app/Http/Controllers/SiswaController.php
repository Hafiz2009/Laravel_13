<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SiswaController extends Controller
{
    /**
     * Menampilkan daftar siswa dengan pagination.
     * Menggunakan explicit return type declaration (PHP 8.3+)
     */
    public function index(): View
    {
        // Best Practice: Menggunakan pencarian berbasis query yang efisien
        $siswas = Siswa::latest()->paginate(10);
        
        return view('siswa.index', compact('siswas'));
    }

    /**
     * Menampilkan form untuk menambahkan siswa baru.
     */
    public function create(): View
    {
        return view('siswa.create');
    }

    /**
     * Menyimpan data siswa baru ke database dan memicu antrean sistem (Queue).
     * Menerapkan Typed Properties pada parameter Form Request kustom.
     */
    public function store(StoreSiswaRequest $request): RedirectResponse
    {
        // Best Practice: Hanya menggunakan data yang telah lolos validasi (Safe Data)
        Siswa::create($request->validated());

        // ⛓️ KODE QUEUE: Memicu antrean Job di latar belakang untuk mencatat aktivitas log
        \App\Jobs\LogSiswaBaru::dispatch();

        return redirect()
            ->route('siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail informasi satu siswa (Opsional).
     * Memanfaatkan Route Model Binding otomatis dari Laravel.
     */
    public function show(Siswa $siswa): View
    {
        return view('siswa.show', compact('siswa'));
    }

    /**
     * Menampilkan form edit untuk siswa tertentu.
     */
    public function edit(Siswa $siswa): View
    {
        return view('siswa.edit', compact('siswa'));
    }

    /**
     * Memperbarui data siswa di database.
     */
    public function update(UpdateSiswaRequest $request, Siswa $siswa): RedirectResponse
    {
        $siswa->update($request->validated());

        return redirect()
            ->route('siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Menghapus data siswa dari database.
     */
    public function destroy(Siswa $siswa): RedirectResponse
    {
        $siswa->delete();

        return redirect()
            ->route('siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}