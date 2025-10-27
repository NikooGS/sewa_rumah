<?php
include '../config/koneksi.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../user/login.php'); exit;
}

if (!isset($_GET['id'])) {
    echo 'ID rumah tidak disertakan.'; exit;
}

$id_rumah = intval($_GET['id']);
$id_penyewa = $_SESSION['user']['id_user'];

if (isset($_POST['sewa'])) {
    $mulai = $_POST['tanggal_mulai'];
    $selesai = $_POST['tanggal_selesai'];

    $query = "INSERT INTO sewa (id_rumah, id_penyewa, tanggal_mulai, tanggal_selesai, total_bayar, status_pembayaran)
              VALUES ('$id_rumah','$id_penyewa','$mulai','$selesai',0,'belum')";

    mysqli_query($koneksi, "UPDATE rumah SET status='disewa' WHERE id_rumah='$id_rumah'");
    mysqli_query($koneksi, $query);

    echo "Rumah berhasil disewa! <a href='list_rumah.php'>Kembali</a>";
    exit;
}

$rumah = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM rumah WHERE id_rumah='$id_rumah'"));
echo "<h3>Sewa Rumah: {$rumah['alamat']}</h3>";
?>
<form method="post">
    Tanggal Mulai: <input type="date" name="tanggal_mulai" required><br>
    Tanggal Selesai: <input type="date" name="tanggal_selesai" required><br>
    <button type="submit" name="sewa">Sewa Sekarang</button>
</form>
