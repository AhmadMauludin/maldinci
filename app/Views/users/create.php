<?= $this->extend('layouts/main') ?>

<?= $this->section('pageTitle') ?>
Tambah User
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah User (Anggota)</h6>
                <a href="<?= base_url('login') ?>" class="btn btn-secondary">Sudah Punya Akun</a>
            </div>
        </div>
        <div class="card-body">
            <form action="<?= base_url('users/store') ?>" method="post" enctype="multipart/form-data" novalidate>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" required value="<?= old('nama') ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" required value="<?= old('email') ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" name="username" class="form-control" required value="<?= old('username') ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>

                <input type="hidden" name="role" value="anggota">

                <hr>
                <h5 class="mb-3">Data Anggota</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">NIS <span class="text-danger">*</span></label>
                        <input type="text" name="nis" class="form-control" required value="<?= old('nis') ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">No HP <span class="text-danger">*</span></label>
                        <input type="text" name="no_hp" class="form-control" required value="<?= old('no_hp') ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat <span class="text-danger">*</span></label>
                    <textarea name="alamat" class="form-control" rows="3" required><?= old('alamat') ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Profil</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak upload foto</small>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>