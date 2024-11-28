<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            font: 14px "Tahoma";
        }
        h2 {
            text-align: center;
            color: #007bff;
        }
        th {
            background: darkgray;
            color: white;
        }
        td {
            background: #eee;
            color: black;
        }
        .cetak, .back {
            background: blue;
            color: white;
            border-radius: 20px;
            border: none;
            text-decoration: none;
            padding: 5px 15px;
            margin: 5px;
        }
        .cetak:hover, .back:hover {
            background: darkblue;
        }
    </style>
</head>
<body>

<?php  
// Mendapatkan tanggal hari ini
$tgl = date('d');
$bln = date('m');
$thn = date('Y');
$tanggal = $thn . "-" . $bln . "-" . $tgl;
?>

<h2>Laporan Harian<br>Tgl. <?= $tgl ?>-<?= $bln ?>-<?= $thn ?></h2>
<table width="100%">
    <tr>
        <th class="jdl-kolom">No.</th>
        <th class="jdl-kolom" width="100px">Tanggal</th>
        <th class="jdl-kolom">Kode Produk</th>
        <th class="jdl-kolom">Nama Produk</th>
        <th class="jdl-kolom">Harga</th>
        <th class="jdl-kolom">Jumlah</th>
        <th class="jdl-kolom">Total</th>
        <th class="jdl-kolom">Nama Petugas</th>
    </tr>
    <?php  
    include "../config.php";
    $sql = "SELECT penjualan.tgl_penjualan, produk.kode_produk, produk.nama_produk, produk.harga, detailpenjualan.jumlah_produk, 
                   produk.harga * detailpenjualan.jumlah_produk AS total, penjualan.nama_user 
            FROM penjualan
            JOIN detailpenjualan ON penjualan.penjualan_id = detailpenjualan.penjualan_id
            JOIN produk ON detailpenjualan.kode_produk = produk.kode_produk
            WHERE penjualan.tgl_penjualan LIKE '$tanggal%'
            ORDER BY detailpenjualan.penjualan_id ASC";
    $result = mysqli_query($conn, $sql);
    $no = 1;
    $total = 0;
    
    while ($data = mysqli_fetch_array($result)) {
        $total += $data['total'];
        ?>
        <tr>
            <td><?= $no ?>.</td>
            <td><?= $data['tgl_penjualan'] ?></td>
            <td><?= $data['kode_produk'] ?></td>
            <td><?= $data['nama_produk'] ?></td>
            <td><?= number_format($data['harga'], 0, ".", ",") ?></td>
            <td><?= $data['jumlah_produk'] ?></td>
            <td><?= number_format($data['total'], 0, ".", ",") ?></td>
            <td><?= $data['nama_user'] ?></td>
        </tr>
        <?php
        $no++;
    }
    ?>
    <tr>
        <td colspan="6"><b>Total :</b></td>
        <td><b><?= number_format($total, 0, ",", ".") ?></b></td>
        <td></td>
    </tr>
</table>
<br>
<a href="harian_print.php?tgl=<?= $tgl ?>&bln=<?= $bln ?>&thn=<?= $thn ?>" class="cetak" target="_blank">Cetak</a>
<a href="index.php" class="back">Back</a>

</body>
</html>
