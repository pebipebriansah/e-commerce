<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\CustomerModel;
use App\Models\ProdukModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $modelCustomer = new CustomerModel();
        $modelProduk = new ProdukModel();
        $data = [
            'title' => 'Dashboard - Supplier',
            'produk' => $modelProduk->findAll(),
            'supplier' => $modelCustomer->getDataCustomerById(session()->get('id_supplier')),
        ];
            return view('pages/customer/dashboard', $data);
        
    }
    
}