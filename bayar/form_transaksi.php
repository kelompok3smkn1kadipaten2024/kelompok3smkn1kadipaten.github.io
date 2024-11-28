<?php
session_start();
$_SESSION['user_id'];

$nama_user = isset($_SESSION['nama_user']) ? $_SESSION['nama_user'] : 'Nama Pengguna Tidak Ditemukan';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Transaksi</title>
    <style>
        /* Reset default margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding-top: 0px; /* Space for fixed navbar */
            color: #333;
        }

        /* Navbar Styling */
        .navbar {
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        form {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 12px;
            margin: 20px auto;
            transition: transform 0.3s ease;
        }

        form:hover {
            transform: scale(1.02);
        }

        h2 {
            color: #333;
            font-size: 22px;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        td {
            padding: 10px 5px;
            font-size: 14px;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        input[list] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-top: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[list]:focus {
            border-color: #333;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .simpan,
        .batal {
            border: none;
            border-radius: 5px;
            padding: 12px 20px;
            color: #fff;
            cursor: pointer;
            font-size: 14px;
            transition: opacity 0.3s ease;
        }

        .simpan {
            background-color: #28a745;
        }

        .batal {
            background-color: #dc3545;
            text-decoration: none;
        }

        .batal:hover,
        .simpan:hover {
            opacity: 0.9;
        }

        hr {
            border: 0;
            height: 1px;
            background: #ddd;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <?php include "../navbar.php"; ?>
    </div>

    <!-- Form -->
    <form method="POST" action="detail.php">
        <h2>Input Data Transaksi</h2>
        <?php date_default_timezone_set('Asia/Jakarta'); ?>
        <hr>
        <table>
            <tr>
                <td><label for="nomor_telepon">No HP</label></td>
                <td>
                    <input list="nomor_telepon" name="nomor_telepon" autocomplete="off" placeholder="Pilih Pelanggan">
                    <datalist id="nomor_telepon">
                    <?php
                        include "../config.php";
                        $sqlp = "SELECT * FROM pelanggan";
                        $resp = mysqli_query($conn, $sqlp);
                        while ($dt = mysqli_fetch_array($resp)) {
                            echo "<option value='{$dt['nomor_telepon']}'>{$dt['nama_pelanggan']} | {$dt['nomor_telepon']}</option>";
                        }
                    ?>
                    </datalist>
                </td>
            </tr>
            <tr>
                <td><label for="tgl">Tanggal Penjualan</label></td>
                <td><input type="text" name="tgl" id="tgl" value="<?php echo date('Y-m-d'); ?>" readonly></td>
            </tr>
            <tr>
                <td><label for="nama_user">Petugas</label></td>
                <td><input type="text" name="nama_user" id="nama_user" value="<?php echo $nama_user; ?>" readonly></td>
            </tr>
        </table>
        <hr>
        <div class="button-container">
            <input type="submit" name="simpan" value="Simpan" class="simpan">
            <a href="index.php" class="batal">Batal</a>
        </div>
    </form>
</body>
</html>
