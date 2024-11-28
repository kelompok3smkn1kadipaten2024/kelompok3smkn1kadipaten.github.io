<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
	exit ();
	
}
include "../config.php";
// Tentukan jumlah data per halaman
$data_per_halaman = 10;

// Tentukan halaman saat ini
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;

// Hitung offset
$offset = ($halaman - 1) * $data_per_halaman;

// Query untuk menghitung jumlah total data produk
$query_count = "SELECT COUNT(*) AS total FROM produk";
$result_count = mysqli_query($conn, $query_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_data = $row_count['total'];

// Hitung jumlah total halaman
$total_halaman = ceil($total_data / $data_per_halaman);

// Query untuk mengambil data produk dengan batasan halaman
$query_produk = "SELECT p.produk_id, p.kode_produk, p.nama_produk, k.nama_kategori, p.harga, p.stok 
                 FROM produk p
                 JOIN kategori k ON k.kode_kategori = p.kode_kategori
                 LIMIT $offset, $data_per_halaman";
$result_produk = mysqli_query($conn, $query_produk);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="../style/navbar.css">
	<title>Daftar Produk</title>
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
		.pagination {
			margin-top: 10px;
		}
		.pagination a {
			display: inline-block;
			padding: 5px 10px;
			margin-right: 5px;
			background-color: #f2f2f2;
			border: 1px solid #ddd;
			border-radius: 3px;
			text-decoration: none;
			color: #333;
		}
		.pagination a.active {
			background-color: #007bff;
			color: #fff;
		}
	</style>
<?php
include "../navbar.php";
?>
	
	<div class="container home-container">
	<h2>Daftar Produk</h2>
	<table class="table">
		<tr>
			<th width="30px">No.</th>
			<th>Kode Produk</th>
			<th>Nama Produk</th>
			<th>Kategori</th>
			<th width="100px">Harga</th>
			<th width="100px">Stok</th>
			<th width="200px">Aksi</th>
		</tr>
		<?php 
		$no = ($halaman - 1) * $data_per_halaman + 1; // Hitung nomor urut data yang akan ditampilkan
		while ($data=mysqli_fetch_array($result_produk)) {
			?>
			<tr>
				<td><?= $no ?>.</td>
				<td><?= $data['kode_produk']?></td>
				<td><?= $data['nama_produk']?></td>
				<td><?= $data['nama_kategori']?></td>
				<td align="right"><?= $data['harga']?></td>
				<td align="right"><?= $data['stok']?></td>
				<td align="center">
					<a href="edit.php?id=<?= $data['produk_id'] ?>" class="edit">Edit</a>
				</td>
			</tr>
			<?php 
			$no++;
		}
		 ?>
	</table>
	<br>
	<!-- Tampilkan navigasi halaman -->
	<div class="pagination">
    <?php for ($i = 1; $i <= $total_halaman; $i++) : ?>
        <a href="?halaman=<?= $i ?>" <?= $i == $halaman ? 'class="active"' : '' ?>><?= $i ?></a>
    <?php endfor; ?>
	</div>
	</div>
<br>
	<!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
