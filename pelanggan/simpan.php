<?php 
if (isset($_POST['save'])) {
	$nama_pelanggan=$_POST['nama_pelanggan'];
	$alamat=$_POST['alamat'];
	$nomor_telepon=$_POST['nomor_telepon'];
	include "../config.php";
	$sqls="insert into pelanggan (nama_pelanggan, alamat, nomor_telepon) values ('$nama_pelanggan', '$alamat', '$nomor_telepon')";
	$simpan=mysqli_query($conn,$sqls);
	if ($simpan) {
		echo "<script>alert('Data Berhasil Disimpan')</script>";
	}else{
		echo "<script>alert('Data Gagal Disimpan')</script>";
	}
}
 ?>
 <meta http-equiv="refresh" content="1;url=index.php">