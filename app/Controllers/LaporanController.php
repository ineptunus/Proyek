<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PemasukkanModel;
use App\Models\PengeluaranModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class LaporanController extends BaseController
{
    protected $pemasukkanModel;
    protected $pengeluaranModel;

    public function __construct()
    {
        $this->pemasukkanModel = new PemasukkanModel();
        $this->pengeluaranModel = new PengeluaranModel();
        helper(['form', 'number']);
    }

    /**
     * Menampilkan halaman utama Laporan Keuangan dengan filter tanggal
     */
    public function index()
    {
        // Ambil tanggal dari input GET, jika tidak ada, gunakan bulan ini
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-t');

        // Panggil method private untuk mendapatkan data
        $laporanData = $this->_getDataLaporan($startDate, $endDate);

        $data = [
            'title'       => 'Laporan Keuangan Masjid',
            'transaksi'   => $laporanData['transaksi'],
            'total_pemasukkan'  => $laporanData['total_pemasukkan'],
            'total_pengeluaran' => $laporanData['total_pengeluaran'],
            'saldo_akhir' => $laporanData['saldo_akhir'],
            'start_date'  => $startDate,
            'end_date'    => $endDate,
        ];

        return view('laporan/index', $data);
    }

    /**
     * Method untuk mencetak laporan ke PDF
     */
    public function cetak()
    {
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-t');

        $laporanData = $this->_getDataLaporan($startDate, $endDate);
        
        $data = [
            'title'       => 'Laporan Keuangan Masjid',
            'transaksi'   => $laporanData['transaksi'],
            'total_pemasukkan'  => $laporanData['total_pemasukkan'],
            'total_pengeluaran' => $laporanData['total_pengeluaran'],
            'saldo_akhir' => $laporanData['saldo_akhir'],
            'start_date'  => $startDate,
            'end_date'    => $endDate,
        ];
        
        // Load view PDF dan ubah menjadi HTML
        $html = view('laporan/pdf_template', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        // Output PDF ke browser
        $dompdf->stream("laporan-keuangan-masjid-" . date('Y-m-d') . ".pdf", ['Attachment' => 0]);
    }

    /**
     * Method private untuk mengambil dan memproses data laporan
     */
    private function _getDataLaporan($startDate, $endDate)
    {
        // 1. Ambil data pemasukkan dan pengeluaran berdasarkan rentang tanggal
        $pemasukkan = $this->pemasukkanModel->where('tanggal >=', $startDate)->where('tanggal <=', $endDate)->findAll();
        $pengeluaran = $this->pengeluaranModel->where('tanggal >=', $startDate)->where('tanggal <=', $endDate)->findAll();

        // 2. Gabungkan kedua data ke dalam satu array transaksi
        $transaksi = [];
        $total_pemasukkan = 0;
        foreach ($pemasukkan as $item) {
            $transaksi[] = [
                'tanggal'     => $item->tanggal,
                'keterangan'  => $item->sumber,
                'masuk'       => $item->jumlah,
                'keluar'      => 0
            ];
            $total_pemasukkan += $item->jumlah;
        }

        $total_pengeluaran = 0;
        foreach ($pengeluaran as $item) {
            $transaksi[] = [
                'tanggal'     => $item->tanggal,
                'keterangan'  => $item->keperluan,
                'masuk'       => 0,
                'keluar'      => $item->jumlah
            ];
            $total_pengeluaran += $item->jumlah;
        }

        // 3. Urutkan array transaksi berdasarkan tanggal
        usort($transaksi, function ($a, $b) {
            return strtotime($a['tanggal']) - strtotime($b['tanggal']);
        });

        // 4. Hitung saldo akhir
        $saldo_akhir = $total_pemasukkan - $total_pengeluaran;

        return [
            'transaksi'         => $transaksi,
            'total_pemasukkan'  => $total_pemasukkan,
            'total_pengeluaran' => $total_pengeluaran,
            'saldo_akhir'       => $saldo_akhir
        ];
    }
}