<?php $this->extend('layouts/app'); ?>

<?php $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 mb-3 mb-sm-0">
            <div class="d-flex justify-content-between align-items-center mx-1 my-2">
                <div>
                    <h4 class="text-bold">User</h4>
                    <p class="text-muted">Daftar data pengguna.</p>
                </div>
                <div>
                    <a href="<?= base_url('users/create') ?>" class="btn btn-outline-primary">Tambah</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-striped" id="usersTable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $index => $user): ?>
                                    <tr class="align-middle">
                                        <td><?= $index + 1 ?>.</td>
                                        <td><?= $user['name']; ?></td>
                                        <td><?= $user['username']; ?></td>
                                        <td><?= $user['role']; ?></td>
                                        <td><?= $user['company_name']; ?></td>
                                        <td>
                                            <a href="<?= base_url('users/edit/' . $user['id']); ?>"
                                                class="btn btn-warning me-2">Edit</a>

                                            <form action="<?= base_url('users/delete/' . $user['id']); ?>" method="post"
                                                class="d-inline-block">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data user?');">Hapus</button>
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
        $('#usersTable').DataTable();
    });
</script>
<?= $this->endSection() ?>