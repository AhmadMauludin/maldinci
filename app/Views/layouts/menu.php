<hr class="sidebar-divider">
            <div class="sidebar-heading">Menu Utama</div>

            <a href="<?= base_url('/') ?>" class="nav-link <?= uri_string() == '' ? 'active' : '' ?>">
                <i class="bi bi-speedometer2"></i>
                <span class="nav-text">Dashboard</span>
            </a>

            <a href="<?= base_url('users/edit/' . session()->get('id')) ?>" class="nav-link <?= uri_string() == 'users/edit/' . session()->get('id') ? 'active' : '' ?>">
                <i class="bi bi-person"></i>
                <span class="nav-text">Profile</span>
            </a>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">Manajemen Data</div>

            <a href="<?= base_url('rak') ?>" class="nav-link <?= strpos(uri_string(), 'rak') === 0 ? 'active' : '' ?>">
                <i class="bi bi-bookshelf"></i>
                <span class="nav-text">Rak</span>
            </a>

            <a href="<?= base_url('kategori') ?>" class="nav-link <?= strpos(uri_string(), 'kategori') === 0 ? 'active' : '' ?>">
                <i class="bi bi-tags"></i>
                <span class="nav-text">Kategori</span>
            </a>

            <a href="<?= base_url('penulis') ?>" class="nav-link <?= strpos(uri_string(), 'penulis') === 0 ? 'active' : '' ?>">
                <i class="bi bi-person-lines-fill"></i>
                <span class="nav-text">Penulis</span>
            </a>

            <a href="<?= base_url('penerbit') ?>" class="nav-link <?= strpos(uri_string(), 'penerbit') === 0 ? 'active' : '' ?>">
                <i class="bi bi-building"></i>
                <span class="nav-text">Penerbit</span>
            </a>

            <a href="<?= base_url('buku') ?>" class="nav-link <?= strpos(uri_string(), 'buku') === 0 ? 'active' : '' ?>">
                <i class="bi bi-book"></i>
                <span class="nav-text">Buku</span>
            </a>

            <a href="<?= base_url('peminjaman') ?>" class="nav-link <?= strpos(uri_string(), 'peminjaman') === 0 ? 'active' : '' ?>">
                <i class="bi bi-journal-bookmark"></i>
                <span class="nav-text">Peminjaman</span>
            </a>

            <?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
                <a href="<?= base_url('users') ?>" class="nav-link <?= strpos(uri_string(), 'users') === 0 ? 'active' : '' ?>">
                    <i class="bi bi-people"></i>
                    <span class="nav-text">Users</span>
                </a>
            <?php endif; ?>