<?php $this->extend('layouts/app'); ?>

<?php $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 mb-3 mb-sm-0">
            <div class="d-flex justify-content-between align-items-center mx-1 my-2">
                <div>
                    <h4 class="text-bold">Produk</h4>
                    <p class="text-muted">Daftar data produk.</p>
                </div>
                <div>
                    <a href="<?= base_url('products/create') ?>" class="btn btn-outline-primary">Tambah</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-striped" id="productsTable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Satuan</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $index => $product): ?>
                                    <tr class="align-middle">
                                        <td><?= $index + 1 ?>.</td>
                                        <td><?= $product['code']; ?></td>
                                        <td><?= $product['name']; ?></td>
                                        <td><?= $product['unit_name']; ?></td>
                                        <td><?= $product['stock']; ?></td>
                                        <td><?= formatRupiah($product['price']); ?></td>
                                        <td>
                                            <a href="<?= base_url('products/edit/' . $product['id']); ?>"
                                                class="btn btn-warning me-2">Edit</a>

                                            <form action="<?= base_url('products/delete/' . $product['id']); ?>" method="post"
                                                class="d-inline-block">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="DELETE">

                                                <button type="submit" class="btn btn-danger"
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
        $('#productsTable').DataTable();
    });
</script>
<?= $this->endSection() ?>