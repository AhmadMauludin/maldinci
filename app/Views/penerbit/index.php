<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Penerbit</h1>
        <?php if (session()->get('role') !== 'anggota'): ?>
            <a href="<?= base_url('penerbit/create') ?>" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah Penerbit
            </a>
        <?php endif; ?>
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
                <div class="col-md-6">
                    <input type="text" name="keyword" class="form-control" placeholder="Cari nama penerbit..." value="<?= esc($keyword ?? '') ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100">Filter</button>
                </div>
                <div class="col-md-2">
                    <a href="<?= base_url('penerbit') ?>" class="btn btn-outline-secondary w-100">Reset</a>
                </div>
                <div class="col-md-2">
                    <a href="<?= base_url('penerbit/print' . ($keyword ? '?keyword=' . urlencode($keyword) : '')) ?>" target="_blank" class="btn btn-outline-secondary w-100">Print</a>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th>Nama Penerbit</th>
                            <th>Alamat</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($penerbit)): ?>
                            <?php $no = 1 + ($pager->getCurrentPage() - 1) * $pager->getPerPage(); ?>
                            <?php foreach ($penerbit as $p): ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><?= esc($p['nama_penerbit']) ?></td>
                                    <td><?= esc($p['alamat'] ?? '-') ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('penerbit/detail/' . $p['id_penerbit']) ?>" class="btn btn-sm btn-info" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <?php if (session()->get('role') !== 'anggota'): ?>
                                            <a href="<?= base_url('penerbit/edit/' . $p['id_penerbit']) ?>" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="<?= base_url('penerbit/delete/' . $p['id_penerbit']) ?>" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-4">Tidak ada data penerbit</td>
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