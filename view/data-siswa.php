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
	<title>Data Siswa - Bimbel Rahma</title>
    
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
        <li>
            <a href="../admin/admin-dashboard.php">
				<i class='bx bxs-dashboard'></i>
				<span class="text">Dashboard</span>
			</a>
		</li>
		<li class="active">
			<a href="data-siswa.php">
				<i class='bx bxs-group'></i>
				<span class="text">Data Siswa</span>
			</a>
		</li>
		<li>
			<a href="data-pengajar.php" data-target="data-pengajar">
				<i class='bx bxs-group'></i>
				<span class="text">Data Pengajar</span>
			</a>
		</li>
		<li>
			<a href="jadwal-kelas.php" data-target="jadwal-kelas">
				<i class='bx bxs-school'></i>
				<span class="text">Jadwal Kelas</span>
			</a>
		</li>
		<li>
			<a href="pembayaran.php" data-target="pembayaran">
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
			<a href="setting-profile.php" >
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
    <!-- Dashboard Section -->

<main>
<div class="head-title" id="dashboard">
        <div class="left">
            <h1>Data Siswa</h1>
            <ul class="breadcrumb">
                <li><a href="#">Data Siswa</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">Siswa</a></li>
            </ul>
        </div>
    </div>


    <div class="table-data">
    <div class="order">
        <div class="head">

            <div class="search-container">
                <input type="text" id="search-input" placeholder="Cari...">
                <button id="search-button"><i class='bx bx-search'></i></button>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>No Telepon</th>
                    <th>Aksi</th> <!-- Kolom untuk tombol Aksi -->
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>John Doe</td>
                    <td>Web Development</td>
                    <td>08123456789</td>
                    <td class="action-buttons">
                        <button class="edit-button"><i class='bx bxs-edit'></i></button>
                        <button class="delete-button"><i class='bx bxs-trash'></i></button>
                        <div class="toggle-container">
                        <label class="switch">
                            <input type="checkbox" id="toggle-switch">
                            <span class="slider"></span>
                        </label>
                        <span id="toggle-status">OFF</span>
                    </div>
                    
                    </td>
                </tr>
                <tr>                    
                    <td>Jane Smith</td>
                    <td>Mobile Development</td>
                    <td>08123456789</td>
                    <td class="action-buttons">
                        <button class="edit-button"><i class='bx bxs-edit'></i></button>
                        <button class="delete-button"><i class='bx bxs-trash'></i></button>
                        <label class="switch">
                            <input type="checkbox" id="toggle-switch">
                            <span class="slider"></span>
                        </label>
                        <span id="toggle-status">OFF</span>
                    </div>
                    </td>
                </tr>
                <tr>
                    <td>Michael Johnson</td>
                    <td>Web Design</td>
                    <td>08123456789</td>
                    <td class="action-buttons">
                        <button class="edit-button"><i class='bx bxs-edit'></i></button>
                        <button class="delete-button"><i class='bx bxs-trash'></i></button>
                        <label class="switch">
                            <input type="checkbox" id="toggle-switch">
                            <span class="slider"></span>
                        </label>
                        <span id="toggle-status">OFF</span>
                    </div>
                    </td>
                </tr>
                <tr>
                    <td>Sarah Lee</td>                      
                    <td>Mobile Development</td>
                    <td>08123456789</td>
                    <td class="action-buttons">
                        <button class="edit-button"><i class='bx bxs-edit'></i></button>
                        <button class="delete-button"><i class='bx bxs-trash'></i></button>
                        
                    </td>
                </tr>
                <tr>
                    <td>David Kim</td>
                    <td>Web Development</td>
                    <td>08123456789</td>
                    <td class="action-buttons">
                        <button class="edit-button"><i class='bx bxs-edit'></i></button>
                        <button class="delete-button"><i class='bx bxs-trash'></i></button>
                    </td>
                </tr>
                <tr>
                    <td>Emily Davis</td>
                    <td>Mobile Development</td>
                    <td>08123456789</td>
                    <td class="action-buttons">
                        <button class="edit-button"><i class='bx bxs-edit'></i></button>
                        <button class="delete-button"><i class='bx bxs-trash'></i></button>
                    </td>
                </tr>
                <tr>
                    <td>Robert Wilson</td>
                    <td>Web Design</td>
                    <td>08123456789</td>                    
                    <td class="action-buttons">
                        <button class="edit-button"><i class='bx bxs-edit'></i></button>
                        <button class="delete-button"><i class='bx bxs-trash'></i></button>
                    </td>
                </tr>
                <tr>
                    <td>Robert Wilson</td>
                    <td>Web Design</td>
                    <td>08123456789</td>                    
                    <td class="action-buttons">
                        <button class="edit-button"><i class='bx bxs-edit'></i></button>
                        <button class="delete-button"><i class='bx bxs-trash'></i></button>
                    </td>
                </tr>
                <tr>
                    <td>Robert Wilson</td>
                    <td>Web Design</td>
                    <td>08123456789</td>                    
                    <td class="action-buttons">
                        <button class="edit-button"><i class='bx bxs-edit'></i></button>
                        <button class="delete-button"><i class='bx bxs-trash'></i></button>
                    </td>
                </tr>
                <tr>
                    <td>Robert Wilson</td>
                    <td>Web Design</td>
                    <td>08123456789</td>                    
                    <td class="action-buttons">
                        <button class="edit-button"><i class='bx bxs-edit'></i></button>
                        <button class="delete-button"><i class='bx bxs-trash'></i></button>
                    </td>
                </tr>
                <tr>
                    <td>Robert Wilson</td>
                    <td>Web Design</td>
                    <td>08123456789</td>                    
                    <td class="action-buttons">
                        <button class="edit-button"><i class='bx bxs-edit'></i></button>
                        <button class="delete-button"><i class='bx bxs-trash'></i></button>
                    </td>
                </tr>
                <tr>
                    <td>Robert Wilson</td>
                    <td>Web Design</td>
                    <td>08123456789</td>                    
                    <td class="action-buttons">
                        <button class="edit-button"><i class='bx bxs-edit'></i></button>
                        <button class="delete-button"><i class='bx bxs-trash'></i></button>
                    </td>
                </tr>
                <tr>
                    <td>Maria Rodriguez</td>
                    <td>Mobile Development</td>                     
                    <td>08123456789</td>
                    <td class="action-buttons">
                        <button class="edit-button"><i class='bx bxs-edit'></i></button>
                        <button class="delete-button"><i class='bx bxs-trash'></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</main>


<script>
    document.getElementById('toggle-switch').addEventListener('change', function() {
        const status = document.getElementById('toggle-status');
        if (this.checked) {
            status.textContent = 'ON';
        } else {
            status.textContent = 'OFF';
        }
    });
</script>
</body>
</html>