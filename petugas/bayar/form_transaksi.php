<?php
session_start();
$_SESSION['user_id'];

$nama_user = isset($_SESSION['nama_user']) ? $_SESSION['nama_user'] : 'Nama Pengguna Tidak Ditemukan'; // Default jika kunci "nama_user" tidak tersedia
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=fo, initial-scale=1.0">
    <title>Document</title>
    <style>
        form {
            width: 350px;
            padding: 20px;
            margin: 20px auto;
            box-shadow: 0 0 10px 0 #333;
            border-radius: 20px;
            font: 14px "Tahoma";
        }

        input[type="text"],
        input[type="number"] {
            width: 230px;
            padding: 5px;
        }

        .simpan {
            background: blue;
            color: white;
            border-radius: 20px;
            border: none;
            text-decoration: none;
            padding: 10px 20px;
        }

        .batal {
            background: red;
            color: white;
            border-radius: 20px;
            border: none;
            text-decoration: none;
            padding: 10px 20px;
        }
    </style>
</head>


<body>
<?php
    include "../navbar.php";
    ?>
    <form method="POST" action="detail.php">
        <h2>Input Data Transaksi</h2>
        <?php
        date_default_timezone_set('Asia/Jakarta');
        ?>
        <hr>
        <table width="100%">
            <tr>
                <td>No Hp</td>
                <td>
            <input list="nomor_telepon" name="nomor_telepon" autocomplete="off" placeholder="Pilih Pelanggan" plarequired></td>
            <datalist id="nomor_telepon">
        <?php
        include "../config.php";
        $sqlp = "select * from pelanggan";
        $resp = mysqli_query($conn, $sqlp);
        while ($dt = mysqli_fetch_array($resp)) {
            ?>
            <option value="<?= $dt['nomor_telepon'] ?>"><?= $dt['nama_pelanggan'] ?> | <?= $dt['nomor_telepon'] ?></option>
            <?php
        }
        ?>
    </datalist>
            </tr>
            <tr>
                <td>Tanggal Penjualan</td>
                <td><input type="text" name="tgl" value="<?php echo date('Y-m-d') ?>"></td>
            </tr>
            <tr>
                <td>Petugas</td>
                <td><input type="text" name="nama_user" readonly value="<?php echo $nama_user; ?>"><br></td>
            </tr>
        </table>
        <hr>
        <p align="right">
            <input type="submit" name="simpan" value="Simpan" class="simpan">
            <a href="index.php" class="batal">Batal</a>
        </p>
    </form>
</body>

</html>