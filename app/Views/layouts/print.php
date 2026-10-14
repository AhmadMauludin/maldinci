<!doctype html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print - MaldinPustaka</title>

    <!-- Bootstrap CSS Lokal -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            font-family: "SF Pro", "Helvetica Neue", Helvetica, Arial, sans-serif;
            padding: 20px;
            background-color: #fff;
        }
        
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <?= $this->renderSection('content') ?>
</body>

</html>