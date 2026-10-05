<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table = 'anggota';
    protected $primaryKey = 'id_anggota';
    protected $allowedFields = ['user_id', 'nis', 'alamat', 'no_hp', 'tanggal_daftar'];

    public function getByUserId($user_id)
    {
        return $this->where('user_id', $user_id)->first();
    }

    public function getAllWithUser()
    {
        return $this->select('anggota.*, users.nama')
            ->join('users', 'users.id = anggota.user_id')
            ->findAll();
    }
}