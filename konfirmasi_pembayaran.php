<?php
session_start();

// Ambil data dari sesi
if (isset($_SESSION['paymentDetails'])) {
    $details = $_SESSION['paymentDetails'];
} else {
    echo "Data pembayaran tidak tersedia.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pembayaran</title>
</head>
<body>
    <h1>Konfirmasi Pembayaran</h1>
    <ul>
        <li>Bulan Mulai: <?= htmlspecialchars($details['bulan']) ?></li>
        <li>Tahun Mulai: <?= htmlspecialchars($details['tahun']) ?></li>
        <li>Lama Belajar: <?= htmlspecialchars($details['lama']) ?> Bulan</li>
        <li>Tingkat Pendidikan: <?= htmlspecialchars($details['tingkat']) ?></li>
        <li>Kurikulum: <?= htmlspecialchars($details['kurikulum']) ?></li>
    </ul>
    <a href="selesai.php">Selesaikan Pembayaran</a>
</body>
</html>
