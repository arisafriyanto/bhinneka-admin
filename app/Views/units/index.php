<?php $this->extend('layouts/app'); ?>

<?php $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 mb-3 mb-sm-0">
            <div class="d-flex justify-content-between align-items-center mx-1 my-2">
                <div>
                    <h4 class="text-bold">Satuan</h4>
                    <p class="text-muted">Daftar data satuan.</p>
                </div>
                <div>
                    <a href="<?= base_url('units/create') ?>" class="btn btn-outline-primary">Tambah</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-striped" id="unitsTable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($units as $index => $unit): ?>
                                    <tr class="align-middle">
                                        <td><?= $index + 1 ?>.</td>
                                        <td><?= $unit['name']; ?></td>
                                        <td>
                                            <a href="<?= base_url('units/edit/' . $unit['id']); ?>"
                                                class="btn btn-warning me-2">Edit</a>

                                            <form action="<?= base_url('units/delete/' . $unit['id']); ?>" method="post"
                                                class="d-inline-block">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="DELETE">

                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data satuan?');">Hapus</button>
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
        $('#unitsTable').DataTable();
    });
</script>
<?= $this->endSection() ?>