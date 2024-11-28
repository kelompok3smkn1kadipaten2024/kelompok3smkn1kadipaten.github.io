<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<style>
	/* Gaya CSS untuk halaman laporan */
body {
    font-family: Arial, sans-serif;
}

h2 {
    color: #007bff; /* Warna teks h2 */
}

.form-report {
    max-width: 400px; /* Lebar maksimum form */
    margin: 0 auto 20px; /* Tengah form di halaman dan ruang margin bawah */
    background-color: #fff; /* Warna latar belakang form */
    padding: 20px; /* Ruang padding dalam form */
    border-radius: 8px; /* Border radius form */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Bayangan form */
}

select, input[type="submit"] {
    width: 100%; /* Lebar penuh untuk select dan tombol submit */
    padding: 10px; /* Ruang padding dalam select dan tombol */
    margin: 10px 0; /* Ruang margin atas dan bawah */
    box-sizing: border-box; /* Padding dan border termasuk dalam lebar dan tinggi elemen */
    border: 1px solid #ced4da; /* Warna border */
    border-radius: 4px; /* Border radius */
}

input[type="submit"] {
    background-color: #007bff; /* Warna latar belakang tombol submit */
    color: #fff; /* Warna teks tombol submit */
    border: none; /* Tanpa border */
    cursor: pointer; /* Ganti kursor saat diarahkan ke tombol */
}

input[type="submit"]:hover {
    background-color: #0056b3; /* Warna latar belakang tombol submit saat dihover */
}

</style>
<body>
	<?php
	include "../navbar.php";
	?>
<br>
<form method="POST" action="harian.php" class="form-report">
<h2>Laporan Harian</h2>
	<select name="tgl" size="1">
		<option value="1">Tanggal</option>
		<?php
		for($a=1;$a<=31;$a++){
		?>
		<option value="<?= $a ?>"><?= $a ?></option>
		<?php	
		} 
		?>
	</select>
	<select name="bln" size="1">
		<option value="1">Bulan</option>
		<?php
		for($b=1;$b<=12;$b++){
		?>
		<option value="<?= $b ?>"><?= $b ?></option>
		<?php	
		} 
		?>
	</select>
	<select name="thn" size="1">
		<option value="1">Tahun</option>
		<?php
		$thnskr=date("Y");
		$mulai=$thnskr-6;
		for($c=$mulai;$c<=$thnskr;$c++){
		?>
		<option value="<?= $c ?>"><?= $c ?></option>
		<?php	
		} 
		?>
	</select>
	<input type="submit" name="tglproses" value="OK" style="padding:5px 10px; margin:2px">
</form>

<form method="POST" action="bulanan.php" class="form-report">
	<h2>Laporan Bulanan</h2>
	<select name="bln" size="1">
		<option value="1">Bulan</option>
		<?php
		for($b=1;$b<=12;$b++){
		?>
		<option value="<?= $b ?>"><?= $b ?></option>
		<?php	
		} 
		?>
	</select>
	<select name="thn" size="1">
		<option value="1">Tahun</option>
		<?php
		$thnskr=date("Y");
		$mulai=$thnskr-6;
		for($c=$mulai;$c<=$thnskr;$c++){
		?>
		<option value="<?= $c ?>"><?= $c ?></option>
		<?php	
		} 
		?>
	</select>
	<input type="submit" name="tglproses" value="OK" style="padding:5px 10px; margin:2px">
</form>
</body>
</html>