<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PemasukkanModel; // Tambahkan ini
use App\Models\PengeluaranModel; // Tambahkan ini

class DashboardController extends BaseController
{
    public function __construct()
    {
        $this->pemasukkanModel = new PemasukkanModel();
        $this->pengeluaranModel = new PengeluaranModel();
    }

    public function index()
    {
        // Hitung total pemasukan
        $totalPemasukkan = $this->pemasukkanModel->selectSum('jumlah')->first()->jumlah ?? 0;

        // Hitung total pengeluaran
        $totalPengeluaran = $this->pengeluaranModel->selectSum('jumlah')->first()->jumlah ?? 0;
        
        // Hitung total kas
        $totalKas = $totalPemasukkan - $totalPengeluaran;

        $data = [
            'nama_user'        => session()->get('nama'),
            'total_kas'        => $totalKas,
            'total_pemasukkan'  => $totalPemasukkan,
            'total_pengeluaran' => $totalPengeluaran,
        ];
        
        // Tampilkan view dashboard dengan data yang sudah dihitung
        return view('dashboard/index', $data);
    }
}