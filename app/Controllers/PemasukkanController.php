<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PemasukkanModel;

class PemasukkanController extends BaseController
{
    protected $pemasukkanModel;

    public function __construct()
    {
        $this->pemasukkanModel = new PemasukkanModel();
        helper(['form', 'number']);
    }

    /**
     * Menampilkan halaman utama daftar pemasukkan (READ)
     * URL: GET /pemasukkan
     */
    public function index()
    {
        $data = [
            'title' => 'Data Pemasukkan Kas',
            'pemasukkan' => $this->pemasukkanModel
                                ->select('pemasukkan.*, users.nama as nama_pengurus')
                                ->join('users', 'users.id = pemasukkan.pengurus_id')
                                ->orderBy('tanggal', 'DESC')
                                ->findAll()
        ];
        return view('pemasukkan/index', $data);
    }

    /**
     * Menampilkan form untuk menambah data pemasukkan
     * URL: GET /pemasukkan/new
     */
    public function new() // <-- NAMA DIGANTI DARI create()
    {
        $data = [
            'title' => 'Tambah Data Pemasukkan',
        ];
        return view('pemasukkan/create', $data);
    }

    /**
     * Menyimpan data pemasukkan baru ke database
     * URL: POST /pemasukkan
     */
    public function create() // <-- NAMA DIGANTI DARI store()
    {
        $rules = [
            'tanggal' => 'required|valid_date',
            'sumber'  => 'required|min_length[3]|max_length[255]',
            'jumlah'  => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'tanggal'     => $this->request->getPost('tanggal'),
            'sumber'      => $this->request->getPost('sumber'),
            'jumlah'      => $this->request->getPost('jumlah'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'pengurus_id' => session()->get('user_id')
        ];

        $this->pemasukkanModel->save($data);
        return redirect()->to('/pemasukkan')->with('success', 'Data pemasukkan berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data pemasukkan
     * URL: GET /pemasukkan/{id}/edit
     */
    public function edit($id = null)
    {
        $pemasukkan = $this->pemasukkanModel->find($id);
        if (!$pemasukkan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pemasukkan tidak ditemukan.');
        }

        $data = [
            'title'      => 'Edit Data Pemasukkan',
            'pemasukkan' => $pemasukkan
        ];
        return view('pemasukkan/edit', $data);
    }

    /**
     * Memperbarui data pemasukkan di database
     * URL: PUT/PATCH /pemasukkan/{id}
     */
    public function update($id = null)
    {
        $rules = [
            'tanggal' => 'required|valid_date',
            'sumber'  => 'required|min_length[3]|max_length[255]',
            'jumlah'  => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'tanggal'   => $this->request->getPost('tanggal'),
            'sumber'    => $this->request->getPost('sumber'),
            'jumlah'    => $this->request->getPost('jumlah'),
            'deskripsi' => $this->request->getPost('deskripsi')
        ];

        $this->pemasukkanModel->update($id, $data);
        return redirect()->to('/pemasukkan')->with('success', 'Data pemasukkan berhasil diperbarui.');
    }

    /**
     * Menghapus data pemasukkan
     * URL: DELETE /pemasukkan/{id}
     */
    public function delete($id = null)
    {
        $pemasukkan = $this->pemasukkanModel->find($id);
        if (!$pemasukkan) {
            return redirect()->to('/pemasukkan')->with('error', 'Data pemasukkan tidak ditemukan.');
        }
        
        $this->pemasukkanModel->delete($id);
        return redirect()->to('/pemasukkan')->with('success', 'Data pemasukkan berhasil dihapus.');
    }
}