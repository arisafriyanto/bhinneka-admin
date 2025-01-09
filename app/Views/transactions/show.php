<?php $this->extend('layouts/app'); ?>

<?php $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 mb-3 mb-sm-0">
            <div class="d-flex justify-content-between align-items-center mx-1 my-2">
                <div>
                    <h4 class="text-bold">Detail Transaksi</h4>
                    <p class="text-muted">Detail informasi transaksi dengan nomor faktur <?= $transaction['invoice_number']; ?></p>
                </div>
                <div>
                    <a href="<?= base_url('transactions') ?>" class="btn btn-outline-primary">Kembali ke Daftar</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5>Informasi Transaksi</h5>
                    <p><strong>No. Faktur:</strong> <?= $transaction['invoice_number']; ?></p>
                    <p><strong>Nama</strong> <?= $transaction['name']; ?></p>
                    <p><strong>Total Jumlah:</strong> <?= $total_quantity; ?> Produk</p>
                    <p><strong>Total Harga:</strong> <?= formatRupiah($transaction['total_price']); ?></p>

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
<?= $this->endSection() ?>