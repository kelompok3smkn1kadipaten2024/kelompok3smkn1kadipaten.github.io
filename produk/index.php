<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}
include "../config.php";

// Tentukan jumlah data per halaman
$data_per_halaman = 5;

// Tentukan halaman saat ini
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;

// Hitung offset
$offset = ($halaman - 1) * $data_per_halaman;

// Mendapatkan kategori yang dipilih
$kategori_terpilih = isset($_GET['kategori']) ? $_GET['kategori'] : 'Semua';

// Query untuk menghitung jumlah total data produk sesuai kategori
if ($kategori_terpilih == 'Semua') {
    $query_count = "SELECT COUNT(*) AS total FROM produk";
    $query_produk = "SELECT p.produk_id, p.kode_produk, p.nama_produk, k.nama_kategori, p.harga, p.stok 
                     FROM produk p
                     JOIN kategori k ON k.kode_kategori = p.kode_kategori
                     LIMIT $offset, $data_per_halaman";
} else {
    $query_count = "SELECT COUNT(*) AS total FROM produk p
                    JOIN kategori k ON k.kode_kategori = p.kode_kategori
                    WHERE k.nama_kategori = '$kategori_terpilih'";
    $query_produk = "SELECT p.produk_id, p.kode_produk, p.nama_produk, k.nama_kategori, p.harga, p.stok 
                     FROM produk p
                     JOIN kategori k ON k.kode_kategori = p.kode_kategori
                     WHERE k.nama_kategori = '$kategori_terpilih'
                     LIMIT $offset, $data_per_halaman";
}

$result_count = mysqli_query($conn, $query_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_data = $row_count['total'];

// Hitung jumlah total halaman
$total_halaman = ceil($total_data / $data_per_halaman);

$result_produk = mysqli_query($conn, $query_produk);

// Query untuk mengambil data kategori
$query_kategori = "SELECT DISTINCT nama_kategori FROM kategori";
$result_kategori = mysqli_query($conn, $query_kategori);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Produk</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/navbar.css">
    <style>
        body {
            background-color: #f4f6f9;
        }

        .container {
            margin-top: 20px;
            max-width: 900px;
        }

        .table {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .table th {
            background-color: #007bff;
            color: #ffffff;
            text-align: center;
        }

        .table td, .table th {
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #eaf4ff;
        }

        .btn-info, .btn-success {
            color: #fff;
        }

        .btn-info:hover {
            background-color: #0056b3;
        }

        .pagination a {
            display: inline-block;
            padding: 5px 10px;
            margin-right: 5px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 5px;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .pagination a.active {
            background-color: #007bff;
            color: #fff;
            border: none;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
</head>
<body>
<?php include "../navbar.php"; ?>

<div class="container">
    <h2 class="text-center mb-4">Daftar Produk</h2>

    <!-- Dropdown untuk memilih kategori -->
    <form method="get" class="mb-3">
        <label for="kategori">Pilih Kategori:</label>
        <select name="kategori" id="kategori" class="form-control" style="width: 200px; display: inline-block;">
            <option value="Semua" <?= $kategori_terpilih == 'Semua' ? 'selected' : '' ?>>Semua</option>
            <?php while ($row_kategori = mysqli_fetch_assoc($result_kategori)) : ?>
                <option value="<?= $row_kategori['nama_kategori'] ?>" <?= $kategori_terpilih == $row_kategori['nama_kategori'] ? 'selected' : '' ?>>
                    <?= $row_kategori['nama_kategori'] ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit" class="btn btn-primary ml-2">Tampilkan</button>
    </form>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = ($halaman - 1) * $data_per_halaman + 1;
            while ($data = mysqli_fetch_array($result_produk)) : ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $data['kode_produk'] ?></td>
                    <td><?= $data['nama_produk'] ?></td>
                    <td><?= $data['nama_kategori'] ?></td>
                    <td align="right"><?= number_format($data['harga'], 0, ',', '.') ?></td>
                    <td align="right"><?= $data['stok'] ?></td>
                    <td align="center">
                        <a href="edit.php?id=<?= $data['produk_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete.php?id=<?= $data['produk_id'] ?>" onclick="return confirm('Apakah Anda Yakin Produk <?= $data['nama_produk'] ?> akan dihapus')" class="btn btn-danger btn-sm">Del</a>
                    </td>
                </tr>
                <?php $no++; ?>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Tampilkan navigasi halaman -->
    <div class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $total_halaman; $i++) : ?>
            <a href="?halaman=<?= $i ?>&kategori=<?= $kategori_terpilih ?>" class="<?= $i == $halaman ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>

    <div class="text-center mt-3">
        <a href="form.php" class="btn btn-success">[+] Tambah Produk</a>
    </div>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
