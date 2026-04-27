<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropNamaKelompokFromUsulan extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('usulan', 'nama_kelompok');
    }

    public function down()
    {
        $fields = [
            'nama_kelompok' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
                'after' => 'kode_rekening'
            ]
        ];
        $this->forge->addColumn('usulan', $fields);
    }
}
