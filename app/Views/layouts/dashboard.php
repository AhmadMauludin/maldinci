<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row g-4">

            <!-- Users (Admin/Petugas only) -->
        <?php if (session()->get('role') !== 'anggota'): ?>
        <div class="col-xl-3 col-md-4 col-6">
            <a href="<?= base_url('users') ?>" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-flex align-items-center">
                                <div class="bg-dark bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-people-fill text-dark" style="font-size: 1.5rem;"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Users</h6>
                                    <div class="small text-muted d-flex gap-3 flex-wrap">
                                        <span class="text-danger"><i class="bi bi-person-badge-fill me-1"></i><b><?= $usersAdmin ?></b></span>
                                        <span class="text-warning"><i class="bi bi-person-gear me-1"></i><b><?= $usersPetugas ?></b></span>
                                        <span class="text-success"><i class="bi bi-person-fill me-1"></i><b><?= $usersAnggota ?></b></span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <h3 class="mb-0 fw-bold"><?= $totalUsers ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <small class="text-muted">Selengkapnya <i class="bi bi-arrow-right ms-1"></i></small>
                    </div>
                </div>
            </a>
        </div>
        <?php endif; ?>


        <!-- Peminjaman -->
        <div class="col-xl-3 col-md-4 col-6">
            <a href="<?= base_url('peminjaman') ?>" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-flex align-items-center">
                                <div class="bg-danger bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-journal-text text-danger" style="font-size: 1.5rem;"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Peminjaman</h6>
                                    <div class="small text-muted d-flex gap-3 flex-wrap">
                                        <?php if (session()->get('role') === 'anggota'): ?>
                                            <span class="text-primary"><i class="bi bi-bookmark-check-fill me-1"></i><b><?= $myPeminjamanDipinjam ?? 0 ?></b></span>
                                            <span class="text-warning"><i class="bi bi-hourglass-split me-1"></i><b><?= $myPeminjamanMenunggu ?? 0 ?></b></span>
                                            <span class="text-success"><i class="bi bi-check-circle-fill me-1"></i><b><?= $myPeminjamanDikembalikan ?? 0 ?></b></span>
                                        <?php else: ?>
                                            <span class="text-primary"><i class="bi bi-bookmark-check-fill me-1"></i><b><?= $peminjamanDipinjam ?></b></span>
                                            <span class="text-warning"><i class="bi bi-hourglass-split me-1"></i><b><?= $peminjamanMenunggu ?></b></span>
                                            <span class="text-success"><i class="bi bi-check-circle-fill me-1"></i><b><?= $peminjamanDikembalikan ?></b></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <h3 class="mb-0 fw-bold"><?= session()->get('role') === 'anggota' ? ($myTotalPeminjaman ?? 0) : $totalPeminjaman ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <small class="text-muted">Selengkapnya <i class="bi bi-arrow-right ms-1"></i></small>
                    </div>
                </div>
            </a>
        </div>

        <!-- Buku -->
        <div class="col-xl-3 col-md-4 col-6">
            <a href="<?= base_url('buku') ?>" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-book-fill text-primary" style="font-size: 1.5rem;"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Buku</h6>
                                    <div class="small text-muted d-flex gap-3 flex-wrap">
                                        <span class="text-success"><i class="bi bi-check-circle-fill me-1"></i><b><?= $bukuTersedia ?></b></span>
                                        <span class="text-danger"><i class="bi bi-x-circle-fill me-1"></i><b><?= $bukuTidakTersedia ?></b></span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <h3 class="mb-0 fw-bold"><?= $totalBuku ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <small class="text-muted">Selengkapnya <i class="bi bi-arrow-right ms-1"></i></small>
                    </div>
                </div>
            </a>
        </div>

        <!-- Kategori -->
        <div class="col-xl-3 col-md-4 col-6">
            <a href="<?= base_url('kategori') ?>" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-tags-fill text-success" style="font-size: 1.5rem;"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Kategori</h6>
                                </div>
                            </div>
                            <div class="text-end">
                                <h3 class="mb-0 fw-bold"><?= $totalKategori ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <small class="text-muted">Selengkapnya <i class="bi bi-arrow-right ms-1"></i></small>
                    </div>
                </div>
            </a>
        </div>

        <!-- Penulis -->
        <div class="col-xl-3 col-md-4 col-6">
            <a href="<?= base_url('penulis') ?>" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-flex align-items-center">
                                <div class="bg-warning bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-person-lines-fill text-warning" style="font-size: 1.5rem;"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Penulis</h6>
                                </div>
                            </div>
                            <div class="text-end">
                                <h3 class="mb-0 fw-bold"><?= $totalPenulis ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <small class="text-muted">Selengkapnya <i class="bi bi-arrow-right ms-1"></i></small>
                    </div>
                </div>
            </a>
        </div>

        <!-- Penerbit -->
        <div class="col-xl-3 col-md-4 col-6">
            <a href="<?= base_url('penerbit') ?>" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-flex align-items-center">
                                <div class="bg-info bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-building-fill text-info" style="font-size: 1.5rem;"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Penerbit</h6>
                                </div>
                            </div>
                            <div class="text-end">
                                <h3 class="mb-0 fw-bold"><?= $totalPenerbit ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <small class="text-muted">Selengkapnya <i class="bi bi-arrow-right ms-1"></i></small>
                    </div>
                </div>
            </a>
        </div>

        <!-- Rak -->
        <div class="col-xl-3 col-md-4 col-6">
            <a href="<?= base_url('rak') ?>" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-flex align-items-center">
                                <div class="bg-secondary bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-bookshelf text-secondary" style="font-size: 1.5rem;"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Rak</h6>
                                </div>
                            </div>
                            <div class="text-end">
                                <h3 class="mb-0 fw-bold"><?= $totalRak ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <small class="text-muted">Selengkapnya <i class="bi bi-arrow-right ms-1"></i></small>
                    </div>
                </div>
            </a>
        </div>



    </div>

    <?php $session = session(); $role = $session->get('role'); ?>

    <?php if ($role === 'petugas' && !empty($pendingKonfirmasi)): ?>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-hourglass-split text-warning me-2"></i>Menunggu Konfirmasi</h5>
                    <a href="<?= base_url('peminjaman') ?>" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Anggota</th>
                                    <th>Buku</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Status</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pendingKonfirmasi as $pinjam): ?>
                                <tr>
                                    <td>
                                        <div class="fw-medium"><?= esc($pinjam['nama_anggota']) ?></div>
                                        <small class="text-muted"><?= esc($pinjam['nis']) ?></small>
                                    </td>
                                    <td><?= esc($pinjam['judul_buku']) ?></td>
                                    <td><?= date('d/m/Y', strtotime($pinjam['tanggal_pinjam'])) ?></td>
                                    <td><span class="badge bg-warning text-dark">Menunggu</span></td>
                                    <td class="text-end">
                                        <a href="<?= base_url('peminjaman/detail/' . $pinjam['id_peminjaman']) ?>" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye me-1"></i>Detail
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php elseif ($role === 'petugas'): ?>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0"><i class="bi bi-hourglass-split text-warning me-2"></i>Menunggu Konfirmasi</h5>
                </div>
                <div class="card-body text-center py-4">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                    <p class="mt-2 mb-0 text-muted">Tidak ada peminjaman menunggu konfirmasi</p>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($role === 'anggota' && !empty($activePeminjaman)): ?>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-book text-primary me-2"></i>Peminjaman Aktif</h5>
                    <a href="<?= base_url('peminjaman') ?>" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Buku</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Batas Waktu</th>
                                    <th>Sisa Hari</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($activePeminjaman as $pinjam): 
                                    $today = new DateTime();
                                    $dueDate = new DateTime($pinjam['tanggal_kembali']);
                                    $diff = $today->diff($dueDate);
                                    $sisaHari = $diff->days;
                                    $isOverdue = $today > $dueDate;
                                ?>
                                <tr>
                                    <td>
                                        <?php if (!empty($pinjam['cover'])): ?>
                                        <img src="<?= base_url('uploads/buku/' . $pinjam['cover']) ?>" alt="" class="me-2" style="width: 40px; height: 50px; object-fit: cover; border-radius: 4px;">
                                        <?php endif; ?>
                                        <?= esc($pinjam['judul_buku']) ?>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($pinjam['tanggal_pinjam'])) ?></td>
                                    <td><?= date('d/m/Y', strtotime($pinjam['tanggal_kembali'])) ?></td>
                                    <td>
                                        <?php if ($isOverdue): ?>
                                            <span class="badge bg-danger">Terlambat <?= $sisaHari ?> hari</span>
                                        <?php elseif ($sisaHari <= 3): ?>
                                            <span class="badge bg-warning text-dark"><?= $sisaHari ?> hari</span>
                                        <?php else: ?>
                                            <span class="badge bg-success"><?= $sisaHari ?> hari</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <a href="<?= base_url('peminjaman/detail/' . $pinjam['id_peminjaman']) ?>" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye me-1"></i>Detail
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php elseif ($role === 'anggota'): ?>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0"><i class="bi bi-book text-primary me-2"></i>Peminjaman Aktif</h5>
                </div>
                <div class="card-body text-center py-4">
                    <i class="bi bi-book text-muted" style="font-size: 3rem;"></i>
                    <p class="mt-2 mb-0 text-muted">Anda tidak memiliki peminjaman aktif</p>
                    <a href="<?= base_url('buku') ?>" class="btn btn-primary mt-3"><i class="bi bi-plus me-1"></i>Pinjam Buku</a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>