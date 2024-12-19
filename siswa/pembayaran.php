<?php
require_once '../session.php';
include "../service/database.php";

// Ambil user_id dari sesi
$user_id = $_SESSION['user_id'];

// Jika form pembayaran dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $registration_id = $_POST['registration_id'];
    $user_id = $_POST['user_id'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];

    // Handle file upload
    $file = $_FILES['file']['name'];
    $target_dir = "../uploads/payments/";
    $target_file = $target_dir . basename($file);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
        // Gunakan prepared statement untuk menghindari SQL injection
        $stmt = $db->prepare("INSERT INTO payments (student_id, amount, description, file, status) VALUES (?, ?, ?, ?, 'pending')");
        $stmt->bind_param("iiss", $user_id, $amount, $description, $target_file);

        if ($stmt->execute()) {
            echo "Payment recorded successfully!";
            header('Location: siswa-dashboard.php');
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "File upload failed!";
    }
}

// Query untuk mendapatkan data registrasi dan status pembayaran
$sql = "
    SELECT  
        r.registration_id, 
        r.class, 
        r.total_harga, 
        CASE 
            WHEN p.status = 'completed' THEN 'Lunas'
            WHEN p.status = 'pending' THEN 'Menunggu'
            ELSE 'Belum Bayar'
        END AS payment_status
    FROM registrations r
    LEFT JOIN (
        SELECT 
            student_id, 
            MAX(CASE 
                WHEN status = 'completed' THEN 3
                WHEN status = 'pending' THEN 2
                ELSE 1 
            END) AS priority_status,
            MAX(status) AS status
        FROM payments
        GROUP BY student_id
    ) p ON r.registration_id = p.student_id
    WHERE r.user_id = ?;
";


// Gunakan prepared statement untuk query
$stmt = $db->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="..\img\BIMBELRAHMA.png" sizes="32x32">
    <title>Dashboard Siswa - Pembayaran</title>
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

        body {
            background-color: #f4f4f4;
        }
        #sidebar {
            width: 250px;
            background: #f1f1f1;
            min-height: 100vh;
            position: fixed;
            color: white;
        }
        #sidebar ul {
            list-style-type: none;
            padding: 0;
        }
        #sidebar ul li {
            padding: 15px;
            cursor: pointer;
        }
        #sidebar ul li a {
            text-decoration: none;
            color: white;
            display: flex;
            align-items: center;
        }
        #sidebar ul li:hover {
            background: #f1f1f1;
        }
        main {
            margin-left: 250px;
            padding: 20px;
        }
        .badge {
            font-size: 0.9rem;
            padding: 5px 10px;
        }
    </style>
</head>
<body>
<section id="sidebar">
    <a href="#" class="brand">
        <img src="../img/BIMBELRAHMA.png" alt="Logo Bimbel Rahma" style="width: 80%; height: auto;">
    </a>
    <ul class="side-menu top">
        <li class="active">
            <a href="siswa-dashboard.php"><i class='bx bxs-dashboard'></i><span class="text">Dashboard</span></a>
        </li>
        <li><a href="kelasku.php"><i class='bx bxs-group'></i><span class="text">Kelasku</span></a></li>
        <li><a href="report.php"><i class='bx bxs-bar-chart'></i><span class="text">Report</span></a></li>
        <li><a href="pembayaran.php"><i class='bx bxs-wallet'></i><span class="text">Pembayaran</span></a></li>
        <li><a href="../view/setting-profile.php"><i class='bx bxs-cog'></i><span class="text">Setting Profile</span></a></li>
        <li><a href="../logout.php" class="logout" onclick="return confirmLogout()"><i class='bx bxs-log-out-circle'></i><span class="text">Logout</span></a></li>
    </ul>
</section>

<main>
    <h2 class="mb-4">Daftar Registrasi dan Status Pembayaran</h2>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID Registrasi</th>
                <th>Kelas</th>
                <th>Total Harga</th>
                <th>Status Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['registration_id'] ?></td>
                <td><?= $row['class'] ?></td>
                <td><?= number_format($row['total_harga'], 2) ?></td>
                <td>
                    <span class="badge <?= $row['payment_status'] == 'Lunas' ? 'bg-success' : ($row['payment_status'] == 'Menunggu' ? 'bg-warning' : 'bg-danger') ?>">
                        <?= $row['payment_status'] ?>
                    </span>
                </td>
                <td>
                    <?php if ($row['payment_status'] == 'Lunas'): ?>
                        <button class="btn btn-secondary btn-sm" disabled>Lunas</button>
                    <?php else: ?>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#paymentModal" 
                            onclick="setPaymentDetails(<?= $row['registration_id'] ?>, <?= $row['total_harga'] ?>, <?= $user_id ?>)">
                            Bayar
                        </button>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="5" class="text-center">Tidak ada data registrasi ditemukan.</td>
        </tr>
    <?php endif; ?>
</tbody>

    </table>
</main>

<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Rincian Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="paymentForm" enctype="multipart/form-data" method="POST" action="">
                    <input type="hidden" id="registrationId" name="registration_id">
                    <input type="hidden" id="userId" name="user_id">
                    <div class="mb-3">
                        <label for="paymentAmount" class="form-label">Jumlah Pembayaran</label>
                        <input type="number" class="form-control" id="paymentAmount" name="amount" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="paymentDetails" class="form-label">Detail Pembayaran</label>
                        <textarea class="form-control" id="paymentDetails" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="uploadFile" class="form-label">Upload Bukti Pembayaran</label>
                        <input type="file" class="form-control" id="uploadFile" name="file" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function setPaymentDetails(registrationId, amount, userId) {
        document.getElementById('registrationId').value = registrationId;
        document.getElementById('paymentAmount').value = amount;
        document.getElementById('userId').value = userId;
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
