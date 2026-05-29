<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi Harian - Presensi AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-900">
    <div class="container mx-auto p-6 max-w-6xl">
        
        <div class="flex gap-4 mb-6 text-sm">
            <a href="{{ route('siswa.index') }}" class="text-gray-600 hover:text-blue-600 font-medium">← Kelola Data Siswa</a>
            <span class="text-gray-300">|</span>
            <p class="text-gray-800 font-semibold">Menu Presensi Harian</p>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Presensi Harian Siswa</h1>
                <p class="text-gray-500 text-sm mt-1">Silakan pilih tanggal dan isi status kehadiran siswa.</p>
            </div>
            
            <form action="{{ route('presensi.index') }}" method="GET" class="flex items-center gap-2 bg-white p-2 rounded-lg shadow-sm border border-gray-200">
                <label class="text-sm font-medium text-gray-600 px-2">Tanggal:</label>
                <input type="date" name="tanggal" value="{{ $tanggal }}" onchange="this.form.submit()" class="border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </form>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 shadow">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('presensi.store') }}" method="POST">
            @csrf
            <input type="hidden" name="tanggal" value="{{ $tanggal }}">

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full bg-white">
                    <thead class="bg-slate-800 text-white">
                        <tr>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-1/12">No</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-2/12">NIS</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-3/12">Nama</th>
                            <th class="text-center py-3 px-4 uppercase font-semibold text-sm w-4/12">Status Kehadiran</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-2/12">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse($siswas as $index => $siswa)
                            @php
                                // Mengambil data absen siswa pada tanggal terpilih (jika sudah pernah diabsen)
                                $absenHariIni = $siswa->presensis->first();
                                $statusTerpilih = $absenHariIni ? $absenHariIni->status : 'H';
                                $keteranganLama = $absenHariIni ? $absenHariIni->keterangan : '';
                            @endphp
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4">{{ $index + 1 }}</td>
                                <td class="py-3 px-4 font-mono text-sm">{{ $siswa->nis }}</td>
                                <td class="py-3 px-4 font-semibold text-gray-950">{{ $siswa->nama }}</td>
                                <td class="py-3 px-4 text-center">
                                    <div class="flex justify-center gap-4">
                                        <label class="inline-flex items-center cursor-pointer bg-green-50 px-3 py-1.5 rounded border border-green-200 hover:bg-green-100 transition">
                                            <input type="radio" name="status[{{ $siswa->id }}]" value="H" {{ $statusTerpilih == 'H' ? 'checked' : '' }} class="text-green-600 focus:ring-green-500">
                                            <span class="ml-1.5 text-sm font-medium text-green-800">Hadir</span>
                                        </label>
                                        <label class="inline-flex items-center cursor-pointer bg-blue-50 px-3 py-1.5 rounded border border-blue-200 hover:bg-blue-100 transition">
                                            <input type="radio" name="status[{{ $siswa->id }}]" value="S" {{ $statusTerpilih == 'S' ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500">
                                            <span class="ml-1.5 text-sm font-medium text-blue-800">Sakit</span>
                                        </label>
                                        <label class="inline-flex items-center cursor-pointer bg-amber-50 px-3 py-1.5 rounded border border-amber-200 hover:bg-amber-100 transition">
                                            <input type="radio" name="status[{{ $siswa->id }}]" value="I" {{ $statusTerpilih == 'I' ? 'checked' : '' }} class="text-amber-600 focus:ring-amber-500">
                                            <span class="ml-1.5 text-sm font-medium text-amber-800">Izin</span>
                                        </label>
                                        <label class="inline-flex items-center cursor-pointer bg-red-50 px-3 py-1.5 rounded border border-red-200 hover:bg-red-100 transition">
                                            <input type="radio" name="status[{{ $siswa->id }}]" value="A" {{ $statusTerpilih == 'A' ? 'checked' : '' }} class="text-red-600 focus:ring-red-500">
                                            <span class="ml-1.5 text-sm font-medium text-red-800">Alfa</span>
                                        </label>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <input type="text" name="keterangan[{{ $siswa->id }}]" value="{{ $keteranganLama }}" class="border border-gray-300 rounded px-2 py-1 text-sm w-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Demam, Acara keluarga">
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-6 text-gray-500">Belum ada data siswa untuk melakukan presensi. Silakan tambah siswa terlebih dahulu.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($siswas->isNotEmpty())
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-6 rounded shadow transition">
                        Simpan Semua Presensi
                    </button>
                </div>
            @endif
        </form>
    </div>
</body>
</html>