<!DOCTYPE html>
<html>

<head>
    <title>Edit Keranjang</title>
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
    <form method="POST" action="keranjang_edit.php">
        <?php
        include "config.php";
        session_start();
        $id = $_GET['id'];
        $kode_produk = $_GET['id'];
        include "config.php";
        $jual = mysqli_query($conn, "SELECT * FROM detailpenjualan WHERE kode_produk='$kode_produk' AND penjualan_id='{$_SESSION['id']}'");
        $data = mysqli_fetch_array($jual);
        ?>
        <h2>Edit Keranjang</h2>
        <?php
        date_default_timezone_set('Asia/Jakarta');
        ?>
        <hr>
        <table width="100%">
            <tr>
                <td>Kode Produk</td>
                <td><input type="text" name="kode_produk" value="<?= $data['kode_produk'] ?>" readonly></td>
            </tr>
            <tr>
                <td>Jumlah</td>
                <td><input type="text" name="jumlah_produk" value="<?= $data['jumlah_produk'] ?>"></td>
            </tr>
        </table>
        <hr>
        <p align="right">
            <input type="submit" name="edit" value="Update" class="simpan">
            <a href="detail.php" class="batal">Batal</a>
        </p>
    </form>
</body>

</html>