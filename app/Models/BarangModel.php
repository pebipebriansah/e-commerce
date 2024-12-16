<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'produk';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    
    public function getDataBarangById($id_produk){
        $builder = $this->db->table('produk');
        $builder->select('*');
        $builder->join('kategori', 'produk.id_kategori = kategori.id_kategori');
        $builder->where('produk.id_produk', $id_produk);
        $query = $builder->get();
        return $query->getRowArray();
    }
    public function getDataBarangBySupplier($id_supplier){
   
        $builder = $this->db->table('barang');
        $builder->select('*');
        $builder->join('supplier', 'barang.id_supplier = supplier.id_supplier');
        $builder->join('kategori', 'barang.id_kategori = kategori.id_kategori');
        $builder->where('barang.id_supplier', $id_supplier);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getDataBarangByNama($namaBarang){
   
        $builder = $this->db->table('barang');
        $builder->select('*');
        $builder->join('supplier', 'barang.id_supplier = supplier.id_supplier');
        $builder->join('kategori', 'barang.id_kategori = kategori.id_kategori');
        $builder->where('nama_barang', $namaBarang);
        $query = $builder->get();
        return $query->getRowArray();
    }
    public function getByNama($namaBarang){
   
        $builder = $this->db->table('barang');
        $builder->select('*');
        $builder->join('supplier', 'barang.id_supplier = supplier.id_supplier');
        $builder->join('kategori', 'barang.id_kategori = kategori.id_kategori');
        $builder->where('nama_barang', $namaBarang);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getBarangById($id_barang){
        $builder = $this->db->table('barang');
        $builder->select('*, barang.harga AS hargaBarang');
        $builder->join('barang_keluar', 'barang.id_barang = barang_keluar.id_barang');
        $builder->join('supplier', 'barang.id_supplier = supplier.id_supplier');
        $builder->where('barang.id_barang', $id_barang);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getLastID(){
        $builder = $this->db->table('produk');
        $builder->select('id_produk');
        $builder->orderBy('id_produk', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            return $row->id_produk;
        } else{
            return null;
        }
        }
        public function updateStok($id,$stok){
            $builder = $this->db->table('barang');
            $builder->set('stok', $stok);
            $builder->where('id_barang', $id);
            $builder->update();
        }
        public function updateStokByNamaBarang($namaBarang, $stok) {
            $builder = $this->db->table('barang');
            $builder->set('stok', $stok);
            $builder->where('nama_barang', $namaBarang);
            $builder->update();
        }
        public function updateStokByNamaBarangIdSupplier($namaBarang, $idSupplier,$tanggal_kadaluarsa) {
            $builder = $this->db->table('barang');
            $builder->set('tanggal_kadaluarsa', $tanggal_kadaluarsa);
            $builder->where('nama_barang', $namaBarang);
            $builder->where('id_supplier', $idSupplier);
            $builder->update();
        }
        public function getStokByNamaBarang($namaBarang) {
            $builder = $this->db->table('barang');
            $builder->select('*');
            $builder->where('nama_barang', $namaBarang);
            $query = $builder->get();
            return $query->getRowArray();
        }
        public function getStokByNamaBarangAndIDSupplier($namaBarang,$id_supplier) {
            $builder = $this->db->table('barang');
            $builder->select('*');
            $builder->where('nama_barang', $namaBarang);
            $builder->where('id_supplier', $id_supplier);
            $query = $builder->get();
            return $query->getRowArray();
        }
        public function getStok($id){
            $builder = $this->db->table('barang');
            $builder->select('stok');
            $builder->where('id_barang', $id);
            $query = $builder->get();
            return $query->getResultArray();
        }
}