<?php
include "service/database.php"; // Pastikan koneksi database benar
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $lama = $_POST['lama'];
    $tingkat = $_POST['tingkat'];
    $kelas = $_POST['kelas'];
    $kurikulum = $_POST['kurikulum'];
    
    
    // Hitung total harga
    $biayaPaket = 500000; // Harga paket per bulan
    $lamaBelajar = (int)$lama; // Lama belajar dalam bulan
    $biayaRegistrasi = 200000; // Biaya registrasi
    $totalHarga = ($biayaPaket * $lamaBelajar) + $biayaRegistrasi;
    
    $_SESSION['selected_paket'] = [
        'bulan' => $_POST['bulan'],
        'tahun' => $_POST['tahun'],
        'lama' => $_POST['lama'],
        'tingkat' => $_POST['tingkat'],
        'kelas' => $_POST['kelas'],
        'kurikulum' => $_POST['kurikulum'],
        'total_harga' => $_POST['total_harga']
    ];

    // Query untuk menyimpan data ke database
    $sql = "INSERT INTO paket 
            (bulan_mulai, tahun_mulai, lama_belajar, tingkat_pendidikan, kelas, kurikulum, total_harga) 
            VALUES ('$bulan', '$tahun', '$lama', '$tingkat', '$kelas', '$kurikulum', '$totalHarga')";

    if ($db->query($sql) === TRUE) {
        echo "Data berhasil disimpan!";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}
header("Location: register.php");

?>