<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
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
                        <small class="text-muted">Klik untuk melihat daftar buku <i class="bi bi-arrow-right ms-1"></i></small>
                    </div>
                </div>
            </a>
        </div>
    </div>
    
    <p class="mt-4">Selamat datang di <b>Maldin17</b>App!</p>
</div>
<?= $this->endSection() ?>