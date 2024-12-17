<?php
session_start();


// Cek apakah paket dipilih
if (!isset($_SESSION['selected_paket'])) {
    header("Location: paketbelajar.php");
    exit();
}

$paket = $_SESSION['selected_paket'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran</title>
</head>
<body>
    <h2>Detail Pembayaran</h2>
    <p>Halo, <?= htmlspecialchars($_SESSION['username']); ?>!</p>
    <p>Paket yang dipilih: <?= htmlspecialchars($paket['paket']); ?></p>
    <p>Harga: Rp <?= number_format($paket['harga'], 0, ',', '.'); ?></p>
    <form method="POST" action="proses_pembayaran.php">
        <button type="submit">Bayar Sekarang</button>
    </form>
</body>
</html>
