<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Peminjaman</h1>
        <a href="<?= base_url('/peminjaman/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Peminjaman
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
            <form method="get" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="keyword" class="form-control" placeholder="Cari nama anggota, NIS, atau judul buku..." value="<?= esc($keyword ?? '') ?>">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="dimohon" <?= ($status ?? '') === 'dimohon' ? 'selected' : '' ?>>Dimohon</option>
                        <option value="dipinjam" <?= ($status ?? '') === 'dipinjam' ? 'selected' : '' ?>>Dipinjam</option>
                        <option value="kembali" <?= ($status ?? '') === 'kembali' ? 'selected' : '' ?>>Kembali</option>
                        <option value="terlambat" <?= ($status ?? '') === 'terlambat' ? 'selected' : '' ?>>Terlambat</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100">Filter</button>
                </div>
                <div class="col-md-2">
                    <a href="<?= base_url('/peminjaman') ?>" class="btn btn-outline-secondary w-100">Reset</a>
                </div>
                <div class="col-md-1">
                    <a href="<?= base_url('/peminjaman/print' . ($keyword ? '?keyword=' . urlencode($keyword) : '') . ($status ? ($keyword ? '&' : '?') . 'status=' . $status : '')) ?>" target="_blank" class="btn btn-outline-secondary w-100">Print</a>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th>Anggota</th>
                            <th>Buku</th>
                            <th>Petugas</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Status</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($peminjaman)): ?>
                            <?php $no = 1 + ($pager->getCurrentPage() - 1) * $pager->getPerPage(); ?>
                            <?php foreach ($peminjaman as $pinjam): ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td>
                                        <strong><?= esc($pinjam['nama_anggota']) ?></strong> [NIS: <?= esc($pinjam['nis']) ?>]
                                    </td>
                                    <td><?= esc($pinjam['judul_buku']) ?></td>
                                    <td><?= esc($pinjam['nama_petugas'] ?? '-') ?></td>
                                    <td><?= date('d/m/Y', strtotime($pinjam['tanggal_pinjam'])) ?></td>
                                    <td><?= date('d/m/Y', strtotime($pinjam['tanggal_kembali'])) ?></td>
                                    <td class="text-center">
                                        <?php if ($pinjam['status'] === 'dimohon'): ?>
                                            <span class="badge bg-info">Dimohon</span>
                                        <?php elseif ($pinjam['status'] === 'dipinjam'): ?>
                                            <span class="badge bg-warning text-dark">Dipinjam</span>
                                        <?php elseif ($pinjam['status'] === 'kembali'): ?>
                                            <span class="badge bg-success">Kembali</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Terlambat</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url('/peminjaman/detail/' . $pinjam['id_peminjaman']) ?>" class="btn btn-sm btn-info" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <?php if (session()->get('role') !== 'anggota'): ?>
                                            <a href="<?= base_url('/peminjaman/edit/' . $pinjam['id_peminjaman']) ?>" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <?php if ($pinjam['status'] === 'dimohon' && session()->get('role') === 'petugas'): ?>
                                                <a href="<?= base_url('/peminjaman/konfirmasi/' . $pinjam['id_peminjaman']) ?>" class="btn btn-sm btn-success" title="Konfirmasi" onclick="return confirm('Konfirmasi peminjaman ini?')">
                                                    <i class="bi bi-check-lg"></i>
                                                </a>
                                                <a href="<?= base_url('/peminjaman/tolak/' . $pinjam['id_peminjaman']) ?>" class="btn btn-sm btn-danger" title="Tolak" onclick="return confirm('Tolak peminjaman ini?')">
                                                    <i class="bi bi-x-lg"></i>
                                                </a>
                                            <?php elseif ($pinjam['status'] === 'dipinjam'): ?>
                                                <a href="<?= base_url('/peminjaman/kembalikan/' . $pinjam['id_peminjaman']) ?>" class="btn btn-sm btn-success" title="Kembalikan" onclick="return confirm('Yakin ingin mengembalikan buku ini?')">
                                                    <i class="bi bi-arrow-return-left"></i>
                                                </a>
                                            <?php endif; ?>
                                            <a href="<?= base_url('/peminjaman/delete/' . $pinjam['id_peminjaman']) ?>" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-4">Tidak ada data peminjaman</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if ($pager): ?>
                <nav aria-label="Page navigation">
                    <?= $pager->links() ?>
                </nav>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>