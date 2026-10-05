<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaturanModel extends Model
{
    protected $table = 'pengaturan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_aplikasi', 'denda_per_hari', 'maksimal_pinjam', 'lama_pinjam'];
    protected $useTimestamps = false;
}