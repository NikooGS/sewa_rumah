<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: user/login.php');
    exit;
}
$user = $_SESSION['user'];
echo "<h2>Halo, ".$user['nama']." (".$user['role'].")</h2>";
echo "<a href='rumah/list_rumah.php'>Lihat Rumah</a> | ";
if ($user['role']=='pemilik' || $user['role']=='admin') {
    echo "<a href='rumah/tambah_rumah.php'>Upload Rumah</a> | ";
}
echo "<a href='user/logout.php'>Logout</a>";
?>