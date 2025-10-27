<?php
include '../config/koneksi.php';
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $stored = $user['password'];
        if (password_verify($password, $stored)) {
            // ok
            $_SESSION['user'] = $user;
            header("Location: ../dashboard.php");
            exit;
        } else if ($password === $stored) {
            // plaintext match (initial import); upgrade to hashed password
            $newhash = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query($koneksi, "UPDATE users SET password='$newhash' WHERE id_user={$user['id_user']}");
            $user['password'] = $newhash;
            $_SESSION['user'] = $user;
            header("Location: ../dashboard.php");
            exit;
        } else {
            echo "Email atau password salah!";
        }
    } else {
        echo "Email tidak ditemukan!";
    }
}
?>
<form method="post">
    <h3>Login</h3>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit" name="login">Login</button>
</form>
<p>Belum punya akun? <a href="register.php">Daftar</a></p>
