<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';
    protected $allowedFields = ['id_anggota', 'id_petugas', 'id_buku', 'tanggal_pinjam', 'tanggal_kembali', 'status'];

    public function getPeminjamanWithRelations($id = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('
            peminjaman.*,
            users.nama as nama_anggota,
            anggota.nis,
            buku.judul as judul_buku,
            petugas_user.nama as nama_petugas
        ');
        $builder->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota');
        $builder->join('users', 'users.id = anggota.user_id');
        $builder->join('buku', 'buku.id_buku = peminjaman.id_buku');
        $builder->join('petugas', 'petugas.id_petugas = peminjaman.id_petugas', 'left');
        $builder->join('users as petugas_user', 'petugas_user.id = petugas.user_id', 'left');

        if ($id) {
            $builder->where('peminjaman.id_peminjaman', $id);
            return $builder->get()->getRowArray();
        }

        return $builder->get()->getResultArray();
    }

    public function getPeminjamanByAnggota($id_anggota)
    {
        return $this->where('id_anggota', $id_anggota)->findAll();
    }

    public function getPeminjamanDipinjam()
    {
        return $this->where('status', 'dipinjam')->findAll();
    }
}