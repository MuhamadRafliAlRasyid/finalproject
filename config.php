<?php
// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$database = "your_database_name";

// Create database connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set character set to UTF-8
mysqli_set_charset($conn, "utf8");

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Define base URL
define('BASE_URL', 'http://localhost/finalproject/');

// Error reporting (set to 0 for production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
