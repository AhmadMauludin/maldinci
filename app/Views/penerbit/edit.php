<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php $penerbit = $penerbit ?? []; ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Penerbit</h1>
        <a href="<?= base_url('penerbit') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Penerbit</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('penerbit/update/' . $penerbit['id_penerbit']) ?>" method="post" novalidate>
                <input type="hidden" name="id_penerbit" value="<?= $penerbit['id_penerbit'] ?>">

                <div class="mb-3">
                    <label for="nama_penerbit" class="form-label">Nama Penerbit <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_penerbit" name="nama_penerbit" required maxlength="100" value="<?= esc($penerbit['nama_penerbit']) ?>">
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= esc($penerbit['alamat'] ?? '') ?></textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="<?= base_url('penerbit') ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>