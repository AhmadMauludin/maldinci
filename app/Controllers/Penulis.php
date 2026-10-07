<?php

namespace App\Controllers;

use App\Models\PenulisModel;

class Penulis extends BaseController
{
    protected $penulisModel;

    public function __construct()
    {
        $this->penulisModel = new PenulisModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $data['penulis'] = $this->penulisModel
                ->like('nama_penulis', $keyword)
                ->paginate(10);
        } else {
            $data['penulis'] = $this->penulisModel->paginate(10);
        }

        $data['pager'] = $this->penulisModel->pager;
        $data['keyword'] = $keyword;

        return view('penulis/index', $data);
    }

    public function create()
    {
        return view('penulis/create');
    }

    public function store()
    {
        $this->penulisModel->save([
            'nama_penulis' => $this->request->getPost('nama_penulis')
        ]);

        return redirect()->to('/penulis');
    }

    public function edit($id)
    {
        $data['penulis'] = $this->penulisModel->find($id);
        return view('penulis/edit', $data);
    }

    public function update($id)
    {
        $this->penulisModel->update($id, [
            'nama_penulis' => $this->request->getPost('nama_penulis')
        ]);

        return redirect()->to('/penulis');
    }

    public function delete($id)
    {
        $this->penulisModel->delete($id);
        return redirect()->to('/penulis');
    }

    public function print()
    {
        $data['penulis'] = $this->penulisModel->findAll();
        return view('penulis/print', $data);
    }

    public function detail($id)
    {
        $data['penulis'] = $this->penulisModel->find($id);
        if ($data['penulis']) {
            $bukuModel = new \App\Models\BukuModel();
            $data['buku'] = $bukuModel->getByPenulis($id);
        }
        return view('penulis/detail', $data);
    }
}