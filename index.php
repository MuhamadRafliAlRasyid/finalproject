<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href=".\img\BIMBELRAHMA.png" sizes="32x32">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <title>Bimbel Rahma - Bimbingan Belajar Terbaik</title>
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

    <div class="divider"></div>
    <!--carousel-->
    <div id="geser" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <a href="daftar.php">
                    <img src=".\img\BIMBEL RAHMA (1920 x 600 px) (4).png" class="d-block w-100" alt="Image 1" >
                </a>
            </div>
            <div class="carousel-item">
                <img src=".\img\konten2.png" class="d-block w-100" alt="Image 2">
            </div>
            <div class="carousel-item">
                <img src=".\img\konten3.png" class="d-block w-100" alt="Image 3" >
            </div>
        </div>
        <a class="carousel-control-prev" href="#geser" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#geser" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Learning Options Section -->
    <section class="learning-options">
        <div class="container">
            <h2 class="text-center mb-5">Pilihan Belajar</h2>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="learning-option">
                        <div class="animation-container" style="width: 320px; height: 240px;">
                            <lottie-player src=".\json\1on1.json" background="transparent" speed="1" style="width: 100%; height: 100%;" loop autoplay></lottie-player>
                        </div>
                        <h3>1 on 1 (Private math)</h3>
                        <p>Belajar secara personal dengan tutor berpengalaman untuk hasil maksimal.</p>
                        <a href="paketbelajar1.php" class="btn btn-primary">Pilih Paket</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="learning-option">
                        <div class="animation-container" style="width: 320px; height: 240px;">
                            <lottie-player src=".\json\1on3.json" background="transparent" speed="1" style="width: 100%; height: 100%;" loop autoplay></lottie-player>
                        </div>
                        <h3>1 on 3</h3>
                        <p>Belajar dalam kelompok kecil untuk interaksi yang lebih baik dan fokus.</p>
                        <a href="paketbelajar2.php" class="btn btn-primary">Pilih Paket</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="learning-option">
                        <div class="animation-container" style="width: 320px; height: 240px;">
                            <lottie-player src=".\json\1on5.json" background="transparent" speed="1" style="width: 100%; height: 100%;" loop autoplay></lottie-player>
                        </div>
                        <h3>1 on 5</h3>
                        <p>Belajar dalam kelompok yang lebih besar namun tetap efektif dan efisien.</p>
                        <a href="paketbelajar3.php" class="btn btn-primary">Pilih Paket</a>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mengapa Memilih Bimbel Rahma Section -->
    <section class="container my-5">
        <h2 class="text-center mb-5">Mengapa Memilih Bimbel Rahma?</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="feature-box text-center">
                    <i class="fas fa-chalkboard-teacher fa-3x mb-3" style="color: #020e49;"></i>
                    <h3>Pengajar Berkualitas</h3>
                    <p>Tim pengajar kami terdiri dari lulusan universitas terkemuka dengan pengalaman mengajar yang luas.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box text-center">
                    <i class="fas fa-book fa-3x mb-3" style="color: #020e49;"></i>
                    <h3>Kurikulum Terkini</h3>
                    <p>Materi pembelajaran kami selalu diperbarui mengikuti perkembangan kurikulum nasional.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box text-center">
                    <i class="fas fa-users fa-3x mb-3" style="color: #020e49;"></i>
                    <h3>Kelas Interaktif</h3>
                    <p>Kami menyediakan kelas yang interaktif untuk memastikan setiap siswa dapat berpartisipasi aktif.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box text-center">
                    <i class="fas fa-laptop fa-3x mb-3" style="color: #020e49;"></i>
                    <h3>Fasilitas Modern</h3>
                    <p>Kami dilengkapi dengan fasilitas belajar yang modern dan nyaman untuk mendukung proses belajar mengajar.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box text-center">
                    <i class="fas fa-award fa-3x mb-3" style="color: #020e49;"></i>
                    <h3>Prestasi Terbukti</h3>
                    <p>Banyak siswa kami yang telah meraih prestasi akademik dan diterima di sekolah dan universitas ternama.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box text-center">
                    <i class="fas fa-headset fa-3x mb-3" style="color: #020e49;"></i>
                    <h3>Dukungan Belajar</h3>
                    <p>Kami menyediakan layanan dukungan belajar untuk membantu siswa dalam mengatasi kesulitan belajar.</p>
                </div>
            </div>
        </div>
    </section>

   <!-- Pengajar Carousel Section -->
