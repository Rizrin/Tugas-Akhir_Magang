<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDetailsToUsulan extends Migration
{
    public function up()
    {
        $fields = [
            'nama_opd' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'jenis_usulan' => ['type' => 'VARCHAR', 'constraint' => '50', 'null' => true],
            'kelompok_kode' => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
            'kode_rekening' => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
            'nama_kelompok' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'nama_uraian' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'spesifikasi' => ['type' => 'TEXT', 'null' => true],
            'satuan' => ['type' => 'VARCHAR', 'constraint' => '50', 'null' => true],
            'harga_2026' => ['type' => 'DECIMAL', 'constraint' => '15,2', 'null' => true],
            'harga_penyedia_1' => ['type' => 'DECIMAL', 'constraint' => '15,2', 'null' => true],
            'link_penyedia_1' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'foto_penyedia_1' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'harga_penyedia_2' => ['type' => 'DECIMAL', 'constraint' => '15,2', 'null' => true],
            'link_penyedia_2' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'foto_penyedia_2' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'harga_penyedia_3' => ['type' => 'DECIMAL', 'constraint' => '15,2', 'null' => true],
            'foto_penyedia_3' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'jenis_tkdn' => ['type' => 'VARCHAR', 'constraint' => '50', 'null' => true],
            'usulan_harga_2027' => ['type' => 'DECIMAL', 'constraint' => '15,2', 'null' => true],
            'detail_uraian' => ['type' => 'TEXT', 'null' => true],
            'subjek_kegiatan' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'volume_kegiatan' => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
            'kebutuhan_anggaran' => ['type' => 'DECIMAL', 'constraint' => '15,2', 'null' => true],
            'ketersediaan_anggaran' => ['type' => 'DECIMAL', 'constraint' => '15,2', 'null' => true],
            'tupoksi' => ['type' => 'VARCHAR', 'constraint' => '50', 'null' => true],
        ];
        $this->forge->addColumn('usulan', $fields);
    }

    public function down()
    {
        $fields = [
            'nama_opd', 'jenis_usulan', 'kelompok_kode', 'kode_rekening', 'nama_kelompok',
            'nama_uraian', 'spesifikasi', 'satuan', 'harga_2026', 'harga_penyedia_1',
            'link_penyedia_1', 'foto_penyedia_1', 'harga_penyedia_2', 'link_penyedia_2',
            'foto_penyedia_2', 'harga_penyedia_3', 'foto_penyedia_3', 'jenis_tkdn',
            'usulan_harga_2027', 'detail_uraian', 'subjek_kegiatan', 'volume_kegiatan',
            'kebutuhan_anggaran', 'ketersediaan_anggaran', 'tupoksi'
        ];
        $this->forge->dropColumn('usulan', $fields);
    }
}
