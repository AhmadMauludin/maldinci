<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php
$buku = isset($buku) ? $buku : [
    'id_buku' => '',
    'judul' => '',
    'isbn' => '',
    'id_kategori' => '',
    'id_penulis' => '',
    'id_penerbit' => '',
    'id_rak' => '',
    'tahun_terbit' => '',
    'jumlah' => '',
    'tersedia' => '',
    'deskripsi' => '',
    'cover' => '',
];

$kategori = $kategori ?? [];
$penulis = $penulis ?? [];
$penerbit = $penerbit ?? [];
$rak = $rak ?? [];
?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Buku</h1>
        <a href="<?= base_url('buku') ?>" class="btn btn-secondary">
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
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Buku</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('buku/update/' . $buku['id_buku']) ?>" method="post" enctype="multipart/form-data" novalidate>
                <input type="hidden" name="id_buku" value="<?= $buku['id_buku'] ?>">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="judul" class="form-label">Judul Buku <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="judul" name="judul" required maxlength="255" value="<?= esc($buku['judul']) ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control" id="isbn" name="isbn" maxlength="50" value="<?= esc($buku['isbn'] ?? '') ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="id_kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select class="form-select" id="id_kategori" name="id_kategori" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($kategori as $k): ?>
                                <option value="<?= $k['id_kategori'] ?>" <?= $buku['id_kategori'] == $k['id_kategori'] ? 'selected' : '' ?>>
                                    <?= esc($k['nama_kategori']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="id_penulis" class="form-label">Penulis</label>
                        <select class="form-select" id="id_penulis" name="id_penulis">
                            <option value="">Pilih Penulis</option>
                            <?php foreach ($penulis as $p): ?>
                                <option value="<?= $p['id_penulis'] ?>" <?= $buku['id_penulis'] == $p['id_penulis'] ? 'selected' : '' ?>>
                                    <?= esc($p['nama_penulis']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="id_penerbit" class="form-label">Penerbit</label>
                        <select class="form-select" id="id_penerbit" name="id_penerbit">
                            <option value="">Pilih Penerbit</option>
                            <?php foreach ($penerbit as $p): ?>
                                <option value="<?= $p['id_penerbit'] ?>" <?= $buku['id_penerbit'] == $p['id_penerbit'] ? 'selected' : '' ?>>
                                    <?= esc($p['nama_penerbit']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="id_rak" class="form-label">Rak <span class="text-danger">*</span></label>
                        <select class="form-select" id="id_rak" name="id_rak" required>
                            <option value="">Pilih Rak</option>
                            <?php foreach ($rak as $r): ?>
                                <option value="<?= $r['id_rak'] ?>" <?= $buku['id_rak'] == $r['id_rak'] ? 'selected' : '' ?>>
                                    <?= esc($r['nama_rak']) ?> - <?= esc($r['lokasi'] ?? '') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" min="1900" max="<?= date('Y') + 1 ?>" value="<?= esc($buku['tahun_terbit'] ?? '') ?>">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label for="jumlah" class="form-label">Jumlah <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" required min="1" value="<?= esc($buku['jumlah'] ?? 1) ?>">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label for="tersedia" class="form-label">Tersedia <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="tersedia" name="tersedia" required min="0" value="<?= esc($buku['tersedia'] ?? 1) ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= esc($buku['deskripsi'] ?? '') ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="cover" class="form-label">Cover Buku Baru (Gambar/PDF, max 2MB)</label>
                    <input type="file" class="form-control" id="cover" name="cover" accept=".jpg,.jpeg,.png,.pdf">

                    <?php if ($buku['cover']): ?>
                        <div class="mt-2">
                            <small class="text-muted">Cover saat ini:</small><br>
                            <?php
                            $ext = pathinfo($buku['cover'], PATHINFO_EXTENSION);
                            ?>
                            <?php if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                <img src="<?= base_url('uploads/buku/' . $buku['cover']) ?>" width="100" class="img-thumbnail">
                            <?php else: ?>
                                <a href="<?= base_url('uploads/buku/' . $buku['cover']) ?>" target="_blank" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-file-earmark"></i> Lihat File
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="<?= base_url('buku') ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>