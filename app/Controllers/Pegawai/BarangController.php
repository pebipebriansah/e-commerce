<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\SupplierModel;

class BarangController extends BaseController
{
    public function index()
    {
        $barangModel = new BarangModel();
        $data = [
            'title' => 'Data Produk',
            'barang' => $barangModel->join('kategori', 'kategori.id_kategori = produk.id_kategori')->findAll(),
        ];
        return view('pages/pegawai/barang', $data);
    }
    public function create(){
        $barangModel = new BarangModel();
        $kategoriModel = new KategoriModel();
        $lastID = $barangModel->getLastID();
        if($lastID == null){
            $incrementId = 1;
        }else{
            $sliceId = substr($lastID, 3);
            $incrementId = $sliceId + 1;
        }
        $data = [
            'title' => 'Tambah Barang',
            'kategori' => $kategoriModel->findAll(),
            'id_barang' => 'BR-' . sprintf('%03s', $incrementId),
        ];
        return view('pages/pegawai/barang-create', $data);
    }
    public function save() {
        $barangModel = new BarangModel();
    
        // Mendapatkan file yang diupload
        $photo = $this->request->getFile('photo');
        
        // Inisialisasi data
        $data = [
            'id_produk' => $this->request->getPost('id_produk'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga' => $this->request->getPost('harga'),
            'keterangan' => $this->request->getPost('keterangan'),
            'jumlah' => $this->request->getPost('jumlah'),
            'photo' => null,
        ];
        
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            // Membuat folder tujuan jika belum ada
            $photoFolder = FCPATH . 'uploads/photos/';
            if (!is_dir($photoFolder)) {
                mkdir($photoFolder, 0777, true);
            }
            
            // Membuat nama file unik
            $newName = $photo->getRandomName();
            
            // Memindahkan file ke folder tujuan
            if ($photo->move($photoFolder, $newName)) {
                // Menyimpan nama file yang diupload ke dalam database
                $data['photo'] = $newName;
            } else {
                // Logging error jika gagal memindahkan file
                log_message('error', 'File could not be moved to ' . $photoFolder);
            }
        } else {
            // Logging error jika file tidak valid atau sudah dipindahkan
            log_message('error', 'File is not valid or has already been moved');
        }
    
        // Menyimpan data ke database
        $barangModel->insert($data);
        session()->setFlashdata('success', 'Data berhasil ditambahkan');
        return redirect()->to('pegawai/barang');
    }
    
    public function delete($id){
        $barangModel = new BarangModel();
        $barangModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('pegawai/barang');
    }
    public function edit($id){
        $barangModel = new BarangModel();
        $kategoriModel = new KategoriModel();
        $data = [
            'title' => 'Edit Produk',
            'barang' => $barangModel->join('kategori','kategori.id_kategori = produk.id_kategori')->find($id),
            'kategori' => $kategoriModel->findAll(),
        ];
        return view('pages/pegawai/barang-edit', $data);
    }
    public function update($id) {
        $barangModel = new BarangModel();
    
        // Mendapatkan data produk saat ini
        $existingData = $barangModel->find($id);
    
        // Mendapatkan file yang diupload
        $photo = $this->request->getFile('photo');
    
        // Inisialisasi data yang akan diupdate
        $data = [
            'id_kategori' => $this->request->getPost('id_kategori'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga' => $this->request->getPost('harga'),
            'keterangan' => $this->request->getPost('keterangan'),
            'jumlah' => $this->request->getPost('jumlah'),
        ];
    
        // Jika ada file gambar baru yang diupload
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            // Membuat folder tujuan jika belum ada
            $photoFolder = FCPATH . 'uploads/photos/';
            if (!is_dir($photoFolder)) {
                mkdir($photoFolder, 0777, true);
            }
    
            // Membuat nama file unik
            $newName = $photo->getRandomName();
    
            // Memindahkan file ke folder tujuan
            if ($photo->move($photoFolder, $newName)) {
                // Hapus file lama jika ada
                if (!empty($existingData['photo']) && file_exists($photoFolder . $existingData['photo'])) {
                    unlink($photoFolder . $existingData['photo']);
                }
                // Menyimpan nama file yang diupload ke dalam database
                $data['photo'] = $newName;
            } else {
                // Logging error jika gagal memindahkan file
                log_message('error', 'File could not be moved to ' . $photoFolder);
            }
        } else {
            // Jika tidak ada file baru, gunakan nama file lama jika ada
            $data['photo'] = $existingData['photo'];
        }
    
        // Menyimpan data ke database
        $barangModel->update($id, $data);
        session()->setFlashdata('success', 'Data berhasil diubah');
        return redirect()->to('pegawai/barang');
    }
    
}