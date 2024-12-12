<?php
// Include file auth.php
require_once '../session.php';

// Periksa apakah sudah login
checkLogin();

checkRole(['founder']);

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
	<title>Dashboard Founder - Bimbel Rahma</title>
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
			<a href="../view/data-pengajar.php" >
				<i class='bx bxs-group'></i>
				<span class="text">Data Pengajar</span>
			</a>
		</li>
		<li>
			<a href="../view/jadwal-kelas.php">
				<i class='bx bxs-school'></i>
				<span class="text">Rincian Harga Kursus</span>
			</a>
		</li>
		<li>
			<a href="../view/pembayaran.php" >
				<i class='bx bxs-dollar-circle'></i>
				<span class="text">Pembayaran</span>
			</a>
		</li>
        <li>
			<a href="../view/user-management.php" >
				<i class='bx bxs-group'></i>
				<span class="text">User Management</span>
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

    <ul class="box-info">
        <li>
            <i class='bx bxs-group'></i>
            <span class="text">
                <h3>45</h3>
                <p>Total Pengajar</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-group'></i>
            <span class="text">
                <h3>1200</h3>
                <p>Total Students</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-dollar-circle'></i>
            <span class="text">
                <h3>50</h3>
                <p>Pembayaran Pending</p>
            </span>
        </li>
    </ul>

    <div class="table-data">
        <!-- Recent Enrollments -->
        <div class="order">
            <div class="head">
                <h3>Pendaftaran Terbaru</h3>
                <i class='bx bx-search'></i>
                <i class='bx bx-filter'></i>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Course</th>
                        <th>Date Enrolled</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="img/people.png"><p>Jane Smith</p></td>
                        <td>Web Development</td>
                        <td>11-20-2024</td>
                        <td><span class="status completed">Completed</span></td>
                    </tr>
                    <tr>
                        <td><img src="img/people.png"><p>Mark Lee</p></td>
                        <td>Data Science</td>
                        <td>11-19-2024</td>
                        <td><span class="status pending">Pending</span></td>
                    </tr>
                    <tr>
                        <td><img src="img/people.png"><p>Linda Brown</p></td>
                        <td>Graphic Design</td>
                        <td>11-18-2024</td>
                        <td><span class="status process">In Progress</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Financial Overview -->
        <div class="order">
            <div class="head">
                <h3>Pembayaran Terbaru</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="img/people.png"><p>Jane Smith</p></td>
                        <td>$250</td>
                        <td>11-20-2024</td>
                        <td><span class="status completed">Paid</span></td>
                    </tr>
                    <tr>
                        <td><img src="img/people.png"><p>Mark Lee</p></td>
                        <td>$180</td>
                        <td>11-19-2024</td>
                        <td><span class="status pending">Pending</span></td>
                    </tr>
                    <tr>
                        <td><img src="img/people.png"><p>Linda Brown</p></td>
                        <td>$300</td>
                        <td>11-18-2024</td>
                        <td><span class="status completed">Paid</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
	 <!-- Kehadiran Section -->
	 <div class="charts">
        <div class="chart-container">
            <h3>Kehadiran Siswa</h3>
            <canvas id="studentAttendance"></canvas>
        </div>
        <div class="chart-container">
            <h3>Kehadiran Pengajar</h3>
            <canvas id="teacherAttendance"></canvas>
        </div>
    </div>
	
</main>

	<!-- CONTENT -->
	

	<script src="script.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script>
    // Data Kehadiran Siswa
    const studentAttendanceCtx = document.getElementById('studentAttendance').getContext('2d');
    const studentAttendanceChart = new Chart(studentAttendanceCtx, {
        type: 'bar',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'],
            datasets: [{
                label: 'Jumlah Kehadiran',
                data: [120, 100, 115, 110, 130], // Contoh data
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
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

    // Data Kehadiran Pengajar
    const teacherAttendanceCtx = document.getElementById('teacherAttendance').getContext('2d');
    const teacherAttendanceChart = new Chart(teacherAttendanceCtx, {
        type: 'line',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'],
            datasets: [{
                label: 'Jumlah Kehadiran',
                data: [15, 14, 13, 15, 14], // Contoh data
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
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
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const sidebarLinks = document.querySelectorAll("#sidebar a[data-target]"); // Semua link di sidebar
    const contentDiv = document.getElementById("main-content"); // Div utama untuk konten

    sidebarLinks.forEach(link => {
        link.addEventListener("click", function (e) {
            e.preventDefault(); // Cegah perilaku klik default
            
            // Hapus kelas 'active' dari semua link
            sidebarLinks.forEach(item => item.parentElement.classList.remove("active"));

            // Tambahkan kelas 'active' ke link yang diklik
            this.parentElement.classList.add("active");

            // Ambil target file dari data-target
            const target = this.getAttribute("data-target");

            // Fetch konten dari target
            fetch(target)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Gagal memuat halaman.");
                    }
                    return response.text();
                })
                .then(html => {
                    // Ganti konten di main-content
                    contentDiv.innerHTML = html;
                })
                .catch(err => {
                    // Tampilkan pesan error
                    contentDiv.innerHTML = `<p>Error: ${err.message}</p>`;
                });
        });
    });
});
</script>


</body>
</html>