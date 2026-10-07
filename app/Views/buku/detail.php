<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Buku</h1>
        <div>
            <?php if (session()->get('role') !== 'anggota'): ?>
                <a href="<?= base_url('buku/edit/' . ($buku['id_buku'] ?? '')) ?>" class="btn btn-warning me-2">
                    <i class="bi bi-pencil"></i> Edit
                </a>
            <?php endif; ?>
            <a href="<?= base_url('buku') ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Buku</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <th width="25%">ID</th>
                            <td><?= $buku['id_buku'] ?? '-' ?></td>
                        </tr>
                        <tr>
                            <th>Judul</th>
                            <td><strong><?= esc($buku['judul'] ?? '-') ?></strong></td>
                        </tr>
                        <tr>
                            <th>ISBN</th>
                            <td><?= esc($buku['isbn'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td><?= esc($buku['nama_kategori'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Penulis</th>
                            <td><?= esc($buku['nama_penulis'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Penerbit</th>
                            <td><?= esc($buku['nama_penerbit'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Rak</th>
                            <td><?= esc($buku['nama_rak'] ?? '-') ?> <?= $buku['lokasi'] ? '- ' . esc($buku['lokasi']) : '' ?></td>
                        </tr>
                        <tr>
                            <th>Tahun Terbit</th>
                            <td><?= $buku['tahun_terbit'] ?? '-' ?></td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td><?= $buku['jumlah'] ?? 0 ?></td>
                        </tr>
                        <tr>
                            <th>Tersedia</th>
                            <td>
                                <?php $tersedia = $buku['tersedia'] ?? 0; ?>
                                <?php if ($tersedia > 0): ?>
                                    <span class="badge bg-success"><?= $tersedia ?> Tersedia</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Habis</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td><?= esc($buku['deskripsi'] ?? '-') ?></td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-4 text-center">
                    <?php if (!empty($buku['cover'])): ?>
                        <?php $ext = strtolower(pathinfo($buku['cover'], PATHINFO_EXTENSION)); ?>
                        <?php if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                            <img src="<?= base_url('uploads/buku/' . $buku['cover']) ?>" alt="Cover" class="img-fluid rounded shadow" style="max-width: 200px;">
                        <?php else: ?>
                            <div class="bg-light rounded p-4">
                                <i class="bi bi-file-earmark-pdf text-danger" style="font-size: 4rem;"></i>
                                <p class="mt-2">File PDF</p>
                                <a href="<?= base_url('uploads/buku/' . $buku['cover']) ?>" target="_blank" class="btn btn-sm btn-primary">Lihat File</a>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="bg-light rounded p-5">
                            <i class="bi bi-image text-muted" style="font-size: 4rem;"></i>
                            <p class="mt-2 text-muted">Tidak ada cover</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>