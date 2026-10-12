<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Home extends BaseController
{
    public function index(): string
    {
        $bukuModel = new BukuModel();
        $data['totalBuku'] = $bukuModel->countAllResults();
        
        return view('layouts/dashboard', $data);
    }

    // Tambahkan method profile untuk menampilkan halaman profile
        public function profile(): string
    {
        return view('layouts/profile');
    }
}