<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLinkPenyedia3 extends Migration
{
    public function up()
    {
        $fields = [
            'link_penyedia_3' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
                'after' => 'harga_penyedia_3'
            ],
        ];
        $this->forge->addColumn('usulan', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('usulan', 'link_penyedia_3');
    }
}
