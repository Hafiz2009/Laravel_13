<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Presensi Siswa - Presensi AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* CSS Khusus agar saat dicetak/export PDF tombolnya menghilang dan tampilan rapi */
        @media print {
            .no-print { display: none !important; }
            body { background-color: white; }
            .print-card { shadow: none; border: none; }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans text-gray-900">
    <div class="container mx-auto p-6 max-w-6xl">
        
        <div class="flex justify-between items-center mb-6 no-print">
            <div class="flex gap-4 text-sm">
                <a href="{{ route('siswa.index') }}" class="text-gray-600 hover:text-blue-600 font-medium">← Kelola Siswa</a>
                <span class="text-gray-300">|</span>
                <a href="{{ url('presensi') }}" class="text-gray-600 hover:text-blue-600 font-medium">Input Presensi</a>
                <span class="text-gray-300">|</span>
                <p class="text-gray-800 font-semibold">Rekapitulasi</p>
            </div>
            
            <button onclick="window.print()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-5 rounded-lg shadow transition flex items-center gap-2">
                🖨️ Cetak / Export PDF
            </button>
        </div>

        <div class="text-center md:text-left mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Laporan Rekapitulasi Presensi</h1>
            <p class="text-gray-500 text-sm mt-1">Kumulatif total kehadiran seluruh siswa yang terdaftar di sistem.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8 no-print">
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                <p class="text-xs font-bold text-green-600 uppercase tracking-wider">Total Hadir</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalHadir }} <span class="text-xs font-normal text-gray-400">kali</span></p>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                <p class="text-xs font-bold text-blue-600 uppercase tracking-wider">Total Sakit</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalSakit }} <span class="text-xs font-normal text-gray-400">kali</span></p>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                <p class="text-xs font-bold text-amber-600 uppercase tracking-wider">Total Izin</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalIzin }} <span class="text-xs font-normal text-gray-400">kali</span></p>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                <p class="text-xs font-bold text-red-600 uppercase tracking-wider">Total Alfa</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalAlfa }} <span class="text-xs font-normal text-gray-400">kali</span></p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden print-card">
            <table class="min-w-full bg-white">
                <thead class="bg-slate-800 text-white">
                    <tr>
                        <th class="py-3 px-4 uppercase font-semibold text-xs text-left w-1/12">No</th>
                        <th class="py-3 px-4 uppercase font-semibold text-xs text-left w-2/12">NIS</th>
                        <th class="py-3 px-4 uppercase font-semibold text-xs text-left w-3/12">Nama Siswa</th>
                        <th class="py-3 px-4 uppercase font-semibold text-xs text-center bg-green-900 w-1/12">Hadir</th>
                        <th class="py-3 px-4 uppercase font-semibold text-xs text-center bg-blue-900 w-1/12">Sakit</th>
                        <th class="py-3 px-4 uppercase font-semibold text-xs text-center bg-amber-900 w-1/12">Izin</th>
                        <th class="py-3 px-4 uppercase font-semibold text-xs text-center bg-red-900 w-1/12">Alfa</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-200">
                    @forelse($siswas as $index => $siswa)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3.5 px-4 text-sm">{{ $index + 1 }}</td>
                            <td class="py-3.5 px-4 text-sm font-mono">{{ $siswa->nis }}</td>
                            <td class="py-3.5 px-4 text-sm font-semibold text-gray-950">{{ $siswa->nama }}</td>
                            
                            <td class="py-3.5 px-4 text-sm text-center font-bold text-green-600 bg-green-50/30">
                                {{ $siswa->presensis->where('status', 'H')->count() }}
                            </td>
                            <td class="py-3.5 px-4 text-sm text-center font-bold text-blue-600 bg-blue-50/30">
                                {{ $siswa->presensis->where('status', 'S')->count() }}
                            </td>
                            <td class="py-3.5 px-4 text-sm text-center font-bold text-amber-600 bg-amber-50/30">
                                {{ $siswa->presensis->where('status', 'I')->count() }}
                            </td>
                            <td class="py-3.5 px-4 text-sm text-center font-bold text-red-600 bg-red-50/30">
                                {{ $siswa->presensis->where('status', 'A')->count() }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-8 text-gray-500 text-sm">Tidak ada data rekap presensi yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>