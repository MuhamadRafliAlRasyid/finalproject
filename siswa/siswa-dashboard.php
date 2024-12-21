<?php
require_once '../session.php';
 checkPayments();
// Tampilkan data pengguna
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- My CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="..\img\BIMBELRAHMA.png" sizes="32x32">
    <title>Dashboard Siswa - Bimbel Rahma</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }

        .dashboard-content {
            padding: 20px;
        }

        .upcoming-class {
            background: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .upcoming-class h3 {
            margin: 0 0 10px;
        }

        .upcoming-class p {
            margin: 5px 0;
        }

        .join-button {
            background-color: #28a745; /* Green for Join */
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .join-button:hover {
            background-color: #218838; /* Darker green on hover */
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
            text-align: center;
        }

        .card h3 {
            margin-bottom: 10px;
        }

        .notifications {
            background: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .chart-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            background-color: #f9f9f9;
            color: black;
            text-align: center;
            padding: 10px 0;
            width: 100%;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }

        .countdown {
            font-weight: bold;
            color: #dc3545; /* Red color for countdown */
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
            <a href="siswa-dashboard.php">
                <i class='bx bxs-dashboard'></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="kelasku.php">
                <i class='bx bxs-group'></i>
                <span class="text">Kelasku</span>
            </a>
        </li>
        <li>
            <a href="report.php">
                <i class='bx bxs-group'></i>
                <span class="text">Report</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu top">
        <li>
            <a href="../view/setting-profile.php">
                <i class='bx bxs-cog'></i>
                <span class="text">Setting Profiles</span>
            </a>
        </li>
        <li>
            <a href="#" class="logout" onclick="return confirmLogout()">
                <i class='bx bxs-log-out-circle'></i>
                <span class="text">Logout</span>
            </a>
        </li>

        <script>
            function confirmLogout() {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Anda yakin ingin logout?',
                    text: "Anda akan keluar dari akun ini.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Logout!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "../logout.php";
                    }
                })
                return false;
            }
        </script>
    </ul>
</section>

<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <nav style="justify-content:flex-end">
        <div class="nav-right">
            <span class="welcome-message">Selamat Datang, <?php echo htmlspecialchars($user_id); ?>!"</span>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a>
            <a href="#" class="profile">
                <img src="img/people.png" alt="Profile Picture">
            </a>
        </div>
    </nav>

    <main>
        <div class="head-title" id="dashboard">
            <div class="left">
                <h1>Dashboard Siswa</h1>
                <ul class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="#">Home</a></li>
                </ul>
            </div>
        </div>

        <div class="dashboard-content">
            <!-- Upcoming Class Section -->
            <div class="upcoming-class">
                <h3>Kelas yang Akan Datang</h3>
                <p>A3 - LC7 (3) Ujian Akhir</p>
                <p>Tanggal: Sabtu, 07.12.2025</p>
                <p>Waktu: 14.00 - 14.20</p>
                <div class="countdown" id="countdown"></div>
                <button class="join-button" id="joinClassButton">Gabung Kelas</button>
            </div>

            <div class="cards">
                <div class="card">
                    <h3>Kelas yang Akan Datang</h3>
                    <p id="upcoming-classes-count">3</p>
                    <a href="kelasku.php" class="btn">Lihat Kelas</a>
                </div>
                <div class="card">
                    <h3>Kehadiran Siswa</h3>
                    <p id="attendance-status">80%</p>
                    <a href="attendance.php" class="btn">Lihat Kehadiran</a>
                </div>
            </div>

            <div class="chart-container">
                <div class="chart" style="width: 48%;">
                    <canvas id="attendanceChart"></canvas>
                </div>
                <div class="chart" style="width: 48%;">
                    <canvas id="remainingClassesChart"></canvas>
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
    </main>
</section>

<!-- Footer -->
<footer>
    <p>&copy; 2024 Bimbel Rahma. All rights reserved.</p>
</footer>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Attendance Chart
    const ctxAttendance = document.getElementById('attendanceChart').getContext('2d');
    const attendanceChart = new Chart(ctxAttendance, {
        type: 'bar',
        data: {
            labels: ['Jadwal', 'Hadir', 'Tidak Hadir'],
            datasets: [{
                label: 'Kehadiran',
                data: [10, 8, 2], // Example data
                backgroundColor: [
                    'rgba(0, 123, 255, 0.6)', // Scheduled
                    'rgba(40, 167, 69, 0.6)', // Present
                    'rgba(220, 53, 69, 0.6)'  // Absent
                ],
                borderColor: [
                    'rgba(0, 123, 255, 1)',
                    'rgba(40, 167, 69, 1)',
                    'rgba(220, 53, 69, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah'
                    }
                }
            }
        }
    });

    // Remaining Classes Chart
    const ctxRemainingClasses = document.getElementById('remainingClassesChart').getContext('2d');
    const remainingClassesChart = new Chart(ctxRemainingClasses, {
        type: 'pie',
        data: {
            labels: ['Sisa Pertemuan', 'Pertemuan Selesai'],
            datasets: [{
                label: 'Kelas',
                data: [5, 3], // Example data
                backgroundColor: [
                    'rgba(255, 193, 7, 0.6)', // Remaining
                    'rgba(40, 167, 69, 0.6)'  // Completed
                ],
                borderColor: [
                    'rgba(255, 193, 7, 1)',
                    'rgba(40, 167, 69, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Sisa Pertemuan'
                }
            }
        }
    });

    // Update live counting for upcoming classes
    document.getElementById('upcoming-classes-count').innerText = 3; // Example count
    document.getElementById('attendance-status').innerText = '80%'; // Example attendance

    // Countdown Timer
    const countdownElement = document.getElementById('countdown');
    const classDate = new Date('2025-12-07T14:00:00'); // Set the class date and time

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
