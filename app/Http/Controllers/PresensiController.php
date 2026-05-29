<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PresensiController extends Controller
{
    /**
     * Menampilkan halaman absensi kelas untuk hari ini.
     */
    public function index(Request $request): View
    {
        // Default tanggal adalah hari ini jika user tidak memilih tanggal lain
        $tanggal = $request->get('tanggal', date('Y-m-d'));
        
        // Ambil semua siswa beserta data presensinya di tanggal tersebut
        $siswas = Siswa::with(['presensis' => function($query) use ($tanggal) {
            $query->where('tanggal', $tanggal);
        }])->get();

        return view('presensi.index', compact('siswas', 'tanggal'));
    }

    /**
     * Menyimpan atau memperbarui data absensi siswa.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'tanggal'   => 'required|date',
            'status'    => 'required|array',
            'status.*'  => 'required|in:H,S,I,A',
            'keterangan'=> 'nullable|array',
        ]);

        $tanggal = $request->tanggal;

        // Looping untuk menyimpan absen setiap siswa
        foreach ($request->status as $siswaId => $statusAbsen) {
            Presensi::updateOrCreate(
                [
                    'siswa_id' => $siswaId,
                    'tanggal'  => $tanggal,
                ],
                [
                    'status'     => $statusAbsen,
                    'keterangan' => $request->keterangan[$siswaId] ?? null,
                ]
            );
        }

        return redirect()->route('presensi.index', ['tanggal' => $tanggal])
            ->with('success', 'Data presensi berhasil disimpan.');
    }

    /**
     * Menampilkan rekapitulasi kehadiran siswa beserta statistik global.
     */
    public function rekap(Request $request): View
    {
        // Ambil semua data siswa beserta riwayat absennya
        $siswas = Siswa::with('presensis')->get();

        // Hitung ringkasan total keseluruhan untuk widget indikator di atas halaman
        $totalHadir = Presensi::where('status', 'H')->count();
        $totalSakit = Presensi::where('status', 'S')->count();
        $totalIzin  = Presensi::where('status', 'I')->count();
        $totalAlfa  = Presensi::where('status', 'A')->count();

        return view('presensi.rekap', compact('siswas', 'totalHadir', 'totalSakit', 'totalIzin', 'totalAlfa'));
    }
}