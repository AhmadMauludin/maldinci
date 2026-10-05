<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Detail Kategori</h3>

<?php $kategori = $kategori ?? []; ?>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <td><?= $kategori['id_kategori'] ?? '' ?></td>
    </tr>
    <tr>
        <th>Nama Kategori</th>
        <td><?= $kategori['nama_kategori'] ?? '' ?></td>
    </tr>
</table>

<br>
<a href="<?= base_url('kategori') ?>">Kembali</a>

<?= $this->endSection() ?>