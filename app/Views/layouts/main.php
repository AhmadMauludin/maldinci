<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Maldin17App' ?></title>

    <!-- Bootstrap CSS Lokal -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --header-height: 60px;
        }

        body {
            font-family: "SF Pro", "Helvetica Neue", Helvetica, Arial, sans-serif;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background-color: #fff;
            border-right: 1px solid #e3e6f0;
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar .sidebar-brand {
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 1rem;
            border-bottom: 1px solid #e3e6f0;
        }

        .sidebar .sidebar-brand .brand-text {
            font-weight: 700;
            font-size: 1.1rem;
            color: #4e73df;
            white-space: nowrap;
            overflow: hidden;
            transition: opacity 0.2s ease;
        }

        .sidebar.collapsed .sidebar-brand .brand-text {
            opacity: 0;
            width: 0;
        }

        .sidebar .nav-item {
            padding: 0.25rem 0.75rem;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #858796;
            text-decoration: none;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #eaecf4;
            color: #4e73df;
        }

        .sidebar .nav-link i {
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .sidebar .nav-link .nav-text {
            transition: opacity 0.2s ease;
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar.collapsed .nav-link .nav-text {
            opacity: 0;
            width: 0;
        }

        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 0.75rem;
        }

        .sidebar.collapsed .nav-link i {
            margin-right: 0;
        }

        .sidebar .sidebar-divider {
            border-top: 1px solid #e3e6f0;
            margin: 0.5rem 1rem;
        }

        .sidebar .sidebar-heading {
            padding: 0.5rem 1rem;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.05rem;
            font-weight: 800;
            color: #b7b9cc;
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar.collapsed .sidebar-heading {
            opacity: 0;
            height: 0;
            padding: 0;
            margin: 0;
        }

        .sidebar .user-profile {
            padding: 1rem;
            border-top: 1px solid #e3e6f0;
            margin-top: auto;
        }

        .sidebar .user-profile .user-info {
            display: flex;
            align-items: center;
        }

        .sidebar .user-profile .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .sidebar .user-profile .user-details {
            overflow: hidden;
        }

        .sidebar .user-profile .user-name {
            font-weight: 600;
            font-size: 0.85rem;
            color: #3a3b45;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar .user-profile .user-role {
            font-size: 0.7rem;
            color: #858796;
            text-transform: capitalize;
        }

        .sidebar.collapsed .user-profile .user-details {
            opacity: 0;
            width: 0;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin-left 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .main-content.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Top Navbar */
        .top-navbar {
            height: var(--header-height);
            background-color: #fff;
            border-bottom: 1px solid #e3e6f0;
            position: sticky;
            top: 0;
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        }

        .top-navbar .sidebar-toggle {
            background: none;
            border: none;
            font-size: 1.25rem;
            color: #6c757d;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 0.375rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .top-navbar .sidebar-toggle:hover {
            background-color: #f8f9fa;
            color: #4e73df;
        }

        .top-navbar .page-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #3a3b45;
            margin: 0;
        }

        .top-navbar .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .top-navbar .user-menu .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }

        .top-navbar .user-menu .user-name {
            font-weight: 500;
            color: #3a3b45;
            font-size: 0.875rem;
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Content Area */
        .content-area {
            flex: 1;
            padding: 1.5rem;
        }

        /* Footer */
        .footer {
            background-color: #fff;
            border-top: 1px solid #e3e6f0;
            padding: 1rem 1.5rem;
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s ease;
        }

        .main-content.expanded .footer {
            margin-left: var(--sidebar-collapsed-width);
        }

        .footer .footer-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.5rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .footer .copyright {
            color: #858796;
            font-size: 0.8rem;
            margin: 0;
        }

        .footer .footer-links {
            display: flex;
            gap: 1rem;
        }

        .footer .footer-links a {
            color: #858796;
            font-size: 0.8rem;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer .footer-links a:hover {
            color: #4e73df;
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .sidebar-overlay.show {
            display: block;
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .main-content.expanded {
                margin-left: 0;
            }

            .footer {
                margin-left: 0;
            }

            .top-navbar {
                padding: 0 1rem;
            }

            .content-area {
                padding: 1rem;
            }

            .sidebar.collapsed {
                width: var(--sidebar-width);
            }
        }

        @media (min-width: 992px) {
            .sidebar-overlay {
                display: none !important;
            }
        }

        /* Card enhancements */
        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        }

        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
            border-radius: 0.5rem 0.5rem 0 0 !important;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .badge {
            font-weight: 500;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
    </style>
</head>

<body>
    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-brand">
            <i class="bi bi-book-fill text-primary me-2" style="font-size: 1.5rem;"></i>
            <span class="brand-text">Maldin17App</span>
        </div>

        <div class="sidebar-menu">
        <?php include(APPPATH . 'Views/layouts/menu.php'); ?>
        </div>

    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Navbar -->
        <nav class="top-navbar">
            <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle Sidebar">
                <i class="bi bi-list"></i>
            </button>


            <div class="user-menu">
                <span class="user-name d-none d-md-block"><?= session('nama') ?></span>
                <img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>" alt="User" class="user-avatar" onerror="this.src='<?= base_url('assets/img/default-avatar.png') ?>'">
                <a href="<?= base_url('logout') ?>" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </nav>

        <!-- Content Area -->
        <div class="content-area">
            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <!-- Bootstrap JS Lokal -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            // Toggle sidebar on desktop
            sidebarToggle.addEventListener('click', function() {
                if (window.innerWidth >= 992) {
                    sidebar.classList.toggle('collapsed');
                    mainContent.classList.toggle('expanded');
                } else {
                    sidebar.classList.toggle('show');
                    sidebarOverlay.classList.toggle('show');
                }
            });

            // Close sidebar when clicking overlay on mobile
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
            });

            // Close sidebar when clicking a link on mobile
            document.querySelectorAll('.sidebar .nav-link').forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 992) {
                        sidebar.classList.remove('show');
                        sidebarOverlay.classList.remove('show');
                    }
                });
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992) {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                }
            });

            // Auto-dismiss alerts after 5 seconds
            document.querySelectorAll('.alert-dismissible').forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>
</body>

</html>