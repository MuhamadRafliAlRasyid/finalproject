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
    <title>Tentang Kami - Bimbel Rahma</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
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

    <main class="container my-5">
        <section class="mb-5">
            <h1 class="section-title text-center">Kenali Bimbel Rahma Lebih Dekat</h1>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src=".\img\BIMBELRAHMA.png" alt="Bimbel Rahma" class="img-fluid rounded">
                </div>
                <div class="col-lg-6">
                    <div class="orange-box">
                        <p class="about-content font-italic">
                            Selamat datang di Bimbel Rahma, tempat di mana impian akademis menjadi kenyataan! Dengan lebih dari satu dekade pengalaman, kami telah menjadi mitra setia bagi ribuan siswa dalam perjalanan mereka menuju kesuksesan.
                        </p>
                        <p class="about-content font-italic">
                            Kami memahami bahwa setiap siswa adalah unik, dan itulah mengapa kami menawarkan pendekatan pembelajaran yang dipersonalisasi. Didukung oleh tim pengajar yang berdedikasi dan berpengalaman, kami siap membantu Anda mencapai puncak prestasi.
                        </p>
                        <p class="about-content font-italic">
                            Fasilitas kami dirancang untuk kenyamanan dan kemudahan belajar, termasuk ruang kelas yang modern, perpustakaan yang kaya akan sumber daya, dan akses tak terbatas ke materi digital terkini.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-5">
            <h2 class="section-title text-center">Mengapa Memilih Kami?</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <i class="fas fa-graduation-cap feature-icon"></i>
                        <h3>Pengajar Berkualitas</h3>
                        <p>Tim pengajar kami terdiri dari lulusan universitas terkemuka dengan pengalaman mengajar yang luas.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <i class="fas fa-book-open feature-icon"></i>
                        <h3>Kurikulum Terkini</h3>
                        <p>Materi pembelajaran kami selalu diperbarui mengikuti perkembangan kurikulum nasional.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <i class="fas fa-users feature-icon"></i>
                        <h3>Kelas Kecil</h3>
                        <p>Kami menjaga rasio siswa dan guru yang ideal untuk memastikan setiap siswa mendapat perhatian yang cukup.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <i class="fas fa-chalkboard-teacher feature-icon"></i>
                        <h3>Pembelajaran Inovatif</h3>
                        <p>Kami menggunakan metode pembelajaran yang inovatif dan interaktif.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <i class="fas fa-laptop feature-icon"></i>
                        <h3>Akses Materi Digital</h3>
                        <p>Siswa dapat mengakses materi pembelajaran digital kapan saja dan di mana saja.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <i class="fas fa-trophy feature-icon"></i>
                        <h3>Prestasi Siswa</h3>
                        <p>Banyak siswa kami yang telah meraih prestasi akademis di tingkat nasional dan internasional.</p>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <h2 class="section-title text-center">Visi & Misi</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="orange-box" style="height: 100%;">
                        <h3><strong>Visi</strong></h3>
                        <h2 class="about-content" style="font-size: 24px;"> Menjadi lembaga bimbingan belajar terdepan yang menghasilkan generasi unggul, berprestasi, dan berakhlak mulia.</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="orange-box" style="height: 100%;">
                        <h3><strong>Misi</strong></h3>
                        <ul class="about-content">
                            <li>Menyediakan layanan bimbingan belajar berkualitas tinggi</li>
                            <li>Mengembangkan metode pembelajaran yang inovatif dan efektif</li>
                            <li>Membangun karakter dan kepercayaan diri siswa</li>
                            <li>Mendorong semangat belajar dan kemandirian siswa</li>
                            <li>Menyediakan fasilitas belajar yang lengkap dan modern</li>
                            <li>Mengintegrasikan teknologi dalam proses pembelajaran</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>

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
