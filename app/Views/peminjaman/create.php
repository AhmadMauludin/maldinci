<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Peminjaman</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Form Peminjaman</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('/peminjaman/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="row">
                    <?php if (session()->get('role') === 'anggota'): ?>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Anggota</label>
                            <?php foreach ($anggota as $a): ?>
                                <input type="hidden" name="id_anggota" value="<?= $a['id_anggota'] ?>">
                                <input type="text" class="form-control" value="<?= esc($a['nama'] ?? '') ?> (<?= esc($a['nis'] ?? '') ?>)" readonly>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="col-md-6 mb-3">
                            <label for="id_anggota" class="form-label">Anggota <span class="text-danger">*</span></label>
                            <select name="id_anggota" id="id_anggota" class="form-select" required>
                                <option value="">-- Pilih Anggota --</option>
                                <?php foreach ($anggota as $a): ?>
                                    <option value="<?= $a['id_anggota'] ?>" <?= old('id_anggota') == $a['id_anggota'] ? 'selected' : '' ?>>
                                        <?= esc($a['nama'] ?? '') ?> (<?= esc($a['nis'] ?? '') ?>)
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
                                <option value="<?= $b['id_buku'] ?>" <?= old('id_buku') == $b['id_buku'] ? 'selected' : '' ?> data-tersedia="<?= $b['tersedia'] ?>">
                                    <?= esc($b['judul']) ?> (Tersedia: <?= $b['tersedia'] ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" value="<?= old('tanggal_pinjam', date('Y-m-d')) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_kembali" class="form-label">Tanggal Kembali <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" value="<?= old('tanggal_kembali', date('Y-m-d', strtotime('+7 days'))) ?>" required>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="<?= base_url('/peminjaman') ?>" class="btn btn-secondary">
                        <i class="bi bi-x"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('tanggal_pinjam').addEventListener('change', function() {
    const pinjam = new Date(this.value);
    pinjam.setDate(pinjam.getDate() + 7);
    const kembali = document.getElementById('tanggal_kembali');
    if (!kembali.value || new Date(kembali.value) <= pinjam) {
        kembali.value = pinjam.toISOString().split('T')[0];
    }
});
</script>
<?= $this->endSection() ?>