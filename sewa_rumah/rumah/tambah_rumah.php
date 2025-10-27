<?php
include '../config/koneksi.php';
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../user/login.php'); exit;
}
if (isset($_POST['submit'])) {
    $id_pemilik = $_SESSION['user']['id_user'];
    $alamat = $_POST['alamat'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $status = 'tersedia';

    $gambar = '';
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = time().'_'.basename($_FILES['gambar']['name']);
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "../assets/" . $gambar);
    }

    $query = "INSERT INTO rumah (id_pemilik, alamat, harga, deskripsi, gambar, status)
              VALUES ('$id_pemilik','$alamat','$harga','$deskripsi','$gambar','$status')";

    if (mysqli_query($koneksi, $query)) {
        echo "Data rumah berhasil diupload! <a href='list_rumah.php'>Lihat Daftar</a>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
<form method="post" enctype="multipart/form-data">
    <h3>Upload Rumah</h3>
    Alamat: <input type="text" name="alamat" required><br>
    Harga: <input type="number" name="harga" required><br>
    Deskripsi: <textarea name="deskripsi"></textarea><br>
    Gambar: <input type="file" name="gambar"><br>
    <button type="submit" name="submit">Upload</button>
</form>
