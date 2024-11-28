<?php
require 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Gunakan md5 untuk mengenkripsi password

    // Query SQL untuk mendapatkan data user berdasarkan username dan password
    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            // Login berhasil
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['nama_user'] = $user['nama_user'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['level'] = $user['level'];

            // Redirect ke halaman sesuai tingkatan
            if ($user['level'] == 'admin') {
                header("Location: halaman/");
            } elseif ($user['level'] == 'petugas') {
                header("Location: halaman/");
            exit();
        }
    } else {
        // Login gagal
        echo '<script>alert("Login gagal. Periksa kembali username dan password."); window.location.href="index.php";</script>';
    }
}
}