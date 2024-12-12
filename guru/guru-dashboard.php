<?php
// Include file auth.php
require_once '../session.php';

// Periksa apakah sudah login
checkLogin();

checkRole(['teacher']);

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
    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" href="style.css">
	<link rel="icon" href="..\img\BIMBELRAHMA.png" sizes="32x32">
	<title>Dashboard guru - Bimbel Rahma</title>
    <style>
    
        .head-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        h1 {
            color: #333; /* Warna teks judul */
        }

        .upcoming-classes, .attendance-chart {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Bayangan yang lebih halus */
            padding: 20px;
            margin-top: 20px;
            transition: transform 0.3s; /* Efek transisi */
        }

        .upcoming-classes:hover, .attendance-chart:hover {
            transform: translateY(-5px); /* Efek hover */
        }

        .class {
            margin-bottom: 20px;
        }

        .countdown {
            font-size: 1.5em;
            color: #FF4081; /* Warna untuk hitungan mundur */
            margin: 10px 0;
        }

        .join-class {
            background: #4CAF50; /* Warna tombol */
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s; /* Efek transisi */
        }

        .join-class:hover {
            background: #388E3C; /* Warna saat hover */
            transform: scale(1.05); /* Efek zoom saat hover */
        }

        .attendance-chart {
            margin-top: 20px;
        }

        .summary {
            display: flex;
            justify-content: space-between;
        }

        .summary-item {
            flex: 1;
            margin: 0 10px;
            padding: 20px; /* Padding yang lebih besar */
            background: #e0f7fa; /* Warna latar belakang item ringkasan */
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Bayangan halus */
            transition: transform 0.3s; /* Efek transisi */
        }

        .summary-item:hover {
            transform: translateY(-5px); /* Efek hover */
        }

        .rating {
            font-size: 1.5em; /* Ukuran font rating yang lebih besar */
            color: #FFD700; /* Warna emas untuk rating */
        }
    </style>
</head>
<body>


<section id="sidebar">
	<a href="#" class="brand">
		<img src="../img/BIMBELRAHMA.png" alt="Logo Bimbel Rahma" style="width: 80%; height: auto; margin-top: auto;">
	</a>
	<ul class="side-menu top">
		<li class="active">
			<a href="founder-dashboard.php" >
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
			<a href="../view/jadwal-kelas.php">
				<i class='bx bxs-school'></i>
				<span class="text">Jadwal Kelas</span>
			</a>
		</li>
        <li>
			<a href="../view/jadwal-kelas.php">
				<i class='bx bxs-school'></i>
				<span class="text">Manajemen kehadiran siswa</span>
			</a>
		</li>
        <li>
			<a href="../view/jadwal-kelas.php">
				<i class='bx bxs-school'></i>
				<span class="text">Manajemen nilai siswa</span>
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
        <span class="welcome-message">Selamat Datang, "JANU ROHMANI!"</span>
        <a href="#" class="notification">
            <i class='bx bxs-bell'></i>
            <span class="num">8</span>
        </a>
        <a href="#" class="profile">
            <img src="img/people.png" alt="Profile Picture">
        </a>
    </div>
</nav>

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="#">Home</a>
                        </li>
                    </ul>
                </div>
            </div>

            <section class="upcoming-classes">
        <h2>Kelas yang Akan Datang</h2>
        <div class="class">
            <h3>A3 - LC7 (3) Ujian Akhir</h3>
            <p>Tanggal: Sabtu, 07.12.2025</p>
            <p>Waktu: 14.00 - 14.20</p>
            <div class="countdown" id="countdown"></div>
            <button class="join-class" id="joinClassButton">Gabung Kelas</button>
        </div>
    </section>

    <section class="attendance-chart">
        <h2>Kehadiran Kelas</h2>
        <canvas id="attendanceChart"></canvas>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Hitungan Mundur
    const countdownElement = document.getElementById('countdown');
    const classDate = new Date('2023-12-07T14:00:00'); // Set tanggal dan waktu kelas

    function updateCountdown() {
        const now = new Date();
        const timeRemaining = classDate - now;

        if (timeRemaining < 0) {
            countdownElement.innerHTML = "Kelas telah dimulai!";
            clearInterval(countdownInterval);
            return;
        }

        const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

        countdownElement.innerHTML = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    }

    const countdownInterval = setInterval(updateCountdown, 1000);

    // Grafik Kehadiran
    const ctx = document.getElementById('attendanceChart').getContext('2d');
    const attendanceChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pertemuan 1', 'Pertemuan 2', 'Pertemuan 3', 'Pertemuan 4', 'Pertemuan 5'],
            datasets: [{
                label: 'Kehadiran',
                data: [18, 15, 20, 17, 19], // Data dummy
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Notifikasi saat gabung kelas
    document.getElementById('joinClassButton').addEventListener('click', function() {
        const now = new Date();
        if (classDate > now) {
            Swal.fire({
                icon: 'warning',
                title: 'Maaf!',
                text: 'Kelas belum dimulai!',
            });
        } else {
            Swal.fire({
                icon: 'success',
                title: 'Selamat!',
                text: 'Anda telah bergabung ke dalam kelas.',
            });
        }
    });
</script>

</body>
</html>