<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Peminjaman</h1>
        <a href="<?= base_url('/peminjaman') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Peminjaman</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('/peminjaman/update/' . $peminjaman['id_peminjaman']) ?>" method="post">
                <?= csrf_field() ?>
                <div class="row">
                    <?php if (session()->get('role') === 'anggota'): ?>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Anggota</label>
                            <?php foreach ($anggota as $a): ?>
                                <input type="hidden" name="id_anggota" value="<?= $a['id_anggota'] ?>">
                                <input type="text" class="form-control" value="<?= esc($a['nama_anggota'] ?? '') ?> (<?= esc($a['nis'] ?? '') ?>)" readonly>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="col-md-6 mb-3">
                            <label for="id_anggota" class="form-label">Anggota <span class="text-danger">*</span></label>
                            <select name="id_anggota" id="id_anggota" class="form-select" required>
                                <option value="">-- Pilih Anggota --</option>
                                <?php foreach ($anggota as $a): ?>
                                    <option value="<?= $a['id_anggota'] ?>" <?= old('id_anggota', $peminjaman['id_anggota']) == $a['id_anggota'] ? 'selected' : '' ?>>
                                        <?= esc($a['nama_anggota'] ?? '') ?> (<?= esc($a['nis'] ?? '') ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endif; ?>
                    <div class="col-md-6 mb-3">
                        <label for="id_buku" class="form-label">Buku <span class="text-danger">*</span></label>
                        <select name="id_buku" id="id_buku" class="form-select" required>
                            <option value="">-- Pilih Buku --</option>
                            <?php foreach ($buku as $b): ?>
                                <option value="<?= $b['id_buku'] ?>" <?= old('id_buku', $peminjaman['id_buku']) == $b['id_buku'] ? 'selected' : '' ?> data-tersedia="<?= $b['tersedia'] ?>">
                                    <?= esc($b['judul']) ?> (Tersedia: <?= $b['tersedia'] ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" value="<?= old('tanggal_pinjam', $peminjaman['tanggal_pinjam']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_kembali" class="form-label">Tanggal Kembali <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" value="<?= old('tanggal_kembali', $peminjaman['tanggal_kembali']) ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="dipinjam" <?= old('status', $peminjaman['status']) === 'dipinjam' ? 'selected' : '' ?>>Dipinjam</option>
                            <option value="kembali" <?= old('status', $peminjaman['status']) === 'kembali' ? 'selected' : '' ?>>Kembali</option>
                            <option value="terlambat" <?= old('status', $peminjaman['status']) === 'terlambat' ? 'selected' : '' ?>>Terlambat</option>
                        </select>
                    </div>
                    <?php if (session()->get('role') !== 'petugas'): ?>
                    <div class="col-md-6 mb-3">
                        <label for="id_petugas" class="form-label">Petugas</label>
                        <select name="id_petugas" id="id_petugas" class="form-select">
                            <option value="">-- Pilih Petugas --</option>
                            <?php foreach ($petugas as $p): ?>
                                <option value="<?= $p['id_petugas'] ?>" <?= old('id_petugas', $peminjaman['id_petugas']) == $p['id_petugas'] ? 'selected' : '' ?>>
                                    <?= esc($p['nama'] ?? '') ?> (<?= esc($p['jabatan'] ?? '') ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="<?= base_url('/peminjaman') ?>" class="btn btn-secondary">
                        <i class="bi bi-x"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>