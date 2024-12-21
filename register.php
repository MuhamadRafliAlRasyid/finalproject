<?php 
include "service/database.php";
session_start();

$register_message = "";

// Redirect jika sudah login
if (isset($_SESSION["is_login"])) {
    header("location: dashboard.php");
    exit;
}

// Proses registrasi
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["register"])) {
    // Mengambil input dan memastikan tidak ada injection
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $province = trim($_POST["province"]);
    $regency = trim($_POST["regency"]);
    $district = trim($_POST["district"]);
    $address = trim($_POST["address"] ?? '');
    
    // Nilai default
    $image = "default.png"; // Default image untuk pengguna baru
    $is_active = 0; // Status tidak aktif
    $role_id = 1; // Default role siswa
    $hash_password = password_hash($password, PASSWORD_DEFAULT); // Hash password untuk keamanan

    // Validasi input
    if (empty($username) || empty($password) || empty($email) || empty($phone)) {
        $register_message = "Semua kolom wajib diisi!";
    } else {
        try {
            // Query menggunakan prepared statement
            $sql = "INSERT INTO users (username, password, email, phone, province, regency, district, address, image, is_active, role_id) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($sql);

            if (!$stmt) {
                throw new Exception("Prepare statement error: " . $db->error);
            }

            // Bind parameter ke query
            $stmt->bind_param(
                "sssssssssis",
                $username,
                $hash_password,
                $email,
                $phone,
                $province,
                $regency,
                $district,
                $address,
                $image,
                $is_active,
                $role_id
            );

            // Eksekusi query
            if ($stmt->execute()) {
                $register_message = "Registrasi berhasil! Silakan menunggu konfirmasi aktivasi.";
            } else {
                throw new Exception("Eksekusi gagal: " . $stmt->error);
            }

            $stmt->close();
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) { // 1062 adalah kode error untuk duplikat entri
                $register_message = "Username atau email sudah digunakan.";
            } else {
                $register_message = "Terjadi kesalahan: " . $e->getMessage();
            }
        } catch (Exception $e) {
            $register_message = "Error: " . $e->getMessage();
        }
    }
}
?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href=".\img\BIMBELRAHMA.png" sizes="32x32">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Registrasi - Bimbel Rahma</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            border-radius: 5px 5px 0 0;
            text-align: center;
        }
        .form-container {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 20px;
        }
        .btn-orange {
            background-color: #ff7f50;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent sticky-top"> <!-- Added sticky-top class -->
        <div class="container-fluid">
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
                    <li class="nav-item"><a class="nav-link px-3" href="kontak.php">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-primary text-white ml-3 px-4" href="register.php">daftar</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-primary text-white ml-3 px-4" href="login.php">Masuk</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="divider"></div>

    <!-- Registration Form Section -->
    <div class="col">
        <div class="card card-registration my-4">
            <div class="row g-0">
                <div class="col-xl-5 d-none d-xl-block">
                    <iframe src="https://lottie.host/embed/3ea3e92d-3d26-4233-a3db-7a26b7932021/cD0FoJDylX.lottie" style="width: 100%; height: 100%;"></iframe>
                </div>
                <div class="col-xl-6">
                    <div class="card-body p-md-5 text-black">
                        <h3 style="background-color: orange; color: black; padding: 10px; border-radius: 10px;" class="mb-5 text-uppercase">Student registration form</h3>
                        <form id="registrationForm" action="aksi_register.php" method="POST">
                            <div class="form-group">
                                <label for="username">Username <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password <span style="color: red;">*</span></label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span style="color: red;">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">No Handphone <span style="color: red;">*</span></label>
                                <input type="number" class="form-control" id="phone" name="phone" required>
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
                <div class="col-md-0">
                    <div style="background-color: white;">
                        <img src=".\img\BIMBELRAHMA.png" alt="Bimbel Rahma Logo" width="300" height="200" style="max-height: 200px;">
                    </div>
                    <div class="divider"></div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <h4 style="color: black;">Bimbel Rahma</h4>
                                <p style="color: black;">Jl. Citra Kebun Mas R16 No.01, Bengle, Kec. Majalaya, Karawang, Jawa Barat 41371</p>
                            </div>
                            <div class="col-md-4">
                                <h4 style="color: black;">Hubungi Kami</h4>
                                <p style="color: black;">Email: bimbelrahmakarawang@gmail.com</p>
                                <p style="color: black;">Telepon: 0812-2222-9056</p>
                            </div>
                            <div class="col-md-4">
                                <h4 style="color: black;">Ikuti Kami</h4>
                                <div class="social-media">
                                    <a href="https://www.facebook.com/profile.php?id=100066394995272&mibextid=LQQJ4d" class="text-black mr-3"><i class="fab fa-facebook-f"></i></a>
                                    <a href="https://www.instagram.com/bimbelrahmakarawang/" class="text-black mr-3"><i class="fab fa-instagram"></i></a>
                                    <a href="mailto:bimbelrahmakarawang@gmail.com" class="text-black"><i class="fas fa-envelope"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p class="text-center" style="color: black;">&copy; 2024 Bimbel Rahma. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>

        // JavaScript untuk Dropdown
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
</body>
</html>
