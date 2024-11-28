<?php session_start(); 
$nama_user = isset($_SESSION['nama_user']) ? $_SESSION['nama_user'] : 'Nama Pengguna Tidak Ditemukan'; 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan Penjualan</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<style>
	body{
		background: white;
		padding:20px;
	}
	td{
		background:white;
	}
	</style>
</head>
<body class="a4">
	<section>
		<h2 align="center">Toko AlfaTihah</h2>
	<h5 align="center">Jl. Raya K H Abdul Halim No.467, Tonjong, Kec. Majalengka, Kabupaten. Majalengka</h5><hr>
<?php
$bln=$_GET['bln'];
$thn=$_GET['thn'];
$bulan=$thn."-".$bln;
?>
<h4>Laporan Penjualan<br>Bulan : <?= $bln ?>-<?= $thn ?></h4>
<table width="100%" border="1px" cellspacing="0">
	<tr>
		<th class="jdl-kolom">No.</th>
		<th class="jdl-kolom" width="100px">Tanggal</th>
		<th class="jdl-kolom">Kode Produk</th>
		<th class="jdl-kolom">Nama Produk</th>
		<th class="jdl-kolom">Harga</th>
		<th class="jdl-kolom">Jumlah</th>
		<th class="jdl-kolom">Total</th>
		<th class="jdl-kolom">Nama Petugas</th>
	</tr>
	<?php  
	include "../config.php";
	$sql="select penjualan.tgl_penjualan, produk.kode_produk, produk.nama_produk, produk.harga, detailpenjualan.jumlah_produk, produk.harga*detailpenjualan.jumlah_produk as total, penjualan.nama_user from penjualan,produk,detailpenjualan where penjualan.penjualan_id=  detailpenjualan.penjualan_id and detailpenjualan.kode_produk=produk.kode_produk and penjualan.tgl_penjualan like '$bulan%' order by detailpenjualan.penjualan_id asc";
	$result=mysqli_query($conn,$sql);
	$no=1;
	$brs=0;
	$total=0;
	while($data=mysqli_fetch_array($result)){
		$jumlah_bayar=number_format($data['jumlah_produk'],0,",",".");
		if($brs%2==0){
			echo "<tr class='brs-genap'>";
		}else{
			echo "<tr class='brs-ganjil'>";
		}
	?>
		<td class="brs"><?= $no ?>.</td>
		<td class="brs"><?= $data['tgl_penjualan'] ?></td>
		<td class="brs"><?= $data['kode_produk'] ?></td>
		<td class="brs"><?= $data['nama_produk'] ?></td>
		<td class="brs"><?= $data['harga'] ?></td>
		<td class="brs"><?= $data['jumlah_produk'] ?></td>
		<td class="brs"><?= $data['total'] ?></td>
		<td class="brs"><?= $data['nama_user'] ?></td>
	</tr>
<?php
	$no++;
	$brs++;
	$total=$data['total']+$total;
	$tot=number_format($total,0,",",".");
	}
	?>
	<tr>
		<td colspan="6" class="brs"><b>Total :</b></td>
		<td align="left" class="brs"><b><?= $total ?></b></td>
		<td class="brs"></td>
	</tr>
</table>
<br><br><br><br>
              <h4 align="right">Majalengka, <?php echo date('d/m/Y'); ?></h4>
              <h4 align="right">Petugas,</h4><br><br>
              <h4 align="right">(<?php echo $_SESSION['nama_user']; ?>)</h4><br><br><br><br>
<script>
	window.print();
</script>

</section>
</body>
</html>