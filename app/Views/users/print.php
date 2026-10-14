<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Data Users - MaldinPustaka</title>

    <!-- Bootstrap CSS Lokal -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

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
        <h2><i class="bi bi-people"></i> MaldinPustaka</h2>
        <p>Sistem Manajemen Perpustakaan</p>
    </div>

    <h4 class="mb-3">Data Users</h4>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th width="5%">No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Username</th>
                <th>Role</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($users)): ?>
                <?php $no = 1;
                foreach ($users as $u): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $u['nama'] ?></td>
                        <td><?= $u['email'] ?></td>
                        <td><?= $u['username'] ?></td>
                        <td><?= ucfirst($u['role']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="text-end mt-3 text-muted small">
        Dicetak pada: <?= date('d/m/Y H:i:s') ?>
    </div>
</body>

</html>