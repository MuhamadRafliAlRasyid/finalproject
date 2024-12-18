<?php
include "service/database.php";
session_start();

$register_message = "";



// Redirect jika sudah login
if (isset($_SESSION["is_login"])) {
    header("Location: dashboard.php");
    exit;
}

// Proses registrasi
if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $class = $_POST["class"];
    $province = $_POST["province"];
    $regency = $_POST["regency"];
    $district = $_POST["district"];
    $address = $_POST["address"] ?? ''; 
    $is_active = 0; // Pemeriksaan agar tidak error jika kosong
    $role_id = 1;
    $hash_password = hash("sha256", $password); // Hash password

    // Query untuk memasukkan data
    $sql = "INSERT INTO users (username, password, email, phone, province, regency, district, address, is_active, role_id) 
            VALUES ('$username', '$hash_password', '$email', '$phone', '$province', '$regency', '$district', '$address', '$is_active', '$role_id')";

    try {
        // Eksekusi query
        if (mysqli_query($db, $sql)) {
            // Ambil ID user yang baru saja dibuat
            $user_id = mysqli_insert_id($db); // Fungsi untuk mendapatkan ID terakhir yang dimasukkan
            
            // Simpan data user ke session
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION["is_login"] = true; // Menandakan user sudah login

            // Redirect ke halaman pembayaran
            header("Location: paketbelajar.php");
            
        }
    } catch (mysqli_sql_exception $e) {
        // Menangani kesalahan duplikasi username
        if (mysqli_errno($db) == 1062) { // 1062 adalah kode error untuk duplikat entry
            $register_message = "Username sudah digunakan, silahkan ganti";
        } else {
            $register_message = "Daftar akun gagal, silahkan coba lagi. Error: " . $e->getMessage();
        }
    }
}
?>