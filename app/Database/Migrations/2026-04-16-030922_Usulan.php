<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usulan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomor_usulan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'nama_kegiatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'total_anggaran' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0,
            ],
            'nama_lengkap_pengusul' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nip' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'jabatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'unit_kerja' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'fakultas' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'whatsapp' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'tahun_anggaran' => [
                'type'       => 'INT',
                'constraint' => 4,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Draft', 'Menunggu Review', 'Disetujui', 'Ditolak', 'Revisi'],
                'default'    => 'Draft',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('usulan');
    }

    public function down()
    {
        $this->forge->dropTable('usulan');
    }
}
