<?php
$id=$_GET['id'];
include "../config.php";
$sqld="delete from produk where produk_id='$id'";
$hapus=mysqli_query($conn,$sqld);
if ($hapus) {
    echo "<script>alert('Data Berhasil Di Hapus')</script>";
} else {
    echo "<script>alert('Data Gagal Di Hapus')</script>";
}
?>
<meta http-equiv="refresh" content="1;url=index.php">