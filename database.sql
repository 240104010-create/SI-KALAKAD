-- ====================================================================
-- RANCANGAN BASIS DATA SI-KALAKAD
-- Sistem Informasi Kalender Kegiatan Akademik Mahasiswa
-- Mahasiswa : Roikhan Nur Fauzi (NIM: 240104010)
-- ====================================================================

CREATE DATABASE IF NOT EXISTS kalender_akademik;
USE kalender_akademik;

-- 1. TABEL PENGGUNA (USERS / STAKEHOLDER)
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    role ENUM('admin', 'dosen', 'mahasiswa') NOT NULL DEFAULT 'mahasiswa',
    prodi VARCHAR(50) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. TABEL KATEGORI KEGIATAN
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(50) NOT NULL UNIQUE,
    deskripsi VARCHAR(255) NULL,
    warna_label VARCHAR(20) DEFAULT '#4f46e5'
);

-- 3. TABEL KEGIATAN AKADEMIK (EVENTS)
CREATE TABLE events (
    event_id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    user_id INT NOT NULL,
    judul_kegiatan VARCHAR(255) NOT NULL,
    deskripsi TEXT NULL,
    tanggal_mulai DATE NOT NULL,
    tanggal_selesai DATE NOT NULL,
    lokasi VARCHAR(150) NOT NULL,
    sasaran_peserta VARCHAR(100) NOT NULL DEFAULT 'Semua Mahasiswa',
    tingkat_prioritas ENUM('Tinggi', 'Sedang', 'Rendah') NOT NULL DEFAULT 'Sedang',
    status_publikasi ENUM('Draft', 'Dipublikasikan', 'Dibatalkan') NOT NULL DEFAULT 'Dipublikasikan',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE RESTRICT,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE RESTRICT
);

-- 4. TABEL AGENDA PRIBADI / PENANDA MAHASISWA (USER_BOOKMARKS)
CREATE TABLE user_bookmarks (
    bookmark_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    catatan_pribadi TEXT NULL,
    is_reminded BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_user_event (user_id, event_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES events(event_id) ON DELETE CASCADE
);

-- 5. TABEL LOG NOTIFIKASI PENGINGAT (NOTIFICATIONS)
CREATE TABLE notifications (
    notification_id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    user_id INT NOT NULL,
    pesan_notifikasi VARCHAR(255) NOT NULL,
    tipe_media ENUM('Email', 'Sistem', 'WhatsApp') NOT NULL DEFAULT 'Sistem',
    status_kirim ENUM('Pending', 'Terkirim', 'Gagal') NOT NULL DEFAULT 'Pending',
    waktu_kirim DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (event_id) REFERENCES events(event_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- SEED DATA AWAL
INSERT INTO categories (nama_kategori, deskripsi, warna_label) VALUES
('Akademik', 'Kegiatan administrasi akademik, KRS, dan KPRS', '#4f46e5'),
('Perkuliahan', 'Jadwal tatap muka perkuliahan dan praktikum lab', '#06b6d4'),
('Ujian', 'Pelaksanaan UTS, UAS, dan ujian susulan', '#f43f5e'),
('Keuangan', 'Pembayaran SPP, UKT, dan registrasi ulang', '#f59e0b'),
('Kemahasiswaan', 'Kegiatan seminar, workshop, lomba, dan ormawa', '#10b981');
