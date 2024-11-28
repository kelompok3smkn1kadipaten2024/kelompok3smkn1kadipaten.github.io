<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            box-sizing: border-box;
            font-size: 9px;
        }

        img {
            max-width: 100%;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100% !important;
            height: 100%;
            line-height: 1.2;
        }

        table td {
            vertical-align: top;
        }

        body {
            background-color: #f6f6f6;
        }

        .container {
            display: block !important;
            max-width: 58mm;
            margin: 0 auto !important;
            clear: both !important;
        }

        .content {
            max-width: 58mm;
            margin: 0 auto;
            display: block;
            padding: 5px;
        }

        .content-wrap {
            padding: 5px;
        }

        h1, h2, h3 {
            color: #000;
            margin: 5px 0;
            line-height: 1.2;
            font-weight: 400;
            text-align: center;
        }

        h2 {
            font-size: 12px;
        }

        h3 {
            font-size: 10px;
        }

        .invoice {
            margin: 10px 0;
            text-align: left;
            width: 100%;
        }

        .invoice td {
            padding: 2px 0;
        }

        .invoice .invoice-items td {
            border-top: #eee 1px solid;
        }

        .invoice .invoice-items .total td {
            border-top: 2px solid #333;
            border-bottom: 2px solid #333;
            font-weight: 700;
        }

        @media only screen and (max-width: 640px) {
            h2 {
                font-size: 10px !important;
            }
            .container {
                width: 100% !important;
            }
            .content, .content-wrap {
                padding: 5px !important;
            }
            .invoice {
                width: 100% !important;
            }
        }
    </style>
</head>
<body>
    <?php
        include "config.php";
        $id=$_GET['id'];
        $pel=mysqli_query($conn, "SELECT * FROM penjualan WHERE penjualan_id = '$id'");
        $data=mysqli_fetch_array($pel);
        $pelid = $data['pelanggan_id'];
        $pen=mysqli_query($conn, "SELECT * FROM pelanggan WHERE pelanggan_id = '$pelid'");
        $datapen=mysqli_fetch_array($pen);
    ?>
    <table class="body-wrap">
        <tr>
            <td class="container">
                <div class="content">
                    <table class="main" width="100%">
                        <tr>
                            <td class="content-wrap aligncenter">
                                <table width="100%">
                                    <tr>
                                        <td class="content-block" align="center">
                                            <img src="logo1.png" alt="Logo" style="width: 80%; max-width: 40mm;"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block" align="center">
                                            <h2>ROTI JUARA</h2>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%">
                                    <tr>
                                        <td class="content-block">
                                            <table class="invoice">
                                                <tr>
                                                    <td><?= $datapen['nama_pelanggan'] ?><br>Invoice #<?= $data['penjualan_id'] ?><br><?= $data['tgl_penjualan'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table class="invoice-items" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>Barang</th>
                                                                    <th align="center">Jumlah</th>
                                                                    <th align="right">Harga</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                    $bar = mysqli_query($conn, "SELECT detailpenjualan.kode_produk, produk.nama_produk, produk.harga, detailpenjualan.subtotal, detailpenjualan.jumlah_produk FROM detailpenjualan JOIN produk ON produk.kode_produk=detailpenjualan.kode_produk WHERE detailpenjualan.penjualan_id='$id'");
                                                                    $tot=0;
                                                                    while($barang = mysqli_fetch_array($bar)){
                                                                ?>    
                                                                <tr>
                                                                    <td><?= $barang['nama_produk'] ?></td>
                                                                    <td align="center"><?= $barang['jumlah_produk'] ?></td>
                                                                    <td align="right"><?= number_format($barang['subtotal'], 0, ',', '.') ?></td>
                                                                </tr>
                                                                <?php
                                                                    $tot += $barang['subtotal'];
                                                                    }
                                                                ?>
                                                                <tr class="total">
                                                                    <td>Total</td>
                                                                    <td></td>
                                                                    <td align="right"><?= number_format($tot, 0, ',', '.') ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Bayar</td>
                                                                    <td></td>
                                                                    <td align="right"><?= number_format($data['bayar'], 0, ',', '.') ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Kembalian</td>
                                                                    <td></td>
                                                                    <td align="right"><?= number_format($data['bayar'] - $tot, 0, ',', '.') ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                           <center> Jl. Raya K H Abdul Halim No.467, Tonjong, Kec. Majalengka, Kabupaten. Majalengka</center>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</body>
<script>
    window.print();
</script>
</html>
