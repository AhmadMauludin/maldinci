<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Edit User</h4>
        </div>
        <div class="card-body">

            <form action="<?= base_url('users/update/' . $user['id']) ?>" method="post" enctype="multipart/form-data">

                <input type="hidden" name="role" value="<?= $user['role'] ?>">

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="<?= $user['nama'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= $user['username'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password (kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <input type="text" class="form-control-plaintext" value="<?= ucfirst($user['role']) ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto</label>
                    <input type="file" name="foto" class="form-control">
                    <p>Foto sekarang:</p>
                    <?php if ($user['foto']): ?>
                        <img src="<?= base_url('uploads/users/' . $user['foto']) ?>" width="80" class="img-thumbnail">
                    <?php else: ?>
                        <span class="text-muted">-</span>
                    <?php endif; ?>
                </div>

                <!-- Data Anggota -->
                <div id="anggotaFields" style="<?= $user['role'] !== 'anggota' ? 'display:none;' : '' ?>">
                    <hr>
                    <h5>Data Anggota</h5>
                    
                    <div class="mb-3">
                        <label class="form-label">NIS</label>
                        <input type="text" name="nis" class="form-control" value="<?= $anggota['nis'] ?? '' ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3"><?= $anggota['alamat'] ?? '' ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No HP</label>
                        <input type="text" name="no_hp" class="form-control" value="<?= $anggota['no_hp'] ?? '' ?>">
                    </div>
                </div>

                <!-- Data Petugas -->
                <div id="petugasFields" style="<?= $user['role'] !== 'petugas' ? 'display:none;' : '' ?>">
                    <hr>
                    <h5>Data Petugas</h5>
                    
                    <div class="mb-3">
                        <label class="form-label">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" value="<?= $petugas['jabatan'] ?? '' ?>">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= base_url('users') ?>" class="btn btn-secondary">Kembali</a>

            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const role = document.querySelector('input[name="role"]').value;
    document.getElementById('anggotaFields').style.display = role === 'anggota' ? 'block' : 'none';
    document.getElementById('petugasFields').style.display = role === 'petugas' ? 'block' : 'none';
});
</script>

<?= $this->endSection() ?>