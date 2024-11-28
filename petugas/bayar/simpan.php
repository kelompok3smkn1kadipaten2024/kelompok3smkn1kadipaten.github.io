<?php
include "config.php";
if(isset($_POST['save'])){
    $id=$_POST['id'];
$pelid=$_POST['id_pelanggan'];
$kd=$_POST['kd'];
$produk =mysqli_query($conn, "SELECT * FROM produk where kode_produk = '$kd'");
$show = mysqli_fetch_array($produk);
$jm=$_POST['jm'];
$sub=$_POST['jm'] * $show['harga'];
$insert=mysqli_query($conn,"insert into detailpenjualan (detail_id, penjualan_id, kode_produk, jumlah_produk, subtotal) values('null', '$id', '$kd', '$jm', '$sub')");
}
?>
<meta http-equiv="refresh" content="1;url=detail.php">