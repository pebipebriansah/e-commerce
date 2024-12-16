<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BarangMasukTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_barang_masuk' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'id_supplier' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'id_barang' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'tanggal_masuk' => [
                'type' => 'DATE',
            ],
            'harga' => [
                'type' => 'DOUBLE',
                'constraint' => 11,
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
