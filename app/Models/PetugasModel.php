<?php

namespace App\Models;

use CodeIgniter\Model;

class PetugasModel extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';
    protected $allowedFields = ['user_id', 'jabatan'];

    public function getByUserId($user_id)
    {
        return $this->where('user_id', $user_id)->first();
    }

    public function getAllWithUser()
    {
        return $this->select('petugas.*, users.nama')
            ->join('users', 'users.id = petugas.user_id')
            ->findAll();
    }
}