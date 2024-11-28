<?php 
if (isset($_POST['save'])) {
	$nama_produk=$_POST['nama_produk'];
	$kode_produk=$_POST['kode_produk'];
	$kode_kategori=$_POST['kode_kategori'];
	$harga=$_POST['harga'];
	$stok=$_POST['stok'];
	include "../config.php";
	$sqls="insert into produk (produk_id, nama_produk, kode_produk, kode_kategori, harga, stok) values ('null','$nama_produk', '$kode_produk', '$kode_kategori', '$harga', '$stok')";
	$simpan=mysqli_query($conn,$sqls);
	if ($simpan) {
		echo "<script>alert('Data Berhasil Disimpan')</script>";
	}else{
		echo "<script>alert('Data Gagal Disimpan')</script>";
	}
}
 ?>
 <meta http-equiv="refresh" content="1;url=index.php">