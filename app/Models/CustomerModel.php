<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'customer';
    protected $primaryKey       = 'id_customer';
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
        $builder = $this->db->table('customer');
        $builder->select('id_customer');
        $builder->orderBy('id_customer', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            return $row->id_customer;
        } else{
            return null;
        }
        }
    public function getDataCustomerById($id_customer){
        $builder = $this->db->table('customer');
        $builder->where('id_customer', $id_customer);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getById($id_customer){
        $builder = $this->db->table('customer');
        $builder->where('id_customer', $id_customer);
        $query = $builder->get();
        return $query->getRowArray();
    }
    public function getPointById($id_customer){
        $builder = $this->db->table('customer');
        $builder->select('point');
        $builder->where('id_customer', $id_customer);
        $query = $builder->get();
        return $query->getRowArray();
    }
    function getOngkirByProvinsi($provinsi) {
        switch (strtoupper($provinsi)) {
            case 'ACEH':
                return 12000;
            case 'SUMATERA UTARA':
                return 15000;
            case 'SUMATERA BARAT':
                return 13000;
            case 'RIAU':
                return 14000;
            case 'KEPULAUAN RIAU':
                return 16000;
            case 'JAMBI':
                return 17000;
            case 'SUMATERA SELATAN':
                return 18000;
            case 'BENGKULU':
                return 19000;
            case 'LAMPUNG':
                return 20000;
            case 'BANGKA BELITUNG':
                return 21000;
            case 'DKI JAKARTA':
                return 10000;
            case 'JAWA BARAT':
                return 10000;
            case 'BANTEN':
                return 11000;
            case 'JAWA TENGAH':
                return 12000;
            case 'DI YOGYAKARTA':
                return 13000;
            case 'JAWA TIMUR':
                return 14000;
            case 'BALI':
                return 15000;
            case 'NUSA TENGGARA BARAT':
                return 16000;
            case 'NUSA TENGGARA TIMUR':
                return 17000;
            case 'KALIMANTAN BARAT':
                return 18000;
            case 'KALIMANTAN TENGAH':
                return 19000;
            case 'KALIMANTAN SELATAN':
                return 20000;
            case 'KALIMANTAN TIMUR':
                return 21000;
            case 'KALIMANTAN UTARA':
                return 22000;
            case 'SULAWESI UTARA':
                return 23000;
            case 'GORONTALO':
                return 24000;
            case 'SULAWESI TENGAH':
                return 25000;
            case 'SULAWESI SELATAN':
                return 26000;
            case 'SULAWESI BARAT':
                return 27000;
            case 'SULAWESI TENGGARA':
                return 28000;
            case 'MALUKU':
                return 29000;
            case 'MALUKU UTARA':
                return 30000;
            case 'PAPUA':
                return 31000;
            case 'PAPUA BARAT':
                return 32000;
            case 'PAPUA TENGAH':
                return 33000;
            case 'PAPUA PEGUNUNGAN':
                return 34000;
            case 'PAPUA SELATAN':
                return 35000;
            default:
                return 0; // Default value if the province is not found
        }
    }
}
