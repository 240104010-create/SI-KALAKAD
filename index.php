<?php
declare(strict_types=1);

// Versi Aplikasi Kalender Akademik (Hasil Resolusi Konflik)
$appVersion = "v1.2.0-stable";

// Database konfigurasi & data agenda akademik mock untuk demo logika sistem
$events = [
    [
        'id' => 1,
        'title' => 'Masa Pembayaran UKT Semester Ganjil 2026/2027',
        'category' => 'Keuangan',
        'start_date' => '2026-08-01',
        'end_date' => '2026-08-20',
        'location' => 'Bank Mitra / Virtual Account',
        'target' => 'Semua Mahasiswa',
        'priority' => 'Tinggi',
        'description' => 'Batas akhir pembayaran biaya kuliah semester ganjil bagi seluruh mahasiswa aktif.'
    ],
    [
        'id' => 2,
        'title' => 'Pengisian & Revisi KRS Online (KPRS)',
        'category' => 'Akademik',
        'start_date' => '2026-08-15',
        'end_date' => '2026-08-25',
        'location' => 'Portal SIAKAD Kampus',
        'target' => 'Mahasiswa Semester 3, 5, 7',
        'priority' => 'Tinggi',
        'description' => 'Konsultasi kartu rencana studi dengan Dosen Pembimbing Akademik (DPA).'
    ],
    [
        'id' => 3,
        'title' => 'Awal Perkuliahan Efektif Semester Ganjil',
        'category' => 'Perkuliahan',
        'start_date' => '2026-09-01',
        'end_date' => '2026-12-18',
        'location' => 'Kampus Pusat & Lab Komputer',
        'target' => 'Seluruh Sivitas Akademika',
        'priority' => 'Sedang',
        'description' => 'Pelaksanaan perkuliahan teori tatap muka dan praktikum laboratorium.'
    ],
    [
        'id' => 4,
        'title' => 'Pekan Ujian Tengah Semester (UTS)',
        'category' => 'Ujian',
        'start_date' => '2026-10-12',
        'end_date' => '2026-10-23',
        'location' => 'Ruang Teori & Lab Komputer',
        'target' => 'Mahasiswa Aktif',
        'priority' => 'Tinggi',
        'description' => 'Evaluasi pembelajaran tengah semester genap/ganjil teori dan studi kasus praktikum.'
    ],
    [
        'id' => 5,
        'title' => 'Seminar Nasional Cloud & Software Engineering 2026',
        'category' => 'Kemahasiswaan',
        'start_date' => '2026-11-07',
        'end_date' => '2026-11-07',
        'location' => 'Auditorium Utama & Zoom Live',
        'target' => 'Mahasiswa Informatika & Komputer',
        'priority' => 'Rendah',
        'description' => 'Workshop integrasi cloud native dan praktik rekayasa perangkat lunak modern.'
    ],
    [
        'id' => 6,
        'title' => 'Batas Akhir Pengumpulan Tugas Akhir / Proyek Mandiri',
        'category' => 'Akademik',
        'start_date' => '2026-12-05',
        'end_date' => '2026-12-05',
        'location' => 'Subbag Akademik Prodi',
        'target' => 'Mahasiswa Tingkat Akhir',
        'priority' => 'Tinggi',
        'description' => 'Penyerahan naskah laporan tugas akhir dan demonstrasi aplikasi mandiri.'
    ],
    [
        'id' => 7,
        'title' => 'Pekan Ujian Akhir Semester (UAS)',
        'category' => 'Ujian',
        'start_date' => '2026-12-21',
        'end_date' => '2027-01-08',
        'location' => 'Ruang Ujian Kampus',
        'target' => 'Semua Mahasiswa',
        'priority' => 'Tinggi',
        'description' => 'Pelaksanaan evaluasi akhir semester seluruh mata kuliah.'
    ]
];

// Logika Filter & Pencarian PHP
$selectedCategory = isset($_GET['category']) ? trim((string)$_GET['category']) : 'All';
$searchKeyword = isset($_GET['search']) ? trim((string)$_GET['search']) : '';
$today = '2026-10-13'; // Tanggal referensi sistem

