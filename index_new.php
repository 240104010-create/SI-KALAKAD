<?php
declare(strict_types=1);

// ====================================================================
// SI-KALAKAD - SISTEM INFORMASI KALENDER KEGIATAN AKADEMIK MAHASISWA
// Proyek Mandiri UTS Rekayasa Perangkat Lunak 2026
// Mahasiswa : Roikhan Nur Fauzi (NIM: 240104010)
// Program Studi : D3 Teknik Komputer (Kelas 24A1) - UDB Surakarta
// ====================================================================

$appVersion = "v1.2.0-stable";
$today = '2026-10-13'; // Tanggal referensi sistem

// Data 10 Kegiatan Akademik Terstruktur Lengkap
$events = [
    [
        'id' => 1,
        'title' => 'Masa Pembayaran UKT / SPP Semester Ganjil',
        'category' => 'Keuangan',
        'start_date' => '2026-08-01',
        'end_date' => '2026-08-20',
        'location' => 'Bank Jateng / Virtual Account Kampus',
        'target' => 'Seluruh Mahasiswa Aktif',
        'priority' => 'Tinggi',
        'pic' => 'Biro Keuangan (BAUK)',
        'syarat' => 'Melakukan pembayaran via Teller / ATM / Mobile Banking dengan memasukkan NIM.',
        'description' => 'Batas akhir pembayaran biaya kuliah semester ganjil bagi seluruh mahasiswa aktif agar status registrasi akademik tetap aktif.'
    ],
    [
        'id' => 2,
        'title' => 'Pengisian & Revisi KRS Online dengan DPA',
        'category' => 'Akademik',
        'start_date' => '2026-08-15',
        'end_date' => '2026-08-25',
        'location' => 'Portal SIAKAD UDB Surakarta',
        'target' => 'Mahasiswa Semester 1, 3, 5',
        'priority' => 'Tinggi',
        'pic' => 'Dosen Pembimbing Akademik (DPA)',
        'syarat' => 'Telah melunasi UKT tahap 1 dan berkonsultasi rencana mata kuliah dengan DPA.',
        'description' => 'Pemilihan mata kuliah teori dan praktikum wajib semester ganjil melalui portal akademik online.'
    ],
    [
        'id' => 3,
        'title' => 'Awal Perkuliahan Efektif & Praktikum Lab',
        'category' => 'Perkuliahan',
        'start_date' => '2026-09-01',
        'end_date' => '2026-12-18',
        'location' => 'Ruang Teori Kampus 1 & Lab Komputer 5',
        'target' => 'D3 Teknik Komputer 24A1',
        'priority' => 'Sedang',
        'pic' => 'Subbag Perkuliahan Prodi',
        'syarat' => 'Membawa kartu studi mahasiswa dan modul praktikum laboratorium.',
        'description' => 'Pelaksanaan perkuliahan teori tatap muka 16 pertemuan termasuk praktikum Jaringan dan Rekayasa Perangkat Lunak.'
    ],
    [
        'id' => 4,
        'title' => 'Pekan Ujian Tengah Semester (UTS) Ganjil',
        'category' => 'Ujian',
        'start_date' => '2026-10-12',
        'end_date' => '2026-10-23',
        'location' => 'Lab Komputer 5 & Ruang Ujian',
        'target' => 'Seluruh Mahasiswa D3 TK',
        'priority' => 'Tinggi',
        'pic' => 'Panitia Ujian Fakultas',
        'syarat' => 'Membawa Kartu Peserta Ujian (KPU) dan presensi kehadiran minimal 75%.',
        'description' => 'Evaluasi pembelajaran tengah semester meliputi ujian tertulis teori dan ujian studi kasus proyek mandiri di laboratorium.'
    ],
    [
        'id' => 5,
        'title' => 'Workshop IoT & Embedded Systems Komputer',
        'category' => 'Kemahasiswaan',
        'start_date' => '2026-10-28',
        'end_date' => '2026-10-29',
        'location' => 'Laboratorium Hardware & IoT Terpadu',
        'target' => 'Mahasiswa D3 Teknik Komputer',
        'priority' => 'Sedang',
        'pic' => 'Himpunan Mahasiswa Komputer (HIMAKOM)',
        'syarat' => 'Membawa laptop masing-masing dan kit mikrokontroler (Arduino/ESP32).',
        'description' => 'Pelatihan intensif perancangan sensor cerdas berbasis microcontroller dan komunikasi data nirkabel.'
    ],
    [
        'id' => 6,
        'title' => 'Seminar Nasional Cloud & Software Engineering',
        'category' => 'Kemahasiswaan',
        'start_date' => '2026-11-07',
        'end_date' => '2026-11-07',
        'location' => 'Auditorium Utama UDB & Zoom Cloud',
        'target' => 'Umum & Mahasiswa Komputer',
        'priority' => 'Rendah',
        'pic' => 'Pusat Riset & Inovasi Perangkat Lunak',
        'syarat' => 'Pendaftaran melalui link portal seminar sebelum 5 November 2026.',
        'description' => 'Seminar tren teknologi cloud computing, arsitektur serverless microservices, dan peluang karier engineer 2026.'
    ],
    [
        'id' => 7,
        'title' => 'Batas Pengajuan Judul Proyek Mandiri / TA',
        'category' => 'Akademik',
        'start_date' => '2026-11-20',
        'end_date' => '2026-11-25',
        'location' => 'Ruang Dosen Prodi D3 TK',
        'target' => 'Mahasiswa Tingkat Akhir / Semester 5',
        'priority' => 'Tinggi',
        'pic' => 'Koordinator Tugas Akhir / Proyek',
        'syarat' => 'Menyerahkan proposal ringkas latar belakang masalah dan rancangan fungsionalitas aplikasi.',
        'description' => 'Tenggat penyerahan formulir rencana proyek perangkat lunak mandiri untuk penentuan dosen pembimbing.'
    ],
    [
        'id' => 8,
        'title' => 'Pengisian Kuesioner Evaluasi Dosen (EDOM)',
        'category' => 'Akademik',
        'start_date' => '2026-12-01',
        'end_date' => '2026-12-10',
        'location' => 'Sistem Penjaminan Mutu Internal (SIAKAD)',
        'target' => 'Semua Mahasiswa Aktif',
        'priority' => 'Sedang',
        'pic' => 'Lembaga Penjaminan Mutu (LPM)',
        'syarat' => 'Mengisi kuesioner evaluasi seluruh dosen pengampu sebelum dapat mencetak kartu UAS.',
        'description' => 'Evaluasi berkala kepuasan mahasiswa terhadap proses belajar mengajar dosen demi penjaminan mutu kampus.'
    ],
    [
        'id' => 9,
        'title' => 'Pekan Ujian Akhir Semester (UAS) Ganjil',
        'category' => 'Ujian',
        'start_date' => '2026-12-21',
        'end_date' => '2027-01-08',
        'location' => 'Ruang Ujian & Lab Komputer',
        'target' => 'Seluruh Mahasiswa Kampus',
        'priority' => 'Tinggi',
        'pic' => 'Panitia UAS Fakultas Ilmu Komputer',
        'syarat' => 'Lunas biaya kuliah tahap akhir dan bebas tanggungan peminjaman buku perpustakaan.',
        'description' => 'Ujian akhir semester penentu kelulusan mata kuliah teori dan demonstrasi sistem perangkat lunak.'
    ],
    [
        'id' => 10,
        'title' => 'Yudisium & Pengumuman KHS Semester Ganjil',
        'category' => 'Akademik',
        'start_date' => '2027-01-25',
        'end_date' => '2027-01-26',
        'location' => 'Portal SIAKAD & Papan Pengumuman',
        'target' => 'Seluruh Mahasiswa',
        'priority' => 'Tinggi',
        'pic' => 'Bagian Administrasi Akademik (BAAK)',
        'syarat' => 'Seluruh nilai mata kuliah telah diunggah oleh dosen pengampu di portal kampus.',
        'description' => 'Publikasi Kartu Hasil Studi (KHS), penghitungan Indeks Prestasi Semester (IPS), dan penetapan status kelulusan.'
    ]
];

