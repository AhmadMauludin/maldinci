<?= $this->extend('layouts/main') ?>

<?= $this->section('pageTitle') ?>
Detail Peminjaman
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
$statusTerkunci = in_array($peminjaman['status'], ['kembali', 'terlambat'], true);
$pengembalian = $peminjaman['pengembalian'] ?? null;
$denda = $peminjaman['denda'] ?? null;
?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Peminjaman</h6>
                <a href="<?= base_url('/peminjaman') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th width="30%">ID Peminjaman</th>
                    <td>: <?= $peminjaman['id_peminjaman'] ?></td>
                </tr>
                <tr>
                    <th>Anggota</th>
                    <td>: <?= esc($peminjaman['nama_anggota']) ?> (NIS: <?= esc($peminjaman['nis']) ?>)</td>
                </tr>
                <tr>
                    <th>Buku</th>
                    <td>:
                        <?php if (!empty($peminjaman['buku_list'])): ?>
                            <ul class="mb-0 ps-3">
                                <?php foreach ($peminjaman['buku_list'] as $buku): ?>
                                    <li><?= esc($buku['judul']) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Petugas</th>
                    <td>: <?= esc($peminjaman['nama_petugas'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>Tanggal Pinjam</th>
                    <td>: <?= date('d F Y', strtotime($peminjaman['tanggal_pinjam'])) ?></td>
                </tr>
                <tr>
                    <th>Tanggal Kembali</th>
                    <td>: <?= date('d F Y', strtotime($peminjaman['tanggal_kembali'])) ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        : <?php if ($peminjaman['status'] === 'dimohon'): ?>
                            <span class="badge bg-info">Dimohon</span>
                        <?php elseif ($peminjaman['status'] === 'dipinjam'): ?>
                            <span class="badge bg-warning text-dark">Dipinjam</span>
                        <?php elseif ($peminjaman['status'] === 'kembali'): ?>
                            <span class="badge bg-success">Kembali</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Terlambat</span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Pengembalian &amp; Denda</h6>
        </div>
        <div class="card-body">
            <?php if ($pengembalian): ?>
                <h6 class="fw-bold mb-2">Data Pengembalian</h6>
                <table class="table table-borderless mb-4">
                    <tr>
                        <th width="30%">ID Pengembalian</th>
                        <td>: <?= esc($pengembalian['id_pengembalian']) ?></td>
                    </tr>
                    <tr>
                        <th>ID Peminjaman</th>
                        <td>: <?= esc($pengembalian['id_peminjaman']) ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Dikembalikan</th>
                        <td>: <?= !empty($pengembalian['tanggal_dikembalikan']) ? date('d F Y', strtotime($pengembalian['tanggal_dikembalikan'])) : '-' ?></td>
                    </tr>
                    <tr>
                        <th>Denda</th>
                        <td>: Rp <?= number_format((float) ($pengembalian['denda'] ?? 0), 0, ',', '.') ?></td>
                    </tr>
                </table>

                <h6 class="fw-bold mb-2">Data Denda</h6>
                <?php if ($denda): ?>
                    <table class="table table-borderless mb-3">
                        <tr>
                            <th width="30%">ID Denda</th>
                            <td>: <?= esc($denda['id_denda']) ?></td>
                        </tr>
                        <tr>
                            <th>ID Pengembalian</th>
                            <td>: <?= esc($denda['id_pengembalian']) ?></td>
                        </tr>
                        <tr>
                            <th>Jumlah Denda</th>
                            <td>: <span class="fw-bold <?= $denda['status'] === 'belum_bayar' ? 'text-danger' : 'text-success' ?>">Rp <?= number_format((float) $denda['jumlah_denda'], 0, ',', '.') ?></span></td>
                        </tr>
                        <tr>
                            <th>Status Denda</th>
                            <td>:
                                <?php if ($denda['status'] === 'belum_bayar'): ?>
                                    <span class="badge bg-danger">Belum Bayar</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Sudah Bayar</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                    <?php if ($denda['status'] === 'belum_bayar'): ?>
                        <a href="<?= base_url('/peminjaman/bayar-denda/' . $denda['id_denda']) ?>" class="btn btn-danger" onclick="return confirm('Tandai denda ini sebagai sudah dibayar?')">
                            <i class="bi bi-cash-coin"></i> Bayar Denda
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="alert alert-info mb-0">
                        <i class="bi bi-info-circle"></i> Tidak ada data denda untuk pengembalian ini.
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="alert alert-info mb-0">
                    <i class="bi bi-info-circle"></i> Belum ada data pengembalian untuk peminjaman ini.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- Aksi Cepat -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <?php if ($peminjaman['status'] === 'dimohon' && session()->get('role') === 'petugas'): ?>
                            <a href="<?= base_url('/peminjaman/konfirmasi/' . $peminjaman['id_peminjaman']) ?>" class="btn btn-success" onclick="return confirm('Konfirmasi peminjaman ini?')">
                                <i class="bi bi-check-lg"></i> Konfirmasi Peminjaman
                            </a>
                            <a href="<?= base_url('/peminjaman/tolak/' . $peminjaman['id_peminjaman']) ?>" class="btn btn-danger" onclick="return confirm('Tolak peminjaman ini?')">
                                <i class="bi bi-x-lg"></i> Tolak Peminjaman
                            </a>
                        <?php elseif ($peminjaman['status'] === 'dipinjam' && session()->get('role') !== 'anggota'): ?>
                            <a href="<?= base_url('/peminjaman/kembalikan/' . $peminjaman['id_peminjaman']) ?>" class="btn btn-success" onclick="return confirm('Yakin ingin mengembalikan buku ini?')">
                                <i class="bi bi-arrow-return-left"></i> Kembalikan Buku
                            </a>
                        <?php endif; ?>
                        <?php if (session()->get('role') !== 'anggota' && !$statusTerkunci): ?>
                            <a href="<?= base_url('/peminjaman/edit/' . $peminjaman['id_peminjaman']) ?>" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Edit Data
                            </a>

                            <a href="<?= base_url('/peminjaman/delete/' . $peminjaman['id_peminjaman']) ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                <i class="bi bi-trash"></i> Hapus Data
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>