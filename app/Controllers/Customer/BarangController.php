<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\KategoriModel;

class BarangController extends BaseController
{
    public function index()
    {
        $barang = new BarangModel();
        $data = [
            'title' => 'Barang',
            'barang' => $barang->getDataBarangBySupplier(session()->get('id_supplier')),
        ];
        return view('pages/customer/barang', $data);
    }
    public function create(){
        $barangModel = new BarangModel();
        $kategori = new KategoriModel();
        $lastID = $barangModel->getLastID();
        if($lastID == null){
            $incrementId = 1;
        }else{
            $sliceId = substr($lastID, 3);
            $incrementId = $sliceId + 1;
        }
        $data = [
            'title' => 'Tambah Barang',
            'id_barang' => 'BR-' . sprintf('%03s', $incrementId),
            'kategori' => $kategori->findAll(),
        ];
        return view('pages/customer/barang-create', $data);
    }
    public function detail(){
        $barangModel = new BarangModel();
        $id_barang = $this->request->uri->getSegment(4);
        $data = [
            'barang' => $barangModel->find($id_barang),
        ];
        return view('pages/customer/barang-detail', $data);
    }
    public function save(){
        $barangModel = new BarangModel();
        $data = [
            'id_barang' => $this->request->getPost('id_barang'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'id_supplier' => session()->get('id_supplier'),
            'stok' => $this->request->getPost('stok'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'harga' => $this->request->getPost('harga'),
        ];
        $barangModel->insert($data);
        session()->setFlashdata('success', 'Data Barang Berhasil Ditambahkan');
        return redirect()->to(base_url('customer/barang'));
    }
    public function delete($id_barang){
        $barangModel = new BarangModel();
        $barangModel->delete($id_barang);
        session()->setFlashdata('success', 'Data Barang Berhasil Dihapus');
        return redirect()->to(base_url('customer/barang'));
    }

}