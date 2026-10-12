<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\KategoriModel;
use App\Models\PenulisModel;
use App\Models\PenerbitModel;
use App\Models\RakModel;
use App\Models\PeminjamanModel;
use App\Models\UsersModel;

class Home extends BaseController
{
    public function index(): string
    {
        $bukuModel = new BukuModel();
        $kategoriModel = new KategoriModel();
        $penulisModel = new PenulisModel();
        $penerbitModel = new PenerbitModel();
        $rakModel = new RakModel();
        $peminjamanModel = new PeminjamanModel();
        $usersModel = new UsersModel();

        $data = [
            'totalBuku' => $bukuModel->countAllResults(),
            'totalKategori' => $kategoriModel->countAllResults(),
            'totalPenulis' => $penulisModel->countAllResults(),
            'totalPenerbit' => $penerbitModel->countAllResults(),
            'totalRak' => $rakModel->countAllResults(),
            'totalPeminjaman' => $peminjamanModel->countAllResults(),
            'totalUsers' => $usersModel->countAllResults(),
        ];
        
        return view('layouts/dashboard', $data);
    }

    public function profile(): string
    {
        return view('layouts/profile');
    }
}