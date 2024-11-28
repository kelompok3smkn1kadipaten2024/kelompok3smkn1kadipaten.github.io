<?php
if (isset($_POST['edit'])) {
    $id=$_POST['user_id'];
    $nama_user=$_POST['nama_user'];
    $user=$_POST['username'];
    $level=$_POST['level'];
    include "../config.php";
    $sqls="update user set user_id='$id', nama_user='$nama_user', username='$user', level='$level' where user_id='$id'";
    $edit=mysqli_query($conn,$sqls);
    if ($edit) {
        echo "<script>alert('Data Berhasil Di Edit')</script>";
    } else {
        echo "<script>alert('Data Gagal Di Edit')</script>";
    }
}
?>
<meta http-equiv="refresh" content="1;url=index.php">