<?php
// Periksa apakah session sudah dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect jika belum login
    exit();
}
$username = $_SESSION['username'];
// Fungsi untuk mengecek login
function checkLogin() {
    if (!isset($_SESSION['username'])) {
        // Jika belum login, redirect ke halaman login
        header("Location: ../login.php");
        exit();
    }
}

// Fungsi untuk mengecek role
function checkRole($allowed_roles = []) {
    if (!isset($_SESSION['role'])) {
        header("Location: ../login.php");
        exit();
    }

    // Periksa apakah role pengguna ada dalam daftar role yang diizinkan
    if (!in_array($_SESSION['role'], $allowed_roles)) {
        // Redirect ke halaman berdasarkan role
        switch ($_SESSION['role']) {
            case 'admin':
                header('Location: \finalproject\admin\admin-dashboard.php');
                break;
            case 'student':
                header('Location: \finalproject\siswa\siswa-dashboard.php');
                break;
            case 'teacher':
                header('Location: \finalproject\guru\guru-dashboard.php');
                break;
            case 'founder':
                header('Location: \finalproject\founder\founder-dashboard.php');
                break;
            default:
                header("Location: error.php"); // Jika role tidak dikenal
        }
        exit();
    }       
}

// Fungsi untuk memulai session (jika diperlukan)
function startSession($username, $role) {
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;
    $_SESSION['log'] = 'logged';
}

// Simpan data paket belajar ke session
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $package_id = $_POST['package_id']; // ID paket belajar dari form
    $start_month = $_POST['bulan'];     // Bulan mulai belajar
    $start_year = $_POST['tahun'];      // Tahun mulai belajar
    $duration = $_POST['lama'];         // Lama belajar (bulan)

    // Simpan ke session
    $_SESSION['selected_package'] = [
        'package_id' => $package_id,
        'start_month' => $start_month,
        'start_year' => $start_year,
        'duration' => $duration
    ];

    // Redirect ke halaman login/register
    header("Location: register.php");
    exit();
}

?>
