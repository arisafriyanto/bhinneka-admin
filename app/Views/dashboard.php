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
                        <h2 id="totalTransactions" class="mb-0">34</h2>
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
                        Rp 100.000
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 d-flex">
            <div class="card flex-fill border-0 illustration">
                <div class="card-body p-0 d-flex flex-fill">
                    <div class="p-3 m-1">
                        <h4>Total Qty Item Terjual</h4>
                        <h2 id="totalQtySold" class="mb-0">213</h2>
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
                        <label for="daterange">Filter Tanggal:</label>
                        <input type="text" id="daterange" class="form-control" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6 mt-4">
                        <canvas id="salesPerMonthChart"></canvas>
                    </div>

                    <div class="col-12 col-md-6 mt-4">
                        <canvas id="salesPerItemChart"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>