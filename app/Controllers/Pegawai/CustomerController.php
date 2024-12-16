<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\CustomerModel;

class CustomerController extends BaseController
{
    public function index()
    {
        $customerModel = new CustomerModel();
        $customerModel->findAll();
        $data = [
            'title' => 'Customer',
            'customer' => $customerModel->findAll()
        ];
        return view('pages/pegawai/customer', $data);
    }
    public function create(){
        $customerModel = new CustomerModel();
        $lastID = $customerModel->getLastID();
        if($lastID == null){
            $incrementId = 1;
        }else{
            // Pastikan bahwa kita hanya mengambil bagian angka setelah 'CSM-'
            $sliceId = intval(substr($lastID, 4)); // Ambil bagian setelah 'CSM-'
            $incrementId = $sliceId + 1;
        }
        $data = [
            'title' => 'Tambah Customer',
            'no_customer' => 'CSM-' . sprintf('%03d', $incrementId) // Gunakan %03d untuk tiga digit angka
        ];
        return view('pages/pegawai/customer-create', $data);
    }
    public function save(){
        $customerModel = new CustomerModel();
        
        $data = [
            'id_customer' => $this->request->getVar('id_customer'),
            'nama_customer' => $this->request->getVar('nama_customer'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'tempat_tinggal' => $this->request->getVar('tempat_tinggal'),
            'no_hp' => $this->request->getVar('no_hp'),
            'point' => $this->request->getVar('point'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        ];
       if ($data){
            $customerModel->insert($data);
            session()->setFlashdata('success', 'Data berhasil ditambahkan');
            return redirect()->to(base_url('pegawai/customer'));
        } else {
            session()->setFlashdata('error', 'Data gagal ditambahkan');
            return redirect()->to(base_url('pegawai/customer/create'));
        }
    }
}
