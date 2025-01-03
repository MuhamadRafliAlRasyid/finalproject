<?php
// Include database connection
include 'service/database.php'; // Ensure you have a file for database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $material_id = $_POST['material_id'] ?? null; // Use null coalescing operator for safety
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $type = $_POST['type'] ?? '';
    $file_url = null;

    // Upload file if exists
    if (isset($_FILES['file']) && $_FILES['file']['name'] !== '') {
        $target_dir = "uploads/materi/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['pdf', 'doc', 'docx']; // Allowed file types

        // Validate file type and size
        if (in_array($file_type, $allowed_types) && $_FILES["file"]["size"] < 5000000) { // Limit size to 5MB
            // Create the uploads directory if it doesn't exist
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                $file_url = $target_file;
            } else {
                echo "<script>alert('File upload failed!');</script>";
                exit; // Stop execution if file upload fails
            }
        } else {
            echo "<script>alert('Invalid file type or size!');</script>";
            exit; // Stop execution if validation fails
        }
    }

    // Prepare SQL statement based on whether we are editing or adding
    if ($material_id) {
        // Edit Material
        $sql = "UPDATE materials SET title = ?, content = ?, type = ?, file_url = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ssssi", $title, $content, $type, $file_url, $material_id);
            $stmt->execute();
            echo "<script>alert('Materi berhasil diperbarui!');</script>";
            $stmt->close();
        } else {
            echo "<script>alert('Error preparing statement for update!');</script>";
        }
    } else {
        // Add New Material
        $sql = "INSERT INTO materials (title, content, type, file_url) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ssss", $title, $content, $type, $file_url);
            $stmt->execute();
            echo "<script>alert('Materi berhasil ditambahkan!');</script>";
            $stmt->close();
        } else {
            echo "<script>alert('Error preparing statement for insert!');</script>";
        }
    }
}
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
    <link rel="stylesheet" href="/admin/style.css">
    <link rel="icon" href="..\img\BIMBELRAHMA.png" sizes="32x32">
    <title>Kelasku - Bimbel Rahma</title>
    
    <style>
        /* Existing styles... */
        @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap');

* {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
}

a {
	text-decoration: none;
}

li {
	list-style: none;
}

:root {
	--poppins: 'Poppins', sans-serif;
	--lato: 'Lato', sans-serif;

	--light: #F9F9F9;
	--light-blue: #CFE8FF;
	--grey: #eee;
	--dark-grey: #AAAAAA;
	--dark: #342E37;
	--red: #DB504A;
	--yellow: #FFCE26;
	--light-yellow: #FFF2C6;
	--orange: #FD7238;
	--light-orange: #FFE0D3;
}

html {
	overflow-x: hidden;
}

body.dark {
	--light: #0C0C1E;
	--grey: #060714;
	--dark: #FBFBFB;
}

body {
	background: var(--grey);
	overflow-x: hidden;
}





/* SIDEBAR */
#sidebar .brand img {
    margin-top: 20px; /* Adjust this value as needed */
}
#sidebar {
	position: fixed;
	top: 0;
	left: 0;
	width: 280px;
	height: 100%;
	background: var(--light);
	z-index: 2000;
	font-family: var(--lato);
	transition: .3s ease;
	overflow-x: hidden;
	scrollbar-width: none;
}
#sidebar::--webkit-scrollbar {
	display: none;
}
#sidebar.hide {
	width: 60px;
}
#sidebar .brand {
	font-size: 24px;
	font-weight: 700;
	height: 56px;
	display: flex;
	align-items: center;
	color: #020e49;
	position: sticky;
	top: 0;
	left: 0;
	background: var(--light);
	z-index: 500;
	padding-bottom: 0px;
	box-sizing: content-box;
	padding-top: 10px; /* Jika gambar masih terlalu dekat */
    display: block; /* Agar lebih teratur */
}
#sidebar .brand .bx {
	min-width: 1pppx;
	display: flex;
	justify-content: center;
}
#sidebar .side-menu {
	width: 100%;
	margin-top: 48px;
}
#sidebar .side-menu li {
	height: 48px;
	background: transparent;
	margin-left: 6px;
	border-radius: 48px 0 0 48px;
	padding: 4px;
}
#sidebar .side-menu li.active {
	background: var(--grey);
	position: relative;
}
#sidebar .side-menu li.active::before {
	content: '';
	position: absolute;
	width: 40px;
	height: 40px;
	border-radius: 50%;
	top: -40px;
	right: 0;
	box-shadow: 20px 20px 0 var(--grey);
	z-index: -1;
}
#sidebar .side-menu li.active::after {
	content: '';
	position: absolute;
	width: 40px;
	height: 40px;
	border-radius: 50%;
	bottom: -40px;
	right: 0;
	box-shadow: 20px -20px 0 var(--grey);
	z-index: -1;
}
#sidebar .side-menu li a {
	width: 100%;
	height: 100%;
	background: var(--light);
	display: flex;
	align-items: center;
	border-radius: 48px;
	font-size: 16px;
	color: var(--dark);
	white-space: nowrap;
	overflow-x: hidden;
}
#sidebar .side-menu.top li.active a {
	color: #020e49; 
}
#sidebar.hide .side-menu li a {
	width: calc(48px - (4px * 2));
	transition: width .3s ease;
}
#sidebar .side-menu li a.logout {
	color: var(--red);
}
#sidebar .side-menu.top li a:hover {
	color: #020e49; 
}
#sidebar .side-menu li a .bx {
	min-width: calc(60px  - ((4px + 6px) * 2));
	display: flex;
	justify-content: center;
}
/* SIDEBAR */





