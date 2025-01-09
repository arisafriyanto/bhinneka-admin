<?php $this->extend('layouts/app'); ?>

<?php $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 mb-3 mb-sm-0">
            <div class="d-flex justify-content-between align-items-center mx-1 my-2">
                <div>
                    <h4 class="text-bold">Transaksi</h4>
                    <p class="text-muted">Daftar data transaksi.</p>
                </div>
                <div>
                    <a href="<?= base_url('transactions/create') ?>" class="btn btn-outline-primary">Tambah</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-striped" id="transactionsTable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Invoice</th>
                                    <th>Nama Pembeli</th>
                                    <th>Total Harga</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($transactions as $index => $transaction): ?>
                                    <tr class="align-middle">
                                        <td><?= $index + 1 ?>.</td>
                                        <td><?= $transaction['invoice_number']; ?></td>
                                        <td><?= $transaction['user_id']; ?></td>
                                        <td><?= formatRupiah($transaction['total_price']); ?></td>
                                        <td class="text-center"><?= $transaction['total_quantity']; ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('transactions/show/' . $transaction['id']); ?>"
                                                class="btn btn-info btn-sm me-2">Lihat</a>

                                            <a href="<?= base_url('transactions/edit/' . $transaction['id']); ?>"
                                                class="btn btn-warning btn-sm me-2">Edit</a>

                                            <form action="<?= base_url('transactions/delete/' . $transaction['id']); ?>" method="post"
                                                class="d-inline-block">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="DELETE">

                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data produk?');">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?php $this->section('scripts'); ?>
<script>
    $(document).ready(function() {
        $('#transactionsTable').DataTable();
    });
</script>
<?= $this->endSection() ?>