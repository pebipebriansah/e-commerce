<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pesanan';
    protected $primaryKey       = 'id_pesanan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = true;

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

    public function getLastID(){
        $builder = $this->db->table('pesanan');
        $builder->select('id_pesanan');
        $builder->orderBy('id_pesanan', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            return $row->id_pesanan;
        } else{
            return null;
        }
        }
    public function getAll(){
        $builder = $this->db->table('pesanan');
        $builder->select('*');
        $builder->join('customer', 'pesanan.id_customer = customer.id_customer');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function konfirmasiId($id){
        $builder = $this->db->table('pesanan');
        $builder->set('status','Belum Bayar');
        $builder->where('id_pesanan', $id);
        $builder->update();
    }
    public function getTotalById($id){
        $builder = $this->db->table('pesanan');
        $builder->select('total');
        $builder->where('id_pesanan', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }
    public function updateTotal($id, $totalBaru){
        $builder = $this->db->table('pesanan');
        $builder->set('total', $totalBaru);
        $builder->where('id_pesanan', $id);
        $builder->update();
    }
    public function getDataByIdCustomer($id_customer){
        $builder = $this->db->table('pesanan');
        $builder->where('id_customer', $id_customer);
        $query = $builder->get();
        return $query->getRowArray();
    }
}
