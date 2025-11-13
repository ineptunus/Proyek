<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InformasiMasjidModel;

class InformasiMasjidController extends BaseController
{
    protected $informasiMasjidModel;

    public function __construct()
    {
        $this->informasiMasjidModel = new InformasiMasjidModel();
        helper(['form', 'date']);
    }

    /**
     * Menampilkan halaman utama daftar informasi (READ)
     */
    public function index()
    {
        $data = [
            'title'     => 'Data Informasi Masjid',
            'informasi' => $this->informasiMasjidModel
                            ->select('informasi_masjid.*, users.nama as nama_pengurus')
                            ->join('users', 'users.id = informasi_masjid.pengurus_id')
                            ->orderBy('tanggal', 'DESC')
                            ->findAll()
        ];
        return view('informasi_masjid/index', $data);
    }

    /**
     * Menampilkan form untuk menambah informasi baru
     */
    public function new()
    {
        $data = [
            'title' => 'Tambah Informasi Baru',
        ];
        return view('informasi_masjid/create', $data);
    }

    /**
     * Menyimpan informasi baru ke database
     */
    public function create()
    {
        $rules = [
            'judul'     => 'required|min_length[5]|max_length[255]',
            'deskripsi' => 'required|min_length[10]',
            'tanggal'   => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->informasiMasjidModel->save([
            'judul'       => $this->request->getPost('judul'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'tanggal'     => $this->request->getPost('tanggal'),
            'pengurus_id' => session()->get('user_id')
        ]);

        return redirect()->to('/informasi-masjid')->with('success', 'Informasi berhasil dipublikasikan.');
    }

    /**
     * Menampilkan form untuk mengedit informasi
     */
    public function edit($id = null)
    {
        $informasi = $this->informasiMasjidModel->find($id);
        if (!$informasi) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Informasi tidak ditemukan.');
        }

        $data = [
            'title'     => 'Edit Informasi Masjid',
            'informasi' => $informasi
        ];
        return view('informasi_masjid/edit', $data);
    }

    /**
     * Memperbarui informasi di database
     */
    public function update($id = null)
    {
        $rules = [
            'judul'     => 'required|min_length[5]|max_length[255]',
            'deskripsi' => 'required|min_length[10]',
            'tanggal'   => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->informasiMasjidModel->update($id, [
            'judul'     => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tanggal'   => $this->request->getPost('tanggal')
        ]);

        return redirect()->to('/informasi-masjid')->with('success', 'Informasi berhasil diperbarui.');
    }

    /**
     * Menghapus informasi dari database
     */
    public function delete($id = null)
    {
        if (!$this->informasiMasjidModel->find($id)) {
            return redirect()->to('/informasi-masjid')->with('error', 'Informasi tidak ditemukan.');
        }

        $this->informasiMasjidModel->delete($id);
        return redirect()->to('/informasi-masjid')->with('success', 'Informasi berhasil dihapus.');
    }
}