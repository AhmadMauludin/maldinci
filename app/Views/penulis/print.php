<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Data Penulis - Maldin17App</title>

    <!-- Bootstrap CSS Lokal -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">

    <style>
        body {
            font-family: "SF Pro", "Helvetica Neue", Helvetica, Arial, sans-serif;
            padding: 20px;
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }

        .print-header {
            text-align: center;
            border-bottom: 2px solid #4e73df;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .print-header h2 {
            margin: 0;
            color: #4e73df;
        }

        .print-header p {
            margin: 5px 0 0;
            color: #6c757d;
        }

        .table th {
            background-color: #f8f9fc;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="print-header">
        <h2><i class="bi bi-book-fill"></i> Maldin17App</h2>
        <p>Sistem Manajemen Perpustakaan</p>
    </div>

    <h4 class="mb-3">Data Penulis</h4>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr class="text-center">
                <th width="5%">No</th>
                <th>Nama Penulis</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (isset($penulis) && is_array($penulis) ? $penulis : [] as $i => $p): ?>
                <tr>
                    <td class="text-center"><?= $i + 1 ?></td>
                    <td><?= esc($p['nama_penulis']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-end mt-3 text-muted small">
        Dicetak pada: <?= date('d/m/Y H:i:s') ?>
    </div>
</body>

</html>