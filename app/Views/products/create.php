<?php $this->extend('layouts/app'); ?>

<?php $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 mb-3 mb-sm-0">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="<?= base_url('products') ?>" class="btn btn-light">
                            <i class="fa fa-arrow-left-long"></i>
                        </a>

                        Tambah Produk
                    </h5>
                    <p class="text-muted">Isi semua form untuk menambahkan data produk.</p>

                    <form action="<?= base_url('products/store') ?>" method="POST">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="newCode" class="form-label">Kode Produk</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="newCode" name="newCode" value="<?= esc($newCode) ?>" disabled>

                            <input type="hidden" id="code" name="code" value="<?= esc($newCode) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control <?= session('validation') && session('validation')->hasError('name') ? 'is-invalid' : '' ?>"
                                id="name" name="name" value="<?= old('name') ?>">

                            <?php if (session('validation') && session('validation')->hasError('name')): ?>
                                <div class="invalid-feedback">
                                    <?= session('validation')->getError('name') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="unit" class="form-label">Satuan</label>
                            <span class="text-danger">*</span>
                            <select class="form-select <?= session('validation') && session('validation')->hasError('unit') ? 'is-invalid' : '' ?>" name="unit" id="unit">
                                <option selected disabled>--Pilih Satuan--</option>
                                <?php foreach ($units as $unit): ?>
                                    <option value="<?= esc($unit['id']) ?>"><?= esc($unit['name']) ?></option>
                                <?php endforeach; ?>
                            </select>

                            <?php if (session('validation') && session('validation')->hasError('unit')): ?>
                                <div class="invalid-feedback">
                                    <?= session('validation')->getError('unit') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <span class="text-danger">*</span>
                            <input type="number" class="form-control <?= session('validation') && session('validation')->hasError('price') ? 'is-invalid' : '' ?>"
                                id="price" name="price" value="<?= old('price') ?>">

                            <?php if (session('validation') && session('validation')->hasError('price')): ?>
                                <div class="invalid-feedback">
                                    <?= session('validation')->getError('price') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stok</label>
                            <span class="text-danger">*</span>
                            <input type="number" class="form-control <?= session('validation') && session('validation')->hasError('stock') ? 'is-invalid' : '' ?>"
                                id="stock" name="stock" value="<?= old('stock') ?>">

                            <?php if (session('validation') && session('validation')->hasError('stock')): ?>
                                <div class="invalid-feedback">
                                    <?= session('validation')->getError('stock') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>