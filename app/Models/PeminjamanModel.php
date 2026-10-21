<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';
    protected $allowedFields = ['id_anggota', 'id_petugas', 'id_buku', 'tanggal_pinjam', 'tanggal_kembali', 'status'];

    /**
     * Mengubah nilai id_buku (JSON array, array, atau id tunggal) menjadi array id buku.
     */
    public function getBukuIds($value): array
    {
        if (is_array($value)) {
            $ids = $value;
        } elseif ($value === null || $value === '') {
            $ids = [];
        } else {
            $decoded = json_decode((string) $value, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $ids = $decoded;
            } elseif (json_last_error() === JSON_ERROR_NONE && is_numeric($decoded)) {
                $ids = [$decoded];
            } else {
                $ids = explode(',', (string) $value);
            }
        }

        $ids = array_filter(array_map('intval', $ids), static fn ($id) => $id > 0);

        return array_values(array_unique($ids));
    }

    /**
     * Mengubah array id buku menjadi JSON array untuk disimpan di kolom id_buku.
     */
    public function setBukuIds(array $ids): string
    {
        $ids = array_map('intval', $ids);
        $ids = array_filter($ids, static fn ($id) => $id > 0);

        return json_encode(array_values(array_unique($ids)));
    }

    /**
     * Melengkapi baris peminjaman dengan daftar buku yang dipinjam.
     */
    public function attachBuku(array $rows): array
    {
        if (empty($rows)) {
            return $rows;
        }

        $semuaId = [];
        foreach ($rows as $row) {
            $semuaId = array_merge($semuaId, $this->getBukuIds($row['id_buku'] ?? null));
        }
        $semuaId = array_values(array_unique($semuaId));

        $bukuMap = [];
        if (!empty($semuaId)) {
            $bukuModel = new BukuModel();
            foreach ($bukuModel->whereIn('id_buku', $semuaId)->findAll() as $buku) {
                $bukuMap[(int) $buku['id_buku']] = $buku;
            }
        }

        foreach ($rows as &$row) {
            $ids = $this->getBukuIds($row['id_buku'] ?? null);
            $daftarBuku = [];

            foreach ($ids as $id) {
                if (isset($bukuMap[$id])) {
                    $daftarBuku[] = $bukuMap[$id];
                }
            }

            $row['buku_ids'] = $ids;
            $row['buku_list'] = $daftarBuku;
            $row['judul_buku'] = !empty($daftarBuku) ? implode(', ', array_column($daftarBuku, 'judul')) : '-';

            if (empty($row['cover'])) {
                $row['cover'] = $daftarBuku[0]['cover'] ?? null;
            }
        }
        unset($row);

        return $rows;
    }

    public function getPeminjamanWithRelations($id = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('
            peminjaman.*,
            users.nama as nama_anggota,
            anggota.nis,
            petugas_user.nama as nama_petugas
        ');
        $builder->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota');
        $builder->join('users', 'users.id = anggota.user_id');
        $builder->join('petugas', 'petugas.id_petugas = peminjaman.id_petugas', 'left');
        $builder->join('users as petugas_user', 'petugas_user.id = petugas.user_id', 'left');

        if ($id) {
            $builder->where('peminjaman.id_peminjaman', $id);
            $row = $builder->get()->getRowArray();

            if (!$row) {
                return null;
            }

            return $this->attachBuku([$row])[0];
        }

        return $this->attachBuku($builder->get()->getResultArray());
    }

    public function getPeminjamanByAnggota($id_anggota)
    {
        return $this->where('id_anggota', $id_anggota)->findAll();
    }

    public function getPeminjamanByAnggotaWithRelations($id_anggota)
    {
        $builder = $this->db->table($this->table);
        $builder->select('
            peminjaman.*,
            users.nama as nama_anggota,
            anggota.nis,
            petugas_user.nama as nama_petugas
        ');
        $builder->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota');
        $builder->join('users', 'users.id = anggota.user_id');
        $builder->join('petugas', 'petugas.id_petugas = peminjaman.id_petugas', 'left');
        $builder->join('users as petugas_user', 'petugas_user.id = petugas.user_id', 'left');
        $builder->where('anggota.id_anggota', $id_anggota);
        $builder->orderBy('peminjaman.tanggal_pinjam', 'DESC');

        return $this->attachBuku($builder->get()->getResultArray());
    }

    public function getPeminjamanDipinjam()
    {
        return $this->where('status', 'dipinjam')->findAll();
    }

    public function getPendingKonfirmasi($limit = 5)
    {
        $builder = $this->db->table($this->table);
        $builder->select('
            peminjaman.*,
            users.nama as nama_anggota,
            anggota.nis
        ');
        $builder->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota');
        $builder->join('users', 'users.id = anggota.user_id');
        $builder->where('peminjaman.status', 'dimohon');
        $builder->orderBy('peminjaman.tanggal_pinjam', 'ASC');
        $builder->limit($limit);

        return $this->attachBuku($builder->get()->getResultArray());
    }

    public function getActivePeminjamanByAnggota($id_anggota, $limit = 5)
    {
        $builder = $this->db->table($this->table);
        $builder->select('peminjaman.*');
        $builder->where('peminjaman.id_anggota', $id_anggota);
        $builder->where('peminjaman.status', 'dipinjam');
        $builder->orderBy('peminjaman.tanggal_kembali', 'ASC');
        $builder->limit($limit);

        return $this->attachBuku($builder->get()->getResultArray());
    }

    public function getPeminjamanCountByAnggota($id_anggota)
    {
        return $this->where('id_anggota', $id_anggota)->countAllResults();
    }

    public function getPeminjamanDipinjamByAnggota($id_anggota)
    {
        return $this->where('id_anggota', $id_anggota)->where('status', 'dipinjam')->countAllResults();
    }

    public function getPeminjamanMenungguByAnggota($id_anggota)
    {
        return $this->where('id_anggota', $id_anggota)->where('status', 'dimohon')->countAllResults();
    }

    public function getPeminjamanDikembalikanByAnggota($id_anggota)
    {
        return $this->where('id_anggota', $id_anggota)->where('status', 'kembali')->countAllResults();
    }
}