/* CONTENT */
#content {
	position: relative;
	width: calc(100% - 280px);
	left: 280px;
	transition: .3s ease;
}
#sidebar.hide ~ #content {
	width: calc(100% - 60px);
	left: 60px;
}




/* NAVBAR */
/* Style untuk Navbar */
nav {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding: 10px 20px;
    background-color: #f4f4f4; /* Sesuaikan dengan tema */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Wrapper untuk elemen di sebelah kanan */
.nav-right {
    display: flex;
    align-items: center;
    gap: 15px; /* Spasi antar elemen */
}

/* Gaya untuk Pesan Selamat Datang */
.welcome-message {
    font-size: 1rem;
    color: #555; /* Sesuaikan warna */
    font-weight: 500;
}

/* Gaya untuk Notifikasi */
.notification {
    position: relative;
    font-size: 1.5rem;
    color: #555; /* Sesuaikan warna */
    cursor: pointer;
    text-decoration: none;
}

.notification .num {
    position: absolute;
    top: -5px;
    right: -5px;
    background-color: red;
    color: white;
    font-size: 0.75rem;
    padding: 2px 6px;
    border-radius: 50%;
}
/* CHART */

.charts {
    display: flex;
    gap: 20px;
    justify-content: space-between;
    margin-top: 20px;
}

.chart-container {
    flex: 1;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.chart-container h3 {
    margin-bottom: 20px;
    text-align: center;
}

/* Gaya untuk Profil */
.profile {
    display: flex;
    align-items: center;
}

.profile img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

.logo {
    margin-top: 20px; /* Sesuaikan nilainya sesuai kebutuhan */
    padding-top: 10px; /* Jika diperlukan */
}

#content nav {
	height: 56px;
	background: var(--light);
	padding: 0 24px;
	display: flex;
	align-items: center;
	grid-gap: 24px;
	font-family: var(--lato);
	position: sticky;
	top: 0;
	left: 0;
	z-index: 1000;
}
#content nav::before {
	content: '';
	position: absolute;
	width: 40px;
	height: 40px;
	bottom: -40px;
	left: 0;
	border-radius: 50%;
	box-shadow: -20px -20px 0 var(--light);
}
#content nav a {
	color: var(--dark);
}
#content nav .bx.bx-menu {
	cursor: pointer;
	color: var(--dark);
}
#content nav .nav-link {
	font-size: 16px;
	transition: .3s ease;
}
#content nav .nav-link:hover {
	color: #020e49;
}
#content nav form {
	max-width: 400px;
	width: 100%;
	margin-right: auto;
}
#content nav form .form-input {
	display: flex;
	align-items: center;
	height: 36px;
}
#content nav form .form-input input {
	flex-grow: 1;
	padding: 0 16px;
	height: 100%;
	border: none;
	background: var(--grey);
	border-radius: 36px 0 0 36px;
	outline: none;
	width: 100%;
	color: var(--dark);
}
#content nav form .form-input button {
	width: 36px;
	height: 100%;
	display: flex;
	justify-content: center;
	align-items: center;
	background: #020e49;
	color: var(--light);
	font-size: 18px;
	border: none;
	outline: none;
	border-radius: 0 36px 36px 0;
	cursor: pointer;
}
#content nav .notification {
	font-size: 20px;
	position: relative;
}
#content nav .notification .num {
	position: absolute;
	top: -6px;
	right: -6px;
	width: 20px;
	height: 20px;
	border-radius: 50%;
	border: 2px solid var(--light);
	background: var(--red);
	color: var(--light);
	font-weight: 700;
	font-size: 12px;
	display: flex;
	justify-content: center;
	align-items: center;
}
#content nav .profile img {
	width: 36px;
	height: 36px;
	object-fit: cover;
	border-radius: 50%;
}
#content nav .switch-mode {
	display: block;
	min-width: 50px;
	height: 25px;
	border-radius: 25px;
	background: var(--grey);
	cursor: pointer;
	position: relative;
}
#content nav .switch-mode::before {
	content: '';
	position: absolute;
	top: 2px;
	left: 2px;
	bottom: 2px;
	width: calc(25px - 4px);
	background: #020e49;
	border-radius: 50%;
	transition: all .3s ease;
}
#content nav #switch-mode:checked + .switch-mode::before {
	left: calc(100% - (25px - 4px) - 2px);
}
/* NAVBAR */





