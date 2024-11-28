<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}
include "config.php";

// Tentukan jumlah data per halaman
$data_per_halaman = 10;

// Tentukan halaman saat ini
$halaman = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;

// Hitung offset
$offset = ($halaman - 1) * $data_per_halaman;

// Query untuk menghitung jumlah total data produk
$query_count = "SELECT COUNT(*) AS total FROM penjualan";
$result_count = mysqli_query($conn, $query_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_data = $row_count['total'];

// Hitung jumlah total halaman
$total_halaman = ceil($total_data / $data_per_halaman);

// Query untuk mengambil data produk dengan batasan halaman
$query_penjualan = "SELECT * FROM penjualan LIMIT $offset, $data_per_halaman";
$result_penjualan = mysqli_query($conn, $query_penjualan);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Penjualan</title>
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

        .table td,
        .table th {
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #eaf4ff;
        }

        .btn-info {
            background-color: #007bff;
            border: none;
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
        <h2 class="text-center mb-4">Daftar Transaksi</h2>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tgl Penjualan</th>
                    <th>Bayar</th>
                    <th>Total Harga</th>
                    <th>Pelanggan ID</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = ($halaman - 1) * $data_per_halaman + 1; // Hitung nomor urut data yang akan ditampilkan
                while ($data = mysqli_fetch_array($result_penjualan)) {
                    ?>
                    <tr>
                        <td><?= $no ?>.</td>
                        <td><?= $data['tgl_penjualan'] ?></td>
                        <td><?= number_format($data['bayar'], 0, ',', '.') ?></td>
                        <td><?= number_format($data['total_harga'], 0, ',', '.') ?></td>
                        <td><?= $data['pelanggan_id'] ?></td>
                        <td>
                            <a href="nota.php?id=<?= $data['penjualan_id'] ?>" class="btn btn-info btn-sm">Nota</a>
                        </td>
                    </tr>
                    <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>

        <!-- Tampilkan navigasi halaman -->
        <div class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $total_halaman; $i++): ?>
                <a href="?halaman=<?= $i ?>" class="<?= $i == $halaman ? 'active' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>

        <div class="text-center mt-3">
            <a href="form_transaksi.php" class="btn btn-success">[+] Transaksi</a>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
