<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['level'] != 'admin') {
    header("Location: ../index.php");
    exit();
}
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewpoint" content="with=device-width,
        initial-scale=1">
        <link rel="stylesheet" href="../style/navbar.css">
        <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <title>Form Petugas</title>
    </head>
    <body>
    <style>
        h2 {
            color: #007bff; /* Warna teks h2 */
        }

        form {
            max-width: 350px; /* Lebar maksimum formulir */
            margin: 0 auto; /* Tengah formulir di halaman */
        }

        small {
            color: #6c757d; /* Warna teks small */
        }

        input[type="text"],
        input[type="number"] {
            width: 100%; /* Lebar input text dan number */
            padding: 5px; /* Ruang padding pada input */
            margin-bottom: 10px; /* Ruang margin di bawah input */
            box-sizing: border-box; /* Padding dan border termasuk dalam lebar dan tinggi elemen */
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #28a745; /* Warna latar belakang tombol submit dan reset */
            color: #fff; /* Warna teks tombol */
            padding: 10px 10px; /* Ruang padding pada tombol */
            border: none; /* Tanpa border pada tombol */
            border-radius: 5px; /* Border radius pada tombol */
            cursor: pointer; /* Ganti kursor saat diarahkan ke tombol */
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #218838; /* Warna latar belakang tombol saat dihover */
        }

        hr {
            border: 1px solid #dee2e6; /* Garis pemisah */
            margin: 10px 0; /* Ruang margin di atas dan bawah garis pemisah */
        }
    </style>
   <?php
include "../navbar.php";
?>

        <?php
        include "../config.php";
        $id=$_GET['id'];
        $sql="select * from user where user_id='$id'";
        $result=mysqli_query($conn,$sql);
        $data=mysqli_fetch_array($result);
        ?>
        <h2 align="center">Form Petugas</h2>
        <form method="POST" action="update.php">
        <p>
            <small>Nama User :</small><br>
            <input type="hidden" name="user_id" value="<?= $data['user_id'] ?>">
            <input type="text" name="nama_user" value="<?= $data['nama_user'] ?>">
        </p>
        <p>
            <small>Username :</small><br>
            <input type="text" name="username" value="<?= $data['username'] ?>">
        </p>
        <p>
        <small>Level:</small><br>
<select name="level" id="level">
    <option value='admin' <?= ($data["level"] == 'admin') ? 'selected' : '' ?>>Admin</option>
    <option value='petugas' <?= ($data["level"] == 'petugas') ? 'selected' : '' ?>>Petugas</option>
</select>
            <input type="submit" name="edit" value="Update">
            <a href="index.php"></a>
        </p>
        </form>
        <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>