<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- Widget - Grafik (Menggunakan Chart.js) -->
               <div class="card">
					<div class="card-header">
						<h3 class="card-title">Yoo selamat datang di app coba printing</h3>
					</div>
					<div class="card-body">
						<ul class="list-group list-group-flush">
							<li class="list-group-item"><strong>NAMA</strong>: FIKRI</li>
							<li class="list-group-item"><strong>STAMBUK</strong>: 20210302042</li>
							<li class="list-group-item"><strong>KONTAK</strong>: 082132445523</li>
						</ul>
						<canvas id="salesChart" style="height: 250px;"></canvas>
					</div>
				</div>
                <!-- /.card -->
            </div>

            <div class="col-md-6">
                <!-- Widget - Informasi Dasar -->
                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="fas fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Email Admin</span>
                        <span class="info-box-number"><?= $user['email']; ?></span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

<!-- Script untuk inisialisasi Chart -->
<script>
    $(function () {
        // Ambil data penjualan dari server (gunakan AJAX atau PHP untuk mengambil data dari database)
        var salesData = {
            labels: <?= json_encode($months); ?>,
            datasets: [{
                label: 'Penjualan Bulanan',
                data: <?= json_encode($monthlySales); ?>,
                backgroundColor: 'rgba(0, 123, 255, 0.9)',
                borderColor: 'rgba(0, 123, 255, 0.9)',
                borderWidth: 1
            }]
        };

        var salesOptions = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    grid: {
                        display: false
                    }
                }
            }
        };

        // Inisialisasi grafik menggunakan Chart.js
        var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
        var salesChart = new Chart(salesChartCanvas, {
            type: 'bar',
            data: salesData,
            options: salesOptions
        });
    });
</script>
