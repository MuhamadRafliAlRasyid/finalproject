<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="../admin/style.css">
    <link rel="icon" href="..\img\BIMBELRAHMA.png" sizes="32x32">
    <title>Reporting Siswa - Bimbel Rahma</title>
    
    <style>
        /* Existing styles... */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensures the footer stays at the bottom */
            font-family: 'Arial', sans-serif; /* Improved font */
            background-color: #f4f4f4; /* Light background for contrast */
        }

        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        input[type="text"] {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .table-data {
            margin-top: 20px;
            flex: 1; /* Allows the table data to grow and push the footer down */
        }

        .chart-container {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .chart {
            width: 48%; /* Adjust width for two charts side by side */
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
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
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1); /* Shadow for footer */
        }
    </style>
</head>
<body>

<section id="sidebar">
    <a href="#" class="brand">
        <img src="../img/BIMBELRAHMA.png" alt="Logo Bimbel Rahma" style="width: 80%; height: auto; margin-top: auto;">
    </a>
    <ul class="side-menu top">
        <li>
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
        <li class="active">
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

    <main>
        <div class="head-title" id="dashboard">
            <div class="left">
                <h1>Report Siswa</h1>
                <ul class="breadcrumb">
                    <li><a href="#">Report siswa</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                </ul>
            </div>
        </div>

        <div class="table-data">
            <div class="order">
                <div class="head">
                    <div class="search-container">
                        
                    </div>
                </div>

                <!-- Charts for Student Progress and Attendance -->
                <div class="chart-container">
                    <div class="chart" id="progressChartContainer">
                        <canvas id="progressChart"></canvas>
                    </div>
                    <div class="chart" id="attendanceChartContainer">
                        <canvas id="attendanceChart"></canvas>
                    </div>
                </div>
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
    // Student Progress Chart
    const ctxProgress = document.getElementById('progressChart').getContext('2d');
    const progressChart = new Chart(ctxProgress, {
        type: 'bar',
        data: {
            labels: ['Matematika', 'Bahasa Inggris', 'Fisika', 'Kimia'],
            datasets: [{
                label: 'Nilai',
                data: [90, 85, 78, 92],
                backgroundColor: 'rgba(0, 123, 255, 0.6)',
                borderColor: 'rgba(0, 123, 255, 1)',
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
                        text: 'Nilai'
                    }
                }
            }
        }
    });

    // Attendance Chart
    const ctxAttendance = document.getElementById('attendanceChart').getContext('2d');
    const attendanceChart = new Chart(ctxAttendance, {
        type: 'pie',
        data: {
            labels: ['Hadir', 'Tidak Hadir'],
            datasets: [{
                label: 'Kehadiran',
                data: [4, 1], // Example data
                backgroundColor: [
                    'rgba(40, 167, 69, 0.6)', // Green for Hadir
                    'rgba(220, 53, 69, 0.6)'  // Red for Tidak Hadir
                ],
                borderColor: [
                    'rgba(40, 167, 69, 1)',
                    'rgba(220, 53, 69, 1)'
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
                    text: 'Manajemen Kehadiran'
                }
            }
        }
    });
</script>

</body>
</html>
