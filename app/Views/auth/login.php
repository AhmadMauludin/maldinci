<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Maldin17App</title>

    <!-- Bootstrap CSS Lokal -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 1rem;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175);
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .login-header .icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2.5rem;
        }

        .login-header h3 {
            margin: 0;
            font-weight: 700;
        }

        .login-header p {
            margin: 0.5rem 0 0;
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .login-body {
            padding: 2rem;
        }

        .form-floating > label {
            color: #6c757d;
        }

        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }

        .btn-login {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            border: none;
            padding: 0.75rem;
            font-weight: 600;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 0.5rem 1rem rgba(78, 115, 223, 0.4);
        }

        .login-footer {
            padding: 1.5rem 2rem 2rem;
            text-align: center;
            border-top: 1px solid #e3e6f0;
            background-color: #f8f9fc;
        }

        .login-footer a {
            color: #4e73df;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .login-footer a:hover {
            color: #224abe;
            text-decoration: underline;
        }

        .alert {
            border-radius: 0.5rem;
            border: none;
        }
    </style>
</head>

<body>
    <div class="login-card card">
        <div class="login-header">
            <div class="icon">
                <i class="bi bi-book-fill"></i>
            </div>
            <h3>Maldin17App</h3>
            <p>Sistem Manajemen Perpustakaan</p>
        </div>

        <div class="login-body">
            <!-- Pesan Error -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('salahpw')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?= session()->getFlashdata('salahpw') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Form Login -->
            <form action="<?= base_url('/proses-login') ?>" method="post" novalidate>
                <div class="form-floating mb-3">
                    <input type="text" name="username" class="form-control" id="username" placeholder="Username" required autocomplete="username">
                    <label for="username"><i class="bi bi-person me-2"></i>Username</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required autocomplete="current-password">
                    <label for="password"><i class="bi bi-lock me-2"></i>Password</label>
                </div>

                <button type="submit" class="btn btn-primary btn-login w-100">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Sign In
                </button>
            </form>
        </div>

        <div class="login-footer">
            <p class="mb-0 text-muted small">
                Belum punya akun?
                <a href="<?= base_url('register') ?>">
                    <i class="bi bi-person-plus me-1"></i> Daftar Sekarang
                </a>
            </p>
        </div>
    </div>

    <!-- Bootstrap JS Lokal -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>