<?php $this->extend('layouts/app'); ?>

<?php $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 mb-3 mb-sm-0">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="<?= base_url('units') ?>" class="btn btn-light">
                            <i class="fa fa-arrow-left-long"></i>
                        </a>

                        Edit Satuan
                    </h5>
                    <p class="text-muted">Isi formulir untuk mengedit data satuan.</p>

                    <form action="<?= base_url('units/update/') . $unit['id']  ?>" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">

                        <div class="mb-3">
                            <label for="name" class="form-label">name</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control <?= session('validation') && session('validation')->hasError('name') ? 'is-invalid' : '' ?>"
                                id="name" name="name" value="<?= old('name') ?? $unit['name'] ?>">

                            <?php if (session('validation') && session('validation')->hasError('name')): ?>
                                <div class="invalid-feedback">
                                    <?= session('validation')->getError('name') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>