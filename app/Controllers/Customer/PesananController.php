<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\PesananModel;
class PesananController extends BaseController
{
    public function index()
    {
        $pesanan = new PesananModel();
        $data = [
            'title' => 'Pesanan',
            'pesanan' => $pesanan->join('customer', 'customer.id_customer = pesanan.id_customer')->findAll()
        ];
        return view('pages/customer/pesanan', $data);
    }

    public function kirim($id)
    {
        $pesanan = new PesananModel();
        $pesanan->updateStatusByIdSupplier($id);
        session()->setFlashdata('success', 'Pengiriman Berhasil ditambahkan');
        return redirect()->to('/customer/pesanan');
    }
}