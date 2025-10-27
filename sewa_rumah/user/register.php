<?php
include '../config/koneksi.php';

if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'penyewa';

    $query = "INSERT INTO users (nama, email, password, role) VALUES ('$nama','$email','$password','$role')";
    if (mysqli_query($koneksi, $query)) {
        echo "Registrasi berhasil! <a href='login.php'>Login di sini</a>";
    } else {
        echo "Gagal: " . mysqli_error($koneksi);
    }
}
?>
<form method="post">
    <h3>Registrasi</h3>
    Nama: <input type="text" name="nama" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit" name="register">Daftar</button>
</form>
