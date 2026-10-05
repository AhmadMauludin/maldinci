<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\AnggotaModel;
use App\Models\PetugasModel;
use App\Models\BukuModel;
use App\Models\UsersModel;
use App\Models\PengaturanModel;

class Peminjaman extends BaseController
{
    protected $peminjaman;
    protected $anggota;
    protected $petugas;
    protected $buku;
    protected $users;
    protected $pengaturan;

    public function __construct()
    {
        $this->peminjaman = new PeminjamanModel();
        $this->anggota = new AnggotaModel();
        $this->petugas = new PetugasModel();
        $this->buku = new BukuModel();
        $this->users = new UsersModel();
        $this->pengaturan = new \App\Models\PengaturanModel();
    }

    public function index()
    {
        $session = session();
        $keyword = $this->request->getGet('keyword');
        $status = $this->request->getGet('status');

        $builder = $this->peminjaman->select('
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

        // Anggota hanya bisa melihat peminjaman miliknya sendiri
        if ($session->get('role') === 'anggota') {
            $anggotaData = $this->anggota->getByUserId($session->get('id'));
            if ($anggotaData) {
                $builder->where('peminjaman.id_anggota', $anggotaData['id_anggota']);
            }
        }

        if ($keyword) {
            $builder->groupStart()
                ->like('users.nama', $keyword)
                ->orLike('anggota.nis', $keyword)
                ->orLike('buku.judul', $keyword)
                ->groupEnd();
        }

        if ($status) {
            $builder->where('peminjaman.status', $status);
        }

        $builder->orderBy('peminjaman.tanggal_pinjam', 'DESC');
        $data['peminjaman'] = $builder->paginate(10);
        $data['pager'] = $this->peminjaman->pager;
        $data['keyword'] = $keyword;
        $data['status'] = $status;

        return view('peminjaman/index', $data);
    }

    public function create()
    {
        $session = session();
        $data['buku'] = $this->buku->where('tersedia >', 0)->findAll();
        $data['petugas'] = $this->petugas->getAllWithUser();
        $data['pengaturan'] = $this->pengaturan->first();

        if ($session->get('role') === 'anggota') {
            $anggotaData = $this->anggota->getByUserId($session->get('id'));
            if ($anggotaData) {
                $data['anggota'] = [$anggotaData];
            } else {
                return redirect()->to('/peminjaman')->with('error', 'Data anggota tidak ditemukan');
            }
        } else {
            $data['anggota'] = $this->anggota->getAllWithUser();
        }

        return view('peminjaman/create', $data);
    }

    public function store()
    {
        $session = session();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_buku'       => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali' => 'required',
        ]);

