<?php

namespace App\Controllers;

use App\Models\PenerbitModel;

class Penerbit extends BaseController
{
    protected $penerbitModel;

    public function __construct()
    {
        $this->penerbitModel = new PenerbitModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $data['penerbit'] = $this->penerbitModel
                ->like('nama_penerbit', $keyword)
                ->paginate(10);
        } else {
            $data['penerbit'] = $this->penerbitModel->paginate(10);
        }

        $data['pager'] = $this->penerbitModel->pager;
        $data['keyword'] = $keyword;

        return view('penerbit/index', $data);
    }

    public function create()
    {
        return view('penerbit/create');
    }

    public function store()
    {
        $this->penerbitModel->save([
            'nama_penerbit' => $this->request->getPost('nama_penerbit'),
            'alamat' => $this->request->getPost('alamat')
        ]);

        return redirect()->to('/penerbit');
    }

    public function edit($id)
    {
        $data['penerbit'] = $this->penerbitModel->find($id);
        return view('penerbit/edit', $data);
    }

    public function update($id)
    {
        $this->penerbitModel->update($id, [
            'nama_penerbit' => $this->request->getPost('nama_penerbit'),
            'alamat' => $this->request->getPost('alamat')
        ]);

        return redirect()->to('/penerbit');
    }

    public function delete($id)
    {
        $this->penerbitModel->delete($id);
        return redirect()->to('/penerbit');
    }

    public function print()
    {
        $data['penerbit'] = $this->penerbitModel->findAll();
        return view('penerbit/print', $data);
    }

    public function detail($id)
    {
        $data['penerbit'] = $this->penerbitModel->find($id);
        if ($data['penerbit']) {
            $bukuModel = new \App\Models\BukuModel();
            $data['buku'] = $bukuModel->getByPenerbit($id);
        }
        return view('penerbit/detail', $data);
    }
}