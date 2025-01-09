<?php $this->extend('layouts/app'); ?>

<?php $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 mb-3 mb-sm-0">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('reports.index') }}" class="btn btn-light">
                            <i class="fa fa-arrow-left-long"></i>
                        </a>

                        Detail Transaksi
                    </h5>
                    <p class="text-muted mb-4">Berikut adalah rincian detail transaksi yang telah dibuat.
                    </p>

                    <div>
                        <h5 class="mb-3">Informasi Transaksi</h5>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>No. Faktur</th>
                                    <td><?= htmlspecialchars($transaction['invoice_number']); ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Pembeli</th>
                                    <td><?= htmlspecialchars($user['name']); ?></td>
                                </tr>
                                <tr>
                                    <th>Perusahaan</th>
                                    <td><?= htmlspecialchars($user['company_name']); ?></td>
                                </tr>
                                <tr>
                                    <th>Total Jumlah</th>
                                    <td><?= htmlspecialchars($total_quantity); ?> Produk</td>
                                </tr>
                                <tr>
                                    <th>Total Harga</th>
                                    <td><?= formatRupiah($transaction['total_price']); ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Pembelian</th>
                                    <td><?= date('d F Y, H:i', strtotime($transaction['created_at'])); ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <h5 class="mt-4">Detail Produk</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Produk</th>
                                    <th>Satuan</th>
                                    <th class="text-center">Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($transaction_details as $detail): ?>
                                    <tr>
                                        <td><?= $detail['code']; ?></td>
                                        <td><?= $detail['name']; ?></td>
                                        <td><?= $detail['unit_name']; ?></td>
                                        <td class="text-center"><?= $detail['quantity']; ?></td>
                                        <td><?= formatRupiah($detail['price']); ?></td>
                                        <td><?= formatRupiah($detail['subtotal_price']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="3" class="text-center"><strong>TOTAL</strong></td>
                                    <td class="text-center"><?= $total_quantity; ?></td>
                                    <td><?= formatRupiah($price); ?></td>
                                    <td><?= formatRupiah($transaction['total_price']); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>