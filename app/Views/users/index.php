<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Users</h1>
        <?php if (session()->get('role') == 'admin'): ?>
            <a href="<?= base_url('users/create') ?>" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah User
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
                <div class="col-md-4">
                    <input type="text" name="keyword" class="form-control" placeholder="Cari nama, email, atau username..." value="<?= esc($keyword ?? '') ?>">
                </div>
                <div class="col-md-3">
                    <select name="role" class="form-select">
                        <option value="">Semua Role</option>
                        <option value="admin" <?= ($role ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="petugas" <?= ($role ?? '') === 'petugas' ? 'selected' : '' ?>>Petugas</option>
                        <option value="anggota" <?= ($role ?? '') === 'anggota' ? 'selected' : '' ?>>Anggota</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100">Filter</button>
                </div>
                <div class="col-md-2">
                    <a href="<?= base_url('users') ?>" class="btn btn-outline-secondary w-100">Reset</a>
                </div>
                <div class="col-md-1">
                    <a href="<?= base_url('users/print' . (($keyword ?? '') ? '?keyword=' . urlencode($keyword) : '') . (($role ?? '') ? (($keyword ?? '') ? '&' : '?') . 'role=' . $role : '')) ?>" target="_blank" class="btn btn-outline-secondary w-100">Print</a>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Foto</th>
                            <?php if (session()->get('role') == 'admin'): ?>
                                <th width="15%">Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)): ?>
                            <?php $no = 1 + ($pager->getCurrentPage() - 1) * $pager->getPerPage(); ?>
                            <?php foreach ($users as $u): ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><?= esc($u['nama']) ?></td>
                                    <td><?= esc($u['email']) ?></td>
                                    <td><?= esc($u['username']) ?></td>
                                    <td class="text-center">
                                        <?php if ($u['role'] === 'admin'): ?>
                                            <span class="badge bg-danger">Admin</span>
                                        <?php elseif ($u['role'] === 'petugas'): ?>
                                            <span class="badge bg-warning text-dark">Petugas</span>
                                        <?php else: ?>
                                            <span class="badge bg-info">Anggota</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($u['status'] === 'aktif'): ?>
                                            <span class="badge bg-success">Aktif</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Nonaktif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($u['foto']): ?>
                                            <img src="<?= base_url('uploads/users/' . $u['foto']) ?>" width="50" class="rounded-circle">
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <?php if (session()->get('role') == 'admin'): ?>
                                        <td class="text-center">
                                            <a href="<?= base_url('users/detail/' . $u['id']) ?>" class="btn btn-sm btn-info" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="<?= base_url('users/edit/' . $u['id']) ?>" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="<?= base_url('users/wa/' . $u['id']) ?>" target="_blank" class="btn btn-sm btn-success" title="Kirim WA">
                                                <i class="bi bi-whatsapp"></i>
                                            </a>
                                            <a href="<?= base_url('users/delete/' . $u['id']) ?>" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus user ini?')">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="<?= session()->get('role') == 'admin' ? '8' : '7' ?>" class="text-center py-4">Belum ada data user</td>
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