<?php
if (isset($_POST['edit'])) {
    $id=$_POST['id'];
    $nama_produk=$_POST['nama_produk'];
    $kode_produk=$_POST['kode_produk'];
    $kode_kategori=$_POST['kode_kategori'];
    $harga=$_POST['harga'];
    $stok=$_POST['stok'];
    include "../config.php";
    $sqls="update produk set produk_id='$id', nama_produk='$nama_produk', kode_produk='$kode_produk', kode_kategori='$kode_kategori', harga='$harga', stok='$stok' where produk_id='$id'";
    $edit=mysqli_query($conn,$sqls);
    if ($edit) {
        echo "<script>alert('Data Berhasil Di Edit')</script>";
    } else {
        echo "<script>alert('Data Gagal Di Edit')</script>";
    }
}
?>
<meta http-equiv="refresh" content="1;url=index.php">