$filteredEvents = array_filter($events, function($item) use ($selectedCategory, $searchKeyword) {
    $matchCategory = ($selectedCategory === 'All') || (strcasecmp($item['category'], $selectedCategory) === 0);
    $matchSearch = empty($searchKeyword) || 
                   (stripos($item['title'], $searchKeyword) !== false) || 
                   (stripos($item['description'], $searchKeyword) !== false) ||
                   (stripos($item['location'], $searchKeyword) !== false);
    return $matchCategory && $matchSearch;
});

// Logika Penghitungan Countdown / Status Kegiatan
function getEventStatus(string $startDate, string $endDate, string $currentDate): array {
    $start = strtotime($startDate);
    $end = strtotime($endDate);
    $now = strtotime($currentDate);

    if ($now < $start) {
        $diffDays = (int)ceil(($start - $now) / 86400);
        return [
            'label' => "Akan Datang ($diffDays hari lagi)",
            'color' => 'bg-blue-500/20 text-blue-300 border-blue-500/40',
            'badge' => 'Upcoming'
        ];
    } elseif ($now >= $start && $now <= $end) {
        return [
            'label' => 'Sedang Berlangsung 🔥',
            'color' => 'bg-emerald-500/20 text-emerald-300 border-emerald-500/40 animate-pulse',
            'badge' => 'Ongoing'
        ];
    } else {
        return [
            'label' => 'Telah Berakhir',
            'color' => 'bg-slate-700/40 text-slate-400 border-slate-600/30',
            'badge' => 'Ended'
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
                        primary: {
                            50: '#eef2ff',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            900: '#312e81'
                        }
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        code, pre { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex flex-col antialiased selection:bg-indigo-500 selection:text-white">

    <!-- Header & Navigasi -->
    <header class="sticky top-0 z-40 bg-slate-900/90 backdrop-blur-md border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-indigo-400 flex items-center justify-center font-black text-white shadow-lg shadow-indigo-500/30 text-lg">
                    📅
                </div>
                <div>
                    <h1 class="text-base font-extrabold tracking-tight text-white flex items-center gap-2">
                        SI-KALAKAD
                        <span class="text-[10px] uppercase font-bold bg-indigo-500/20 text-indigo-300 px-2 py-0.5 rounded-full border border-indigo-500/30">UTS RPL 2026</span>
                    </h1>
                    <p class="text-xs text-slate-400">Sistem Informasi Kalender Kegiatan Akademik Mahasiswa</p>
                </div>
            </div>

            <!-- Identitas Mahasiswa -->
            <div class="hidden md:flex items-center gap-4 text-xs bg-slate-800/80 px-4 py-2 rounded-xl border border-slate-700/80">
                <div class="text-right">
                    <span class="font-bold text-white block">Roikhan Nur Fauzi</span>
                    <span class="text-slate-400 font-mono">NIM: 240104010 · D3 TK 24A1</span>
                </div>
                <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center font-bold text-white border border-indigo-400">
                    R
                </div>
            </div>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        
        <!-- Hero Banner Informasi -->
        <section class="bg-gradient-to-r from-slate-900 via-indigo-950/40 to-slate-900 rounded-2xl p-6 sm:p-8 border border-indigo-900/40 relative overflow-hidden shadow-2xl">
            <div class="max-w-3xl space-y-3 relative z-10">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Semester Ganjil TA 2026/2027 · Referensi Waktu: <?= date('d M Y', strtotime($today)) ?>
                </div>
                <h2 class="text-2xl sm:text-3xl font-black text-white tracking-tight">
                    Pantau Semua Agenda & Batas Waktu Akademik Tepat Waktu
                </h2>
                <p class="text-slate-400 text-sm leading-relaxed">
                    Sistem ini mengelola seluruh timeline kegiatan perkuliahan, registrasi KRS, jadwal ujian, hingga seminar prodi secara terintegrasi untuk mencegah keterlambatan mahasiswa.
                </p>
            </div>
            <div class="absolute -right-8 -bottom-8 w-64 h-64 bg-indigo-600/10 rounded-full blur-3xl pointer-events-none"></div>
        </section>

        <!-- Filter & Bar Pencarian -->
        <section class="bg-slate-900 p-4 sm:p-5 rounded-2xl border border-slate-800 space-y-4">
            <form method="GET" action="" class="grid grid-cols-1 md:grid-cols-12 gap-3">
                <!-- Pencarian -->
                <div class="md:col-span-6 relative">
                    <input 
                        type="text" 
                        name="search" 
                        value="<?= htmlspecialchars($searchKeyword) ?>" 
                        placeholder="Cari kegiatan (misal: UTS, KRS, UKT, Seminar)..." 
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 transition"
                    />
                </div>

                <!-- Kategori Dropdown -->
                <div class="md:col-span-4">
                    <select 
                        name="category" 
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500 transition"
                        onchange="this.form.submit()"
                    >
                        <option value="All" <?= $selectedCategory === 'All' ? 'selected' : '' ?>>Semua Kategori Kegiatan</option>
                        <option value="Akademik" <?= $selectedCategory === 'Akademik' ? 'selected' : '' ?>>Akademik & KRS</option>
                        <option value="Perkuliahan" <?= $selectedCategory === 'Perkuliahan' ? 'selected' : '' ?>>Perkuliahan & Praktikum</option>
                        <option value="Ujian" <?= $selectedCategory === 'Ujian' ? 'selected' : '' ?>>Pekan Ujian (UTS/UAS)</option>
                        <option value="Keuangan" <?= $selectedCategory === 'Keuangan' ? 'selected' : '' ?>>Keuangan & UKT</option>
                        <option value="Kemahasiswaan" <?= $selectedCategory === 'Kemahasiswaan' ? 'selected' : '' ?>>Kemahasiswaan & Seminar</option>
                    </select>
                </div>

                <!-- Tombol Submit / Reset -->
                <div class="md:col-span-2 flex gap-2">
                    <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-4 rounded-xl text-xs transition shadow-lg shadow-indigo-600/30">
                        Cari
                    </button>
                    <?php if (!empty($searchKeyword) || $selectedCategory !== 'All'): ?>
                        <a href="index.php" class="bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold py-2.5 px-3 rounded-xl text-xs transition border border-slate-700 flex items-center justify-center">
                            Reset
                        </a>
                    <?php endif; ?>
                </div>
            </form>

            <!-- Kategori Chips Cepat -->
            <div class="flex flex-wrap items-center gap-1.5 pt-2 border-t border-slate-800/80 text-xs">
                <span class="text-slate-500 font-medium mr-1">Filter Cepat:</span>
                <?php foreach (['All' => 'Semua', 'Ujian' => 'Ujian', 'Akademik' => 'KRS/Akademik', 'Keuangan' => 'UKT', 'Kemahasiswaan' => 'Seminar'] as $key => $title): ?>
                    <a href="?category=<?= urlencode($key) ?>&search=<?= urlencode($searchKeyword) ?>" class="px-2.5 py-1 rounded-lg font-medium transition <?= $selectedCategory === $key ? 'bg-indigo-600 text-white' : 'bg-slate-800/60 text-slate-400 hover:text-white hover:bg-slate-800' ?>">
                        <?= $title ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Daftar Kartu Agenda Akademik -->
        <section class="space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-extrabold uppercase tracking-wider text-slate-400">
                    Daftar Agenda Akademik (<?= count($filteredEvents) ?> Kegiatan Ditemukan)
                </h3>
            </div>

            <?php if (empty($filteredEvents)): ?>
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-12 text-center space-y-3">
                    <div class="text-4xl">🔍</div>
                    <h4 class="text-base font-bold text-white">Tidak ada kegiatan akademik yang cocok</h4>
                    <p class="text-xs text-slate-400">Coba ubah kata kunci pencarian atau pilih kategori lain.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php foreach ($filteredEvents as $item): ?>
                        <?php $status = getEventStatus($item['start_date'], $item['end_date'], $today); ?>
                        <div class="bg-slate-900 rounded-2xl border border-slate-800 hover:border-slate-700 transition duration-300 p-5 flex flex-col justify-between space-y-4 shadow-lg group">
                            
                            <div class="space-y-2.5">
                                <!-- Baris Status & Kategori -->
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-[11px] font-bold px-2.5 py-0.5 rounded-lg bg-slate-800 text-indigo-300 border border-slate-700">
                                        <?= htmlspecialchars($item['category']) ?>
                                    </span>
                                    <span class="text-[11px] font-bold px-2.5 py-0.5 rounded-lg border <?= $status['color'] ?>">
                                        <?= $status['label'] ?>
                                    </span>
                                </div>

                                <!-- Judul Kegiatan -->
                                <h4 class="text-base font-extrabold text-white group-hover:text-indigo-400 transition line-clamp-2">
                                    <?= htmlspecialchars($item['title']) ?>
                                </h4>

                                <!-- Deskripsi -->
                                <p class="text-xs text-slate-400 leading-relaxed line-clamp-3">
                                    <?= htmlspecialchars($item['description']) ?>
                                </p>
                            </div>

                            <!-- Detail Tanggal & Lokasi -->
                            <div class="pt-3 border-t border-slate-800/80 space-y-1.5 text-xs text-slate-300">
                                <div class="flex items-center gap-2">
                                    <span class="text-indigo-400">🗓️</span>
                                    <span class="font-mono text-[11px]">
                                        <?= date('d M Y', strtotime($item['start_date'])) ?>
                                        <?php if ($item['start_date'] !== $item['end_date']): ?>
                                            - <?= date('d M Y', strtotime($item['end_date'])) ?>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-indigo-400">📍</span>
                                    <span class="text-slate-400 truncate"><?= htmlspecialchars($item['location']) ?></span>
                                </div>
                                <div class="flex items-center justify-between text-[11px] text-slate-400 pt-1">
                                    <span>Sasaran: <strong class="text-slate-200"><?= htmlspecialchars($item['target']) ?></strong></span>
                                    <span>Prioritas: <strong class="<?= $item['priority'] === 'Tinggi' ? 'text-rose-400' : 'text-slate-300' ?>"><?= $item['priority'] ?></strong></span>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>

        <!-- Informasi Arsitektur & Logika Sistem (Syarat Tugas RPL Tahap 1) -->
        <section class="bg-slate-900 border border-slate-800 rounded-2xl p-6 space-y-4">
            <h3 class="text-sm font-extrabold uppercase tracking-wider text-indigo-400 flex items-center gap-2">
                <span>⚙️</span> Logika Sistem & Pemenuhan Tugas Tahap 1 RPL
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs">
                <div class="bg-slate-950 p-4 rounded-xl border border-slate-800">
                    <strong class="text-white block mb-1">1. Logika Filter Asinkron</strong>
                    <p class="text-slate-400">Penyaringan dinamis menggunakan array manipulation PHP berdasarkan multi-parameter (kategori kegiatan & pencarian kata kunci).</p>
                </div>
                <div class="bg-slate-950 p-4 rounded-xl border border-slate-800">
                    <strong class="text-white block mb-1">2. Status & Countdown Waktu</strong>
                    <p class="text-slate-400">Fungsi <code>getEventStatus()</code> menghitung selisih hari antara tanggal server dengan tanggal pelaksanaan untuk status Ongoing, Upcoming, atau Ended.</p>
                </div>
                <div class="bg-slate-950 p-4 rounded-xl border border-slate-800">
                    <strong class="text-white block mb-1">3. Skalabilitas Basis Data</strong>
                    <p class="text-slate-400">Struktur dirancang siap dihubungkan ke relational database (MySQL/PostgreSQL) dengan 5 entitas terelasi.</p>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 border-t border-slate-800 py-6 text-center text-xs text-slate-500">
        <div class="max-w-7xl mx-auto px-4">
            Proyek Mandiri Rekayasa Perangkat Lunak &copy; 2026 · <strong class="text-slate-300">Roikhan Nur Fauzi (240104010)</strong> · D3 Teknik Komputer UDB Surakarta
        </div>
    </footer>

</body>
</html>
// Fitur Bookmark & Notifikasi Agenda Mahasiswa
