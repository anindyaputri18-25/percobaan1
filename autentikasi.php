<?php
if (!isset($_SESSION['users'])) {
    header("Location: login.php");
    exit();
}

$user_session = $_SESSION['users'];

// Ambil role terbaru dari DB
$query_auth = mysqli_query($koneksi, "SELECT role FROM users WHERE username = '$user_session'");
$data_auth = mysqli_fetch_assoc($query_auth);

if (!$data_auth) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// SET 1 SUMBER ROLE
$_SESSION['role'] = $data_auth['role'];
$role = $_SESSION['role'];
?>