/* MAIN */
#content main {
	width: 100%;
	padding: 36px 24px;
	font-family: var(--poppins);
	max-height: calc(100vh - 56px);
	overflow-y: auto;
}
#content main .head-title {
	display: flex;
	align-items: center;
	justify-content: space-between;
	grid-gap: 16px;
	flex-wrap: wrap;
}
#content main .head-title .left h1 {
	font-size: 36px;
	font-weight: 600;
	margin-bottom: 10px;
	color: var(--dark);
}
#content main .head-title .left .breadcrumb {
	display: flex;
	align-items: center;
	grid-gap: 16px;
}
#content main .head-title .left .breadcrumb li {
	color: var(--dark);
}
#content main .head-title .left .breadcrumb li a {
	color: var(--dark-grey);
	pointer-events: none;
}
#content main .head-title .left .breadcrumb li a.active {
	color: #020e49;
	pointer-events: unset;
}
#content main .head-title .btn-download {
	height: 36px;
	padding: 0 16px;
	border-radius: 36px;
	background: #020e49;
	color: var(--light);
	display: flex;
	justify-content: center;
	align-items: center;
	grid-gap: 10px;
	font-weight: 500;
}




#content main .box-info {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
	grid-gap: 24px;
	margin-top: 36px;
}
#content main .box-info li {
	padding: 24px;
	background: var(--light);
	border-radius: 20px;
	display: flex;
	align-items: center;
	grid-gap: 24px;
}
#content main .box-info li .bx {
	width: 80px;
	height: 80px;
	border-radius: 10px;
	font-size: 36px;
	display: flex;
	justify-content: center;
	align-items: center;
}
#content main .box-info li:nth-child(1) .bx {
	background: var(--light-blue);
	color: #020e49; 
}
#content main .box-info li:nth-child(2) .bx {
	background: var(--light-yellow);
	color: var(--yellow);
}
#content main .box-info li:nth-child(3) .bx {
	background: var(--light-orange);
	color: var(--orange);
}
#content main .box-info li .text h3 {
	font-size: 24px;
	font-weight: 600;
	color: var(--dark);
}
#content main .box-info li .text p {
	color: var(--dark);	
}





#content main .table-data {
	display: flex;
	flex-wrap: wrap;
	grid-gap: 24px;
	margin-top: 24px;
	width: 100%;
	color: var(--dark);
}
#content main .table-data > div {
	border-radius: 20px;
	background: var(--light);
	padding: 24px;
	overflow-x: auto;
}
#content main .table-data .head {
	display: flex;
	align-items: center;
	grid-gap: 16px;
	margin-bottom: 24px;
}
#content main .table-data .head h3 {
	margin-right: auto;
	font-size: 24px;
	font-weight: 600;
}
#content main .table-data .head .bx {
	cursor: pointer;
}

#content main .table-data .order {
	flex-grow: 1;
	flex-basis: 500px;
}
#content main .table-data .order table {
	width: 100%;
	border-collapse: collapse;
}
#content main .table-data .order table th {
	padding-bottom: 12px;
	font-size: 13px;
	text-align: left;
	border-bottom: 1px solid var(--grey);
}
#content main .table-data .order table td {
	padding: 16px 0;
}
#content main .table-data .order table tr td:first-child {
	display: flex;
	align-items: center;
	grid-gap: 12px;
	padding-left: 6px;
}
#content main .table-data .order table td img {
	width: 36px;
	height: 36px;
	border-radius: 50%;
	object-fit: cover;
}
#content main .table-data .order table tbody tr:hover {
	background: var(--grey);
}
#content main .table-data .order table tr td .status {
	font-size: 10px;
	padding: 6px 16px;
	color: var(--light);
	border-radius: 20px;
	font-weight: 700;
}
#content main .table-data .order table tr td .status.completed {
	background: #020e49;
}
#content main .table-data .order table tr td .status.process {
	background: var(--yellow);
}
#content main .table-data .order table tr td .status.pending {
	background: var(--orange);
}


