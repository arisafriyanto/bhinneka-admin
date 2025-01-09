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
                        Edit Transaksi
                    </h5>
                    <p class="text-muted">Isi semua form untuk memperbarui data transaksi.</p>

                    <form action="<?= base_url('transactions/update/') . $transaction['id'] ?>" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">

                        <div class="mb-3">
                            <label for="user_id" class="form-label">Nama Pembeli</label>
                            <span class="text-danger">*</span>
                            <select class="form-control <?= session('validation') && session('validation')->hasError('user_id') ? 'is-invalid' : '' ?>"
                                id="user_id" name="user_id">
                                <option value="" disabled>-- Pilih Pembeli --</option>
                                <?php foreach ($users as $user): ?>
                                    <option value="<?= esc($user['id']) ?>" <?= (old('user_id') ?? esc($transaction['user_id'])) == esc($user['id']) ? 'selected' : '' ?>>
                                        <?= esc($user['name']) ?>
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
                                <?php foreach ($transactionDetails as $index => $detail): ?>
                                    <div class="product-row mb-3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <select class="form-control product-select" name="products[<?= $index ?>][product_id]" required>
                                                    <option value="">--Pilih Produk--</option>
                                                    <?php foreach ($products as $product): ?>
                                                        <option value="<?= esc($product['id']) ?>" data-price="<?= esc($product['price']) ?>"
                                                            <?= esc($detail['product_id']) == $product['id'] ? 'selected' : '' ?>>
                                                            <?= esc($product['name']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <input type="number" class="form-control product-quantity" name="products[<?= $index ?>][quantity]" placeholder="Quantity" min="1" value="<?= esc($detail['quantity']) ?>" required>
                                            </div>

                                            <div class="col-md-2">
                                                <input type="number" class="form-control product-price" name="products[<?= $index ?>][price]" placeholder="Price" readonly value="<?= esc($detail['price']) ?>">
                                            </div>

                                            <div class="col-md-2">
                                                <input type="number" class="form-control product-total-price" name="products[<?= $index ?>][total_price]" placeholder="Total Price" readonly value="<?= esc($detail['subtotal_price']) ?>">
                                            </div>

                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger remove-product">-</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <button type="button" class="btn btn-success" id="add-product">+ Tambah Produk</button>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <label for="total_price">Total Harga</label>
                            <input type="number" id="total-price" class="form-control" name="total_price" value="<?= esc($transaction['total_price']) ?>" readonly>
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
    let productIndex = <?= count($transactionDetails) ?>;
</script>

<?= $this->include('transactions/partials/script') ?>
<?= $this->endSection() ?>