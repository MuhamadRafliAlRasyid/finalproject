<?php
session_start();

// Redirect jika belum login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil data user dari session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'Tidak Ada';
$role = $_SESSION['role'];

// Fungsi untuk mengecek login
function checkLogin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}

// Fungsi untuk mengecek role
function checkRole($allowed_roles = []) {
    if (!in_array($_SESSION['role'], $allowed_roles)) {
        // Redirect ke halaman sesuai role
        switch ($_SESSION['role']) {
            case 'admin':
                header('Location: ../admin/admin-dashboard.php');
                break;
            case 'student':
                header('Location: ../siswa/siswa-dashboard.php');
                break;
            case 'teacher':
                header('Location: ../guru/guru-dashboard.php');
                break;
            case 'founder':
                header('Location: ../founder/founder-dashboard.php');
                break;
            default:
                header("Location: error.php");
                exit();
        }
    }
}

// Fungsi untuk mendapatkan semua data user dari session
function getUserData() {
    return [
        'user_id' => $_SESSION['user_id'],
        'username' => $_SESSION['username'],
        'email' => isset($_SESSION['email']) ? $_SESSION['email'] : '',
        'role' => $_SESSION['role'],
    ];
}

// Contoh penggunaan fungsi getUserData()
$user_data = getUserData();
?>
