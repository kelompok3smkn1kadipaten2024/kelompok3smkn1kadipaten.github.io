<?php
include "config.php";
session_start();

$nama_user = isset ($_SESSION['nama_user']) ? $_SESSION['nama_user'] : 'Nama Pengguna Tidak Ditemukan';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/navbar.css">
    <title>Daftar Penjualan</title>
</head>

<body>
    <?php
    include "../navbar.php";
    include "config.php";
    date_default_timezone_set('Asia/Jakarta');
    if (isset ($_POST['simpan'])) {
        $hp = $_POST['nomor_telepon'];
        $tgl = $_POST['tgl'];
        $nama_user = $_POST['nama_user'];
        $data_user = mysqli_query($conn, "SELECT * FROM pelanggan where nomor_telepon = '$hp'");
        $r = mysqli_fetch_array($data_user);
        $data_p = mysqli_query($conn, "select * from user where nama_user = '$nama_user'");
        $p = mysqli_fetch_array($data_p);
        $telp = $r['nomor_telepon'];
        $id = $r['pelanggan_id'];
        $nama = $r['nama_pelanggan'];
        $nama_user = $p['nama_user'];
        $insert = mysqli_query($conn, "insert into penjualan (penjualan_id, tgl_penjualan, nama_user,
            pelanggan_id) values (null, '$tgl', '$nama_user', '$id')");
        if ($hp == $telp) {
            $_SESSION['pelanggan_id'] = $id;
            $_SESSION['nama_pelanggan'] = $nama;
            $_SESSION['nomor_telepon'] = $telp;
        } else {
            echo 'gagal';
        }
    }
    ?>
    <hr>
    <?php
    $sql = "select * from penjualan ORDER BY penjualan_id DESC";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    $_SESSION['id'] = $data['penjualan_id'];

    ?>

    <form action="simpan.php" method="POST">
        <table class="m-2">
            <tr>
                <input type="hidden" name="id" value="<?= $data['penjualan_id'] ?>">
                <td><label for="tg">Tanggal </td>
                <td>:
                    <?php echo date('d-m-Y'); ?>
                </td></label>
            <tr>
                <td><label for="ip">Id Pelanggan</label></td>
                <td><input type="text" name="id_pelanggan" value="<?php echo $_SESSION['pelanggan_id'] ?>" id="ip"></td>
            </tr>
            <tr>
                <td><label for="np">Nama Pelanggan</label></td>
                <td><input type="text" name="nama" value="<?php echo $_SESSION['nama_pelanggan'] ?>" id="np"></td>
            </tr>
            <tr>
                <td><label for="hp">Nomor Telepon</label></td>
                <td><input type="text" name="telp" value="<?php echo $_SESSION['nomor_telepon'] ?>" id="hp"></td>
            </tr>
            <tr>
                <td><label for="kd">Kode Produk</label></td>
                <td><select name="kd" id="kd">
                    <option value="0">Pilih Produk</option>
                        <?php
                        $sel = mysqli_query($conn, "select * from produk");
                        while ($pr = mysqli_fetch_array($sel)) {
                            ?>
                            <option value="<?= $pr['kode_produk'] ?>">
                                <?= $pr['kode_produk'] ?> |
                                <?= $pr['nama_produk'] ?> | Rp.
                                <?= $pr['harga'] ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <br>
            <tr>
                <td><label for="jm">Jumlah Produk</label></td>
                <td><input type="number" name="jm" value="1" id="jm"></td>
            </tr>

            <tr>
                <td><input class="btn btn-info m-2" type="submit" name="save" value="save"></td>
            </tr>
        </table>
    </form>
    <hr>
    <div class="container home-container">
    <table class="table">
        <tr>
            <th>No</th>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total harga</th>
            <th>Aksi</th>
        </tr>
        <tbody>
        <?php

        $id = $_SESSION['id'];
        $jual = mysqli_query($conn, "select detailpenjualan.kode_produk, produk.nama_produk, produk.harga, detailpenjualan.jumlah_produk, produk.harga * detailpenjualan.jumlah_produk as subtot from detailpenjualan, produk where produk.kode_produk=detailpenjualan.kode_produk and detailpenjualan.penjualan_id='$id'");
        $no = 1;
        $tot = 0;
        while ($detail = mysqli_fetch_array($jual)) {
            ?>
            <tr>
                <td>
                    <?= $no ?>
                </td>
                <td>
                    <?= $detail['nama_produk'] ?>
                </td>
                <td>
                    <?= $detail['kode_produk'] ?>
                </td>
                <td>
                <?= number_format($detail['harga'], 0, ',', '.'); ?>
                </td>
                <td>
                    <?= $detail['jumlah_produk'] ?>
                </td>
                <td>
                    <?= number_format($detail['subtot'], 0, ',', '.'); ?>
                </td>
				<td align="center" width="0px">
    <div class="btn-group">
        <a href="form_edit.php?id=<?= $detail['kode_produk'] ?>" class="btn btn-success">Edit</a>
        <a href="keranjang_del.php?id=<?= $detail['kode_produk'] ?>"
            onclick="return confirm('Apakah Anda Yakin data produk <?= $detail['nama_produk'] ?> akan dihapus?')"
            class="btn btn-danger">Delete</a>
    </div>
</td>

            </tr>

            <?php
            $no++;
            $tot = $tot + $detail['subtot'];
        }
        ?>
        <tr>
            <td colspan="5">Total harga</td>
            <td>
                <?= number_format($tot, 0, ',', '.'); ?>
            </td>
        </tr>
    </tbody>
    </table>

    <form method="POST" action="hitung.php">
        total harga : <input type="hidden" name="tot" value="<?= $tot ?>">
        <?= number_format($tot, 0, ',', '.'); ?><br>
        bayar : <input type="number" name="bayar">
        <input type="submit" name="save" value="OK">
    </form>
<hr>
    <?php
    if (isset ($_GET['save'])) {
        // code...
    
        $total_harga = $_SESSION['tot'];
        $bayar = $_SESSION['byr'];
        $kembali = $_SESSION['kembali'];
        ?>
        <br>
        <tr>
            <td>total harga :
                <?= $total_harga ?>
            </td><br>
        </tr>
        bayar :
        <?= number_format($bayar, 0, ',', '.'); ?><br>
        kembali :
        <?= number_format($kembali, 0, ',', '.'); ?><br>
        <br><br>
        <a href="index.php" class="m-2 btn btn-success">selesai</a>
        <td align="center" width="80px">
      <a href="nota.php?id=<?= $data['penjualan_id'] ?>" class="btn btn-info mb-1">Nota</a>
        </td>
    <?php } ?>
    </div>
<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>