<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<style>
    /* Gaya CSS untuk halaman laporan */
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa; /* Warna latar belakang halaman */
        margin: 0;
        padding: 0;
    }

    h2 {
        color: #007bff; /* Warna teks h2 */
        font-size: 20px;
        text-align: center;
    }

    .container {
        display: flex;
        justify-content: center; /* Menempatkan form di tengah halaman */
        gap: 20px; /* Jarak antara form */
        padding: 30px; /* Jarak atas dan bawah */
        max-width: 1000px;
        margin: 0 auto;
    }

    .form-report {
        width: 300px; /* Lebar maksimum form */
        background-color: #fff; /* Warna latar belakang form */
        padding: 20px; /* Padding dalam form */
        border-radius: 8px; /* Sudut melingkar */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Bayangan form */
    }

    select, input[type="submit"] {
        width: 100%; /* Lebar penuh */
        padding: 10px; /* Padding dalam elemen */
        margin: 10px 0; /* Margin atas dan bawah */
        box-sizing: border-box; /* Menggabungkan padding dan border ke dalam ukuran elemen */
        border: 1px solid #ced4da; /* Warna border */
        border-radius: 4px; /* Sudut melingkar */
        font-size: 14px;
    }

    input[type="submit"] {
        background-color: #007bff; /* Warna latar belakang tombol */
        color: #fff; /* Warna teks tombol */
        border: none; /* Tanpa border */
        cursor: pointer; /* Ganti kursor saat diarahkan ke tombol */
        transition: background-color 0.3s; /* Efek transisi saat hover */
    }

    input[type="submit"]:hover {
        background-color: #0056b3; /* Warna tombol saat dihover */
    }

</style>
<body>
    <!-- Navbar tetap berada di atas -->
    <?php include "../navbar.php"; ?>

    <div class="container">
        <!-- Form Laporan Harian -->
        <form method="POST" action="harian.php" class="form-report">
            <h2>Laporan Harian</h2>
            <select name="tgl" size="1">
                <option value="">Tanggal</option>
                <?php for($a=1; $a<=31; $a++) { ?>
                    <option value="<?= $a ?>"><?= $a ?></option>
                <?php } ?>
            </select>
            <select name="bln" size="1">
                <option value="">Bulan</option>
                <?php
                $months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                foreach($months as $index => $month) {
                    $value = $index + 1;
                    echo "<option value=\"$value\">$month</option>";
                }
                ?>
            </select>
            <select name="thn" size="1">
                <option value="">Tahun</option>
                <?php
                $thnskr = date("Y");
                $mulai = $thnskr - 6;
                for($c = $mulai; $c <= $thnskr; $c++) {
                    echo "<option value=\"$c\">$c</option>";
                }
                ?>
            </select>
            <input type="submit" name="tglproses" value="OK">
        </form>

        <!-- Form Laporan Bulanan -->
        <form method="POST" action="bulanan.php" class="form-report">
            <h2>Laporan Bulanan</h2>
            <select name="bln" size="1">
                <option value="">Bulan</option>
                <?php
                foreach($months as $index => $month) {
                    $value = $index + 1;
                    echo "<option value=\"$value\">$month</option>";
                }
                ?>
            </select>
            <select name="thn" size="1">
                <option value="">Tahun</option>
                <?php
                for($c = $mulai; $c <= $thnskr; $c++) {
                    echo "<option value=\"$c\">$c</option>";
                }
                ?>
            </select>
            <input type="submit" name="tglproses" value="OK">
        </form>
    </div>
</body>
</html>
