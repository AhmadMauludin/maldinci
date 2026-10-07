<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail User</h1>
        <div>
            <?php if (session()->get('role') == 'admin' || session()->get('id') == $user['id']): ?>
                <a href="<?= base_url('users/edit/' . $user['id']) ?>" class="btn btn-warning me-2">
                    <i class="bi bi-pencil"></i> Edit
                </a>
            <?php endif; ?>
            <a href="<?= base_url('users') ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <!-- User Info -->
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Akun</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">Nama</th>
                                    <td><?= esc($user['nama']) ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?= esc($user['email']) ?></td>
                                </tr>
                                <tr>
                                    <th>Username</th>
                                    <td><?= esc($user['username']) ?></td>
                                </tr>
                                <tr>
                                    <th>Role</th>
                                    <td>
                                        <?php if ($user['role'] === 'admin'): ?>
                                            <span class="badge bg-danger">Admin</span>
                                        <?php elseif ($user['role'] === 'petugas'): ?>
                                            <span class="badge bg-warning text-dark">Petugas</span>
                                        <?php else: ?>
                                            <span class="badge bg-info">Anggota</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <?php if ($user['status'] === 'aktif'): ?>
                                            <span class="badge bg-success">Aktif</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Nonaktif</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Terdaftar</th>
                                    <td><?= date('d/m/Y H:i', strtotime($user['created_at'])) ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6 text-center">
                            <?php if ($user['foto']): ?>
                                <img src="<?= base_url('uploads/users/' . $user['foto']) ?>" alt="Foto" class="img-thumbnail mb-3" style="max-width: 200px;">
                            <?php else: ?>
                                <div class="bg-light rounded p-5 mb-3">
                                    <i class="bi bi-person-circle text-muted" style="font-size: 5rem;"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Anggota/Petugas Detail -->
            <?php if (isset($anggota)): ?>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Anggota</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th width="30%">NIS</th>
                                <td><?= esc($anggota['nis']) ?></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td><?= esc($anggota['alamat']) ?></td>
                            </tr>
                            <tr>
                                <th>No. HP</th>
                                <td><?= esc($anggota['no_hp']) ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Daftar</th>
                                <td><?= date('d/m/Y', strtotime($anggota['tanggal_daftar'])) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (isset($petugas)): ?>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Petugas</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th width="30%">Jabatan</th>
                                <td><?= esc($petugas['jabatan']) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Riwayat Peminjaman -->
            <?php if (isset($riwayat_pinjam) && !empty($riwayat_pinjam)): ?>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Riwayat Peminjaman</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr class="text-center">
                                        <th width="5%">No</th>
                                        <th>Judul Buku</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Tgl Kembali</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach ($riwayat_pinjam as $pinjam): ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td><?= esc($pinjam['judul_buku']) ?></td>
                                            <td><?= date('d/m/Y', strtotime($pinjam['tanggal_pinjam'])) ?></td>
                                            <td><?= $pinjam['tanggal_kembali'] ? date('d/m/Y', strtotime($pinjam['tanggal_kembali'])) : '-' ?></td>
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
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php elseif (isset($anggota)): ?>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Riwayat Peminjaman</h6>
                    </div>
                    <div class="card-body text-center text-muted py-4">
                        Belum ada riwayat peminjaman
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar Info -->
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <?php if (session()->get('role') == 'admin'): ?>
                            <a href="<?= base_url('users/edit/' . $user['id']) ?>" class="btn btn-outline-primary">
                                <i class="bi bi-pencil"></i> Edit Data
                            </a>
                            <a href="<?= base_url('users/wa/' . $user['id']) ?>" target="_blank" class="btn btn-outline-success">
                                <i class="bi bi-whatsapp"></i> Kirim WA
                            </a>
                            <a href="<?= base_url('users/delete/' . $user['id']) ?>" class="btn btn-outline-danger" onclick="return confirm('Yakin ingin menghapus user ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </a>
                        <?php elseif (session()->get('id') == $user['id']): ?>
                            <a href="<?= base_url('users/edit/' . $user['id']) ?>" class="btn btn-outline-primary">
                                <i class="bi bi-pencil"></i> Edit Profil
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>