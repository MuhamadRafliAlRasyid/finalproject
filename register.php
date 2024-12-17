<?php 
include "service/database.php";
session_start();

$register_message = "";
if (!isset($_SESSION['selected_paket'])) {
    header("Location: paketbelajar1.php");
    exit();
}
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
    $class = $_POST["class"];
    $province = $_POST["province"];
    $regency = $_POST["regency"];
    $district = $_POST["district"];
    $address = $_POST["address"] ?? ''; // Tambahkan pemeriksaan agar tidak error jika belum ada nilai
    $role_id = 1;
    $hash_password = hash("sha256", $password); // Hash password

    // Query untuk memasukkan data
    $sql = "INSERT INTO users (username, password, email, phone, class, province, regency, district, address, role_id) 
            VALUES ('$username', '$hash_password', '$email', '$phone', '$class', '$province', '$regency', '$district', '$address', $role_id)";

    try {
        // Eksekusi query
        if (mysqli_query($db, $sql)) {
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
    <nav class="navbar navbar-expand-lg navbar-light py-0">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src=".\img\BIMBELRAHMA.png" alt="Bimbel Rahma Logo" width="300" height="1500"> <!-- Increased width and height -->
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link px-3" href="index.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="tentangkami.php">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="paketbelajar.php">Paket Belajar</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="kontak.php">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-primary text-white ml-3 px-4" href="login.php">Masuk</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-primary text-white ml-3 px-4" href="register.php">Daftar Sekarang</a></li>
                </ul>
            </div>
        </div>
    </nav>

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
                        <form method="post" action="register.php">
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
                                <label for="class">Class</label>
                                <input type="text" class="form-control" id="class" name="class" required>
                            </div>

                            <!-- Dropdown Provinsi -->
                            <div class="form-group">
                                <label for="province">Provinsi</label>
                                <select class="form-control" id="province" name="province" required>
                                    <option value="">Pilih Provinsi</option>
                                </select>
                            </div>

                            <!-- Dropdown Kabupaten/Kota -->
                            <div class="form-group">
                                <label for="regency">Kabupaten/Kota</label>
                                <select class="form-control" id="regency" name="regency" required disabled>
                                    <option value="">Pilih Kabupaten/Kota</option>
                                </select>
                            </div>

                            <!-- Dropdown Kecamatan -->
                            <div class="form-group">
                                <label for="district">Kecamatan</label>
                                <select class="form-control" id="district" name="district" required disabled>
                                    <option value="">Pilih Kecamatan</option>
                                </select>
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

    <!-- JavaScript untuk Dropdown -->
    <script>
        const apiBase = 'https://www.emsifa.com/api-wilayah-indonesia/api';

        async function fetchData(endpoint) {
            const response = await fetch(`${apiBase}/${endpoint}.json`);
            return response.json();
        }

        async function loadProvinces() {
            const provinces = await fetchData('provinces');
            const provinceSelect = document.getElementById("province");

            provinces.forEach(province => {
                const option = new Option(province.name, province.id);
                provinceSelect.add(option);
            });
        }

        async function loadRegencies(provinceId) {
            const regencies = await fetchData(`regencies/${provinceId}`);
            const regencySelect = document.getElementById("regency");

            regencySelect.innerHTML = "<option value=''>Pilih Kabupaten/Kota</option>";

            regencies.forEach(regency => {
                const option = new Option(regency.name, regency.id);
                regencySelect.add(option);
            });

            regencySelect.disabled = false;
        }

        async function loadDistricts(regencyId) {
            const districts = await fetchData(`districts/${regencyId}`);
            const districtSelect = document.getElementById("district");

            districtSelect.innerHTML = "<option value=''>Pilih Kecamatan</option>";

            districts.forEach(district => {
                const option = new Option(district.name, district.id);
                districtSelect.add(option);
            });

            districtSelect.disabled = false;
        }

        document.getElementById("province").addEventListener("change", function() {
            const provinceId = this.value;
            if (provinceId) {
                loadRegencies(provinceId);
                document.getElementById("district").innerHTML = "<option value=''>Pilih Kecamatan</option>";
                document.getElementById("district").disabled = true;
            }
        });

        document.getElementById("regency").addEventListener("change", function() {
            const regencyId = this.value;
            if (regencyId) {
                loadDistricts(regencyId);
            }
        });

        loadProvinces();
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
