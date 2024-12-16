<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_supplier' => 'SUP0001',
                'nama' => 'Supplier 1',
                'email' => 'supplier1@gmail.com',
                'password' => password_hash('supplier1', PASSWORD_DEFAULT),
                'alamat' => 'Jl. Siliwangi No. 2 Kuningan',
                'no_hp' => '081234567890'
            ],
            [
                'id_supplier' => 'SUP0002',
                'nama' => 'Supplier 2',
                'email' => 'supplier2@gmail.com',
                'password' => password_hash('supplier2', PASSWORD_DEFAULT),
                'alamat' => 'Jl. Siliwangi No. 4 Kuningan',
                'no_hp' => '081234567890'
            ],
        ];

        $this->db->table('supplier')->insertBatch($data);
    }
}
