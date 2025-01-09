<?php $this->extend('layouts/guest'); ?>

<?php $this->section('content'); ?>
<section class="vh-100 gradient-custom">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-light text-dark" style="border-radius: 1rem;">
                    <div class="card-body px-5 pt-5 pb-3 text-center">

                        <form action="<?= base_url('login') ?>" method="POST" class="px-md-4">
                            <?= csrf_field() ?>

                            <div class="mb-5 mt-4 pb-2">
                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <p class="text-dark-50 mb-5">Silakan login dengan akun Anda!</p>

                                <div class="mb-4 text-start">
                                    <label class="form-label" for="username">Username</label>
                                    <input type="text" class="form-control border-dark-subtle <?= session('validation') && session('validation')->hasError('username') ? 'is-invalid' : '' ?>"
                                        id="username" name="username" value="<?= old('username') ?>">

                                    <?php if (session('validation') && session('validation')->hasError('username')): ?>
                                        <div class="invalid-feedback">
                                            <?= session('validation')->getError('username') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="mb-4 text-start">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" class="form-control border-dark-subtle <?= session('validation') && session('validation')->hasError('password') ? 'is-invalid' : '' ?>"
                                        id="password" name="password" value="<?= old('password') ?>">

                                    <?php if (session('validation') && session('validation')->hasError('password')): ?>
                                        <div class="invalid-feedback">
                                            <?= session('validation')->getError('password') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="pt-3">
                                    <button class="btn btn-dark px-5 py-2" type="submit">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>