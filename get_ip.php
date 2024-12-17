<?php
function getClientIP() {
    $ip = '';

    // Periksa apakah ada IP melalui proxy
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        // Ambil IP langsung dari REMOTE_ADDR
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    // Dalam kasus X_FORWARDED_FOR, IP bisa berupa daftar IP. Ambil yang pertama.
    if (strpos($ip, ',') !== false) {
        $ipArray = explode(',', $ip);
        $ip = trim($ipArray[0]);
    }

    return $ip;
}

// Gunakan fungsi untuk mendapatkan IP
$clientIP = getClientIP();

// Tampilkan IP klien
echo "Alamat IP Anda: " . $clientIP;
?>
