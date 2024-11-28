<?php
if (isset($_POST['edit'])) {
    $id=$_POST['pelanggan_id'];
    $nama_pelanggan=$_POST['nama_pelanggan'];
    $alamat=$_POST['alamat'];
    $nomor_telepon=$_POST['nomor_telepon'];
    include "../config.php";
    $sqls="update pelanggan set pelanggan_id='$id', nama_pelanggan='$nama_pelanggan', alamat='$alamat', nomor_telepon='$nomor_telepon' where pelanggan_id='$id'";
    $edit=mysqli_query($conn,$sqls);
    if ($edit) {
        echo "<script>alert('Data Berhasil Di Edit')</script>";
    } else {
        echo "<script>alert('Data Gagal Di Edit')</script>";
    }
}
?>
<meta http-equiv="refresh" content="1;url=index.php">