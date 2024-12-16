<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\PesananModel;
use App\Models\DetailPesananModel;
use App\Models\CartModel;

class ShopController extends BaseController
{
    public function index()
    {
        $barangModel = new BarangModel();
       
        $data = [
            'title' => 'Shop',
            'produk' => $barangModel->findAll(),
        ];
        return view('pages/customer/shop', $data);
    }
    public function detail($id_produk){
        $modelBarang = new BarangModel();
        $data = [
            'produk' => $modelBarang->getDataBarangById($id_produk),
        ];
        return view('pages/customer/shop', $data);
    }
    public function pesan($id_produk)
{
    $modelBarang = new BarangModel();
    $pesananModel = new PesananModel();
    $detailPesananModel = new DetailPesananModel();

    // Ambil informasi produk berdasarkan $id_produk
    $barang = $modelBarang->find($id_produk);

    // Cek ID pesanan terakhir
    $lastID = $pesananModel->getLastID();
    if ($lastID == null) {
        $incrementId = 1;
    } else {
        $sliceId = (int) substr($lastID, 4); // Mengambil angka setelah PSN-
        $incrementId = $sliceId + 1;
    }

    // Format ID pesanan
    $id_pesanan = 'PSN-' . sprintf('%03d', $incrementId); // Format 3 digit dengan leading zero

    // Data untuk tabel pesanan
    $dataPesanan = [
        'id_pesanan' => $id_pesanan,
        'id_customer' => session()->get('id_customer'),
        'total' => $barang['harga'], // Harga produk sebagai total
        'tanggal' => date('Y-m-d'),
        'status' => 'Menunggu Konfirmasi',
    ];

    // Simpan data pesanan ke dalam tabel pesanan
    $pesananModel->insert($dataPesanan);

    $lastIDDetail = $detailPesananModel->getLastID();
    if ($lastIDDetail == null) {
        $incrementId = 1;
    } else {
        $sliceId = (int) substr($lastIDDetail, 4); // Mengambil angka setelah PSN-
        $incrementId = $sliceId + 1;
    }
    $id_detail_pesanan = 'DPSN-' . sprintf('%03d', $incrementId); // Format 3 digit dengan leading zero

    // Data untuk tabel detail pesanan
    $dataDetailPesanan = [
        'id_detail_pesanan' => $id_detail_pesanan,
        'id_pesanan' => $id_pesanan,
        'id_produk' => $barang['id_produk'],
        'harga' => $barang['harga'],
    ];

    // Simpan data detail pesanan ke dalam tabel detail pesanan
    $detailPesananModel->insert($dataDetailPesanan);

    // Set flashdata untuk memberikan pesan sukses kepada pengguna
    session()->setFlashdata('success', 'Pesanan Berhasil Ditambahkan');

    // Redirect ke halaman order atau halaman lain yang sesuai
    return redirect()->to(base_url('customer/order'));
}

public function checkout()
{
    $cartModel = new CartModel();
    $pesananModel = new PesananModel();
    $detailPesananModel = new DetailPesananModel();
    $session = session();

    // Get cart items for the logged-in customer
    $id_customer = $session->get('id_customer');
    $cartItems = $cartModel
        ->select('chart.*, produk.nama_produk, produk.harga')
        ->join('produk', 'produk.id_produk = chart.id_produk')
        ->where('chart.id_customer', $id_customer)
        ->findAll();

    if (empty($cartItems)) {
        $session->setFlashdata('error', 'Keranjang belanja kosong.');
        return redirect()->to(base_url('customer/cart'));
    }

    // Calculate total price
    $total = array_sum(array_column($cartItems, 'harga'));

    $lastID = $pesananModel->getLastID();
    if ($lastID == null) {
        $incrementId = 1;
    } else {
        $sliceId = (int) substr($lastID, 4); // Mengambil angka setelah PSN-
        $incrementId = $sliceId + 1;
    }

    // Format ID pesanan
    $id_pesanan = 'PSN-' . sprintf('%03d', $incrementId); // Format 3 digit dengan leading zero

    // Insert data into pesanan table
    $orderData = [
        'id_pesanan' => $id_pesanan,
        'id_customer' => $id_customer,
        'total' => $total,
        'tanggal' => date('Y-m-d'),
        'status' => 'Menunggu Konfirmasi'
    ];
    $pesananModel->insert($orderData);

    // Insert data into detail_pesanan table
    foreach ($cartItems as $item) {
        // Generate new detail_pesanan ID
        $lastIDDetail = $detailPesananModel->getLastID();
        if ($lastIDDetail == null) {
            $incrementId = 1;
        } else {
            $sliceId = (int) substr($lastIDDetail, 5); // Mengambil angka setelah PSN-
            $incrementId = $sliceId + 1;
        }
        $id_detail_pesanan = 'DPSN-' . sprintf('%0d', $incrementId); // Format 3 digit dengan leading zero

        $detailData = [
            'id_detail_pesanan' => $id_detail_pesanan,
            'id_pesanan' => $id_pesanan,
            'id_produk' => $item['id_produk'],
            'harga' => $item['harga']
        ];
        $detailPesananModel->insert($detailData);
    }

    // Clear the cart for the customer
    $cartModel->where('id_customer', $id_customer)->delete();

    $session->setFlashdata('success', 'Checkout berhasil. Pesanan Anda telah dibuat.');
    return redirect()->to(base_url('customer/order'));
}
}