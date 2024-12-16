<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\PembayaranModel;
use App\Models\PesananModel;
use App\Models\DetailPesananModel;
use Dompdf\Dompdf;
class PembayaranController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $id_customer = session()->get('id_customer');
        
        $builder = $db->table('pembayaran');
        $builder->select('pembayaran.*, pesanan.*') // Select columns you need
                ->join('pesanan', 'pesanan.id_pesanan = pembayaran.id_pesanan')
                ->where('pembayaran.id_customer', $id_customer);
        $query = $builder->get();
        $pembayaran = $query->getResultArray();
        
        $data = [
            'title' => 'Payment',
            'payment' => $pembayaran,
        ];
        
        return view('pages/customer/payment', $data);
    }

    public function download($id_pesanan)
{
    $db = \Config\Database::connect();
    $id_customer = session()->get('id_customer');
    
    // Query to get the data
    $builder = $db->table('pembayaran');
    $builder->select('pembayaran.*, pesanan.*, customer.nama_customer AS nama_customer, customer.tempat_tinggal AS alamat_customer') // Select columns you need
            ->join('pesanan', 'pesanan.id_pesanan = pembayaran.id_pesanan')
            ->join('customer', 'customer.id_customer = pembayaran.id_customer') // Assuming you have a 'customer' table
            ->where('pembayaran.id_pesanan', $id_pesanan)
            ->where('pembayaran.id_customer', $id_customer);
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

    $html = view('pages/customer/invoice', $data);

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $dompdf->stream('invoice_' . $id_pesanan . '.pdf', array("Attachment" => 1));
}



}