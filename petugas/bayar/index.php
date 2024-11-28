<?php
session_start();
if (!isset ($_SESSION['user_id'])) {
  header("Location: ../index.php");
  exit();
}
include "config.php";
// Tentukan jumlah data per halaman
$data_per_halaman = 10;

// Tentukan halaman saat ini
$halaman = isset ($_GET['halaman']) ? (int) $_GET['halaman'] : 1;

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
$query_penjualan = "SELECT * from penjualan LIMIT $offset, $data_per_halaman";
$result_penjualan = mysqli_query($conn, $query_penjualan);

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../style/navbar.css">
  <title>Daftar Penjualan</title>
</head>

<body>
  <style>
    .edit {
      background-color: #0a0a23;
      color: #fff;
      border: none;
      border-radius: 10px;
      border-radius: 5px;
      padding: 5px 5px;
    }

    .delete {
      color: #fff;
      background-color: red;
      border-radius: 5px;
      padding: 5px 5px;
    }

    .add {
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
    <h2>Daftar Transaksi</h2>
    <table class="table">
      <tr>
        <th width="30px">No</th>
        <th>Tgl Penjualan</th>
        <th width="100px">Bayar</th>
        <th width="125px">Total Harga</th>
        <th width="132px">Pelanggan Id</th>
        <th width="200px">Aksi</th>
      </tr>
      <?php
      include "config.php";
      $sql = "select * from penjualan";
      $result = mysqli_query($conn, $sql);
      $no = 1;
      while ($data = mysqli_fetch_array($result)) {

        $no = ($halaman - 1) * $data_per_halaman + 1; // Hitung nomor urut data yang akan ditampilkan
        while ($data = mysqli_fetch_array($result_penjualan)) {
          ?>
    <td><?= $no ?>.</td>
    <td><?= $data['tgl_penjualan'] ?></td>
    <td><?= $data['bayar'] ?>
    </td>
    <td><?= number_format($data['total_harga'], 0, ',', '.') ?></td>
    <td><?= $data['pelanggan_id'] ?></td>
    <td align="center" width="80px">
      <a href="nota.php?id=<?= $data['penjualan_id'] ?>" class="btn btn-info mb-1">Nota</a>
        </td>
          </tr>
          <?php
          $no++;
        }
      }
      ?>
    </table>
    <br>
    <!-- Tampilkan navigasi halaman -->
    <div class="pagination">
      <?php for ($i = 1; $i <= $total_halaman; $i++): ?>
        <a href="?halaman=<?= $i ?>" <?= $i == $halaman ? 'class="active"' : '' ?>>
          <?= $i ?>
        </a>
      <?php endfor; ?>
    </div>
    <a href="form_transaksi.php" class="btn btn-info mb-3">[+] Transaksi</a>
  </div>
</body>
<footer>
  <!-- Bootstrap JS and Popper.js -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</footer>
</html>