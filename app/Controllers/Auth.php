<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\AnggotaModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    // Menampilkan halaman view/auth/login
    public function login()
    {
        return view('auth/login');
    }

    // Memproses data login yang diinput pada halaman login
    public function prosesLogin()
    {
        $session = session();
        $usersModel = new UsersModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $users = $usersModel->getUsersByUsername($username);

        if ($users) {
            if (password_verify($password, $users['password'])) {
                $session->set([
                    'id' => $users['id'],
                    'nama' => $users['nama'],
                    'email' => $users['email'],
                    'username' => $users['username'],
                    'role' => $users['role'],
                    'foto' => $users['foto'],
                    'logged_in' => true
                ]);

                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('salahpw', 'Password salah');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('error', 'Nama tidak ditemukan');
            return redirect()->to('/login');
        }
    }

    // Logout (keluar dari aplikasi)
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    // Menampilkan halaman registrasi
    public function register()
    {
        return view('auth/register');
    }

    // Memproses data registrasi (simpan ke users & anggota)
    public function store()
    {
        $usersModel = new UsersModel();
        $anggotaModel = new AnggotaModel();

        // Validasi
        $rules = [
            'nama' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
            'nis' => 'required|is_unique[anggota.nis]',
            'alamat' => 'required',
            'no_hp' => 'required',
            'terms' => 'required'
        ];

        $messages = [
            'email' => [
                'is_unique' => 'Email sudah terdaftar'
            ],
            'username' => [
                'is_unique' => 'Username sudah digunakan'
            ],
            'nis' => [
                'is_unique' => 'NIS sudah terdaftar'
            ],
            'password_confirm' => [
                'matches' => 'Konfirmasi password tidak cocok'
            ],
            'terms' => [
                'required' => 'Anda harus menyetujui syarat & ketentuan'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $userData = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'anggota',
            'status' => 'aktif'
        ];

        $usersModel->save($userData);
        $userId = $usersModel->getInsertID();

        $anggotaModel->save([
            'user_id' => $userId,
            'nis' => $this->request->getPost('nis'),
            'alamat' => $this->request->getPost('alamat'),
            'no_hp' => $this->request->getPost('no_hp'),
            'tanggal_daftar' => date('Y-m-d'),
        ]);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}