<?php
include "service/database.php";
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
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'guest'; // Nilai default 'guest'

// Fungsi untuk mengecek login
function checkLogin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}
function checkPayments() {
    global $db;

    // Pastikan session sudah berjalan
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $sql = "SELECT status FROM payments WHERE student_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $status = $row['status'];

        // Redirect hanya jika diperlukan
        $currentPage = basename($_SERVER['PHP_SELF']);

        if ($status === 'completed' && $currentPage !== 'siswa-dashboard.php') {
            header("Location: siswa-dashboard.php");
            exit;
        } elseif (($status === 'pending' || $status === 'unpaid') && $currentPage !== 'pembayaran.php') {
            header("Location: pembayaran.php");
            exit;
        }
    } else {
        // Jika tidak ada catatan pembayaran, arahkan ke pembayaran
        header("Location: pembayaran.php");
        exit;
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
        'role' => isset($_SESSION['role']) ? $_SESSION['role'] : 'guest',
    ];
}

// Contoh penggunaan fungsi getUserData()
$user_data = getUserData();
?>
