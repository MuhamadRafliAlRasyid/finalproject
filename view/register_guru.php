<?php 
include "../service/database.php";
session_start();

$register_message = "";

// Redirect jika sudah login
if (isset($_SESSION["is_login"])) {
    header("location: dashboard.php");
    exit;
} 

// Proses registrasi
if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"] ?? ''; // Tambahkan pemeriksaan agar tidak error jika belum ada nilai
    $role_id = 2;
    $hash_password = hash("sha256", $password); // Hash password

    // Query untuk memasukkan data
    $sql = "INSERT INTO users (username, password, email, phone, address, role_id) 
            VALUES ('$username', '$hash_password', '$email', '$phone', '$address', $role_id)";

    try {
        // Eksekusi query
        if (mysqli_query($db, $sql)) {
            header("location: user-management.php");
            $register_message = "Daftar akun berhasil, silahkan login";
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

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Bimbel Rahma</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        /* CSS styling untuk tampilan registrasi */
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f4f4f4;
            margin: 0;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
            width: 100%;
            max-width: 1200px;
        }

        .navbar-brand img {
            height: 80px;
        }
        
        .nav-link {
            color: #333 !important;
            font-weight: 600;
        }
        .nav-link:hover {
            color: #ff9800 !important;
        }

        .btn-primary {
            background-color: #ff9800;
            border-color: #ff9800;
        }

        .card {
            border: 2px solid #ff9800;
            max-width: 100%;
            width: 100%;
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: #ff9800;
            color: #ffffff;
            text-align: center;
            padding: 10px 0;
            font-size: 1.5em;
        }

        .form-group label {
            font-weight: bold;
        }

        @media (min-width: 768px) {
            .container {
                max-width: 600px;
                padding: 0;
            }
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 800px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <!-- Navbar -->
    
    <!-- Form Registrasi -->
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Register</h3>
                    </div>
                    <div class="card-body">
                        <?php if ($register_message): ?>
                            <div class="alert alert-danger"><?php echo $register_message; ?></div>
                        <?php endif; ?>
                        <form method="post" action="register_guru.php">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">No Handphone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="address">Alamat Lengkap</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Masukkan alamat lengkap Anda" required>
                            </div>
                            
                            <button type="submit" name="register" class="btn btn-primary btn-block">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div style="background-color: white; padding: 5px;">
                        <img src=".\img\BIMBELRAHMA.png" alt="Bimbel Rahma Logo" width="300" height="80" style="max-height: 100px;">
                    </div>
                    <h4>Bimbel Rahma</h4>
                    <p>Jl. Citra Kebun Mas R16 No.01, Bengle, Kec. Majalaya, Karawang, Jawa Barat 41371</p>
                </div>
                <div class="col-md-4">
                    <h4>Hubungi Kami</h4>
                    <p>Email: bimbelrahmakarawang@gmail.com</p>
                    <p>Telepon: 0812-2222-9056</p>
                </div>
                <div class="col-md-4">
                    <h4>Ikuti Kami</h4>
                    <a href="https://www.facebook.com/profile.php?id=100066394995272&mibextid=LQQJ4d" class="text-white mr-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/bimbelrahmakarawang/" class="text-white mr-3"><i class="fab fa-instagram"></i></a>
                    <a href="mailto:bimbelrahmakarawang@gmail.com" class="text-white"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
            <hr>
            <p class="text-center">&copy; 2024 Bimbel Rahma. All rights reserved.</p>
        </div>
    </footer>


</body>
</html>
