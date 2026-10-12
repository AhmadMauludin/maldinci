<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row g-4">
        <div class="col-xl-2 col-md-4 col-6">
            <a href="<?= base_url('buku') ?>" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Total Buku</h6>
                                <h3 class="mb-0 fw-bold"><?= $totalBuku ?></h3>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded">
                                <i class="bi bi-book-fill text-primary" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <small class="text-muted">Klik untuk melihat <i class="bi bi-arrow-right ms-1"></i></small>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-2 col-md-4 col-6">
            <a href="<?= base_url('kategori') ?>" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Kategori</h6>
                                <h3 class="mb-0 fw-bold"><?= $totalKategori ?></h3>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded">
                                <i class="bi bi-tags-fill text-success" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <small class="text-muted">Klik untuk melihat <i class="bi bi-arrow-right ms-1"></i></small>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-2 col-md-4 col-6">
            <a href="<?= base_url('penulis') ?>" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Penulis</h6>
                                <h3 class="mb-0 fw-bold"><?= $totalPenulis ?></h3>
                            </div>
                            <div class="bg-warning bg-opacity-10 p-3 rounded">
                                <i class="bi bi-person-lines-fill text-warning" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <small class="text-muted">Klik untuk melihat <i class="bi bi-arrow-right ms-1"></i></small>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-2 col-md-4 col-6">
            <a href="<?= base_url('penerbit') ?>" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Penerbit</h6>
                                <h3 class="mb-0 fw-bold"><?= $totalPenerbit ?></h3>
                            </div>
                            <div class="bg-info bg-opacity-10 p-3 rounded">
                                <i class="bi bi-building-fill text-info" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <small class="text-muted">Klik untuk melihat <i class="bi bi-arrow-right ms-1"></i></small>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-2 col-md-4 col-6">
            <a href="<?= base_url('rak') ?>" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Rak</h6>
                                <h3 class="mb-0 fw-bold"><?= $totalRak ?></h3>
                            </div>
                            <div class="bg-secondary bg-opacity-10 p-3 rounded">
                                <i class="bi bi-bookshelf text-secondary" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <small class="text-muted">Klik untuk melihat <i class="bi bi-arrow-right ms-1"></i></small>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-2 col-md-4 col-6">
            <a href="<?= base_url('peminjaman') ?>" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Peminjaman</h6>
                                <h3 class="mb-0 fw-bold"><?= $totalPeminjaman ?></h3>
                            </div>
                            <div class="bg-danger bg-opacity-10 p-3 rounded">
                                <i class="bi bi-journal-text text-danger" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <small class="text-muted">Klik untuk melihat <i class="bi bi-arrow-right ms-1"></i></small>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-2 col-md-4 col-6">
            <a href="<?= base_url('users') ?>" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Users</h6>
                                <h3 class="mb-0 fw-bold"><?= $totalUsers ?></h3>
                            </div>
                            <div class="bg-dark bg-opacity-10 p-3 rounded">
                                <i class="bi bi-people-fill text-dark" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <small class="text-muted">Klik untuk melihat <i class="bi bi-arrow-right ms-1"></i></small>
                    </div>
                </div>
            </a>
        </div>
    </div>
    
    <p class="mt-4">Selamat datang di <b>Maldin17</b>App!</p>
</div>
<?= $this->endSection() ?>