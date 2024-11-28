<?php
require '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_user = $_POST['nama_user'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $level = $_POST['level'];

    // Periksa apakah username sudah terdaftar
    $checkQuery = "SELECT * FROM `user` WHERE `username` = '$username'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Username sudah terdaftar
        echo '<script>alert("Username sudah terdaftar. Silahkan pilih username lain!"); window.location.href = "form.php";</script>';
    } else {
        // Lakukan proses registrasi
        $insertQuery = "INSERT INTO `user` (`nama_user`, `username`, `password`, `level`) VALUES ('$nama_user', '$username', '$password', '$level')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            // Registrasi berhasil
            echo '<script>alert("Tambah data berhasil!"); window.location.href = "index.php";</script>';
        } else {
            // Registrasi gagal
            echo '<script>alert("Tambah data gagal! Silahkan coba lagi."); window.location.href = "form.php";</script>';
        }
    }
}

mysqli_close($conn);