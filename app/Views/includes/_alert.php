<?php if (session()->getFlashdata('success')): ?>
    <div class="position-fixed" style="top: 3rem; left: 50%; transform: translate(-50%, -50%); z-index: 1050;">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="position-fixed" style="top: 3rem; left: 50%; transform: translate(-50%, -50%); z-index: 1050;">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>