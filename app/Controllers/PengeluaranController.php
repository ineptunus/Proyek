<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengeluaranModel;

class PengeluaranController extends BaseController
{
    protected $pengeluaranModel;

    public function __construct()
    {
        $this->pengeluaranModel = new PengeluaranModel();
        helper(['form', 'number']);
    }

    /**
     * Menampilkan halaman utama daftar pengeluaran (READ)
     * URL: GET /pengeluaran
     */
    public function index()
    {
        $data = [
            'title' => 'Data Pengeluaran Kas',
            'pengeluaran' => $this->pengeluaranModel
                                ->select('pengeluaran.*, users.nama as nama_pengurus')
                                ->join('users', 'users.id = pengeluaran.pengurus_id')
                                ->orderBy('tanggal', 'DESC')
                                ->findAll()
        ];
        return view('pengeluaran/index', $data);
    }

    /**
     * Menampilkan form untuk menambah data pengeluaran
     * URL: GET /pengeluaran/new
     */
    public function new() // <-- NAMA DIGANTI DARI create()
    {
        $data = [
            'title' => 'Tambah Data Pengeluaran',
        ];
        return view('pengeluaran/create', $data);
    }

    /**
     * Menyimpan data pengeluaran baru ke database
     * URL: POST /pengeluaran
     */
    public function create() // <-- NAMA DIGANTI DARI store()
    {
        $rules = [
            'tanggal'   => 'required|valid_date',
            'keperluan' => 'required|min_length[3]|max_length[255]',
            'jumlah'    => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'tanggal'     => $this->request->getPost('tanggal'),
            'keperluan'   => $this->request->getPost('keperluan'),
            'jumlah'      => $this->request->getPost('jumlah'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'pengurus_id' => session()->get('user_id')
        ];

        $this->pengeluaranModel->save($data);
        return redirect()->to('/pengeluaran')->with('success', 'Data pengeluaran berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data pengeluaran
     * URL: GET /pengeluaran/{id}/edit
     */
    public function edit($id = null)
    {
        $pengeluaran = $this->pengeluaranModel->find($id);
        if (!$pengeluaran) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pengeluaran tidak ditemukan.');
        }

        $data = [
            'title'       => 'Edit Data Pengeluaran',
            'pengeluaran' => $pengeluaran
        ];
        return view('pengeluaran/edit', $data);
    }

    /**
     * Memperbarui data pengeluaran di database
     * URL: PUT/PATCH /pengeluaran/{id}
     */
    public function update($id = null)
    {
        $rules = [
            'tanggal'   => 'required|valid_date',
            'keperluan' => 'required|min_length[3]|max_length[255]',
            'jumlah'    => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'tanggal'   => $this->request->getPost('tanggal'),
            'keperluan' => $this->request->getPost('keperluan'),
            'jumlah'    => $this->request->getPost('jumlah'),
            'deskripsi' => $this->request->getPost('deskripsi')
        ];

        $this->pengeluaranModel->update($id, $data);
        return redirect()->to('/pengeluaran')->with('success', 'Data pengeluaran berhasil diperbarui.');
    }

    /**
     * Menghapus data pengeluaran
     * URL: DELETE /pengeluaran/{id}
     */
    public function delete($id = null)
    {
        $pengeluaran = $this->pengeluaranModel->find($id);
        if (!$pengeluaran) {
            return redirect()->to('/pengeluaran')->with('error', 'Data pengeluaran tidak ditemukan.');
        }

        $this->pengeluaranModel->delete($id);
        return redirect()->to('/pengeluaran')->with('success', 'Data pengeluaran berhasil dihapus.');
    }
}