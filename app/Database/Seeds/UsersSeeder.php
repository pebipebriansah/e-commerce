<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
            'nama' => 'Pimpinan',
            'email' => 'pimpinan@gmail.com',
            'password' => password_hash('pimpinan', PASSWORD_DEFAULT),
            'role' =>   '1'
            ],
            [
            'nama' => 'Pegawai',
            'email' => 'pegawai@gmail.com',
            'password' => password_hash('pegawai', PASSWORD_DEFAULT),
            'role' =>   '2'
            ],
            [
            'nama' => 'Supplier',
            'email' => 'supplier@gmail.com',
            'password' => password_hash('supplier', PASSWORD_DEFAULT),
            'role' =>   '3'
            ],

        ];

        $this->db->table('users')->insertBatch($data);
    }
}
