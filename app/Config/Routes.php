<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Variabel Filter
$authFilter = ['filter' => 'auth'];

// Variabel Role
$admin     = ['filter' => 'role:admin'];
$petugas   = ['filter' => 'role:petugas'];
$anggota   = ['filter' => 'role:anggota'];
$allRole   = ['filter' => 'role:admin, petugas, anggota'];

// Login
$routes->get('/login', 'Auth::login');
$routes->post('/proses-login', 'Auth::prosesLogin');
$routes->get('/logout', 'Auth::logout');

// Register
$routes->get('/register', 'Auth::register');
$routes->post('/register/store', 'Auth::store');

// Halaman utama
$routes->get('/', 'Home::index', $authFilter);
$routes->get('/dashboard', 'Home::index', $authFilter);

// Halaman User
$routes->get('/users/create', 'Users::create'); // form tambah user
$routes->post('/users/store', 'Users::store'); // aksi simpan user
$routes->get('/users', 'Users::index', $allRole); // menampilkan data user hanya untuk admin dan petugas
$routes->get('/users/edit/(:num)', 'Users::edit/$1', $allRole); // form edit user
$routes->post('/users/update/(:num)', 'Users::update/$1', $allRole); // aksi update user
$routes->get('/users/delete/(:num)', 'Users::delete/$1', $allRole); // aksi hapus user
$routes->get('users/detail/(:num)', 'Users::detail/$1', $allRole); // aksi detail user
$routes->get('users/print', 'Users::print', $allRole); // aksi print data user
$routes->get('users/wa/(:num)', 'Users::wa/$1', $allRole); // aksi kirim ke whatsapp

// Buku
$routes->get('buku', 'Buku::index');
$routes->get('buku/create', 'Buku::create');
$routes->post('buku/store', 'Buku::store');
$routes->get('buku/detail/(:num)', 'Buku::detail/$1');
$routes->get('buku/edit/(:num)', 'Buku::edit/$1');
$routes->post('buku/update/(:num)', 'Buku::update/$1');
$routes->get('buku/delete/(:num)', 'Buku::delete/$1');
$routes->get('buku/print', 'Buku::print');
$routes->get('buku/wa/(:num)', 'Buku::wa/$1');

// Kelola data Rak
$routes->get('/rak', 'Rak::index');
$routes->get('/rak/create', 'Rak::create');
$routes->post('/rak/store', 'Rak::store');
$routes->get('/rak/detail/(:num)', 'Rak::detail/$1');
$routes->get('/rak/edit/(:num)', 'Rak::edit/$1');
$routes->post('/rak/update/(:num)', 'Rak::update/$1');
$routes->get('/rak/delete/(:num)', 'Rak::delete/$1');
$routes->get('/rak/print', 'Rak::print');

// Kelola data kategori
$routes->get('/kategori', 'Kategori::index');
$routes->get('/kategori/create', 'Kategori::create');
$routes->post('/kategori/store', 'Kategori::store');
$routes->get('/kategori/detail/(:num)', 'Kategori::detail/$1');
$routes->get('/kategori/edit/(:num)', 'Kategori::edit/$1');
$routes->post('/kategori/update/(:num)', 'Kategori::update/$1');
$routes->get('/kategori/delete/(:num)', 'Kategori::delete/$1');
$routes->get('/kategori/print', 'Kategori::print');

// Kelola data Penulis
$routes->get('/penulis', 'Penulis::index');
$routes->get('/penulis/create', 'Penulis::create');
$routes->post('/penulis/store', 'Penulis::store');
$routes->get('/penulis/detail/(:num)', 'Penulis::detail/$1');
$routes->get('/penulis/edit/(:num)', 'Penulis::edit/$1');
$routes->post('/penulis/update/(:num)', 'Penulis::update/$1');
$routes->get('/penulis/delete/(:num)', 'Penulis::delete/$1');
$routes->get('/penulis/print', 'Penulis::print');

// Kelola data Penerbit
$routes->get('/penerbit', 'Penerbit::index');
$routes->get('/penerbit/create', 'Penerbit::create');
$routes->post('/penerbit/store', 'Penerbit::store');
$routes->get('/penerbit/detail/(:num)', 'Penerbit::detail/$1');
$routes->get('/penerbit/edit/(:num)', 'Penerbit::edit/$1');
$routes->post('/penerbit/update/(:num)', 'Penerbit::update/$1');
$routes->get('/penerbit/delete/(:num)', 'Penerbit::delete/$1');
$routes->get('/penerbit/print', 'Penerbit::print');

// Peminjaman
$routes->get('/peminjaman', 'Peminjaman::index', $allRole);
$routes->get('/peminjaman/create', 'Peminjaman::create', $allRole);
$routes->post('/peminjaman/store', 'Peminjaman::store', $allRole);
$routes->get('/peminjaman/detail/(:num)', 'Peminjaman::detail/$1', $allRole);
$routes->get('/peminjaman/edit/(:num)', 'Peminjaman::edit/$1', $allRole);
$routes->post('/peminjaman/update/(:num)', 'Peminjaman::update/$1', $allRole);
$routes->get('/peminjaman/delete/(:num)', 'Peminjaman::delete/$1', $allRole);
$routes->get('/peminjaman/kembalikan/(:num)', 'Peminjaman::kembalikan/$1', $allRole);
$routes->get('/peminjaman/konfirmasi/(:num)', 'Peminjaman::konfirmasi/$1', $allRole);
$routes->get('/peminjaman/tolak/(:num)', 'Peminjaman::tolak/$1', $allRole);
$routes->get('/peminjaman/print', 'Peminjaman::print', $allRole);
