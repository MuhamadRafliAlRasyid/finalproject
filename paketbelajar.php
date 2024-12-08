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
    <title>Paket Belajar - Bimbel Rahma</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
     <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light py-0" style="box-shadow: none;">
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
                <li class="nav-item"><a class="nav-link btn btn-primary text-white ml-3 px-4" href="paketbelajar.php">Daftar Sekarang</a></li>
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
    <section class="container my-3">
        <h2 class="text-center mb-5">Paket Belajar Bimbel Rahma</h2>
        <div class="row">
            <!-- Paket Bronze -->
            <div class="col-md-4 mb-4">
                <div class="card package-card h-100">
                    <img src=".\img\kursus.jpeg" alt="Paket Bronze" class="package-image">
                    <div class="package-header">
                        <h3 class="text-center">Paket 1on1</h3>
                    </div>
                    <div class="package-body">
                        <p class="package-price text-center">Rp 500.000 <small>/bulan</small></p>
                        <ul class="feature-list">
                            <li>4x pertemuan per bulan</li>
                            <li>Durasi 90 menit per pertemuan</li>
                            <li>Materi pelajaran sekolah</li>
                            <li>Tutor berpengalaman</li>
                            <li>Kelas offline</li>
                        </ul>
                        <a href="paketbelajar1.php" class="btn btn-primary btn-block mt-4">Pilih Paket</a>
                    </div>
                </div>
            </div>
            
            <!-- Paket Silver -->
            <div class="col-md-4 mb-4">
                <div class="card package-card h-100">
                    <img src=".\img\kursus.jpeg" alt="Paket Silver" class="package-image">
                    <div class="package-header">
                        <h3 class="text-center">Paket 1on3</h3>
                    </div>
                    <div class="package-body">
                        <p class="package-price text-center">Rp 750.000 <small>/bulan</small></p>
                        <ul class="feature-list">
                            <li>8x pertemuan per bulan</li>
                            <li>Durasi 120 menit per pertemuan</li>
                            <li>Materi pelajaran sekolah</li>
                            <li>Tutor berpengalaman</li>
                            <li>Kelas offline dan online</li>
                            <li>Modul latihan tambahan</li>
                        </ul>
                        <a href="paketbelajar2.php" class="btn btn-primary btn-block mt-4">Pilih Paket</a>
                    </div>
                </div>
            </div>
            
            <!-- Paket Gold -->
            <div class="col-md-4 mb-4">
                <div class="card package-card h-100">
                    <img src=".\img\kursus.jpeg" alt="Paket Gold" class="package-image">
                    <div class="package-header">
                        <h3 class="text-center">Paket 1on5</h3>
                    </div>
                    <div class="package-body">
                        <p class="package-price text-center">Rp 1.000.000 <small>/bulan</small></p>
                        <ul class="feature-list">
                            <li>12x pertemuan per bulan</li>
                            <li>Durasi 120 menit per pertemuan</li>
                            <li>Materi pelajaran sekolah</li>
                            <li>Tutor berpengalaman</li>
                            <li>Kelas offline dan online</li>
                            <li>Modul latihan tambahan</li>
                            <li>Konsultasi pribadi</li>
                            <li>Tryout bulanan</li>
                        </ul>
                        <a href="paketbelajar3.php" class="btn btn-primary btn-block mt-4">Pilih Paket</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="container my-5">
        <h2 class="text-center mb-5">Apa Kata Siswa Kami?</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card testimonial-card h-100 shadow-lg">
                    <div class="card-body">
                        <p class="testimonial-text">"Bimbel Rahma adalah kunci sukses saya! Tutornya sangat berpengalaman dan sabar, membuat belajar jadi menyenangkan."</p>
                        <p class="testimonial-author text-right font-italic">- Siti, Kelas 10</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card testimonial-card h-100 shadow-lg">
                    <div class="card-body">
                        <p class="testimonial-text">"Paket belajar yang ditawarkan sangat memuaskan. Materinya lengkap, mudah dipahami, dan sangat membantu dalam ujian!"</p>
                        <p class="testimonial-author text-right font-italic">- Budi, Kelas 12</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card testimonial-card h-100 shadow-lg">
                    <div class="card-body">
                        <p class="testimonial-text">"Kelas online yang fleksibel sangat membantu saya yang tinggal jauh dari lokasi bimbel. Terima kasih Bimbel Rahma!"</p>
                        <p class="testimonial-author text-right font-italic">- Andi, Kelas 11</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="container my-5">
        <h2 class="text-center mb-5">Pertanyaan yang Sering Diajukan (FAQ)</h2>
        <div class="accordion" id="faqAccordion">
            <div class="card">
                <div class="card-header" id="faqHeading1">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                            Apa saja paket belajar yang ditawarkan?
                        </button>
                    </h5>
                </div>
                <div id="faqCollapse1" class="collapse show" aria-labelledby="faqHeading1" data-parent="#faqAccordion">
                    <div class="card-body">
                        Kami menawarkan tiga paket belajar: Paket 1on1, Paket 1on3, dan Paket 1on5. Setiap paket memiliki durasi dan fitur yang berbeda.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="faqHeading2">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                            Bagaimana cara mengakses materi belajar?
                        </button>
                    </h5>
                </div>
                <div id="faqCollapse2" class="collapse" aria-labelledby="faqHeading2" data-parent="#faqAccordion">
                    <div class="card-body">
                        Anda dapat mengakses materi belajar melalui platform online kami setelah mendaftar. Materi dapat diakses kapan saja dan di mana saja.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="faqHeading3">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                            Bagaimana cara mendaftar?
                        </button>
                    </h5>
                </div>
                <div id="faqCollapse3" class="collapse" aria-labelledby="faqHeading3" data-parent="#faqAccordion">
                    <div class="card-body">
                        Anda dapat mendaftar melalui website kami dengan mengklik tombol "Daftar Sekarang" di bagian atas halaman ini.
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
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</body>
</html>
