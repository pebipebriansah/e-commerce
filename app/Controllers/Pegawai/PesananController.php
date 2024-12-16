<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\CustomerModel;
use App\Models\PesananModel;
use Dompdf\Dompdf;
use App\Models\DetailPesananModel;
class PesananController extends BaseController
{
    public function index()
    {
        $pesananModel = new PesananModel();
        $data = [
            'title' => 'Pesanan',
            'pesanan' => $pesananModel->getAll(),
        ];
        return view('pages/pegawai/pesanan', $data);
    }
    public function konfirmasi($id_pesanan)
{
    $pesananModel = new PesananModel();
    $pesanan = $pesananModel->join('customer', 'customer.id_customer = pesanan.id_customer')
                            ->where('pesanan.id_pesanan', $id_pesanan)
                            ->first();
    // Ambil total sebelumnya dari database berdasarkan id_pesanan
    $ongkir = $pesanan['ongkir'];
    $totalSebelumnya = $pesananModel->getTotalById($id_pesanan);
    $total = (float) ($totalSebelumnya['total'] ?? 0);

    // Hitung total baru dengan menambahkan ongkos kirim ke total sebelumnya
    $totalBaru = $total + $ongkir;

    // Update total pesanan ke dalam database
    $pesananModel->updateTotal($id_pesanan, $totalBaru);

    // Tandai pesanan sebagai dikonfirmasi (jika ada logika tambahan)
    $pesananModel->konfirmasiId($id_pesanan);

    // Set flashdata untuk memberikan pesan sukses kepada pengguna
    session()->setFlashdata('success', 'Pesanan Berhasil Dikonfirmasi');

    // Redirect ke halaman pesanan atau halaman lain yang sesuai
    return redirect()->to(base_url('pegawai/pesanan'));
}

public function download($id_pesanan)
{
    $db = \Config\Database::connect();
    // Query to get the data
    $builder = $db->table('pembayaran');
    $builder->select('pembayaran.*, pesanan.*, customer.nama_customer AS nama_customer, customer.tempat_tinggal AS alamat_customer') // Select columns you need
            ->join('pesanan', 'pesanan.id_pesanan = pembayaran.id_pesanan')
            ->join('customer', 'customer.id_customer = pembayaran.id_customer') // Assuming you have a 'customer' table
            ->where('pembayaran.id_pesanan', $id_pesanan);
    $query = $builder->get();
    $pembayaran = $query->getRowArray(); // Use getRowArray to get a single row

    if (!$pembayaran) {
        return redirect()->back()->with('error', 'Invoice tidak ditemukan.');
    }

    $detailPesananModel = new DetailPesananModel();
    $orderDetails = [];

    // Get details of the specific order
    $details = $detailPesananModel->select('detail_pesanan.*, produk.nama_produk, produk.harga')
                                  ->join('produk', 'produk.id_produk = detail_pesanan.id_produk')
                                  ->where('detail_pesanan.id_pesanan', $id_pesanan)
                                  ->findAll();
    $orderDetails[$id_pesanan] = $details;

    $data = [
        'title' => 'Invoice',
        'pesanan' => $pembayaran, // Use the result from the query
        'pembayaran' => $pembayaran,
        'orderDetails' => $orderDetails,
    ];

    $html = view('pages/pegawai/invoice', $data);

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $dompdf->stream('invoice_' . $id_pesanan . '.pdf', array("Attachment" => 1));
}

}
