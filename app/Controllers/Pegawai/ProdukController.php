<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\ProdukModel;

class ProdukController extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();
        $data = [
            'title' => 'Data Produk',
            'produk' => $produkModel->findAll(),
        ];
        return view('pages/pegawai/produk', $data);
    }
}