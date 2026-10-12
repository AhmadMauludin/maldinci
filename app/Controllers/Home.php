<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\KategoriModel;
use App\Models\PenulisModel;
use App\Models\PenerbitModel;
use App\Models\RakModel;
use App\Models\PeminjamanModel;
use App\Models\UsersModel;
use App\Models\AnggotaModel;
use App\Models\PetugasModel;

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
            'bukuTersedia' => count($bukuModel->bukuTersedia()),
            'totalKategori' => $kategoriModel->countAllResults(),
            'totalPenulis' => $penulisModel->countAllResults(),
            'totalPenerbit' => $penerbitModel->countAllResults(),
            'totalRak' => $rakModel->countAllResults(),
            'totalPeminjaman' => $peminjamanModel->countAllResults(),
            'totalUsers' => $usersModel->countAllResults(),
        ];

        $session = session();
        $role = $session->get('role');

        if ($role === 'petugas') {
            $data['pendingKonfirmasi'] = $peminjamanModel->getPendingKonfirmasi(5);
        } elseif ($role === 'anggota') {
            $anggotaModel = new AnggotaModel();
            $anggota = $anggotaModel->getByUserId($session->get('id'));
            if ($anggota) {
                $data['activePeminjaman'] = $peminjamanModel->getActivePeminjamanByAnggota($anggota['id_anggota'], 5);
            }
        }
        
        return view('layouts/dashboard', $data);
    }

    public function profile(): string
    {
        return view('layouts/profile');
    }
}