<?php

namespace App\Controllers;

use App\Models\RakModel;

class Rak extends BaseController
{
    protected $rakModel;

    public function __construct()
    {
        $this->rakModel = new RakModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $data['rak'] = $this->rakModel
                ->like('nama_rak', $keyword)
                ->orLike('lokasi', $keyword)
                ->paginate(10);
        } else {
            $data['rak'] = $this->rakModel->paginate(10);
        }

        $data['pager'] = $this->rakModel->pager;
        $data['keyword'] = $keyword;

        return view('rak/index', $data);
    }

    public function create()
    {
        return view('rak/create');
    }

    public function store()
    {
        $this->rakModel->save([
            'nama_rak' => $this->request->getPost('nama_rak'),
            'lokasi'   => $this->request->getPost('lokasi'),
        ]);

        return redirect()->to('/rak');
    }

    public function edit($id)
    {
        $data['rak'] = $this->rakModel->find($id);
        return view('rak/edit', $data);
    }

    public function update($id)
    {
        $this->rakModel->update($id, [
            'nama_rak' => $this->request->getPost('nama_rak'),
            'lokasi'   => $this->request->getPost('lokasi'),
        ]);

        return redirect()->to('/rak');
    }

    public function delete($id)
    {
        $this->rakModel->delete($id);
        return redirect()->to('/rak');
    }

    public function print()
    {
        $data['rak'] = $this->rakModel->findAll();
        return view('rak/print', $data);
    }

    public function detail($id)
    {
        $data['rak'] = $this->rakModel->find($id);
        if ($data['rak']) {
            $bukuModel = new \App\Models\BukuModel();
            $data['buku'] = $bukuModel->getByRak($id);
        }
        return view('rak/detail', $data);
    }
}