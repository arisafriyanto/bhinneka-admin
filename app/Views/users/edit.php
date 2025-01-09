<?php $this->extend('layouts/app'); ?>

<?php $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 mb-3 mb-sm-0">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="<?= base_url('users') ?>" class="btn btn-light">
                            <i class="fa fa-arrow-left-long"></i>
                        </a>

                        Edit User
                    </h5>
                    <p class="text-muted">Isi form untuk memperbarui data user.</p>

                    <form action="<?= base_url('users/update/') . $user['id']  ?>" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control <?= session('validation') && session('validation')->hasError('name') ? 'is-invalid' : '' ?>"
                                id="name" name="name" value="<?= old('name') ?? esc($user['name']) ?>">

                            <?php if (session('validation') && session('validation')->hasError('name')): ?>
                                <div class="invalid-feedback">
                                    <?= session('validation')->getError('name') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control <?= session('validation') && session('validation')->hasError('username') ? 'is-invalid' : '' ?>"
                                id="username" name="username" value="<?= old('username') ?? esc($user['username']) ?>">

                            <?php if (session('validation') && session('validation')->hasError('username')): ?>
                                <div class="invalid-feedback">
                                    <?= session('validation')->getError('username') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control <?= session('validation') && session('validation')->hasError('password') ? 'is-invalid' : '' ?>"
                                id="password" name="password">

                            <?php if (session('validation') && session('validation')->hasError('password')): ?>
                                <div class="invalid-feedback">
                                    <?= session('validation')->getError('password') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <span class="text-danger">*</span>
                            <select class="form-select <?= session('validation') && session('validation')->hasError('role') ? 'is-invalid' : '' ?>" name="role" id="role">
                                <option selected disabled>--Pilih Role--</option>
                                <option value="admin" <?= old('role') ?? esc($user['role']) == 'admin' ? 'selected' : '' ?>>Admin</option>
                                <option value="purchasing" <?= old('role') ?? esc($user['role']) == 'purchasing' ? 'selected' : '' ?>>Purchasing</option>
                            </select>

                            <?php if (session('validation') && session('validation')->hasError('role')): ?>
                                <div class="invalid-feedback">
                                    <?= session('validation')->getError('role') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="company_name" class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control <?= session('validation') && session('validation')->hasError('company_name') ? 'is-invalid' : '' ?>"
                                id="company_name" name="company_name" value="<?= old('company_name') ?? esc($user['company_name']) ?>">

                            <?php if (session('validation') && session('validation')->hasError('company_name')): ?>
                                <div class="invalid-feedback">
                                    <?= session('validation')->getError('company_name') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="company_address" class="form-label">Alamat Perusahaan</label>
                            <textarea class="form-control <?= session('validation') && session('validation')->hasError('company_address') ? 'is-invalid' : '' ?>"
                                id="company_address" name="company_address" rows="3"><?= old('company_address') ?? esc($user['company_address']) ?></textarea>

                            <?php if (session('validation') && session('validation')->hasError('company_address')): ?>
                                <div class="invalid-feedback">
                                    <?= session('validation')->getError('company_address') ?>
                                </div>
                            <?php endif; ?>
                        </div>


                        <div class="mb-3">
                            <label for="company_city" class="form-label">Kota Perusahaan</label>
                            <input type="text" class="form-control <?= session('validation') && session('validation')->hasError('company_city') ? 'is-invalid' : '' ?>"
                                id="company_city" name="company_city" value="<?= old('company_city') ?? esc($user['company_city']) ?>">

                            <?php if (session('validation') && session('validation')->hasError('company_city')): ?>
                                <div class="invalid-feedback">
                                    <?= session('validation')->getError('company_city') ?>
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