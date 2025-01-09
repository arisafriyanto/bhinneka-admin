<?php $this->extend('layouts/app'); ?>

<?php $this->section('content'); ?>
<div class="container-fluid">
    <div class="mb-3 my-2 mx-1">
        <div class="d-flex">
            <h4 class="text-bold">Dashboard</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-4 d-flex">
            <div class="card flex-fill border-0 illustration">
                <div class="card-body p-0 d-flex flex-fill">
                    <div class="p-3 m-1">
                        <h4>Total Transaksi</h4>
                        <h2 id="totalTransactions" class="mb-0"><?= $totalTransactions; ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 d-flex">
            <div class="card flex-fill border-0">
                <div class="card-body py-4">
                    <h4 class="mb-2">
                        Total Penjualan (Rp)
                    </h4>
                    <h4 id="totalSalesAmount" class="text-success me-2">
                        Rp <?= number_format($totalSalesAmount, 0, ',', '.'); ?>
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 d-flex">
            <div class="card flex-fill border-0 illustration">
                <div class="card-body p-0 d-flex flex-fill">
                    <div class="p-3 m-1">
                        <h4>Total Produk Terjual</h4>
                        <h2 id="totalQtySold" class="mb-0"><?= $totalQtySold; ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-start py-2">
                    <div>
                        <h3>Penjualan Produk Terbanyak</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-12 mt-4">
                        <canvas id="salesPerItemChart" style="max-height: 550px;"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx1 = document.getElementById('salesPerItemChart').getContext('2d');
        const salesPerItemChart = new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: <?= $productNames; ?>,
                datasets: [{
                    label: 'Jumlah Penjualan',
                    data: <?= $productSales; ?>,
                    backgroundColor: [
                        '#3498db',
                        '#2ecc71',
                        '#f1c40f',
                        '#e67e22',
                        '#9b59b6',
                        '#95a5a6'
                    ],
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' produk';
                            }
                        }
                    }
                }
            }
        });
    });
</script>
<?= $this->endSection() ?>