<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa - Presensi AI</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="container mx-auto p-6 max-w-6xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Manejemen Data Siswa</h1>
            <a href="{{ route('siswa.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
                + Tambah Siswa Baru
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 shadow">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm">No</th>
                        <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">NIS</th>
                        <th class="w-3/12 text-left py-3 px-4 uppercase font-semibold text-sm">Nama</th>
                        <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Kelas</th>
                        <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">L/P</th>
                        <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse($siswas as $index => $siswa)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="text-left py-3 px-4">{{ $siswas->firstItem() + $index }}</td>
                            <td class="text-left py-3 px-4 font-mono text-sm">{{ $siswa->nis }}</td>
                            <td class="text-left py-3 px-4 font-semibold text-gray-900">{{ $siswa->nama }}</td>
                            <td class="text-left py-3 px-4">{{ $siswa->kelas }}</td>
                            <td class="text-left py-3 px-4">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $siswa->jenis_kelamin == 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                    {{ $siswa->jenis_kelamin }}
                                </span>
                            </td>
                            <td class="text-left py-3 px-4 flex gap-2">
                                <a href="{{ route('siswa.edit', $siswa->id) }}" class="text-amber-600 hover:text-amber-900 font-medium text-sm">Edit</a>
                                <span class="text-gray-300">|</span>
                                <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-medium text-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500">Belum ada data siswa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-4 bg-gray-50">
                {{ $siswas->links() }}
            </div>
        </div>
    </div>
</body>
</html>