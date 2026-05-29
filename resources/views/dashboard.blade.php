<x-app-layout>
    <style>
        /* Animasi untuk Live Background Bergerak (Mesh Gradient) */
        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .live-bg {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradientMove 15s ease infinite;
        }

        /* Efek Kaca Transparan (Glassmorphism) untuk Efek 3D Layer */
        .glass-card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        /* Efek Angkat 3D Pop-Up saat Kursor Hover */
        .glass-card:hover {
            transform: translateY(-8px) scale(1.02);
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
    </style>

    <div class="live-bg min-h-screen py-12 px-4 sm:px-6 lg:px-8 flex flex-col justify-between">
        
        <div class="max-w-4xl mx-auto w-full my-auto">
            
            <div class="text-center mb-12">
                <span class="bg-white/20 text-white text-xs font-semibold tracking-widest uppercase px-3 py-1 rounded-full backdrop-blur-sm border border-white/10">
                    ⚡ Admin Panel Connected
                </span>
                <h1 class="text-4xl font-black text-white tracking-tight mt-4 drop-shadow-md">
                    Selamat Datang di Presensi AI
                </h1>
                <p class="text-white/80 mt-2 text-base max-w-xl mx-auto drop-shadow-sm font-medium">
                    Status: <span class="bg-emerald-500 text-white text-xs px-2 py-0.5 rounded font-bold">Logged In</span>. Silakan kelola data absensi melalui menu interaktif di bawah ini.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-3xl mx-auto items-stretch">
                
                <div class="glass-card p-6 rounded-2xl shadow-lg flex flex-col justify-between group">
                    <div>
                        <div class="w-14 h-14 bg-gradient-to-tr from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white mb-5 text-2xl shadow-md group-hover:scale-110 transition-transform duration-300">
                            👤
                        </div>
                        <h2 class="text-2xl font-bold text-slate-800 mb-2">Manajemen Siswa</h2>
                        <p class="text-slate-600 text-sm mb-6 leading-relaxed">Tambah, lihat, edit, dan hapus data profil siswa kelas secara terorganisir.</p>
                    </div>
                    <a href="{{ route('siswa.index') }}" class="w-full text-center bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3 px-4 rounded-xl shadow-md hover:shadow-indigo-500/20 transition duration-300">
                        Buka Data Siswa
                    </a>
                </div>

                <div class="glass-card p-6 rounded-2xl shadow-lg flex flex-col justify-between group">
                    <div>
                        <div class="w-14 h-14 bg-gradient-to-tr from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center text-white mb-5 text-2xl shadow-md group-hover:scale-110 transition-transform duration-300">
                            📅
                        </div>
                        <h2 class="text-2xl font-bold text-slate-800 mb-2">Presensi Harian</h2>
                        <p class="text-slate-600 text-sm mb-6 leading-relaxed">Catat atau perbarui kehadiran siswa (Hadir, Sakit, Izin, Alfa) setiap harinya dengan akurat.</p>
                    </div>
                    <a href="{{ route('presensi.index') }}" class="w-full text-center bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold py-3 px-4 rounded-xl shadow-md hover:shadow-emerald-500/20 transition duration-300">
                        Buka Absensi
                    </a>
                </div>

                <div class="glass-card p-6 rounded-2xl shadow-lg flex flex-col justify-between md:col-span-2 max-w-md mx-auto w-full mt-2 group">
                    <div>
                        <div class="w-14 h-14 bg-gradient-to-tr from-violet-500 to-purple-600 rounded-xl flex items-center justify-center text-white mb-5 text-2xl shadow-md group-hover:scale-110 transition-transform duration-300">
                            📊
                        </div>
                        <h2 class="text-2xl font-bold text-slate-800 mb-2 text-center md:text-left">Laporan Rekapitulasi</h2>
                        <p class="text-slate-600 text-sm mb-6 leading-relaxed text-center md:text-left">Lihat akumulasi absensi total siswa beserta fitur cetak dokumen fisik atau simpan sebagai PDF/Excel resmi.</p>
                    </div>
                    <a href="{{ route('presensi.rekap') }}" class="w-full text-center bg-gradient-to-r from-violet-600 to-purple-600 hover:from-violet-700 hover:to-purple-700 text-white font-bold py-3 px-4 rounded-xl shadow-md hover:shadow-purple-500/20 transition duration-300">
                        Buka Rekap & Cetak
                    </a>
                </div>

            </div>
        </div>

        <div class="text-center text-white/60 text-xs pt-8 font-medium tracking-wide">
            &copy; 2026 Presensi AI &bull; Secured by Laravel Breeze Authentication
        </div>
    </div>
</x-app-layout>