<?php 
require_once '../service/database.php';

// Include file session.php
require_once '../session.php';

// Periksa login
checkLogin();

// Debug koneksi database
if (!isset($db)) {
    die("Variabel \$db tidak tersedia. Pastikan file database.php sudah di-*include* dengan benar.");
}

// Query data materi
$sql = "SELECT * FROM materi";
$result = $db->query($sql);

if (!$result) {
    die("Gagal mengambil data: " . $db->error);
}

$materi_data = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $materi_data[] = $row;
    }
}
$pengenalan = array_filter($materi_data, function($item) {
    return strtolower($item['kategori']) === 'pengenalan';
});

$pertemuan = array_filter($materi_data, function($item) {
    return strtolower($item['kategori']) === 'pertemuan';
});
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
    <link rel="stylesheet" href="../admin/style.css">
    <link rel="icon" href="..\img\BIMBELRAHMA.png" sizes="32x32">
    <title>Kelasku - Bimbel Rahma</title>
    
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
            transition: border-color 0.3s;
        }

        input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Added shadow */
        }

        button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .table-data {
            margin-top: 20px;
            flex: 1; /* Allows the table data to grow and push the footer down */
        }

        .accordion {
            background-color: #ffffff; /* White background for accordion */
            border-radius: 10px; /* Increased border radius */
            margin-top: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Deeper shadow */
            padding: 10px; /* Added padding */
        }

        .accordion-item {
            border-bottom: 1px solid #ccc;
            margin-bottom: 10px; /* Added margin between items */
            border-radius: 8px; /* Rounded corners for items */
            overflow: hidden; /* Prevents overflow */
        }

        .accordion-header {
            padding: 15px;
            cursor: pointer;
            background-color: #007bff; /* Header background */
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.3s;
            border-radius: 8px; /* Rounded corners for header */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Shadow for header */
        }

        .accordion-content {
            padding: 0 15px; /* Added padding for content */
            max-height: 0; /* Hidden by default */
            overflow: hidden; /* Prevents overflow */
            background-color: white;
            transition: max-height 0.3s ease, padding 0.3s ease; /* Smooth transition */
        }

        .accordion-content p {
            margin: 15px 0; /* Margin for paragraph */
        }

        .accordion-header:hover {
            background-color: #0056b3; /* Darker on hover */
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
        <li class="active">
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
                <h1>Kelasku</h1>
                <ul class="breadcrumb">
                    <li><a href="#">Kelasku</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                </ul>
            </div>
        </div>

        <div class="table-data">
            <div class="order">
                <div class="head">
                    <div class="search-container">
                        <h2 id="welcome-message"></h2>
                        <script>
                            // Typing animation for the welcome message
                            const message = "Selamat Datang di Kelas Anda";
                            let index = 0;
                            function typeWriter() {
                                if (index < message.length) {
                                    document.getElementById("welcome-message").innerHTML += message.charAt(index);
                                    index++;
                                    setTimeout(typeWriter, 100); // Adjust typing speed by changing the timeout duration
                                }
                            }
                            typeWriter();
                        </script>
                    </div>
                </div>
                
                <!-- Accordion for Course Content -->
                <!-- Pengenalan -->
                <h2>Pengenalan</h2>
                <div class="accordion">
                    <?php foreach ($pengenalan as $materi): ?>
                        <div class="accordion-item">
                            <div class="accordion-header">
                                <h3><?= htmlspecialchars($materi['title']) ?></h3>
                                <i class='bx bx-chevron-down'></i>
                            </div>
                            <div class="accordion-content">
                                <p><?= nl2br(htmlspecialchars($materi['content'])) ?></p>
                                <p><?php if (!empty($materi['file_url'])): ?>
                                <a href="../uploads/materi/<?= htmlspecialchars($materi['file_url']) ?>" target="_blank"><?= htmlspecialchars($materi['file_url']) ?></a>
                            <?php else: ?>
                                Tidak ada file
                            <?php endif; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pertemuan -->
                <h2>Pertemuan</h2>
                <div class="accordion">
                    <?php foreach ($pertemuan as $materi): ?>
                        <div class="accordion-item">
                            <div class="accordion-header">
                                <h3><?= htmlspecialchars($materi['title']) ?></h3>
                                <i class='bx bx-chevron-down'></i>
                            </div>
                            <div class="accordion-content">
                                <p><?= nl2br(htmlspecialchars($materi['content'])) ?></p>
                                <p><?php if (!empty($materi['file_url'])): ?>
                                <a href="../uploads/materi/<?= htmlspecialchars($materi['file_url']) ?>" target="_blank"><?= htmlspecialchars($materi['file_url']) ?></a>
                            <?php else: ?>
                                Tidak ada file
                            <?php endif; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
        </div>
    </main>
</section>

<!-- Footer -->
<footer>
    <p>&copy; 2024 Bimbel Rahma. All rights reserved.</p>
</footer>

<script>
    // JavaScript for accordion functionality
    document.querySelectorAll('.accordion-header').forEach(header => {
        header.addEventListener('click', () => {
            const content = header.nextElementSibling;
            const isOpen = content.style.maxHeight;

            // Close all other accordion items
            document.querySelectorAll('.accordion-content').forEach(item => {
                item.style.maxHeight = null;
            });

            // Toggle the clicked accordion item
            if (isOpen) {
                content.style.maxHeight = null;
                header.querySelector('i').classList.toggle('bx-chevron-down');
                header.querySelector('i').classList.toggle('bx-chevron-up');
            } else {
                content.style.maxHeight = content.scrollHeight + "px"; // Set to the scroll height for smooth opening
                header.querySelector('i').classList.toggle('bx-chevron-down');
                header.querySelector('i').classList.toggle('bx-chevron-up');
            }
        });
    });
</script>

</body>
</html>
