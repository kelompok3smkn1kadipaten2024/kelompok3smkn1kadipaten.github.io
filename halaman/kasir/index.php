<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS and Icons -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        main {
            margin-top: 30px;
        }
        .chart {
            width: 100%;
            padding-top: 5px;
        }
        .carousel-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../halaman/">
            <i class="bi bi-house-door"></i> Home
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../../produk/"><i class="bi bi-box"></i> Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/petugas/bayar/"><i class="bi bi-credit-card"></i> Penjualan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/petugas/report/"><i class="bi bi-bar-chart"></i> Laporan</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php" onclick="return confirm('Apakah anda yakin akan logout?')">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <header class="mt-4 mb-3 text-center">
            <h2>DASHBOARD</h2>
            <h3 class="text-secondary">Ini Merupakan Tampilan Dashboard</h3>
            <hr>
        </header>

        <main>
            <div class="row carousel-container">
                <div class="col-md-8">
                    <div class="chart">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
                <div class="col-md-4">
                    <h4 class="text-center">Best Seller Menu</h4>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="image1.jpeg" class="d-block w-100" alt="Roti Juara Keju">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Roti Juara Keju</h5>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="image2.jpg" class="d-block w-100" alt="Roti Juara Coklat">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Roti Juara Durian</h5>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="image3.jpeg" class="d-block w-100" alt="Roti Juara Durian">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Roti Juara Coklat</h5>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="chart">
                        <canvas id="Charts"></canvas>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Chart.js Scripts -->
    <script>
        const grafik = <?= $json_penjualan ?? '[]'; ?>;
        const ctx = document.getElementById('myChart').getContext('2d');
        const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: grafik.map((item) => bulan[item.bulan - 1]),
                datasets: [{
                    label: 'Jumlah Penjualan',
                    data: grafik.map(item => item.count),
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'white',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const charts = document.getElementById('Charts').getContext('2d');
        const grafiks = <?= $json_produk ?? '[]'; ?>;
        new Chart(charts, {
            type: 'doughnut',
            data: {
                labels: grafiks.map((item) => item.nama_produk),
                datasets: [{
                    label: 'Jumlah Terjual',
                    data: grafiks.map(item => item.jumlah),
                    backgroundColor: ["red", "blue", "yellow", "green", "orange"],
                }]
            }
        });
    </script>

    <!-- Bootstrap JS, jQuery, and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdel
