<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?php $kategori = $kategori ?? []; ?>

<h3>Edit Kategori</h3>

<form action="<?= base_url('kategori/update/' . $kategori['id_kategori']) ?>" method="post">
    <label>Nama Kategori</label><br>
    <input type="text" name="nama_kategori" value="<?= $kategori['nama_kategori'] ?>"><br><br>

    <button type="submit">Update</button>
</form>

<?= $this->endSection() ?>