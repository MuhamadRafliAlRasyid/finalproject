<?php 
include 'service/database.php';

session_start();

// Tangkap data dari form
$bulan = isset($_POST['bulan']) ? $_POST['bulan'] : '';
$tahun = isset($_POST['tahun']) ? $_POST['tahun'] : '';
$lama = isset($_POST['lama']) ? $_POST['lama'] : '';
$tingkat = isset($_POST['tingkat']) ? $_POST['tingkat'] : '';
$kurikulum = isset($_POST['kurikulum']) ? $_POST['kurikulum'] : '';

// Lakukan logika pembayaran atau validasi data
if ($bulan && $tahun && $lama && $tingkat && $kurikulum) {
    // Simpan ke sesi atau database jika perlu
    $_SESSION['paymentDetails'] = [
        'bulan' => $bulan,
        'tahun' => $tahun,
        'lama' => $lama,
        'tingkat' => $tingkat,
        'kurikulum' => $kurikulum,
    ];

    // Redirect ke halaman selanjutnya
    header("Location: konfirmasi_pembayaran.php");
    exit;
} else {
    echo "Semua data harus diisi!";
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $status = "pending";

    // File upload handling
    $upload_dir = '../uploads/payments/';
    $file_name = basename($_FILES['bukti_pembayaran']['name']);
    $target_file = $upload_dir . $file_name;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi file
    $allowed_types = ['jpg', 'jpeg', 'png', 'pdf'];
    if (in_array($file_type, $allowed_types) && move_uploaded_file($_FILES['bukti_pembayaran']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO payments (student_id, amount, bukti_pembayaran, payment_date, description, status) VALUES (?, ?, ?, NOW(), ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("idsss", $student_id, $amount, $file_name, $description, $status);

        if ($stmt->execute()) {
            echo "Pembayaran berhasil disimpan!";
        } else {
            echo "Terjadi kesalahan: " . $stmt->error;
        }
    } else {
        echo "File tidak valid atau gagal diunggah.";
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href=".\img\BIMBELRAHMA.png" sizes="32x32">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Registrasi - Bimbel Rahma</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            border-radius: 5px 5px 0 0;
            text-align: center;
        }
        .form-container {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 20px;
        }
        .btn-orange {
            background-color: #ff7f50;
            color: white;
        }
    </style>
</head>
    <!-- Modal Rincian Pembayaran -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Rincian Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="paymentForm">
                    <div class="mb-3">
                        <label for="paymentAmount" class="form-label">Jumlah Pembayaran</label>
                        <input type="number" class="form-control" id="paymentAmount" name="amount" value="500000" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="paymentMethod" class="form-label">Metode Pembayaran</label>
                        <select class="form-select" id="paymentMethod" name="paymentMethod" required>
                            <option value="bankTransfer" selected>Transfer Bank</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bankAccount" class="form-label">Rekening Tujuan</label>
                        <input type="text" class="form-control" id="bankAccount" value="Bank ABC - 1234567890" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="paymentDetails" class="form-label">Detail Pembayaran</label>
                        <textarea class="form-control" id="paymentDetails" name="description" rows="3" placeholder="Masukkan detail pembayaran"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="openUploadModal()">Lanjutkan</button>
            </div>
        </div>
    </div>
</div>


    <!-- Modal Upload Bukti Pembayaran -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload Bukti Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" enctype="multipart/form-data" method="POST" action="upload_payment.php">
                    <input type="hidden" name="student_id" id="studentId" value="1234"> <!-- ID siswa -->
                    <input type="hidden" name="amount" id="uploadAmount"> <!-- Jumlah pembayaran -->
                    <input type="hidden" name="description" id="uploadDescription"> <!-- Deskripsi pembayaran -->
                    <div class="mb-3">
                        <label for="uploadFile" class="form-label">Pilih File Bukti Pembayaran</label>
                        <input type="file" class="form-control" id="uploadFile" name="bukti_pembayaran" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" form="uploadForm" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</div>


    <!-- Footer -->
    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function openUploadModal() {
    // Ambil data dari modal pertama
    const amount = document.getElementById("paymentAmount").value;
    const description = document.getElementById("paymentDetails").value;

    // Set data ke modal kedua
    document.getElementById("uploadAmount").value = amount;
    document.getElementById("uploadDescription").value = description;

    // Tampilkan modal kedua
    const uploadModal = new bootstrap.Modal(document.getElementById("uploadModal"));
    uploadModal.show();
}

       
    </script>
</body>
</html>