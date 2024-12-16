<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\CustomerModel;

class ProfileController extends BaseController
{
    public function index()
    {
    $modelCustomer = new CustomerModel();
    $id_customer = session()->get('id_customer');
    $customer = $modelCustomer->getById($id_customer);

    if (!$customer) {
        return redirect()->to('/customer/not_found'); // Contoh: arahkan ke halaman not_found jika data tidak ditemukan
    }

    $data = [
        'title' => 'Profile - Supplier',
        'customer' => $customer,
    ];

    return view('pages/customer/profile', $data);
}

    public function edit(){
        $modelSupplier = new CustomerModel();
        $data = [
            'title' => 'Edit Profile - Supplier',
            'supplier' => $modelSupplier->getById(session()->get('id_supplier')),
        ];
        return view('pages/customer/edit-profile', $data);
    }
    public function update($id_supplier){
        $modelSupplier = new CustomerModel();
        $password = $this->request->getVar('password');
        $data = [
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'no_hp' => $this->request->getPost('no_hp'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];
        $modelSupplier->update($id_supplier, $data);
        session()->setFlashdata('success', 'Data berhasil diubah');
        return redirect()->to(base_url('customer/profile'));
    }
}