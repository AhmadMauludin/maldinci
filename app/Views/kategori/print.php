<html>

<head>
    <title>Print Data Kategori</title>
</head>

<body onload="window.print()">

    <h3>Data Kategori</h3>

    <table border="1" width="100%">
        <tr>
            <th>ID</th>
            <th>Nama Kategori</th>
        </tr>

        <?php foreach (isset($kategori) && is_array($kategori) ? $kategori : [] as $k): ?>
            <tr>
                <td><?= $k['id_kategori'] ?></td>
                <td><?= $k['nama_kategori'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>

</html>