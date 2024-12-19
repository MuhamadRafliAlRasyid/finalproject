<?php
require_once 'session.php';
include "service/database.php";

// Simulasi session user_id
$user_id = $_SESSION['user_id'] ?? 1; // Default user_id jika session kosong

// Tetapkan package_id ke 1
$package_id = 1;

// Proses form jika disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bulan = $_POST['bulan'];         // start_month
    $tahun = $_POST['tahun'];         // start_year
    $lama = $_POST['lama'];           // duration
    $tingkat = $_POST['tingkat'];     // tingkat
    $kelas = $_POST['kelas'];         // class
    $kurikulum = $_POST['kurikulum']; // kurikulum

    // Perhitungan total harga
    $price_per_month = 500000;
    $registration_fee = 200000;
    $total_harga = ($price_per_month * $lama) + $registration_fee;

    // Insert data ke database
    $query = "INSERT INTO registrations (user_id, package_id, class, tingkat, kurikulum, start_month, start_year, duration, total_harga, created_at) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $db->prepare($query);
    $stmt->bind_param(
        "iiisssiii",  // Format data
        $user_id, 
        $package_id, 
        $kelas, 
        $tingkat, 
        $kurikulum, 
        $bulan, 
        $tahun, 
        $lama, 
        $total_harga
    );

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil disimpan!'); window.location.href='pembayaran.php';</script>";
        header("Location: siswa/pembayaran.php");
    } else {
        echo "<script>alert('Gagal menyimpan data: " . $stmt->error . "');</script>";
    }
    $stmt->close();
    $db->close();
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
    <title>Paket Belajar - Bimbel Rahma</title>
    <style>
        #paymentSummary {
            display: none; /* Initially hidden */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src=".\img\BIMBELRAHMA.png" alt="Bimbel Rahma Logo" width="300" height="1500">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link px-3" href="index.php">Beranda </a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="tentangkami.php">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="paketbelajar.php">Paket Belajar</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="kontak.php">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <script>
        // Menandai nav-item aktif berdasarkan URL saat ini
        document.addEventListener("DOMContentLoaded", function () {
            const navLinks = document.querySelectorAll(".nav-link");
            const currentUrl = window.location.href;

            navLinks.forEach(link => {
                if (link.href === currentUrl) {
                    link.classList.add("active");
                }
            });
        });
    </script>

    <!-- Divider -->
    <div class="divider"></div>

    <!-- Paket Belajar Section -->
    <section class="container my-5">
        <h2 class="text-center mb-5 package-title"><strong>Paket Belajar Bimbel Rahma</strong></h2>
        <div class="row">
            <!-- Paket Bronze -->
            <div class="col-md-6 mb-4">
                <div class="card package-card">
                    <img src="img/kursus.jpeg" alt="Paket 1on1" class="card-img-top">
                    <div class="card-body">
                        <h3 class="text-center">Paket 1on1</h3>
                        <p class="package-price text-center">Rp 500.000 <small>/bulan</small></p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">4x pertemuan per bulan</li>
                            <li class="list-group-item">Durasi 90 menit per pertemuan</li>
                            <li class="list-group-item">Materi pelajaran sekolah</li>
                            <li class="list-group-item">Tutor berpengalaman</li>
                            <li class="list-group-item">Kelas offline</li>
                            <li class="list-group-item" style ="color: white" ><?php echo htmlspecialchars($user_id); ?></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Form Pilihan -->
            <div class="col-md-6 mb-4">
                <div class="card package-card">
                    <div class="package-header">
                        <h3 class="text-center" style="color: black;">Form Pilihan</h3>
                    </div>
                    <div class="package-body">
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="bulan">Bulan Mulai</label>
                                <select name="bulan" id="bulan" class="form-control" required>
                                    <option value="">Pilih Bulan</option>
                                    <option value="Januari">Januari</option>
                                    <option value="Februari">Februari</option>
                                    <option value="Maret">Maret</option>
                                    <option value="April">April</option>
                                    <option value="Mei">Mei</option>
                                    <option value="Juni">Juni</option>
                                    <option value="Juli">Juli</option>
                                    <option value="Agustus">Agustus</option>
                                    <option value="September">September</option>
                                    <option value="Oktober">Oktober</option>
                                    <option value="November">November</option>
                                    <option value="Desember">Desember</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tahun">Tahun Mulai</label>
                                <select name="tahun" id="tahun" class="form-control" required>
                                    <option value="">Pilih Tahun</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                    <option value="2030">2030</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="lama">Lama Belajar (Bulan)</label>
                                <select name="lama" id="lama" class="form-control" required>
                                    <option value="">Pilih Lama Belajar</option>
                                    <option value="3">3 Bulan</option>
                                    <option value="6">6 Bulan</option>
                                    <option value="12">12 Bulan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tingkat">Tingkat Pendidikan</label>
                                <select name="tingkat" id="tingkat" class="form-control" required>
                                    <option value="">Pilih Tingkat Pendidikan</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select name="kelas" id="kelas" class="form-control" required>
                                    <option value="">Pilih Kelas</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kurikulum">Kurikulum</label>
                                <select name="kurikulum" id="kurikulum" class="form-control" required>
                                    <option value="">Pilih Kurikulum</option>
                                    <option value="Kurikulum 2013">Kurikulum 2013</option>
                                    <option value="Kurikulum 2018">Kurikulum 2018</option>
                                </select>
                            </div>
                            <h4 class="text-center">Total Harga: <span id="totalPrice">Rp 0</span></h4>
                            <button type="submit" class="btn btn-primary btn-block mt-4" id="confirmPayment">SELANJUTNYA</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-0">
                    <div style="background-color: white;">
                        <img src=".\img\BIMBELRAHMA.png" alt="Bimbel Rahma Logo" width="300" height="100" style="max-height: 100px;">
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
        // Function to calculate total price
        function calculateTotalPrice() {
            const lama = document.getElementById('lama').value;
            const pricePerMonth = 500000; // Price per month
            const registrationFee = 200000; // Registration fee
            const totalPrice = lama ? pricePerMonth * lama + registrationFee : registrationFee;

            // Update the total price display
            document.getElementById('totalPrice').innerText = 'Rp ' + totalPrice.toLocaleString();
            document.getElementById('packageCost').innerText = 'Rp ' + (pricePerMonth * lama).toLocaleString();
            document.getElementById('subTotal').innerText = 'Rp ' + totalPrice.toLocaleString();
            document.getElementById('totalPayment').innerText = 'Rp ' + totalPrice.toLocaleString();

            // Show payment summary if all fields are filled
            if (lama && document.getElementById('bulan').value && document.getElementById('tahun').value && document.getElementById('tingkat').value && document.getElementById('kelas').value && document.getElementById('kurikulum').value) {
                document.getElementById('paymentSummary').style.display = 'block';
            } else {
                document.getElementById('paymentSummary').style.display = 'none';
            }
        }

        // Event listeners for form changes
        document.getElementById('lama').addEventListener('change', calculateTotalPrice);
        document.getElementById('bulan').addEventListener('change', calculateTotalPrice);
        document.getElementById('tahun').addEventListener('change', calculateTotalPrice);
        document.getElementById('tingkat').addEventListener('change', calculateTotalPrice);
        document.getElementById('kurikulum').addEventListener('change', calculateTotalPrice);

        // Confirm payment action
       

        // Populate kelas based on tingkat
        document.getElementById('tingkat').addEventListener('change', function() {
            var tingkat = this.value;
            var kelasSelect = document.getElementById('kelas');
            kelasSelect.innerHTML = '<option value="">Pilih Kelas</option>';
            if (tingkat === 'SD') {
                for (var i = 1; i <= 6; i++) {
                    kelasSelect.options[kelasSelect.options.length] = new Option('Kelas ' + i, i);
                }
            } else if (tingkat === 'SMP') {
                for (var i = 7; i <= 9; i++) {
                    kelasSelect.options[kelasSelect.options.length] = new Option('Kelas ' + i, i);
                }
            } else if (tingkat === 'SMA') {
                for (var i = 10; i <= 12; i++) {
                    kelasSelect.options[kelasSelect.options.length] = new Option('Kelas ' + i, i);
                }
            }
        });
    </script>
</body>
</html>
