<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../style/navbar.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Form Pelanggan</title>
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
		a:hover{
            background-color: #006dd9;
        }
        .back{
            background-color: #007bff;
            color: #fff; 
            padding: 10px 10px;
            border: none; 
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php
include "../navbar.php";
?>
<h2 align="center">Form Pelanggan</h2>
<hr>
<form method="POST" action="simpan.php">
<form method="POST" action="simpan.php">
	<p>
		<small required>Nama Pelanggan :</small><br>
		<input type="text" name="nama_pelanggan" required>
	</p>
	<p>
		<small required>Alamat :</small><br>
		<input type="text" name="alamat" required>
	</p>
	<p>
		<small required>Telepon :</small><br>
		<input type="text" name="nomor_telepon" required>
		<hr>
		<input type="submit" name="save" value="Simpan">
		<input type="reset" name="rst" value="Clear">
		<a href="index.php" class="back">Back</a>
	</p>
</form>
<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
