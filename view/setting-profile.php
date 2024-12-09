<?php
// Include file auth.php
require_once '../session.php';

// Periksa apakah sudah login
checkLogin();

// Periksa apakah pengguna memiliki role 'admin'
checkRole(['admin']);

// Jika lolos, tampilkan konten halaman admin
echo "Selamat datang, Admin " . $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../img/BIMBELRAHMA.png" sizes="32x32">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Setting Profiles - Bimbel Rahma</title>
    <style>
        body {
            background-color: #f4f4f4;
        }
        .container {
            margin-top: 20px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<section id="sidebar">
    <!-- Sidebar content here -->
</section>

<section id="content">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <span class="navbar-brand">Selamat Datang, <?php echo htmlspecialchars($username); ?>!</span>
            <div class="ml-auto">
                <a href="#" class="notification">
                    <i class='bx bxs-bell'></i>
                    <span class="num">8</span>
                </a>
                <a href="#" class="profile">
                    <img src="img/people.png" alt="Profile Picture" class="rounded-circle" width="40">
                </a>
            </div>
        </div>
    </nav>

    <main class="container">
        <h1 class="text-center">Setting Profiles</h1>
        <form id="profile-form">
            <div class="form-group">
                <label for="name">Nama Lengkap:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
            </div>
            <div class="form-group">
                <label for="phone">Nomor Telepon:</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Masukkan nomor telepon" required>
            </div>
            <div class="form-group">
                <label for="profile-pic">Foto Profil:</label>
                <input type="file" class="form-control-file" id="profile-pic" name="profile-pic" accept="image/*">
            </div>
            <div class="form-group">
                <label for="bio">Bio:</label>
                <textarea class="form-control" id="bio" name="bio" rows="4" placeholder="Tulis bio Anda..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </main>
</section>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('profile-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah pengiriman form default

        // Tampilkan SweetAlert
        Swal.fire({
            title: 'Berhasil',
            text: 'Data berhasil disimpan',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
