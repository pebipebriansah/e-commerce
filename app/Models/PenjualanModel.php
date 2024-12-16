<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'penjualan';
    protected $primaryKey       = 'id_penjualan';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
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
        $builder = $this->db->table('penjualan');
        $builder->select('id_penjualan');
        $builder->orderBy('id_penjualan', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            return $row->id_penjualan;
        } else{
            return null;
        }
        }
    public function getDataByDate($id)
    {
        $builder = $this->db->table('penjualan');
        $builder->select('penjualan.*, pesanan.*, customer.nama_customer'); // Menambahkan kolom yang diperlukan
        $builder->join('pesanan', 'pesanan.id_pesanan = penjualan.id_pesanan');
        $builder->join('customer', 'customer.id_customer = penjualan.id_customer');
        $builder->like('penjualan.tanggal', $id);
        $query = $builder->get();
        $result = $query->getResultArray();

        return $result;
    }
    public function getDataByMonth($month){
        $builder = $this->db->table('penjualan');
        $builder->select('penjualan.*, pesanan.*, customer.nama_customer'); // Menambahkan kolom yang diperlukan
        $builder->join('pesanan', 'pesanan.id_pesanan = penjualan.id_pesanan');
        $builder->join('customer', 'customer.id_customer = penjualan.id_customer');
        $builder->where('MONTH(penjualan.tanggal)', $month);
        $query = $builder->get();
        $result = $query->getResultArray();

        return $result;
    }
    public function getDataByYear($year)
    {
        $builder = $this->db->table('penjualan');
        $builder->select('penjualan.*, pesanan.*, customer.nama_customer'); // Menambahkan kolom yang diperlukan
        $builder->join('pesanan', 'pesanan.id_pesanan = penjualan.id_pesanan');
        $builder->join('customer', 'customer.id_customer = penjualan.id_customer');
        $builder->where('YEAR(penjualan.tanggal)', $year);
        $query = $builder->get();
        $result = $query->getResultArray();

        return $result;
    }

    public function getDataByLastThreeMonths()
    {
        $builder = $this->db->table('penjualan');
        $builder->select('penjualan.*, pesanan.*, customer.nama_customer'); // Menambahkan kolom yang diperlukan
        $builder->join('pesanan', 'pesanan.id_pesanan = penjualan.id_pesanan');
        $builder->join('customer', 'customer.id_customer = penjualan.id_customer');

        $currentYear = date('Y');
        $currentMonth = date('m');

        $builder->where('YEAR(penjualan.tanggal)', $currentYear);

        // Menentukan bulan awal dan akhir dari tiga bulan terakhir
        $startMonth = $currentMonth - 2;
        $endMonth = $currentMonth;

        // Mengatur filter berdasarkan rentang bulan
        if ($startMonth <= 0) {
            $startMonth = 12 + $startMonth;
            $builder->where('(MONTH(penjualan.tanggal) >= ' . $startMonth . ' OR MONTH(penjualan.tanggal) <= ' . $endMonth . ')');
        } else {
            $builder->where('MONTH(penjualan.tanggal) BETWEEN ' . $startMonth . ' AND ' . $endMonth);
        }

        $builder->orderBy('tanggal', 'ASC');

        $query = $builder->get();
        $result = $query->getResultArray();

        return $result;
    }
    public function getDataByDay($day){
        $builder = $this->db->table('penjualan');
        $builder->select('penjualan.*, pesanan.*, customer.nama_customer'); // Menambahkan kolom yang diperlukan
        $builder->join('pesanan', 'pesanan.id_pesanan = penjualan.id_pesanan');
        $builder->join('customer', 'customer.id_customer = penjualan.id_customer');
        $builder->where('DATE(penjualan.tanggal)', $day);
        $query = $builder->get();
        $result = $query->getResultArray();
    
        return $result;
    }
}
