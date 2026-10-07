<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php $rak = $rak ?? []; ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Rak</h1>
        <div>
            <?php if (session()->get('role') !== 'anggota'): ?>
                <a href="<?= base_url('rak/edit/' . $rak['id_rak']) ?>" class="btn btn-warning me-2">
                    <i class="bi bi-pencil"></i> Edit
                </a>
            <?php endif; ?>
            <a href="<?= base_url('rak') ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Rak</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">ID</th>
                            <td><?= $rak['id_rak'] ?? '-' ?></td>
                        </tr>
                        <tr>
                            <th>Nama Rak</th>
                            <td><?= esc($rak['nama_rak'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Lokasi</th>
                            <td><?= esc($rak['lokasi'] ?? '-') ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Daftar Buku di Rak Ini -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Buku pada Rak Ini</h6>
                </div>
                <div class="card-body">
                    <?php if (isset($buku) && !empty($buku)): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr class="text-center">
                                        <th width="5%">No</th>
                                        <th>Judul</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach ($buku as $b): ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td>
                                                <a href="<?= base_url('buku/detail/' . $b['id_buku']) ?>">
                                                    <strong><?= esc($b['judul']) ?></strong>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center text-muted py-4">
                            <i class="bi bi-book" style="font-size: 2rem;"></i>
                            <p class="mt-2">Tidak ada buku pada rak ini</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik</h6>
                </div>
                <div class="card-body">
                    <?php if (isset($buku)): ?>
                        <div class="row text-center">
                            <div class="col-6 mb-3">
                                <div class="bg-primary text-white rounded p-3">
                                    <div class="h3 mb-0"><?= count($buku) ?></div>
                                    <small>Judul Buku</small>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="bg-success text-white rounded p-3">
                                    <div class="h3 mb-0">
                                        <?php
                                        $totalJumlah = 0;
                                        foreach ($buku as $b) { $totalJumlah += $b['jumlah'] ?? 0; }
                                        echo $totalJumlah;
                                        ?>
                                    </div>
                                    <small>Total Eksemplar</small>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="bg-info text-white rounded p-3">
                                    <div class="h3 mb-0">
                                        <?php
                                        $totalTersedia = 0;
                                        foreach ($buku as $b) { $totalTersedia += $b['tersedia'] ?? 0; }
                                        echo $totalTersedia;
                                        ?>
                                    </div>
                                    <small>Total Tersedia</small>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="bg-warning text-dark rounded p-3">
                                    <div class="h3 mb-0">
                                        <?php
                                        $totalHabis = 0;
                                        foreach ($buku as $b) { if (($b['tersedia'] ?? 0) == 0) $totalHabis++; }
                                        echo $totalHabis;
                                        ?>
                                    </div>
                                    <small>Judul Habis</small>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>