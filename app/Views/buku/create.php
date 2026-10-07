<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Buku</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Buku</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('buku/store') ?>" method="post" enctype="multipart/form-data" novalidate>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="judul" class="form-label">Judul Buku <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="judul" name="judul" required maxlength="255" value="<?= old('judul') ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control" id="isbn" name="isbn" maxlength="50" value="<?= old('isbn') ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="id_kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select class="form-select" id="id_kategori" name="id_kategori" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach (($kategori ?? []) as $k): ?>
                                <option value="<?= $k['id_kategori'] ?>" <?= old('id_kategori') == $k['id_kategori'] ? 'selected' : '' ?>>
                                    <?= esc($k['nama_kategori']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="id_penulis" class="form-label">Penulis</label>
                        <select class="form-select" id="id_penulis" name="id_penulis">
                            <option value="">Pilih Penulis</option>
                            <?php foreach (($penulis ?? []) as $p): ?>
                                <option value="<?= $p['id_penulis'] ?>" <?= old('id_penulis') == $p['id_penulis'] ? 'selected' : '' ?>>
                                    <?= esc($p['nama_penulis']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="id_penerbit" class="form-label">Penerbit</label>
                        <select class="form-select" id="id_penerbit" name="id_penerbit">
                            <option value="">Pilih Penerbit</option>
                            <?php foreach (($penerbit ?? []) as $p): ?>
                                <option value="<?= $p['id_penerbit'] ?>" <?= old('id_penerbit') == $p['id_penerbit'] ? 'selected' : '' ?>>
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
                            <?php foreach (($rak ?? []) as $r): ?>
                                <option value="<?= $r['id_rak'] ?>" <?= old('id_rak') == $r['id_rak'] ? 'selected' : '' ?>>
                                    <?= esc($r['nama_rak']) ?> - <?= esc($r['lokasi'] ?? '') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" min="1900" max="<?= date('Y') + 1 ?>" value="<?= old('tahun_terbit') ?>">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label for="jumlah" class="form-label">Jumlah <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" required min="1" value="<?= old('jumlah', 1) ?>">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label for="tersedia" class="form-label">Tersedia <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="tersedia" name="tersedia" required min="0" value="<?= old('tersedia', 1) ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= old('deskripsi') ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="cover" class="form-label">Cover Buku (Gambar/PDF, max 2MB)</label>
                    <input type="file" class="form-control" id="cover" name="cover" accept=".jpg,.jpeg,.png,.pdf">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="<?= base_url('buku') ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>