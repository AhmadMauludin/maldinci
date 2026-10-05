<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h3>Data Kategori</h3>

<form method="get">
    <input type="text" name="keyword" placeholder="Cari nama kategori">
    <button type="submit">Cari</button>
</form>

<a href="<?= base_url('kategori/create') ?>">Tambah</a>
<a href="<?= base_url('kategori/print') ?>" target="_blank">Print</a>

<table border="1" width="100%">
    <tr>
        <th>ID</th>
        <th>Nama Kategori</th>
        <th>Aksi</th>
    </tr>

    <?php if (isset($kategori) && is_array($kategori)): ?>
        <?php foreach ($kategori as $k): ?>
            <tr>
                <td><?= $k['id_kategori'] ?></td>
                <td><?= $k['nama_kategori'] ?></td>
                <td>
                    <a href="<?= base_url('kategori/edit/' . $k['id_kategori']) ?>">Edit</a>
                    <a href="<?= base_url('kategori/detail/' . $k['id_kategori']) ?>">Detail</a>
                    <a href="<?= base_url('kategori/delete/' . $k['id_kategori']) ?>" onclick="return confirm('Yakin?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="4">Data tidak ditemukan</td>
        </tr>
    <?php endif; ?>
</table>

<?= $this->endSection() ?>