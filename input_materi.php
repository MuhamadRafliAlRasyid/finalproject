<?php 
include "service/database.php"; // Pastikan file database.php benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_id = $_POST['course_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $file_url = null;

    // Proses upload file
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $file_name = basename($_FILES['file']['name']);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
            $file_url = $file_name; // Simpan nama file
        } else {
            die("Gagal mengunggah file.");
        }
    }

    // Simpan data ke database menggunakan MySQLi
    $sql = "INSERT INTO materi (course_id, title, content, file_url) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($sql); // Gunakan MySQLi $conn
    if ($stmt === false) {
        die("Kesalahan pada prepare statement: " . $conn->error);
    }

    // Bind parameter
    $stmt->bind_param("isss", $course_id, $title, $content, $file_url); // "i" untuk integer, "s" untuk string

    // Eksekusi statement
    if ($stmt->execute()) {
        header("Location: materi.php");
        exit;
    } else {
        die("Gagal menyimpan data: " . $stmt->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Materi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Form Input Materi</h1>
    <form action="input_materi.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="course_id" class="form-label">Course ID</label>
            <input type="number" name="course_id" id="course_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Judul Materi</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Konten Materi</label>
            <textarea name="content" id="content" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Upload File (opsional)</label>
            <input type="file" name="file" id="file" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
</body>
</html>
