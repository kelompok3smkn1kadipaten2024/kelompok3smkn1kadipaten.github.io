<html>
<head>
<meta name="vieport" content="width=device-width,
initial-scale=1.0">
<title>Laporan Penjualan</title>
<link rel="stylesheet" type="text/css" href="style.css">
<style>
body{
font:14px "Tahoma";
}
th{
background: darkgray;
color:white;
}
td{
background: #eee;
color:black;
}
.cetak{
background: blue;
color:white;
border-radius: 20px;
border:none;
text-decoration: none;
padding:3px 15px;
}
.halaman{
background: black;
color:white;
border-radius: 30px;
border:none;
text-decoration: none;
padding:3px 15px;
}
.simpan{
background: grey;
color:white;
border-radius: 20px;
border:none;
text-decoration: none;
padding:10px 20px;
}
.edit:hover, .hapus:hover, .simpan:hover{
background:purple;
}
</style>
</head>
<?php  
$tgl=$_POST['tgl'];
$bln=$_POST['bln'];
$thn=$_POST['thn'];
if($tgl<10){
	$tgl="0".$tgl;
}
if($bln<10){
	$bln="0".$bln;
}
$tanggal=$thn."-".$bln."-".$tgl;
?>
<h2>Laporan Harian<br>Tgl. <?= $tgl ?>-<?= $bln ?>-<?= $thn ?></h2>
<table width="100%">
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
$sql="select penjualan.tgl_penjualan, produk.kode_produk, produk.nama_produk, produk.harga, detailpenjualan.jumlah_produk, produk.harga*detailpenjualan.jumlah_produk as total, penjualan.nama_user from penjualan,produk,detailpenjualan where penjualan.penjualan_id=  detailpenjualan.penjualan_id and detailpenjualan.kode_produk=produk.kode_produk and penjualan.tgl_penjualan like '$tanggal%' order by detailpenjualan.penjualan_id asc";
	$result=mysqli_query($conn,$sql);
	$no=1;
	$brs=0;
	$total=0;
	while($data=mysqli_fetch_array($result)){
		$jumlah_bayar=number_format($data['jumlah_produk'],0,".",",");
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
<br>
<a href="harian_print.php?tgl=<?= $tgl ?>&bln=<?= $bln ?>&thn=<?= $thn ?>" class="cetak" target="_blank">Cetak</a>
<a href="index.php" class="cetak">Back</a>
</body>
</html>