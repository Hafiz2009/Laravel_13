<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa - Presensi AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-900">
    <div class="container mx-auto p-6 max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('siswa.index') }}" class="text-blue-600 hover:underline">&larr; Kembali ke Daftar Siswa</a>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Data Siswa</h2>

            <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">NIS (Nomor Induk Siswa)</label>
                    <input type="text" name="nis" value="{{ old('nis', $siswa->nis) }}" class="border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nis') border-red-500 @enderror">
                    @error('nis') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $siswa->nama) }}" class="border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama') border-red-500 @enderror">
                    @error('nama') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Kelas</label>
                    <input type="text" name="kelas" value="{{ old('kelas', $siswa->kelas) }}" class="border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('kelas') border-red-500 @enderror">
                    @error('kelas') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Jenis Kelamin</label>
                    <div class="mt-2 flex gap-4">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="radio" name="jenis_kelamin" value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'checked' : '' }} class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-gray-700">Laki-laki</span>
                        </label>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="radio" name="jenis_kelamin" value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'checked' : '' }} class="w-4 h-4 text-pink-600 focus:ring-pink-500">
                            <span class="ml-2 text-gray-700">Perempuan</span>
                        </label>
                    </div>
                    @error('jenis_kelamin') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full bg-amber-600 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded shadow transition focus:outline-none focus:ring-2 focus:ring-amber-500">
                    Perbarui Data Siswa
                </button>
            </form>
        </div>
    </div>
</body>
</html>