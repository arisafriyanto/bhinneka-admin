<?php $this->extend('layouts/app'); ?>

<?php $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 mb-3 mb-sm-0">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="<?= base_url('transactions') ?>" class="btn btn-light">
                            <i class="fa fa-arrow-left-long"></i>
                        </a>

                        Tambah Transaksi
                    </h5>
                    <p class="text-muted">Isi semua form untuk menambahkan data transaksi.</p>

                    <form action="<?= base_url('transactions/store') ?>" method="POST">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="user_id" class="form-label">Nama Pembeli</label>
                            <span class="text-danger">*</span>
                            <select class="form-control <?= session('validation') && session('validation')->hasError('user_id') ? 'is-invalid' : '' ?>"
                                id="user_id" name="user_id">
                                <option value="">--Pilih Pembeli--</option>
                                <?php foreach ($users as $user): ?>
                                    <option value="<?= $user['id']; ?>" <?= old('user_id') == $user['id'] ? 'selected' : '' ?>>
                                        <?= esc($user['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <?php if (session('validation') && session('validation')->hasError('user_id')): ?>
                                <div class="invalid-feedback">
                                    <?= session('validation')->getError('user_id') ?>
                                </div>
                            <?php endif; ?>
                        </div>


                        <div class="mb-3">
                            <label for="products" class="mb-1">Produk</label>
                            <div id="products-container">
                                <div class="product-row mb-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select class="form-control product-select" name="products[0][product_id]" required>
                                                <option value="">--Pilih Produk--</option>
                                                <?php foreach ($products as $product): ?>
                                                    <option value="<?= esc($product['id']) ?>" data-price="<?= esc($product['price']) ?>">
                                                        <?= esc($product['name']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <input type="number" class="form-control product-quantity" name="products[0][quantity]" placeholder="Jumlah" min="1" value="1" required>
                                        </div>

                                        <div class="col-md-2">
                                            <input type="number" class="form-control product-price" name="products[0][price]" placeholder="Harga" readonly>
                                        </div>

                                        <div class="col-md-2">
                                            <input type="number" class="form-control product-total-price" name="products[0][total_price]" placeholder="Total Harga" readonly>
                                        </div>

                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger remove-product">-</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-success" id="add-product">+ Tambah Produk</button>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <label for="total_price">Total Harga</label>
                            <input type="number" id="total-price" class="form-control" name="total_price" value="0" readonly>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?php $this->section('scripts'); ?>
<script>
    let productIndex = 1;
</script>
<?= $this->include('transactions/partials/script') ?>
<?= $this->endSection() ?>