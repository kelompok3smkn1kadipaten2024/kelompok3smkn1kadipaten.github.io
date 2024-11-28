<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="../style/navbar.css">

<nav class="navbar navbar-expand-lg navbar-dark">
    <!-- Logo mengarah ke halaman tentang.php -->
    <a class="navbar-brand" href="../halaman/tentang/">
        <img src="../logo1.png" alt="Logo" style="width: 30px; height: 30px; margin-right: 10px;">
    </a>
    <a class="navbar-brand" href="../halaman/">
        <i class="bi bi-house-door"></i> Home
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <?php  
    if(isset($_SESSION['level'])){
        $level=$_SESSION['level'];
        if($level=="admin"){
    ?>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="../pelanggan/">
                    <i class="bi bi-people"></i> Pelanggan
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../user/">
                    <i class="bi bi-person-badge"></i> Petugas
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../produk/">
                    <i class="bi bi-box"></i> Produk
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../bayar/">
                    <i class="bi bi-credit-card"></i> Penjualan
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../report/">
                    <i class="bi bi-bar-chart"></i> Laporan
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="../logout.php" onclick="return confirm ('Apakah anda yakin akan logout?') ">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>
        </ul>
    </div>
    <?php 
        } else {
    ?>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="../produk1">
                    <i class="bi bi-box"></i> Produk
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../bayar/">
                    <i class="bi bi-credit-card"></i> Penjualan
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../report/">
                    <i class="bi bi-bar-chart"></i> Laporan
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="../logout.php" onclick="return confirm ('Apakah anda yakin akan logout?') ">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>
        </ul>
    </div>
    <?php
        }
    }
    ?>
</nav>