#content main .table-data .todo {
	flex-grow: 1;
	flex-basis: 300px;
}
#content main .table-data .todo .todo-list {
	width: 100%;
}
#content main .table-data .todo .todo-list li {
	width: 100%;
	margin-bottom: 16px;
	background: var(--grey);
	border-radius: 10px;
	padding: 14px 20px;
	display: flex;
	justify-content: space-between;
	align-items: center;
}
#content main .table-data .todo .todo-list li .bx {
	cursor: pointer;
}
#content main .table-data .todo .todo-list li.completed {
	border-left: 10px solid #020e49;
}
#content main .table-data .todo .todo-list li.not-completed {
	border-left: 10px solid var(--orange);
}
#content main .table-data .todo .todo-list li:last-child {
	margin-bottom: 0;
}
/* MAIN */
/* CONTENT */
/* Initial state for logout text */
#logout-text {
    display: inline-block;
    transition: all 0.5s ease;
}

/* Slide up and fade out effect */
.fade-out-slide-up {
    opacity: 0;
    transform: translateY(-30px); /* Move the text up */
}

/* Optionally, you can add more animations to the icon */
#logout-link {
    transition: all 0.5s ease;
}









@media screen and (max-width: 768px) {
	#sidebar {
		width: 200px;
	}

	#content {
		width: calc(100% - 60px);
		left: 200px;
	}

	#content nav .nav-link {
		display: none;
	}
}






@media screen and (max-width: 576px) {
	#content nav form .form-input input {
		display: none;
	}

	#content nav form .form-input button {
		width: auto;
		height: auto;
		background: transparent;
		border-radius: none;
		color: var(--dark);
	}

	#content nav form.show .form-input input {
		display: block;
		width: 100%;
	}
	#content nav form.show .form-input button {
		width: 36px;
		height: 100%;
		border-radius: 0 36px 36px 0;
		color: var(--light);
		background: var(--red);
	}

	#content nav form.show ~ .notification,
	#content nav form.show ~ .profile {
		display: none;
	}

	#content main .box-info {
		grid-template-columns: 1fr;
	}

	#content main .table-data .head {
		min-width: 420px;
	}
	#content main .table-data .order table {
		min-width: 420px;
	}
	#content main .table-data .todo .todo-list {
		min-width: 420px;
	}
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
			<a href="../view/kelasku-guru.php">
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
            <span class="welcome-message">Selamat Datang, <?php echo htmlspecialchars($username); ?>!   </span>
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

        <div class="container">
            <h2>Manajemen Materi</h2>
            <button class="btn btn-primary" id="addMaterialBtn">+ Tambah Materi</button>
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Tipe</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $materials = $conn->query("SELECT * FROM materials");
                    while ($row = $materials->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['title']}</td>
                                <td>{$row['content']}</td>
                                <td><span class='badge badge-info'>" . strtoupper($row['type']) . "</span></td>
                                <td>
                                    <button class='btn btn-info btn-sm'>Lihat</button>
                                    <button class='btn btn-warning btn-sm'>Edit</button>
                                    <button class='btn btn-danger btn-sm'>Hapus</button>
                                    <button class='btn btn-success btn-sm'>+ Tambah Submateri</button>
                                </td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
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

    const modal = document.getElementById("materialModal");
const closeBtn = document.getElementsByClassName("close")[0];
const materialForm = document.getElementById("materialForm");
const modalTitle = document.getElementById("modalTitle");

// Tambah Materi
document.getElementById("addMaterialBtn").onclick = function () {
    modal.style.display = "block";
    modalTitle.innerText = "Tambah Materi";
    materialForm.reset(); // Reset form untuk mode tambah
    document.getElementById("material_id").value = ""; // Kosongkan material_id
};

// Edit Materi
function editMaterial(id, title, content, type) {
    modal.style.display = "block";
    modalTitle.innerText = "Edit Materi";
    document.getElementById("material_id").value = id;
    document.getElementById("title").value = title;
    document.getElementById("content").value = content;
    document.getElementById("type").value = type;
}

// Tutup Modal
closeBtn.onclick = function () {
    modal.style.display = "none";
};

// Tutup Modal saat klik di luar area
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};

</script>

<!-- MODAL -->

<!-- Modal Tambah/Edit Materi -->
<div id="materialModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 id="modalTitle">Tambah Materi</h2>
        <form id="materialForm" action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="material_id" id="material_id"> <!-- Hidden field for Edit -->
            
            <label for="title">Judul Materi:</label>
            <input type="text" name="title" id="title" required>
            
            <label for="content">Deskripsi:</label>
            <textarea name="content" id="content" required></textarea>
            
            <label for="type">Tipe:</label>
            <select name="type" id="type" required>
                <option value="link">Link</option>
                <option value="doc">Dokumen</option>
                <option value="pdf">PDF</option>
            </select>
            
            <label for="file">Unggah File (Opsional):</label>
            <input type="file" name="file" id="file">
            
            <button type="submit" id="submitBtn">Simpan</button>
        </form>
    </div>
</div>


</body>
</html>