<section class="pengajar-carousel">
    <div class="container">
        <h2 class="text-center mb-5">Mengenal Pengajar di Bimbel Rahma</h2>
        <div id="pengajarCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="img/1.jpg" class="d-block mx-auto" style="width: 100%; height: auto;" alt="Foto Pengajar A">
                        </div>
                        <div class="col-md-6">
                            <img src="img/2.jpg" class="d-block mx-auto" style="width: 100%; height: auto;" alt="Foto Pengajar B">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="img/3.jpg" class="d-block mx-auto" style="width: 100%; height: auto;" alt="Foto Pengajar C">
                        </div>
                        <div class="col-md-6">
                            <img src="img/4.jpg" class="d-block mx-auto" style="width: 100%; height: auto;" alt="Foto Pengajar D">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="img/5.jpg" class="d-block mx-auto" style="width: 100%; height: auto;" alt="Foto Pengajar E">
                        </div>
                        <div class="col-md-6">
                            <img src="img/6.jpg" class="d-block mx-auto" style="width: 100%; height: auto;" alt="Foto Pengajar F">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="img/7.jpg" class="d-block mx-auto" style="width: 100%; height: auto;" alt="Foto Pengajar G">
                        </div>
                        <div class="col-md-6">
                            <img src="img/8.jpg" class="d-block mx-auto" style="width: 100%; height: auto;" alt="Foto Pengajar H">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="img/9.jpg" class="d-block mx-auto" style="width: 100%; height: auto;" alt="Foto Pengajar I">
                        </div>
                        <div class="col-md-6">
                            <img src="img/10.jpg" class="d-block mx-auto" style="width: 100%; height: auto;" alt="Foto Pengajar J">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="img/11.jpg" class="d-block mx-auto" style="width: 100%; height: auto;" alt="Foto Pengajar K">
                        </div>
                        <div class="col-md-6">
                            <img src="img/12.jpg" class="d-block mx-auto" style="width: 100%; height: auto;" alt="Foto Pengajar L">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="img/13.jpg" class="d-block mx-auto" style="width: 100%; height: auto;" alt="Foto Pengajar M">
                        </div>
                        <div class="col-md-6">
                            <img src="img/14.jpg" class="d-block mx-auto" style="width: 100%; height: auto;" alt="Foto Pengajar N">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="img/15.jpg" class="d-block mx-auto" style="width: 100%; height: auto;" alt="Foto Pengajar O">
                        </div>
                        <div class="col-md-6">
                            <img src="img/16.jpg" class="d-block mx-auto" style="width: 100%; height: auto;" alt="Foto Pengajar P">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="img/17.jpg" class="d-block mx-auto" style="width: 100%; height: auto;" alt="Foto Pengajar Q">
                        </div>
                        <div class="col-md-6">
                            <img src="img/18.jpg" class="d-block mx-auto" style="width: 100%; height: auto;" alt="Foto Pengajar R">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="img/19.jpg" class="d-block mx-auto" style="width: 100%; height: auto;" alt="Foto Pengajar S">
                        </div>
                        <div class="col-md-6">
                            <img src="img/20.jpg" class="d-block mx-auto" style="width: 100%; height: auto;" alt="Foto Pengajar T">
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#pengajarCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Sebelumnya</span>
            </a>
            <a class="carousel-control-next" href="#pengajarCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Selanjutnya</span>
            </a>
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
    <script>
    </script>
</body>
</html>
