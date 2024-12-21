<?php
// Include file auth.php
require_once '../session.php';
// Periksa apakah sudah login
checkLogin();

// Periksa apakah pengguna memiliki role 'admin'
checkRole(['admin']);
$sql = "SELECT u.id, u.username AS nama, u.email, r.role AS role
        FROM users u
        JOIN users_role r ON u.role_id = r.id  WHERE u.role_id =2";
$result = mysqli_query($db, $sql); // Eksekusi query

// Jika lolos, tampilkan konten halaman admin
echo "Selamat datang, Admin " . $_SESSION['username'];
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
    <link rel="stylesheet" href="../admin/style.css">
	<link rel="icon" href="..\img\BIMBELRAHMA.png" sizes="32x32">
	<title>Dashboard Founder - Bimbel Rahma</title>
</head>
<style>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .edit-button {
            background-color: #28a745; /* Hijau untuk Edit */
            color: white;
            border: none;
            padding: 5px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .delete-button {
            background-color: #dc3545; /* Merah untuk Hapus */
            color: white;
            border: none;
            padding: 5px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .edit-button:hover {
            background-color: #218838; /* Warna lebih gelap saat hover */
        }

        .delete-button:hover {
            background-color: #c82333; /* Warna lebih gelap saat hover */
        }

        .toggle-container {
            display: flex;
            align-items: center;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 40px; /* Lebar saklar */
            height: 20px; /* Tinggi saklar */
            margin-right: 10px; /* Jarak antara saklar dan teks */
        }

        .switch input {
            opacity: 0; /* Sembunyikan input checkbox */
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc; /* Warna latar belakang saat OFF */
            transition: .4s;
            border-radius: 34px; /* Membuat sudut bulat */
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px; /* Tinggi lingkaran */
            width: 16px; /* Lebar lingkaran */
            left: 2px; /* Jarak dari kiri */
            bottom: 2px; /* Jarak dari bawah */
            background-color: white; /* Warna lingkaran */
            transition: .4s;
            border-radius: 50%; /* Membuat lingkaran */
        }

        input:checked + .slider {
            background-color: #4CAF50; /* Warna saat ON */
        }

        input:checked + .slider:before {
            transform: translateX(20px); /* Geser lingkaran saat ON */
        }
        .status-paid {
    color: green;
    font-weight: bold;
}

.status-unpaid {
    color: red;
    font-weight: bold;
}

.add-button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.add-button:hover {
    background-color: #0056b3;
}

    </style>
<body>


<section id="sidebar">
	<a href="#" class="brand">
		<img src="../img/BIMBELRAHMA.png" alt="Logo Bimbel Rahma" style="width: 80%; height: auto; margin-top: auto;">
	</a>
	<ul class="side-menu top">
		<li class="active">
        <a href="../admin/admin-dashboard.php">
				<i class='bx bxs-dashboard'></i>
				<span class="text">Dashboard</span>
			</a>
		</li>
		<li>
			<a href="../view/data-siswa.php">
				<i class='bx bxs-group'></i>
				<span class="text">Data Siswa</span>
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
				<span class="text">Jadwal Kelas</span>
			</a>
		</li>
		<li>
			<a href="../view/pembayaran.php" >
				<i class='bx bxs-dollar-circle'></i>
				<span class="text">Pembayaran</span>
			</a>
		</li>
        <li class="active">
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
            <h1>User Management</h1>
            <ul class="breadcrumb">
                <li><a href="#">User Management</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">User</a></li>
            </ul>
        </div>
    </div>

    <div class="table-data">
        <div class="order">
            <div class="head">
                <div class="search-container">
                    <input type="text" id="search-input" placeholder="Cari...">
                    <button id="search-button"><i class='bx bx-search'></i></button>
                    <a href="register_guru.php"><button class="btn btn-primary" id="addMaterialBtn">+ Tambah Akun</button></a>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
            if ($result && mysqli_num_rows($result) > 0) {
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                    echo "<td>
                            <button class='btn btn-warning btn-sm edit-button'><i class='bx bxs-edit'></i></button>
                            <button class='btn btn-danger btn-sm delete-button'><i class='bx bxs-trash'></i></button>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>Tidak ada data</td></tr>";
            }
            ?>
        </tbody>

</body>
</html>