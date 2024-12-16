<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\PenjualanModel;
use Dompdf\Dompdf;

class LaporanTransaksiController extends BaseController
{
    public function index()
    {
        $penjulanModel = new PenjualanModel();
        $laporanTerjual = $penjulanModel->join('pesanan','pesanan.id_pesanan = penjualan.id_pesanan')->join('customer','customer.id_customer = penjualan.id_customer')->findAll();
        $data = [
            'title' => 'Laporan Transaksi',
            'laporanTerjual' => $laporanTerjual,
        ];
        return view('pages/pegawai/laporan-transaksi', $data);

    }
    public function create(){
        $tanggal = $this->request->getVar('month');
        $penjulanModel = new PenjualanModel();
        $laporanMasuk = $penjulanModel->join('pesanan','pesanan.id_pesanan = penjualan.id_pesanan')->join('customer','customer.id_customer = penjualan.id_customer')->getDataByDate($tanggal);
        $data = [
            'title' => 'Laporan Transaksi',
            'laporanTerjual' => $laporanMasuk,
        ];

        return view('layouts/print-transaksi', $data);
    }
    public function unduh()
{
    $tanggal = $this->request->getVar('month');
    $penjulanModel = new PenjualanModel();
    $laporanMasuk = $penjulanModel->join('pesanan','pesanan.id_pesanan = penjualan.id_pesanan')->join('customer','customer.id_customer = penjualan.id_customer')->getDataByDate($tanggal);
    $data = [
        'title' => 'Laporan Transaksi',
        'laporanTerjual' => $laporanMasuk,
    ];

    // Load view into a variable
    $html = view('layouts/print-transaksi', $data);

    // Instantiate Dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Generate file name
    $filename = 'laporan_transaksi_' . date('Ymd') . '.pdf';

    // Force download the PDF file
    $dompdf->stream($filename, ['Attachment' => true]);
}
}