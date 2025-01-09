<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/styles.css'); ?>">
    <?= $this->renderSection('styles') ?>
</head>

<body>
    <div>
        <?= $this->include('includes/_alert') ?>
        <main>
            <?= $this->renderSection('content'); ?>
        </main>
    </div>

    <script src="<?= base_url('js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('js/scripts.js'); ?>"></script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>