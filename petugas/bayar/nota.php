<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Kecil</title>
    <style>
        /* Reset umum */
        * {
            margin: 0;
            padding: 0;
            font-family: "Helvetica Neue", "Helvetica", Arial, sans-serif;
            box-sizing: border-box;
            font-size: 11px; /* Ukuran font lebih kecil */
        }

        body {
            -webkit-font-smoothing: antialiased;
            width: 100%;
            height: 100%;
            line-height: 1.4;
            background-color: #fff; /* Latar belakang putih */
        }

        .container {
            width: 100%;
            max-width: 250px; /* Ukuran kecil untuk nota */
            margin: 0 auto;
        }

        .content {
            padding: 10px;
        }

        .main {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
        }

        h2 {
            font-size: 14px; /* Ukuran lebih kecil */
            text-align: center;
        }

        .invoice {
            width: 100%;
            margin: 10px 0;
        }

        .invoice-items td {
            padding: 3px 0;
        }

        .invoice-items {
            width: 100%;
            margin-bottom: 10px;
        }

        .invoice-items td {
            border-top: #eee 1px solid;
        }

        .invoice-items .total td {
            border-top: 2px solid #333;
            border-bottom: 2px solid #333;
            font-weight: bold;
        }

        .alignright {
            text-align: right;
        }

        .aligncenter {
            text-align: center;
        }

        .footer {
            text-align: center;
            margin-top: 10px;
            font-size: 10px;
            color: #555;
        }
    </style>
</head>
<body>
    <?php
        include "config.php";

        // Sanitize and get the id parameter
        $id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : die("Invalid ID");

        // Fetch sales data
        $pel = mysqli_query($conn, "SELECT * FROM penjualan WHERE penjualan_id = '$id'");
        if (!$pel) {
            die("Database query failed: " . mysqli_error($conn));
        }
        $data = mysqli_fetch_array($pel);

        if (!$data) {
            die("No data found for this invoice.");
        }

        // Fetch customer data
        $pelid = $data['pelanggan_id'];
        $pen = mysqli_query($conn, "SELECT * FROM pelanggan WHERE pelanggan_id = '$pelid'");
        if (!$pen) {
            die("Database query failed: " . mysqli_error($conn));
        }
        $datapen = mysqli_fetch_array($pen);
    ?>
    <div class="container">
        <div class="content">
            <div class="main">
                <h2>Toko AlfaTihah</h2>
                <p>Nama Pelanggan: <?= htmlspecialchars($datapen['nama_pelanggan']) ?><br>
                Invoice #<?= htmlspecialchars($data['penjualan_id']) ?><br>
                Tanggal: <?= htmlspecialchars($data['tgl_penjualan']) ?></p>

                <table class="invoice-items">
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th align="center">Jml</th>
                            <th align="right">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $bar = mysqli_query($conn, "SELECT detailpenjualan.kode_produk, produk.nama_produk, produk.harga, detailpenjualan.subtotal, detailpenjualan.jumlah_produk FROM detailpenjualan, produk WHERE produk.kode_produk=detailpenjualan.kode_produk AND detailpenjualan.penjualan_id='$id'");
                            $tot = 0;
                            while($barang = mysqli_fetch_array($bar)){
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($barang['nama_produk']) ?></td>
                            <td class="aligncenter"><?= htmlspecialchars($barang['jumlah_produk']) ?></td>
                            <td class="alignright"><?= number_format($barang['subtotal'], 0, ',', '.') ?></td>
                        </tr>
                        <?php
                            $tot += $barang['subtotal'];
                            }
                        ?>
                        <tr class="total">
                            <td>Total</td>
                            <td></td>
                            <td class="alignright"><?= number_format($tot, 0, ',', '.') ?></td>
                        </tr>
                    </tbody>
                </table>

                <div class="footer">
                    Jl. Raya K H Abdul Halim No.467<br>
                    Tonjong, Kec. Majalengka, Kabupaten Majalengka
                </div>
            </div>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
