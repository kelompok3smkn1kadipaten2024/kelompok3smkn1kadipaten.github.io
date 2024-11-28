<?php 
session_start();
$id=$_SESSION['id'];
$tot=$_POST['tot'];
$bayar=$_POST['bayar'];
include "config.php";
$sqls="update penjualan set total_harga='$tot', bayar='$bayar' where penjualan_id='$id'";
$simpan=mysqli_query($conn,$sqls);
$_SESSION['tot']=$tot;
$_SESSION['byr']=$bayar;
if ($bayar < $tot) {
    echo "<script>alert('Pembayaran tidak mencukupi')</script>";
} else {
    $kembali = $bayar-$tot;
    $_SESSION['kembali']=$kembali;
}
?>
<meta http-equiv="refresh" content="1;url=detail.php?save=1">