<?php
require_once '../fungsi/db.php';
session_start();

// Cek apakah user adalah admin
if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
  $stmt = $pdo->prepare("SELECT notification_id, message, type, status, created_at 
                           FROM notifications 
                           WHERE status = 'unread' 
                           ORDER BY created_at DESC");
  $stmt->execute();
  $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($notifications);
} else {
  echo json_encode([]);
}