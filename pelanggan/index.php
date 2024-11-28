<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit ();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Pelanggan</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/navbar.css">
</head>
<body>
<style>
		.edit{
    		background-color:#0a0a23;
    		color: #fff;
    		border:none;
    		border-radius:10px;
			border-radius: 5px;
			padding: 5px 5px;
		}
		.delete{
			color: #fff;
			background-color: red;
			border-radius: 5px;
			padding: 5px 5px;
		}
		.add{
			color: #fff;
			background-color: green;
			padding: 10px 10px;
			border-radius: 10px;
		}
	</style>
  <?php
include "../navbar.php";
?>

    <div class="container home-container">
        <h2>Daftar Pelanggan</h2>
        <table class="table">
                <tr>
                    <th width="30px">No.</th>
                    <th>Nama Pelanggan</th>
                    <th width="200px">Alamat</th>
                    <th width="200px">No telepon</th>
                    <th width="200px">Aksi</th>
                </tr>
                <?php
                include "../config.php";
                $sql = "select * from pelanggan";
                $result = mysqli_query($conn, $sql);
                $no = 1;
                while ($data = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?= $no ?>.</td>
                        <td><?= $data['nama_pelanggan'] ?></td>
                        <td><?= $data['alamat'] ?></td>
                        <td><?= $data['nomor_telepon'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $data['pelanggan_id'] ?>" class="edit">Edit</a>
                            <a href="delete.php?id=<?= $data['pelanggan_id'] ?>" onclick="return confirm('Apakah Anda Yakin Pelanggan <?= $data['nama_pelanggan'] ?> akan dihapus')" class="delete" >Del</a>
                        </td>
                    </tr>
                    <?php
                    $no++;
                }
                ?>
        </table><br>
        <a href="form.php" class="add">[+]Tambah Pelanggan</a>
    </div> <br>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
