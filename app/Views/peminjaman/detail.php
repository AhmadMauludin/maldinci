<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Peminjaman</h1>
        <div>
<a href="<?= base_url('/peminjaman') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Peminjaman</h6>
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
                            <td>: <?= esc($peminjaman['judul_buku']) ?></td>
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
        </div>
        <div class="col-md-4">
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
                        <?php if (session()->get('role') !== 'anggota'): ?>
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