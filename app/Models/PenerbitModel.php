<?php

namespace App\Models;

use CodeIgniter\Model;

class PenerbitModel extends Model
{
    protected $table = 'penerbit';
    protected $primaryKey = 'id_penerbit';
    protected $allowedFields = ['nama_penerbit', 'alamat'];
    protected $useTimestamps = false;
}