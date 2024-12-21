<?php
// Include file auth.php
require_once '../session.php';

// Update status jika ada request POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $payment_id = $_POST['payment_id'];
    $new_status = $_POST['status'];

    // Update query untuk status pembayaran
    // Update query untuk status pembayaran
$query = "UPDATE payments SET status = 'completed' WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $payment_id); // Bind only the payment_id, as 'completed' is now hardcoded.

if ($stmt->execute()) {
    echo "<script>alert('Status berhasil diperbarui!'); window.location.href='pembayaran.php';</script>";
} else {
    echo "<script>alert('Gagal memperbarui status: " . $stmt->error . "');</script>";
}

$stmt->close();

}

// Fetch data dari tabel payments
$query = "SELECT id, student_id, amount, payment_date, file, description, status FROM payments";
$result = $db->query($query);

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

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="../admin/style.css">
    <link rel="icon" href="..\img\BIMBELRAHMA.png" sizes="32x32">
    <title>Pembayaran - Bimbel Rahma</title>
    
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
</head>
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
        <li>
            <a href="data-siswa.php">
                <i class='bx bxs-group'></i>
                <span class="text">Data Siswa</span>
            </a>
        </li>
        <li>
            <a href="data-pengajar.php">
                <i class='bx bxs-group'></i>
                <span class="text">Data Pengajar</span>
            </a>
        </li>
        <li>
            <a href="jadwal-kelas.php">
                <i class='bx bxs-school'></i>
                <span class="text">Jadwal Kelas</span>
            </a>
        </li>
        <li class="active">
            <a href="pembayaran.php">
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
            <a href="setting-profile.php">
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

    <main>
    <div class="head-title" id="dashboard">
        <div class="left">
            <h1>Pembayaran</h1>
            <ul class="breadcrumb">
                <li><a href="#">Pembayaran</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
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
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Jumlah Pembayaran</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['student_id'] ?></td>
                        <td><?= number_format($row['amount'], 2) ?></td>
                        <td><?= $row['payment_date'] ?></td>
                        <td><a href="<?= $row['file'] ?>" target="_blank">View File</a></td>
                        <td><?= $row['description'] ?></td>
                        <td><?= $row['status'] ?></td>
                        <td>
                            <?php if ($row['status'] === 'pending'): ?>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="payment_id" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" name="update_status">Mark as Completed</button>
                                </form>
                            <?php else: ?>
                                Completed
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No payments found</td>
                </tr>
            <?php endif; ?>
        </tbody>
            </table>
        </div>
    </div>
</main>


</body>
</html>
