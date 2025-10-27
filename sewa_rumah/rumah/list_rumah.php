<?php
include '../config/koneksi.php';
session_start();

$result = mysqli_query($koneksi, "SELECT r.*, u.nama as pemilik FROM rumah r LEFT JOIN users u ON r.id_pemilik=u.id_user");

echo "<h3>Daftar Rumah</h3>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<div style='border:1px solid #ccc; margin:10px; padding:10px;'>";
    if (!empty($row['gambar'])) {
        echo "<img src='../assets/{$row['gambar']}' width='150'><br>";
    }
    echo "Pemilik: {$row['pemilik']}<br>";
    echo "Alamat: {$row['alamat']}<br>";
    echo "Harga: Rp".number_format($row['harga'],0,",", ".")."<br>";
    echo "Status: {$row['status']}<br>";

    if ($row['status'] == 'tersedia') {
        echo "<a href='sewa_rumah.php?id={$row['id_rumah']}'>Sewa Sekarang</a>";
    }
    echo "</div>";
}
?>
