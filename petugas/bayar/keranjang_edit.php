<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config.php';
    $kode_produk = $_POST['kode_produk'];
    $jumlah_produk = $_POST['jumlah_produk'];
    $sqls = "UPDATE detailpenjualan SET jumlah_produk='$jumlah_produk' WHERE kode_produk='$kode_produk' AND penjualan_id='{$_SESSION['id']}'";
    $edit=mysqli_query($conn,$sqls);
    if ($edit) {
        echo "<script>alert('Data Berhasil Di Edit')</script>";
    } else {
        echo "<script>alert('Data Gagal Di Edit')</script>";
    }
}
?>
<meta http-equiv="refresh" content="1;url=detail.php">