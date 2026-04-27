<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsulanSsh extends Migration
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
                'default'    => '0.00',
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
            'nama_opd' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'jenis_usulan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'kelompok_kode' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'kode_rekening' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'spesifikasi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'satuan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'harga_2026' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => true,
            ],
            'harga_penyedia_1' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => true,
            ],
            'link_penyedia_1' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'foto_penyedia_1' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'harga_penyedia_2' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => true,
            ],
            'link_penyedia_2' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'foto_penyedia_2' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'harga_penyedia_3' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => true,
            ],
            'link_penyedia_3' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'foto_penyedia_3' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'jenis_tkdn' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'usulan_harga_2027' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => true,
            ],
            'detail_uraian' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'subjek_kegiatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'volume_kegiatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'kebutuhan_anggaran' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => true,
            ],
            'ketersediaan_anggaran' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => true,
            ],
            'tupoksi' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('usulan_ssh');
    }

    public function down()
    {
        $this->forge->dropTable('usulan_ssh');
    }
}
