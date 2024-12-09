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
        // Jika role tidak sesuai, redirect ke halaman error atau dashboard
        header("Location: unauthorized.php");
        exit();
    }
}

// Fungsi untuk memulai session (jika diperlukan)
function startSession($username, $role) {
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;
    $_SESSION['log'] = 'logged';
}

?>
