<?php
include "service/database.php"; // Pastikan file database.php benar

// Query untuk mengambil semua data dari tabel 'materi'
$sql = "SELECT * FROM materi";
$result = $db->query($sql);

if (!$result) {
    die("Gagal mengambil data: " . $db->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Materi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Daftar Materi</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Course ID</th>
                <th>Judul Materi</th>
                <th>Konten</th>
                <th>File</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['course_id']) ?></td>
                        <td><?= htmlspecialchars($row['title']) ?></td>
                        <td><?= htmlspecialchars($row['content']) ?></td>
                        <td>
                            <?php if (!empty($row['file_url'])): ?>
                                <a href="uploads/<?= htmlspecialchars($row['file_url']) ?>" target="_blank">Lihat File</a>
                            <?php else: ?>
                                Tidak ada file
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Belum ada data.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
