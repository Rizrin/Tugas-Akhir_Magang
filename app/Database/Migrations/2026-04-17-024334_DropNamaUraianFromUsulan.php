<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropNamaUraianFromUsulan extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('usulan', 'nama_uraian');
    }

    public function down()
    {
        $fields = [
            'nama_uraian' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
                'after' => 'kode_rekening'
            ]
        ];
        $this->forge->addColumn('usulan', $fields);
    }
}