        if ($session->get('role') !== 'anggota') {
            $validation->setRules([
                'id_anggota'    => 'required',
            ]);
        }

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->with('error', implode('<br>', $validation->getErrors()))->withInput();
        }

        $buku = $this->buku->find($this->request->getPost('id_buku'));
        if (!$buku || $buku['tersedia'] <= 0) {
            return redirect()->back()->with('error', 'Buku tidak tersedia untuk dipinjam')->withInput();
        }

        $id_petugas = null;
        $status = 'dipinjam';

        if ($session->get('role') === 'petugas') {
            $petugasData = $this->petugas->getByUserId($session->get('id'));
            if ($petugasData) {
                $id_petugas = $petugasData['id_petugas'];
            }
        } elseif ($session->get('role') === 'anggota') {
            $status = 'dimohon';
        } else {
            $id_petugas = $this->request->getPost('id_petugas');
        }

        $id_anggota = $this->request->getPost('id_anggota');
        if ($session->get('role') === 'anggota') {
            $anggotaData = $this->anggota->getByUserId($session->get('id'));
            if ($anggotaData) {
                $id_anggota = $anggotaData['id_anggota'];
            }
        }

        $data = [
            'id_anggota'     => $id_anggota,
            'id_petugas'     => $id_petugas,
            'id_buku'        => $this->request->getPost('id_buku'),
            'tanggal_pinjam' => $this->request->getPost('tanggal_pinjam'),
            'tanggal_kembali' => $this->request->getPost('tanggal_kembali'),
            'status'         => $status,
        ];

        $this->peminjaman->save($data);

        // Kurangi stok hanya jika status dipinjam (bukan dimohon)
        if ($status === 'dipinjam') {
            $this->buku->update($data['id_buku'], ['tersedia' => $buku['tersedia'] - 1]);
        }

        $msg = $status === 'dimohon' ? 'Pengajuan peminjaman berhasil dikirim, menunggu konfirmasi petugas!' : 'Peminjaman berhasil ditambahkan!';
        return redirect()->to('/peminjaman')->with('success', $msg);
    }

    public function konfirmasi($id)
    {
        $session = session();

        // Hanya petugas yang bisa konfirmasi
        if ($session->get('role') !== 'petugas') {
            return redirect()->to('/peminjaman')->with('error', 'Hanya petugas yang bisa mengkonfirmasi peminjaman');
        }

        $peminjaman = $this->peminjaman->find($id);

        if (!$peminjaman) {
            return redirect()->to('/peminjaman')->with('error', 'Data tidak ditemukan');
        }

        if ($peminjaman['status'] !== 'dimohon') {
            return redirect()->to('/peminjaman')->with('error', 'Hanya peminjaman dengan status dimohon yang bisa dikonfirmasi');
        }

        $petugasData = $this->petugas->getByUserId($session->get('id'));
        if (!$petugasData) {
            return redirect()->to('/peminjaman')->with('error', 'Data petugas tidak ditemukan');
        }

        $buku = $this->buku->find($peminjaman['id_buku']);
        if (!$buku || $buku['tersedia'] <= 0) {
            return redirect()->to('/peminjaman')->with('error', 'Buku sudah tidak tersedia');
        }

        $this->peminjaman->update($id, [
            'status'     => 'dipinjam',
            'id_petugas' => $petugasData['id_petugas'],
        ]);

        $this->buku->update($peminjaman['id_buku'], ['tersedia' => $buku['tersedia'] - 1]);

        return redirect()->to('/peminjaman')->with('success', 'Peminjaman berhasil dikonfirmasi!');
    }

    public function tolak($id)
    {
        $session = session();

        if ($session->get('role') !== 'petugas') {
            return redirect()->to('/peminjaman')->with('error', 'Hanya petugas yang bisa menolak peminjaman');
        }

        $peminjaman = $this->peminjaman->find($id);

        if (!$peminjaman) {
            return redirect()->to('/peminjaman')->with('error', 'Data tidak ditemukan');
        }

        if ($peminjaman['status'] !== 'dimohon') {
            return redirect()->to('/peminjaman')->with('error', 'Hanya peminjaman dengan status dimohon yang bisa ditolak');
        }

        $this->peminjaman->update($id, ['status' => 'kembali']);

        return redirect()->to('/peminjaman')->with('success', 'Pengajuan peminjaman ditolak!');
    }

    public function edit($id)
    {
        $session = session();
        $peminjaman = $this->peminjaman->getPeminjamanWithRelations($id);

        if (!$peminjaman) {
            return redirect()->to('/peminjaman')->with('error', 'Data tidak ditemukan');
        }

        // Anggota hanya bisa edit peminjaman miliknya
        if ($session->get('role') === 'anggota') {
            $anggotaData = $this->anggota->getByUserId($session->get('id'));
            if ($anggotaData && $peminjaman['id_anggota'] != $anggotaData['id_anggota']) {
                return redirect()->to('/peminjaman')->with('error', 'Tidak diizinkan mengedit peminjaman orang lain');
            }
        }

        $data['peminjaman'] = $peminjaman;
        $data['buku'] = $this->buku->findAll();
        $data['petugas'] = $this->petugas->getAllWithUser();

        if ($session->get('role') === 'anggota') {
            $anggotaData = $this->anggota->getByUserId($session->get('id'));
            if ($anggotaData) {
                $data['anggota'] = [$anggotaData];
            }
        } else {
            $data['anggota'] = $this->anggota->getAllWithUser();
        }

        return view('peminjaman/edit', $data);
    }

    public function update($id)
    {
        $session = session();
        $peminjaman = $this->peminjaman->find($id);

        if (!$peminjaman) {
            return redirect()->to('/peminjaman')->with('error', 'Data tidak ditemukan');
        }

        // Anggota hanya bisa update peminjaman miliknya
        if ($session->get('role') === 'anggota') {
            $anggotaData = $this->anggota->getByUserId($session->get('id'));
            if ($anggotaData && $peminjaman['id_anggota'] != $anggotaData['id_anggota']) {
                return redirect()->to('/peminjaman')->with('error', 'Tidak diizinkan mengupdate peminjaman orang lain');
            }
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_buku'        => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali' => 'required',
            'status'         => 'required',
        ]);

        if ($session->get('role') !== 'anggota') {
            $validation->setRules([
                'id_anggota'     => 'required',
            ]);
        }

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->with('error', implode('<br>', $validation->getErrors()))->withInput();
        }

        $oldBukuId = $peminjaman['id_buku'];
        $newBukuId = $this->request->getPost('id_buku');

        if ($oldBukuId != $newBukuId) {
            $oldBuku = $this->buku->find($oldBukuId);
            $newBuku = $this->buku->find($newBukuId);

            if ($oldBuku) {
                $this->buku->update($oldBukuId, ['tersedia' => $oldBuku['tersedia'] + 1]);
            }
            if ($newBuku && $newBuku['tersedia'] > 0) {
                $this->buku->update($newBukuId, ['tersedia' => $newBuku['tersedia'] - 1]);
            } else {
                return redirect()->back()->with('error', 'Buku baru tidak tersedia')->withInput();
            }
        }

        $id_petugas = null;
        if ($session->get('role') === 'petugas') {
            $petugasData = $this->petugas->getByUserId($session->get('id'));
            if ($petugasData) {
                $id_petugas = $petugasData['id_petugas'];
            }
        } else {
            $id_petugas = $this->request->getPost('id_petugas');
        }

        $id_anggota = $this->request->getPost('id_anggota');
        if ($session->get('role') === 'anggota') {
            $anggotaData = $this->anggota->getByUserId($session->get('id'));
            if ($anggotaData) {
                $id_anggota = $anggotaData['id_anggota'];
            }
        }

        $data = [
            'id_anggota'      => $id_anggota,
            'id_petugas'      => $id_petugas,
            'id_buku'         => $newBukuId,
            'tanggal_pinjam'  => $this->request->getPost('tanggal_pinjam'),
            'tanggal_kembali' => $this->request->getPost('tanggal_kembali'),
            'status'          => $this->request->getPost('status'),
        ];

        $this->peminjaman->update($id, $data);

        return redirect()->to('/peminjaman')->with('success', 'Peminjaman berhasil diupdate!');
    }

    public function delete($id)
    {
        $session = session();
        $peminjaman = $this->peminjaman->find($id);

        if (!$peminjaman) {
            return redirect()->to('/peminjaman')->with('error', 'Data tidak ditemukan');
        }

        // Anggota hanya bisa hapus peminjaman miliknya (dan hanya yang status dipinjam)
        if ($session->get('role') === 'anggota') {
            $anggotaData = $this->anggota->getByUserId($session->get('id'));
            if ($anggotaData && $peminjaman['id_anggota'] != $anggotaData['id_anggota']) {
                return redirect()->to('/peminjaman')->with('error', 'Tidak diizinkan menghapus peminjaman orang lain');
            }
            if ($peminjaman['status'] !== 'dipinjam') {
                return redirect()->to('/peminjaman')->with('error', 'Anggota hanya bisa menghapus peminjaman yang statusnya dipinjam');
            }
        }

        if ($peminjaman['status'] === 'dipinjam') {
            $buku = $this->buku->find($peminjaman['id_buku']);
            if ($buku) {
                $this->buku->update($peminjaman['id_buku'], ['tersedia' => $buku['tersedia'] + 1]);
            }
        }

        $this->peminjaman->delete($id);

        return redirect()->to('/peminjaman')->with('success', 'Peminjaman berhasil dihapus!');
    }

    public function detail($id)
    {
        $session = session();
        $peminjaman = $this->peminjaman->getPeminjamanWithRelations($id);

        if (!$peminjaman) {
            return redirect()->to('/peminjaman')->with('error', 'Data tidak ditemukan');
        }

        // Anggota hanya bisa lihat detail peminjaman miliknya
        if ($session->get('role') === 'anggota') {
            $anggotaData = $this->anggota->getByUserId($session->get('id'));
            if ($anggotaData && $peminjaman['id_anggota'] != $anggotaData['id_anggota']) {
                return redirect()->to('/peminjaman')->with('error', 'Tidak diizinkan melihat detail peminjaman orang lain');
            }
        }

        return view('peminjaman/detail', ['peminjaman' => $peminjaman]);
    }

    public function kembalikan($id)
    {
        $session = session();
        $peminjaman = $this->peminjaman->find($id);

        if (!$peminjaman) {
            return redirect()->to('/peminjaman')->with('error', 'Data tidak ditemukan');
        }

        if ($peminjaman['status'] !== 'dipinjam') {
            return redirect()->to('/peminjaman')->with('error', 'Buku sudah dikembalikan');
        }

        // Hanya petugas dan admin yang bisa mengembalikan buku
        if ($session->get('role') === 'anggota') {
            return redirect()->to('/peminjaman')->with('error', 'Hanya petugas yang bisa mengembalikan buku');
        }

        $this->peminjaman->update($id, ['status' => 'kembali']);

        $buku = $this->buku->find($peminjaman['id_buku']);
        if ($buku) {
            $this->buku->update($peminjaman['id_buku'], ['tersedia' => $buku['tersedia'] + 1]);
        }

        $id_petugas = null;
        if ($session->get('role') === 'petugas') {
            $petugasData = $this->petugas->getByUserId($session->get('id'));
            if ($petugasData) {
                $id_petugas = $petugasData['id_petugas'];
            }
        }

        $pengaturan = $this->pengaturan->first();
        $denda = 0;
        if ($pengaturan && $peminjaman['tanggal_kembali'] < date('Y-m-d')) {
            $tglKembali = new \DateTime($peminjaman['tanggal_kembali']);
            $tglSekarang = new \DateTime();
            $selisih = $tglSekarang->diff($tglKembali)->days;
            $denda = $selisih * $pengaturan['denda_per_hari'];
        }

        $pengembalianModel = new \App\Models\PengembalianModel();
        $pengembalianModel->save([
            'id_peminjaman'      => $id,
            'tanggal_dikembalikan' => date('Y-m-d'),
            'denda'              => $denda,
        ]);

        if ($denda > 0) {
            $dendaModel = new \App\Models\DendaModel();
            $pengembalian = $pengembalianModel->where('id_peminjaman', $id)->first();
            $dendaModel->save([
                'id_pengembalian' => $pengembalian['id_pengembalian'],
                'jumlah_denda'    => $denda,
                'status'          => 'belum_bayar',
            ]);
        }

        return redirect()->to('/peminjaman')->with('success', 'Buku berhasil dikembalikan!' . ($denda > 0 ? " Denda: Rp " . number_format($denda, 0, ',', '.') : ''));
    }

    public function print()
    {
        $session = session();
        $keyword = $this->request->getGet('keyword');
        $status = $this->request->getGet('status');

        $builder = $this->peminjaman->db->table('peminjaman');
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

        // Anggota hanya bisa print peminjaman miliknya
        if ($session->get('role') === 'anggota') {
            $anggotaData = $this->anggota->getByUserId($session->get('id'));
            if ($anggotaData) {
                $builder->where('peminjaman.id_anggota', $anggotaData['id_anggota']);
            }
        }

        if ($keyword) {
            $builder->groupStart()
                ->like('users.nama', $keyword)
                ->orLike('anggota.nis', $keyword)
                ->orLike('buku.judul', $keyword)
                ->groupEnd();
        }

        if ($status) {
            $builder->where('peminjaman.status', $status);
        }

        $builder->orderBy('peminjaman.tanggal_pinjam', 'DESC');
        $data['peminjaman'] = $builder->findAll();
        $data['keyword'] = $keyword;
        $data['status'] = $status;
        $data['pengaturan'] = $this->pengaturan->first();

        return view('peminjaman/print', $data);
    }
}