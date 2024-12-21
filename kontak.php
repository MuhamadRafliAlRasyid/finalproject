<?php
// Start the session
session_start();

// Include any necessary PHP files or database connections here
//include 'config.php';

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href=".\img\BIMBELRAHMA.png" sizes="32x32">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <title>Kontak - Bimbel Rahma</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navbar -->
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


    <!-- Contact Section -->
    <section class="container my-5">
        <h2 class="text-center mb-5">Hubungi Kami</h2>
        <div class="container">
            <div class="row">
            <div class="col-md-6">
                <div class="contact-info">
                    <h3 class="mb-4">Informasi Kontak</h3>
                    <p><i class="fas fa-map-marker-alt mr-2"></i> Jl. Citra Kebun Mas R16 No.01, Bengle, Kec. Majalaya, Karawang, Jawa Barat 41371</p>
                    <p><i class="fas fa-phone mr-2"></i> 0812-2222-9056</p>
                    <p><i class="fas fa-envelope mr-2"></i> bimbelrahmakarawang@gmail.com</p>
                    <p><i class="fas fa-clock mr-2"></i> Senin - Jumat: 08.00 - 17.00</p>
                    <p><i class="fas fa-clock mr-2"></i> Sabtu: 08.00 - 15.00</p>   
                    <p><i class="fas fa-clock mr-2"></i> Minggu: Tutup</p>
                </div>
                <div class="social-media mt-4">
                    <h4>Ikuti Kami</h4>
                    <a href="https://www.facebook.com/profile.php?id=100066394995272&mibextid=LQQJ4d" class="text-black mr-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/bimbelrahmakarawang/" class="text-black mr-3"><i class="fab fa-instagram"></i></a>
                    <a href="mailto:bimbelrahmakarawang@gmail.com" class="text-black"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-form">
                    <h3 class="mb-4">Kirim Pesan</h3>
                    <form action="mailto:bimbelrahmakarawang@gmail.com" method="post" enctype="text/plain">
                        <div class="form-group">
                            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" name="nomor_telepon" class="form-control" placeholder="Nomor Telepon" required>
                        </div>
                        <div class="form-group">
                            <textarea name="pesan" class="form-control" rows="5" placeholder="Pesan" required></textarea>
                        </div>
                        <input type="submit" value="Kirim Pesan" class="btn btn-primary btn-block" onclick="this.form.submit();">
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="container-fluid px-0 my-5">
        <div class="map-container" style="height: 600px;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.2387124688897!2d107.4762893!3d-6.3686567!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e699d5f0384a3b7%3A0x5f3d0f5c4f3d0f5c!2sJl.%20Citra%20Kebun%20Mas%20R16%20No.01%2C%20Bengle%2C%20Kec.%20Majalaya%2C%20Karawang%2C%20Jawa%20Barat%2041371!5e0!3m2!1sen!2sid!4v1620000000000!5m2!1sen!2sid" width="100%" height="100%" style="border:0; height: 600px;" allowfullscreen="" loading="lazy"></iframe>
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
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</body>
</html>
