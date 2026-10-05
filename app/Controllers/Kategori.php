<?php

namespace App\Controllers;

use App\Models\KategoriModel;

class Kategori extends BaseController
{
    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $data['kategori'] = $this->kategoriModel
                ->like('nama_kategori', $keyword)
                ->findAll();
        } else {
            $data['kategori'] = $this->kategoriModel->findAll();
        }

        return view('kategori/index', $data);
    }

    public function create()
    {
        return view('kategori/create');
    }

    public function store()
    {
        $this->kategoriModel->save([
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ]);

        return redirect()->to('/kategori');
    }

    public function edit($id)
    {
        $data['kategori'] = $this->kategoriModel->find($id);
        return view('kategori/edit', $data);
    }

    public function update($id)
    {
        $this->kategoriModel->update($id, [
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ]);

        return redirect()->to('/kategori');
    }

    public function delete($id)
    {
        $this->kategoriModel->delete($id);
        return redirect()->to('/kategori');
    }

    public function print()
    {
        $data['kategori'] = $this->kategoriModel->findAll();
        return view('kategori/print', $data);
    }

    public function detail($id)
    {
        $data['kategori'] = $this->kategoriModel->find($id);
        return view('kategori/detail', $data);
    }
}