// Logika Filter & Pencarian PHP
$selectedCategory = isset($_GET['category']) ? trim((string)$_GET['category']) : 'All';
$searchKeyword = isset($_GET['search']) ? trim((string)$_GET['search']) : '';
$selectedMonth = isset($_GET['month']) ? trim((string)$_GET['month']) : 'All';

$filteredEvents = array_filter($events, function($item) use ($selectedCategory, $searchKeyword, $selectedMonth) {
    $matchCategory = ($selectedCategory === 'All') || (strcasecmp($item['category'], $selectedCategory) === 0);
    $matchSearch = empty($searchKeyword) || 
                   (stripos($item['title'], $searchKeyword) !== false) || 
                   (stripos($item['description'], $searchKeyword) !== false) ||
                   (stripos($item['location'], $searchKeyword) !== false);
    
    $matchMonth = true;
    if ($selectedMonth !== 'All') {
        $eventMonth = date('Y-m', strtotime($item['start_date']));
        $eventEndMonth = date('Y-m', strtotime($item['end_date']));
        $matchMonth = ($eventMonth === $selectedMonth || $eventEndMonth === $selectedMonth);
    }

    return $matchCategory && $matchSearch && $matchMonth;
});

// Hitung Statistik
$countTotal = count($events);
$countOngoing = 0;
$countUpcoming = 0;
$countEnded = 0;

