<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['level'] != 'admin') {
    header("Location: ../petugas/");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../style/navbar.css">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<title>Daftar Petugas</title>
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
	<h2>Daftar Petugas</h2>
	<table class="table">
		<tr>
			<th width="30px">No.</th>
			<th width="auto">Nama Petugas</th>
			<th width="200px">UserName</th>
			<th width="100px">Level</th>
			<th width="200px">Aksi</th>
		</tr>
		<?php 
		include "../config.php";
		$sql="select * from user";
		$result=mysqli_query($conn,$sql);
		$no=1;
		while ($data=mysqli_fetch_array($result)) {
			?>
			<tr>
				<td><?= $no ?>.</td>
				<td><?= $data['nama_user']?></td>
				<td align="right"><?= $data['username']?></td>
				<td align="right"><?= $data['level']?></td>
				<td align="center">
					<a href="edit.php?id=<?= $data['user_id'] ?>" class="edit">Edit</a>
					<a href="delete.php?id=<?= $data['user_id'] ?>" onclick="return confirm('Apakah Anda Yakin Petugas <?= $data['nama_user'] ?> akan dihapus')" class="delete">Del</a>
				</td>
			</tr>
			<?php 
			$no++;
		}
		 ?>
	</table>
	<br>
	<!-- Tombol atau elemen untuk memicu modal -->
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" >
        Tambah Petugas
    </button>
	</div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulir di dalam modal -->
                    <form action="simpan.php" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nama_user" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="level" required>
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>