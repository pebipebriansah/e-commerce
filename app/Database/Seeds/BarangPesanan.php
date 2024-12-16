<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BarangPesanan extends Seeder
{
    public function run()
    {
        $data = [
            [

                'id_barang_pesanan' => 'PES0001',
                'id_supplier' => 'SUP0001',
                'nama_barang' => 'Bolt 100 Kg',
                'tanggal_pesan' => '2023-03-22',
                'jumlah' => '2',
                'status' => 'Dipesan',
            ],
            [
                    
                    'id_barang_pesanan' => 'PES0002',
                    'id_supplier' => 'SUP0002',
                    'nama_barang' => 'Bolt 50 Kg',
                    'tanggal_pesan' => '2023-03-22',
                    'jumlah' => '3',
                    'status' => 'Dipesan',
            ]

        ];
        $this->db->table('barang_pesanan')->insertBatch($data);
    }
}
