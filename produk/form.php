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
    <title>Form Produk</title>
    <style>
        h2 {
            color: #007bff; /* Warna teks h2 */
        }

        form {
            max-width: 300px; /* Lebar maksimum formulir */
            margin: 0 auto; /* Tengah formulir di halaman */
        }

        small {
            color: #6c757d; /* Warna teks small */
        }

        input[type="text"],
        input[type="number"] {
            width: 100%; /* Lebar input text dan number */
            padding: 5px; /* Ruang padding pada input */
            margin-bottom: 2px; /* Ruang margin di bawah input */
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
<h2 align="center">Form Produk</h2>
<hr>
<form method="POST" action="simpan.php">
    <p>
        <label for="nama_produk">Nama Produk :</label>
        <input type="text" id="nama_produk" name="nama_produk" required>
    </p>
    <p>
        <label for="kode_produk">Kode Produk :</label>
        <input type="text" id="kode_produk" name="kode_produk" required>
    </p>
    <p>
        <label for="kk">Kategori :</label><br>
        <input list="kode_kategori" name="kode_kategori" autocomplete="off" placeholder="Pilih Kategori" required>
        <datalist id="kode_kategori">
            <?php
            include "../config.php";
            $sqlp = "select * from kategori";
            $resp = mysqli_query($conn, $sqlp);
            while ($dt = mysqli_fetch_array($resp)) {
                ?>
                <option value="<?= $dt['kode_kategori'] ?>"><?= $dt['nama_kategori'] ?> | <?= $dt['kode_kategori'] ?></option>
                <?php
            }
            ?>
        </datalist>
    </p>
    <p>
        <label for="harga">Harga Produk :</label>
        <input type="number" id="harga" name="harga" required>
    </p>
    <p>
        <label for="stok">Stok :</label>
        <input type="number" id="stok" name="stok" required>
    </p>
    <hr>
    <input type="submit" name="save" value="Simpan">
    <input type="reset" name="rst" value="Clear">
    <a href="index.php" class="btn btn-danger">Back</a>
    </form>
<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
