<?php
require_once 'session.php';
include "service/database.php";


// Simulasi user_id dari sesi (pastikan ini disesuaikan dengan login user Anda)
 // Contoh user_id

$user_id = $_SESSION['user_id'];

// Database connection

// Fetch data from registrations and payments table for the logged-in user
$sql = "
    SELECT 
        r.registration_id, 
        r.class, 
        r.total_harga, 
        COALESCE(p.status, 'pending') AS payment_status
    FROM registrations r
    LEFT JOIN payments p ON r.registration_id = p.student_id
    WHERE r.user_id = $user_id
";
$result = $db->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Pembayaran</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Daftar Registrasi dan Status Pembayaran</h2>
        <table class="table">
            <thead>
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
                            <td><?= $row['total_harga'] ?></td>
                            <td>
                                <span class="badge 
                                    <?= $row['payment_status'] == 'completed' ? 'bg-success' : 'bg-warning' ?>">
                                    <?= ucfirst($row['payment_status']) ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($row['payment_status'] == 'pending'): ?>
                                    <!-- Tombol Bayar hanya muncul jika status adalah 'pending' -->
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal" 
                                        onclick="setPaymentDetails(
                                            <?= $row['registration_id'] ?>, 
                                            <?= $row['total_harga'] ?>, 
                                            <?= $user_id ?>
                                        )">
                                        Bayar
                                    </button>
                                <?php elseif ($row['payment_status'] == 'completed'): ?>
                                    <!-- Tombol Disabled untuk status 'completed' -->
                                    <button class="btn btn-secondary" disabled>Lunas</button>
                                <?php else: ?>
                                    <!-- Tidak ada tombol untuk status lainnya -->
                                    <span class="text-muted">Pembayaran Diproses</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Tidak ada data registrasi ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>

    <!-- Modal Pembayaran -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Rincian Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="paymentForm" enctype="multipart/form-data" method="POST" action="save_payment.php">
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
</body>
</html>
