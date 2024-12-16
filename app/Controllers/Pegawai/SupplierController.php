<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\SupplierModel;

class SupplierController extends BaseController
{
    public function index()
    {
        $supplierModel = new SupplierModel();
        $suppliers= $supplierModel->findAll();
        $data = [
            'title' => 'Supplier',
            'suppliers' => $suppliers
        ];
        
        return view('pages/pegawai/supplier', $data);
    }
    public function create()
    {
        $supplierModel = new SupplierModel();
        $supplier = $supplierModel->getLastID();
        if ($supplier == null) {
            $incrementIdSupplier = 1;
        } else {
            $sliceIdSupplier = substr($supplier, 3);
            $incrementIdSupplier = $sliceIdSupplier + 1;
        }
        $data = [
            'title' => 'Tambah Data Supplier',
            'id_supplier' => 'SUP' . sprintf('%04s', $incrementIdSupplier),
        ];
        return view('pages/pegawai/supplier-create', $data);
    }

    public function edit($id)
    {
        $supplierModel = new SupplierModel();
        $supplier = $supplierModel->find($id);
        $data = [
            'title' => 'Edit Data Supplier',
            'supplier' => $supplier
        ];
        return view('pages/pegawai/supplier-edit', $data);
    }

    public function save() 
    {
        $supplierModel = new SupplierModel();

        $id_supplier = $this->request->getPost('id_supplier');
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $password = $this->request->getVar('password');
        $alamat = $this->request->getPost('alamat');
        $no_hp = $this->request->getPost('no_hp');

        $data = [
            'id_supplier' => $id_supplier,
            'nama' => $nama,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'alamat' => $alamat,
            'no_hp' => $no_hp
        ];

        $supplierModel->insert($data);
        session()->setFlashdata('success', 'Data berhasil ditambahkan');
        return redirect()->to(base_url('pegawai/supplier'));
    }
    public function delete($id)
    {
        $supplierModel = new SupplierModel();
        $supplierModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to(base_url('pegawai/supplier'));
    }

      public function update($id)
    {
        $id_supplier = $this->request->getVar('id_supplier');
        $nama = $this->request->getVar('nama');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $alamat = $this->request->getVar('alamat');
        $no_hp = $this->request->getVar('no_hp');

        $supplier = new SupplierModel();
        $data = [
            'id_supplier' => $id_supplier,
            'nama' => $nama,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'alamat' => $alamat,
            'no_hp' => $no_hp
        ];
        if ($data){
            $supplier->update($id, $data);
            session()->setFlashdata('success', 'Data berhasil diubah');
            return redirect()->to(base_url('pegawai/supplier'));
        } else {
            session()->setFlashdata('error', 'Data gagal diubah');
            return redirect()->to(base_url('pegawai/supplier/edit/'.$id));
        }
    }
}