foreach ($events as $e) {
    $s = strtotime($e['start_date']);
    $en = strtotime($e['end_date']);
    $n = strtotime($today);
    if ($n >= $s && $n <= $en) $countOngoing++;
    elseif ($n < $s) $countUpcoming++;
    else $countEnded++;
}

// Logika Penghitungan Status Waktu
function getEventStatus(string $startDate, string $endDate, string $currentDate): array {
    $start = strtotime($startDate);
    $end = strtotime($endDate);
    $now = strtotime($currentDate);

    if ($now < $start) {
        $diffDays = (int)ceil(($start - $now) / 86400);
        return [
            'label' => "Akan Datang ($diffDays hari lagi)",
            'color' => 'bg-blue-500/15 text-blue-400 border border-blue-500/30',
            'badge' => 'Upcoming',
            'dot' => 'bg-blue-400'
        ];
    } elseif ($now >= $start && $now <= $end) {
        return [
            'label' => 'Sedang Berlangsung 🔥',
            'color' => 'bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 animate-pulse',
            'badge' => 'Ongoing',
            'dot' => 'bg-emerald-400'
        ];
    } else {
        return [
            'label' => 'Telah Berakhir',
            'color' => 'bg-slate-800 text-slate-400 border border-slate-700',
            'badge' => 'Ended',
            'dot' => 'bg-slate-500'
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI-KALAKAD - Sistem Kalender Kegiatan Akademik Mahasiswa</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81'
                        }
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 for clean modal -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        code, pre, .font-mono { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex flex-col antialiased selection:bg-indigo-500 selection:text-white">

    <!-- Top Announcement Bar -->
    <div class="bg-gradient-to-r from-indigo-900 via-slate-900 to-indigo-950 text-xs py-2 px-4 border-b border-indigo-900/50 flex flex-wrap items-center justify-between gap-2">
        <div class="flex items-center gap-2 text-indigo-300 mx-auto sm:mx-0">
            <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
            <span><strong>Status Server:</strong> PHP 8.0 Live on Vercel · Versi <?= htmlspecialchars($appVersion) ?></span>
        </div>
        <div class="hidden sm:flex items-center gap-4 text-slate-400 text-[11px]">
            <span>Program Studi: <strong>D3 Teknik Komputer</strong></span>
            <span>Kampus: <strong>Universitas Duta Bangsa Surakarta</strong></span>
        </div>
    </div>

    <!-- Header & Navigasi -->
    <header class="sticky top-0 z-40 bg-slate-900/90 backdrop-blur-md border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-brand-600 to-indigo-500 flex items-center justify-center font-black text-white shadow-lg shadow-brand-500/25 text-xl">
                    📅
                </div>
                <div>
                    <h1 class="text-base sm:text-lg font-extrabold tracking-tight text-white flex items-center gap-2">
                        SI-KALAKAD
                        <span class="text-[10px] uppercase font-bold bg-indigo-500/20 text-indigo-300 px-2 py-0.5 rounded-full border border-indigo-500/30">UTS RPL 2026</span>
                    </h1>
                    <p class="text-xs text-slate-400">Sistem Informasi Kalender Kegiatan Akademik Mahasiswa</p>
                </div>
            </div>

            <!-- Identitas Mahasiswa & Quick Bookmark Counter -->
            <div class="flex items-center gap-3">
                <!-- Bookmark Button -->
                <button onclick="showBookmarkedModal()" class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-800/80 hover:bg-slate-700 border border-slate-700 text-xs font-bold text-amber-300 transition">
                    <span>⭐</span>
                    <span class="hidden sm:inline">Agenda Tersimpan</span>
                    <span id="bookmark-badge" class="bg-amber-400/20 text-amber-300 px-1.5 py-0.2 rounded-md font-mono text-[11px]">0</span>
                </button>

                <!-- Profile Badge -->
                <div class="hidden md:flex items-center gap-3 text-xs bg-slate-800/80 px-3.5 py-2 rounded-xl border border-slate-700/80">
                    <div class="text-right">
                        <span class="font-bold text-white block">Roikhan Nur Fauzi</span>
                        <span class="text-slate-400 font-mono text-[11px]">240104010 · TK 24A1</span>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-brand-600 to-indigo-500 flex items-center justify-center font-bold text-white border border-indigo-400 shadow-sm">
                        R
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        
        <!-- Hero Banner Informasi -->
        <section class="bg-gradient-to-r from-slate-900 via-indigo-950/40 to-slate-900 rounded-3xl p-6 sm:p-8 border border-indigo-900/40 relative overflow-hidden shadow-2xl">
            <div class="max-w-3xl space-y-3 relative z-10">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Semester Ganjil TA 2026/2027 · Tanggal Sistem: <?= date('d F Y', strtotime($today)) ?>
                </div>
                <h2 class="text-2xl sm:text-3xl font-black text-white tracking-tight leading-tight">
                    Pusat Informasi & Jadwal Kegiatan Akademik Mahasiswa
                </h2>
                <p class="text-slate-400 text-sm leading-relaxed">
                    Sistem ini mengelola timeline perkuliahan, pekan ujian (UTS/UAS), registrasi KRS, jadwal praktikum laboratorium, batas pembayaran UKT, serta agenda seminar kemahasiswaan secara terpusat untuk mencegah keterlambatan mahasiswa.
                </p>
            </div>
            <div class="absolute -right-8 -bottom-8 w-72 h-72 bg-indigo-600/10 rounded-full blur-3xl pointer-events-none"></div>
        </section>

        <!-- Ringkasan Statistik Kartu -->
        <section class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            <div class="bg-slate-900 p-4 rounded-2xl border border-slate-800 flex items-center gap-3.5">
                <div class="w-12 h-12 rounded-xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-xl text-indigo-400">
                    📚
                </div>
                <div>
                    <span class="text-xs text-slate-400 block font-medium">Total Agenda</span>
                    <span class="text-xl sm:text-2xl font-black text-white"><?= $countTotal ?> <span class="text-xs font-normal text-slate-500">Kegiatan</span></span>
                </div>
            </div>

            <div class="bg-slate-900 p-4 rounded-2xl border border-slate-800 flex items-center gap-3.5">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-xl text-emerald-400">
                    🔥
                </div>
                <div>
                    <span class="text-xs text-slate-400 block font-medium">Sedang Berjalan</span>
                    <span class="text-xl sm:text-2xl font-black text-emerald-400"><?= $countOngoing ?> <span class="text-xs font-normal text-slate-500">Kegiatan</span></span>
                </div>
            </div>

            <div class="bg-slate-900 p-4 rounded-2xl border border-slate-800 flex items-center gap-3.5">
                <div class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-xl text-blue-400">
                    ⏳
                </div>
                <div>
                    <span class="text-xs text-slate-400 block font-medium">Akan Datang</span>
                    <span class="text-xl sm:text-2xl font-black text-blue-400"><?= $countUpcoming ?> <span class="text-xs font-normal text-slate-500">Kegiatan</span></span>
                </div>
            </div>

            <div class="bg-slate-900 p-4 rounded-2xl border border-slate-800 flex items-center gap-3.5">
                <div class="w-12 h-12 rounded-xl bg-slate-800 border border-slate-700 flex items-center justify-center text-xl text-slate-400">
                    ✅
                </div>
                <div>
                    <span class="text-xs text-slate-400 block font-medium">Telah Selesai</span>
                    <span class="text-xl sm:text-2xl font-black text-slate-300"><?= $countEnded ?> <span class="text-xs font-normal text-slate-500">Kegiatan</span></span>
                </div>
            </div>
        </section>

        <!-- Filter & Bar Pencarian Multi-Parameter -->
        <section class="bg-slate-900 p-5 rounded-2xl border border-slate-800 space-y-4">
            <form method="GET" action="" class="grid grid-cols-1 md:grid-cols-12 gap-3">
                
                <!-- Pencarian Kata Kunci -->
                <div class="md:col-span-5 relative">
                    <input 
                        type="text" 
                        name="search" 
                        value="<?= htmlspecialchars($searchKeyword) ?>" 
                        placeholder="Cari kegiatan (misal: UTS, Lab, KRS, UKT, IoT)..." 
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 transition"
                    />
                </div>

                <!-- Dropdown Kategori -->
                <div class="md:col-span-3">
                    <select 
                        name="category" 
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500 transition"
                        onchange="this.form.submit()"
                    >
                        <option value="All" <?= $selectedCategory === 'All' ? 'selected' : '' ?>>Semua Kategori</option>
                        <option value="Akademik" <?= $selectedCategory === 'Akademik' ? 'selected' : '' ?>>Akademik & KRS</option>
                        <option value="Perkuliahan" <?= $selectedCategory === 'Perkuliahan' ? 'selected' : '' ?>>Perkuliahan & Praktikum</option>
                        <option value="Ujian" <?= $selectedCategory === 'Ujian' ? 'selected' : '' ?>>Pekan Ujian (UTS/UAS)</option>
                        <option value="Keuangan" <?= $selectedCategory === 'Keuangan' ? 'selected' : '' ?>>Keuangan & UKT</option>
                        <option value="Kemahasiswaan" <?= $selectedCategory === 'Kemahasiswaan' ? 'selected' : '' ?>>Kemahasiswaan & Seminar</option>
                    </select>
                </div>

                <!-- Dropdown Bulan Pelaksanaan -->
                <div class="md:col-span-2">
                    <select 
                        name="month" 
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500 transition"
                        onchange="this.form.submit()"
                    >
                        <option value="All" <?= $selectedMonth === 'All' ? 'selected' : '' ?>>Semua Bulan</option>
                        <option value="2026-08" <?= $selectedMonth === '2026-08' ? 'selected' : '' ?>>Agustus 2026</option>
                        <option value="2026-09" <?= $selectedMonth === '2026-09' ? 'selected' : '' ?>>September 2026</option>
                        <option value="2026-10" <?= $selectedMonth === '2026-10' ? 'selected' : '' ?>>Oktober 2026</option>
                        <option value="2026-11" <?= $selectedMonth === '2026-11' ? 'selected' : '' ?>>November 2026</option>
                        <option value="2026-12" <?= $selectedMonth === '2026-12' ? 'selected' : '' ?>>Desember 2026</option>
                        <option value="2027-01" <?= $selectedMonth === '2027-01' ? 'selected' : '' ?>>Januari 2027</option>
                    </select>
                </div>

                <!-- Tombol Submit / Reset -->
                <div class="md:col-span-2 flex gap-2">
                    <button type="submit" class="flex-1 bg-brand-600 hover:bg-brand-700 text-white font-bold py-2.5 px-4 rounded-xl text-xs transition shadow-lg shadow-brand-600/30">
                        Filter
                    </button>
                    <?php if (!empty($searchKeyword) || $selectedCategory !== 'All' || $selectedMonth !== 'All'): ?>
                        <a href="index.php" class="bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold py-2.5 px-3 rounded-xl text-xs transition border border-slate-700 flex items-center justify-center" title="Reset Filter">
                            ✕
                        </a>
                    <?php endif; ?>
                </div>
            </form>

            <!-- Kategori Chips Cepat -->
            <div class="flex flex-wrap items-center gap-1.5 pt-3 border-t border-slate-800/80 text-xs">
                <span class="text-slate-500 font-medium mr-1">Filter Cepat:</span>
                <?php foreach (['All' => 'Semua', 'Ujian' => 'Pekan Ujian', 'Perkuliahan' => 'Praktikum/Kuliah', 'Akademik' => 'KRS/Akademik', 'Keuangan' => 'UKT', 'Kemahasiswaan' => 'Seminar/IoT'] as $key => $title): ?>
                    <a href="?category=<?= urlencode($key) ?>&search=<?= urlencode($searchKeyword) ?>&month=<?= urlencode($selectedMonth) ?>" class="px-2.5 py-1 rounded-lg font-medium transition <?= $selectedCategory === $key ? 'bg-indigo-600 text-white' : 'bg-slate-800/60 text-slate-400 hover:text-white hover:bg-slate-800' ?>">
                        <?= $title ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Daftar Kartu Agenda Akademik -->
        <section class="space-y-4">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h3 class="text-sm font-extrabold uppercase tracking-wider text-slate-400 flex items-center gap-2">
                    <span>📋</span>
                    <span>Daftar Kegiatan Akademik</span>
                    <span class="bg-slate-800 text-indigo-400 px-2 py-0.5 rounded-full text-xs font-mono font-bold"><?= count($filteredEvents) ?></span>
                </h3>
                <span class="text-xs text-slate-500 italic">Klik kartu untuk melihat rincian syarat & penanggung jawab kegiatan.</span>
            </div>

            <?php if (empty($filteredEvents)): ?>
                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-12 text-center space-y-3">
                    <div class="text-4xl">🔍</div>
                    <h4 class="text-base font-bold text-white">Tidak ada kegiatan akademik yang cocok</h4>
                    <p class="text-xs text-slate-400">Coba ubah kata kunci pencarian atau sesuaikan opsi kategori dan bulan.</p>
                    <a href="index.php" class="inline-block mt-2 px-4 py-2 bg-indigo-600 text-white text-xs font-bold rounded-xl hover:bg-indigo-700 transition">
                        Reset Semua Filter
                    </a>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php foreach ($filteredEvents as $item): ?>
                        <?php $status = getEventStatus($item['start_date'], $item['end_date'], $today); ?>
                        <div class="bg-slate-900 rounded-2xl border border-slate-800 hover:border-slate-700 transition-all duration-300 p-5 flex flex-col justify-between space-y-4 shadow-lg group relative">
                            
                            <div class="space-y-3">
                                <!-- Baris Status & Kategori -->
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-[11px] font-bold px-2.5 py-0.5 rounded-lg bg-slate-800 text-indigo-300 border border-slate-700">
                                        <?= htmlspecialchars($item['category']) ?>
                                    </span>
                                    <span class="text-[11px] font-bold px-2.5 py-0.5 rounded-lg <?= $status['color'] ?> flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full <?= $status['dot'] ?>"></span>
                                        <?= $status['label'] ?>
                                    </span>
                                </div>

                                <!-- Judul Kegiatan -->
                                <h4 class="text-base font-extrabold text-white group-hover:text-indigo-400 transition line-clamp-2 leading-snug">
                                    <?= htmlspecialchars($item['title']) ?>
                                </h4>

                                <!-- Deskripsi Ringkas -->
                                <p class="text-xs text-slate-400 leading-relaxed line-clamp-2">
                                    <?= htmlspecialchars($item['description']) ?>
                                </p>
                            </div>

                            <!-- Detail Tanggal, Lokasi, dan Aksi Modal -->
                            <div class="pt-3 border-t border-slate-800/80 space-y-2 text-xs text-slate-300">
                                <div class="flex items-center gap-2">
                                    <span class="text-indigo-400 font-bold">🗓️</span>
                                    <span class="font-mono text-[11px] text-slate-200">
                                        <?= date('d M Y', strtotime($item['start_date'])) ?>
                                        <?php if ($item['start_date'] !== $item['end_date']): ?>
                                            s.d. <?= date('d M Y', strtotime($item['end_date'])) ?>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-indigo-400 font-bold">📍</span>
                                    <span class="text-slate-400 truncate"><?= htmlspecialchars($item['location']) ?></span>
                                </div>
                                
                                <div class="flex items-center justify-between pt-2 border-t border-slate-800/60">
                                    <button 
                                        type="button" 
                                        onclick="openDetailModal(<?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') ?>)" 
                                        class="text-indigo-400 hover:text-indigo-300 font-bold text-xs flex items-center gap-1 transition"
                                    >
                                        Rincian & Syarat ➔
                                    </button>
                                    <button 
                                        type="button"
                                        id="btn-bm-<?= $item['id'] ?>"
                                        onclick="toggleBookmark(<?= $item['id'] ?>, '<?= addslashes($item['title']) ?>')" 
                                        class="text-slate-400 hover:text-amber-300 transition text-xs p-1"
                                        title="Simpan / Tandai Agenda"
                                    >
                                        ⭐
                                    </button>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>

        <!-- Matriks Arsitektur & Relasi Basis Data (Pemenuhan Tugas RPL) -->
        <section class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 space-y-6">
            <div>
                <h3 class="text-base font-extrabold text-white flex items-center gap-2">
                    <span class="text-indigo-400">📊</span> Struktur Entitas & Relasi Data (5 Tabel Relasional)
                </h3>
                <p class="text-xs text-slate-400 mt-1">Perancangan basis data relasional untuk sistem kalender akademik sesuai standar SDLC Tahap 6.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-xs">
                <div class="bg-slate-950 p-4 rounded-xl border border-slate-800 space-y-2">
                    <div class="font-mono font-bold text-indigo-400">1. Tabel `users`</div>
                    <p class="text-slate-400 leading-relaxed">Menyimpan data otentikasi akun mahasiswa, dosen, dan staf pengelola akademik kampus.</p>
                    <span class="inline-block text-[10px] font-mono bg-slate-800 px-2 py-0.5 rounded text-slate-300">PK: user_id</span>
                </div>

                <div class="bg-slate-950 p-4 rounded-xl border border-slate-800 space-y-2">
                    <div class="font-mono font-bold text-indigo-400">2. Tabel `categories`</div>
                    <p class="text-slate-400 leading-relaxed">Menyimpan kelompok kategori kegiatan (Akademik, Ujian, Keuangan, Kemahasiswaan).</p>
                    <span class="inline-block text-[10px] font-mono bg-slate-800 px-2 py-0.5 rounded text-slate-300">PK: category_id</span>
                </div>

                <div class="bg-slate-950 p-4 rounded-xl border border-slate-800 space-y-2">
                    <div class="font-mono font-bold text-indigo-400">3. Tabel `events`</div>
                    <p class="text-slate-400 leading-relaxed">Menyimpan jadwal kegiatan, waktu mulai/selesai, lokasi, penanggung jawab, dan prioritas.</p>
                    <span class="inline-block text-[10px] font-mono bg-slate-800 px-2 py-0.5 rounded text-slate-300">PK: event_id · FK: category_id, user_id</span>
                </div>

                <div class="bg-slate-950 p-4 rounded-xl border border-slate-800 space-y-2">
                    <div class="font-mono font-bold text-indigo-400">4. Tabel `user_bookmarks`</div>
                    <p class="text-slate-400 leading-relaxed">Menghubungkan mahasiswa dengan kegiatan favorit yang disimpan sebagai agenda penting.</p>
                    <span class="inline-block text-[10px] font-mono bg-slate-800 px-2 py-0.5 rounded text-slate-300">PK: bookmark_id · FK: user_id, event_id</span>
                </div>

                <div class="bg-slate-950 p-4 rounded-xl border border-slate-800 space-y-2">
                    <div class="font-mono font-bold text-indigo-400">5. Tabel `notifications`</div>
                    <p class="text-slate-400 leading-relaxed">Mencatat antrean pesan pengingat jadwal otomatis H-3 sebelum kegiatan berakhir.</p>
                    <span class="inline-block text-[10px] font-mono bg-slate-800 px-2 py-0.5 rounded text-slate-300">PK: notification_id · FK: event_id, user_id</span>
                </div>

                <div class="bg-slate-950 p-4 rounded-xl border border-slate-800 space-y-2">
                    <div class="font-mono font-bold text-emerald-400">Kardinalitas Relasi</div>
                    <p class="text-slate-400 leading-relaxed">categories ➔ events (1:N)<br>users ➔ events (1:N)<br>users ➔ bookmarks (1:N)<br>events ➔ bookmarks (1:N)</p>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 border-t border-slate-800 py-8 text-center text-xs text-slate-500 space-y-2">
        <div class="max-w-7xl mx-auto px-4">
            <p class="font-medium text-slate-400">
                Proyek Ujian Tengah Semester (UTS) Rekayasa Perangkat Lunak &copy; 2026
            </p>
            <p>
                Dibuat oleh: <strong class="text-slate-200">Roikhan Nur Fauzi (NIM: 240104010)</strong> · D3 Teknik Komputer 24A1
            </p>
            <p class="text-[11px] text-slate-500 font-mono">
                Universitas Duta Bangsa Surakarta (UDB) · Repository GitHub: <a href="https://github.com/240104010-create/SI-KALAKAD" target="_blank" class="text-indigo-400 underline">240104010-create/SI-KALAKAD</a>
            </p>
        </div>
    </footer>

    <!-- JavaScript Interaktif (Modal Detail & Bookmark) -->
    <script>
        // Manajemen Bookmark di LocalStorage
        function getBookmarks() {
            return JSON.parse(localStorage.getItem('sikalakad_bookmarks') || '[]');
        }

        function updateBookmarkBadge() {
            const bms = getBookmarks();
            const badge = document.getElementById('bookmark-badge');
            if (badge) badge.innerText = bms.length;
        }

        function toggleBookmark(id, title) {
            let bms = getBookmarks();
            const idx = bms.findIndex(item => item.id === id);

            if (idx > -1) {
                bms.splice(idx, 1);
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'info',
                    title: 'Dihapus dari Agenda Tersimpan',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                bms.push({ id, title });
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Disimpan ke Agenda Favorit ⭐',
                    showConfirmButton: false,
                    timer: 1500
                });
            }

            localStorage.setItem('sikalakad_bookmarks', JSON.stringify(bms));
            updateBookmarkBadge();
        }

        function showBookmarkedModal() {
            const bms = getBookmarks();
            if (bms.length === 0) {
                Swal.fire({
                    title: 'Belum Ada Agenda Tersimpan',
                    text: 'Klik ikon ⭐ pada kartu kegiatan untuk menandai agenda penting Anda.',
                    icon: 'info',
                    confirmButtonColor: '#4f46e5'
                });
                return;
            }

            const listHtml = bms.map((b, i) => `
                <div class="flex items-center justify-between p-2.5 bg-slate-800 rounded-xl border border-slate-700 text-left text-xs mb-2">
                    <span class="font-bold text-white">${i+1}. ${b.title}</span>
                </div>
            `).join('');

            Swal.fire({
                title: '⭐ Agenda Akademik Tersimpan',
                html: `<div class="max-h-60 overflow-y-auto space-y-1">${listHtml}</div>`,
                confirmButtonText: 'Tutup',
                confirmButtonColor: '#4f46e5'
            });
        }

        // Modal Rincian Kegiatan
        function openDetailModal(item) {
            Swal.fire({
                title: `<strong class="text-base sm:text-lg text-slate-900">${item.title}</strong>`,
                html: `
                    <div class="text-left text-xs sm:text-sm space-y-3 text-slate-700 mt-2">
                        <div class="p-3 bg-indigo-50 rounded-xl border border-indigo-100">
                            <span class="block text-[11px] font-bold text-indigo-600 uppercase">Kategori & Prioritas</span>
                            <span class="font-black text-slate-900">${item.category} (Prioritas: ${item.priority})</span>
                        </div>
                        <div class="space-y-1.5">
                            <p><strong>🗓️ Tanggal:</strong> ${item.start_date} s.d. ${item.end_date}</p>
                            <p><strong>📍 Lokasi:</strong> ${item.location}</p>
                            <p><strong>👥 Sasaran:</strong> ${item.target}</p>
                            <p><strong>👤 Penanggung Jawab:</strong> ${item.pic}</p>
                        </div>
                        <div class="p-3 bg-slate-100 rounded-xl border border-slate-200">
                            <strong class="block text-slate-900 text-xs mb-1">Syarat & Ketentuan:</strong>
                            <p class="text-xs text-slate-600">${item.syarat}</p>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: '⭐ Tandai Agenda',
                cancelButtonText: 'Tutup',
                confirmButtonColor: '#4f46e5',
                cancelButtonColor: '#64748b'
            }).then((res) => {
                if (res.isConfirmed) {
                    toggleBookmark(item.id, item.title);
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateBookmarkBadge();
        });
    </script>
</body>
</html>
