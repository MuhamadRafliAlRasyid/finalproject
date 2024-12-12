<?php
// Include file auth.php
require_once '../session.php';

// Periksa apakah sudah login
checkLogin();

checkRole(['student']);

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
	<link rel="stylesheet" href="style.css">
	<link rel="icon" href="..\img\BIMBELRAHMA.png" sizes="32x32">
	<title>Dashboard Admin - Bimbel Rahma</title>
</head>
<style>
    .dashboard-content {
    padding: 20px;
}

.cards {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.card {
    background: #f9f9f9;
    border-radius: 8px;
    padding: 20px;
    flex: 1;
    margin: 0 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.card-inner {
    text-align: center;
}

.card h3 {
    margin-bottom: 10px;
}

.btn {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 15px;
    background: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

.notifications {
    background: #f9f9f9;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.notifications h3 {
    margin-bottom: 10px;
}

    </style>
<body>


<section id="sidebar">
	<a href="#" class="brand">
		<img src="../img/BIMBELRAHMA.png" alt="Logo Bimbel Rahma" style="width: 80%; height: auto; margin-top: auto;">
	</a>
	<ul class="side-menu top">
		<li class="active">
			<a href="admin-dashboard.php" >
				<i class='bx bxs-dashboard'></i>
				<span class="text">Dashboard</span>
			</a>
		</li>
		<li>
			<a href="../view/data-siswa.php">
				<i class='bx bxs-group'></i>
				<span class="text">Kelasku</span>
			</a>
		</li>
		<li>
			<a href="../view/data-pengajar.php" >
				<i class='bx bxs-group'></i>
				<span class="text">Report</span>
			</a>
		</li>

	</ul>
	<ul class="side-menu top">
		<li>
			<a href="../view/setting-profile.php" >
				<i class='bx bxs-cog'></i>
				<span class="text">Setting Profiles</span>
			</a>
		</li>
		<li>
			<a href="../logout.php" class="logout">
				<i class='bx bxs-log-out-circle'></i>
				<span class="text">Logout</span>
			</a>
		</li>
	</ul>
</section>


	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav style="justify-content:flex-end">
    <div class="nav-right">
        <span class="welcome-message">Selamat Datang, <?php echo htmlspecialchars($username); ?>!</span>
        <a href="#" class="notification">
            <i class='bx bxs-bell'></i>
            <span class="num">8</span>
        </a>
        <a href="#" class="profile">
            <img src="img/people.png" alt="Profile Picture">
        </a>
    </div>
</nav>


		<!-- NAVBAR -->

		<main>
    <!-- Dashboard Section -->
    <div class="head-title" id="dashboard">
        <div class="left">
            <h1>Dashboard</h1>
            <ul class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">Home</a></li>
            </ul>
        </div>
    </div>


<!-- Content -->
<div class="dashboard-content">
    <div class="cards">
        <div class="card">
            <div class="card-inner">
                <h3>Kelas Aktif</h3>
                <p>Matematika, Bahasa Inggris, Fisika</p>
                <a href="../view/data-siswa.php" class="btn">Lihat Detail</a>
            </div>
        </div>
        <div class="card">
            <div class="card-inner">
                <h3>Tugas Terkini</h3>
                <p>Matematika: Soal 1-10 (Batas Waktu: 10 Desember 2024)</p>
                <p>Bahasa Inggris: Essay (Batas Waktu: 12 Desember 2024)</p>
                <a href="../view/tugas.php" class="btn">Lihat Tugas</a>
            </div>
        </div>
        <div class="card">
            <div class="card-inner">
                <h3>Materi Pembelajaran</h3>
                <p>Materi terbaru: Trigonometri, Tenses dalam Bahasa Inggris</p>
                <a href="../view/materi.php" class="btn">Akses Materi</a>
            </div>
        </div>
    </div>

    <div class="notifications">
        <h3>Notifikasi</h3>
        <ul>
            <li>Anda memiliki 3 tugas yang belum diselesaikan.</li>
            <li>Jadwal ujian Matematika: 15 Desember 2024.</li>
            <li>Pengumuman: Kelas tambahan Bahasa Inggris akan diadakan pada 9 Desember 2024.</li>
        </ul>
    </div>
</div>
	

	
</body>
</html>