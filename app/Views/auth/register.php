<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - Maldin17App</title>

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

        .register-card {
            width: 100%;
            max-width: 480px;
            border: none;
            border-radius: 1rem;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175);
            overflow: hidden;
        }

        .register-header {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .register-header .icon {
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

        .register-header h3 {
            margin: 0;
            font-weight: 700;
        }

        .register-header p {
            margin: 0.5rem 0 0;
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .register-body {
            padding: 2rem;
        }

        .form-floating > label {
            color: #6c757d;
        }

        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }

        .btn-register {
            background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
            border: none;
            padding: 0.75rem;
            font-weight: 600;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .btn-register:hover {
            transform: translateY(-1px);
            box-shadow: 0 0.5rem 1rem rgba(28, 200, 138, 0.4);
        }

        .register-footer {
            padding: 1.5rem 2rem 2rem;
            text-align: center;
            border-top: 1px solid #e3e6f0;
            background-color: #f8f9fc;
        }

        .register-footer a {
            color: #4e73df;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .register-footer a:hover {
            color: #224abe;
            text-decoration: underline;
        }

        .alert {
            border-radius: 0.5rem;
            border: none;
        }

        .password-strength {
            height: 4px;
            border-radius: 2px;
            margin-top: 0.25rem;
            background-color: #e3e6f0;
            overflow: hidden;
        }

        .password-strength .bar {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .password-strength .bar.weak { width: 25%; background-color: #e74a3b; }
        .password-strength .bar.fair { width: 50%; background-color: #f6c23e; }
        .password-strength .bar.good { width: 75%; background-color: #36b9cc; }
        .password-strength .bar.strong { width: 100%; background-color: #1cc88a; }
    </style>
</head>

<body>
    <div class="register-card card">
        <div class="register-header">
            <div class="icon">
                <i class="bi bi-person-plus-fill"></i>
            </div>
            <h3>Daftar Akun Baru</h3>
            <p>Bergabung dengan Maldin17App</p>
        </div>

        <div class="register-body">
            <!-- Pesan Error -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?= session()->getFlashdata('error') ?>
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

            <!-- Form Register -->
            <form action="<?= base_url('/register/store') ?>" method="post" novalidate>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap" required autocomplete="name" value="<?= old('nama') ?>">
                            <label for="nama"><i class="bi bi-person me-2"></i>Nama Lengkap</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email" required autocomplete="email" value="<?= old('email') ?>">
                            <label for="email"><i class="bi bi-envelope me-2"></i>Email</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username" required autocomplete="username" value="<?= old('username') ?>">
                        <label for="username"><i class="bi bi-at me-2"></i>Username</label>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" name="nis" class="form-control" id="nis" placeholder="NIS/Nomor Induk" required autocomplete="off" value="<?= old('nis') ?>">
                        <label for="nis"><i class="bi bi-card-text me-2"></i>NIS / Nomor Induk</label>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required autocomplete="new-password" minlength="6">
                        <label for="password"><i class="bi bi-lock me-2"></i>Password (min. 6 karakter)</label>
                    </div>
                    <div class="password-strength" id="passwordStrength">
                        <div class="bar"></div>
                    </div>
                    <small class="text-muted" id="passwordText"></small>
                </div>

                <div class="mb-4">
                    <div class="form-floating">
                        <input type="password" name="password_confirm" class="form-control" id="password_confirm" placeholder="Konfirmasi Password" required autocomplete="new-password">
                        <label for="password_confirm"><i class="bi bi-lock-fill me-2"></i>Konfirmasi Password</label>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-floating">
                        <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat" required style="height: 100px;"><?= old('alamat') ?></textarea>
                        <label for="alamat"><i class="bi bi-geo-alt me-2"></i>Alamat Lengkap</label>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="form-floating">
                        <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="Nomor HP" required autocomplete="tel" value="<?= old('no_hp') ?>">
                        <label for="no_hp"><i class="bi bi-phone me-2"></i>Nomor HP</label>
                    </div>
                </div>

                <div class="mb-4 form-check">
                    <input type="checkbox" name="terms" class="form-check-input" id="terms" required>
                    <label class="form-check-label small text-muted" for="terms">
                        Saya menyetujui <a href="#" class="text-primary">Syarat & Ketentuan</a> dan <a href="#" class="text-primary">Kebijakan Privasi</a>
                    </label>
                </div>

                <button type="submit" class="btn btn-success btn-register w-100">
                    <i class="bi bi-person-plus me-2"></i> Daftar
                </button>
            </form>
        </div>

        <div class="register-footer">
            <p class="mb-0 text-muted small">
                Sudah punya akun?
                <a href="<?= base_url('login') ?>">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Login di sini
                </a>
            </p>
        </div>
    </div>

    <!-- Bootstrap JS Lokal -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const strengthBar = document.getElementById('passwordStrength')?.querySelector('.bar');
            const strengthText = document.getElementById('passwordText');

            if (passwordInput && strengthBar) {
                passwordInput.addEventListener('input', function() {
                    const password = this.value;
                    let strength = 0;
                    let text = '';

                    // Length check
                    if (password.length >= 6) strength += 25;
                    if (password.length >= 8) strength += 10;
                    if (password.length >= 12) strength += 10;

                    // Character variety
                    if (/[a-z]/.test(password)) strength += 10;
                    if (/[A-Z]/.test(password)) strength += 10;
                    if (/[0-9]/.test(password)) strength += 10;
                    if (/[^a-zA-Z0-9]/.test(password)) strength += 15;

                    strength = Math.min(strength, 100);

                    strengthBar.style.width = strength + '%';
                    strengthBar.className = 'bar';

                    if (strength < 30) {
                        strengthBar.classList.add('weak');
                        text = 'Lemah';
                    } else if (strength < 50) {
                        strengthBar.classList.add('fair');
                        text = 'Cukup';
                    } else if (strength < 75) {
                        strengthBar.classList.add('good');
                        text = 'Baik';
                    } else {
                        strengthBar.classList.add('strong');
                        text = 'Kuat';
                    }

                    if (strengthText) {
                        strengthText.textContent = 'Kekuatan password: ' + text;
                        strengthText.style.color = getComputedStyle(strengthBar).backgroundColor;
                    }
                });
            }

            // Form validation
            document.querySelector('form').addEventListener('submit', function(e) {
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('password_confirm').value;

                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('Password dan konfirmasi password tidak cocok!');
                    return false;
                }

                if (password.length < 6) {
                    e.preventDefault();
                    alert('Password minimal 6 karakter!');
                    return false;
                }
            });
        });
    </script>
</body>

</html>