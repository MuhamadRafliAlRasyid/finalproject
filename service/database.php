<?php 

// Konfigurasi database
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "bimbel_db");

try {
    // Aktifkan laporan error selama pengembangan (nonaktifkan di produksi)
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
    // Membuat koneksi
    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Set charset untuk menghindari masalah encoding
    $db->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    // Tangani kesalahan koneksi
    error_log("Database connection error: " . $e->getMessage()); // Log error untuk debugging
    die("Koneksi database gagal. Silakan coba lagi nanti.");
}

?>