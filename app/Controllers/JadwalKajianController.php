<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JadwalKajianModel;

class JadwalKajianController extends BaseController
{
    protected $jadwalKajianModel;

    public function __construct()
    {
        $this->jadwalKajianModel = new JadwalKajianModel();
        helper(['form', 'date']);
    }

    /**
     * Menampilkan halaman utama daftar jadwal kajian (READ)
     */
    public function index()
    {
        $data = [
            'title' => 'Data Jadwal Kajian',
            'kajian' => $this->jadwalKajianModel
                        ->select('jadwal_kajian.*, users.nama as nama_pengurus')
                        ->join('users', 'users.id = jadwal_kajian.pengurus_id')
                        ->orderBy('tanggal_waktu', 'DESC')
                        ->findAll()
        ];
        return view('jadwal_kajian/index', $data);
    }

    /**
     * Menampilkan form untuk menambah jadwal kajian baru
     */
    public function new()
    {
        $data = [
            'title' => 'Tambah Jadwal Kajian',
        ];
        return view('jadwal_kajian/create', $data);
    }

    /**
     * Menyimpan jadwal kajian baru ke database
     */
    public function create()
    {
        $rules = [
            'tema'       => 'required|min_length[5]',
            'penceramah' => 'required|min_length[3]',
            'lokasi'     => 'required|min_length[3]',
            'tanggal_waktu' => 'required|valid_date',
            'status'     => 'required|in_list[Akan Datang,Selesai,Dibatalkan]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->jadwalKajianModel->save([
            'tema'          => $this->request->getPost('tema'),
            'penceramah'    => $this->request->getPost('penceramah'),
            'lokasi'        => $this->request->getPost('lokasi'),
            'tanggal_waktu' => $this->request->getPost('tanggal_waktu'),
            'status'        => $this->request->getPost('status'),
            'pengurus_id'   => session()->get('user_id')
        ]);

        return redirect()->to('/jadwal-kajian')->with('success', 'Jadwal kajian berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit jadwal kajian
     */
    public function edit($id = null)
    {
        $kajian = $this->jadwalKajianModel->find($id);
        if (!$kajian) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Jadwal kajian tidak ditemukan.');
        }

        $data = [
            'title'  => 'Edit Jadwal Kajian',
            'kajian' => $kajian
        ];
        return view('jadwal_kajian/edit', $data);
    }

    /**
     * Memperbarui jadwal kajian di database
     */
    public function update($id = null)
    {
        $rules = [
            'tema'       => 'required|min_length[5]',
            'penceramah' => 'required|min_length[3]',
            'lokasi'     => 'required|min_length[3]',
            'tanggal_waktu' => 'required|valid_date',
            'status'     => 'required|in_list[Akan Datang,Selesai,Dibatalkan]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->jadwalKajianModel->update($id, [
            'tema'          => $this->request->getPost('tema'),
            'penceramah'    => $this->request->getPost('penceramah'),
            'lokasi'        => $this->request->getPost('lokasi'),
            'tanggal_waktu' => $this->request->getPost('tanggal_waktu'),
            'status'        => $this->request->getPost('status')
        ]);

        return redirect()->to('/jadwal-kajian')->with('success', 'Jadwal kajian berhasil diperbarui.');
    }

    /**
     * Menghapus jadwal kajian dari database
     */
    public function delete($id = null)
    {
        if (!$this->jadwalKajianModel->find($id)) {
             return redirect()->to('/jadwal-kajian')->with('error', 'Jadwal kajian tidak ditemukan.');
        }

        $this->jadwalKajianModel->delete($id);
        return redirect()->to('/jadwal-kajian')->with('success', 'Jadwal kajian berhasil dihapus.');
    }
}