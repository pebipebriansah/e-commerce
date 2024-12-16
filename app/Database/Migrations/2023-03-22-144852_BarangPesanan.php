<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BarangPesanan extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel barang_pesanan
        $this->forge->addField([
            'id_barang_pesanan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'id_supplier' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
            ],
            'nama_barang' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'tanggal_pesan' => [
                'type' => 'DATE',
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Dipesan', 'Dikirim', 'Diterima'],
                'default' => 'Dipesan',
            ],
        ]);
        $this->forge->addKey('id_barang_pesanan', true);
        $this->forge->createTable('barang_pesanan');
    }

    public function down()
    {
        $this->forge->dropTable('barang_pesanan');
    }
}
