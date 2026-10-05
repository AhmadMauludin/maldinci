<?= $this->extend('layouts/print') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="text-center mb-4">
        <h2>Laporan Data Peminjaman</h2>
        <p class="text-muted"><?= esc($pengaturan['nama_aplikasi'] ?? 'Sistem Perpustakaan') ?></p>
        <p class="text-muted">Dicetak pada: <?= date('d F Y H:i:s') ?></p>
        <?php if ($keyword): ?>
            <p class="text-muted">Filter: <?= esc($keyword) ?><?= $status ? ' - Status: ' . ucfirst($status) : '' ?></p>
        <?php elseif ($status): ?>
            <p class="text-muted">Filter Status: <?= ucfirst($status) ?></p>
        <?php endif; ?>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr class="text-center">
                    <th width="5%">No</th>
                    <th>Anggota</th>
                    <th>Buku</th>
                    <th>Petugas</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($peminjaman)): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($peminjaman as $pinjam): ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td>
                                <strong><?= esc($pinjam['nama_anggota']) ?></strong><br>
                                <small>NIS: <?= esc($pinjam['nis']) ?></small>
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
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-4">Tidak ada data peminjaman</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="text-end mt-4">
        <p>Total Data: <?= count($peminjaman) ?></p>
    </div>
</div>

<script>
window.onload = function() {
    window.print();
}
</script>
<?= $this->endSection() ?>