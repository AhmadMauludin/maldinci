<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Tambah Kategori</h3>

<form action="<?= base_url('kategori/store') ?>" method="post">
    <label>Nama Kategori</label><br>
    <input type="text" name="nama_kategori"><br><br>
    <button type="submit">Simpan</button>
</form>

<?= $this->endSection() ?>