<?php

namespace App\Models;

use CodeIgniter\Model;

class UsulanModel extends Model
{
    protected $table            = 'usulan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nomor_usulan', 'nama_kegiatan', 'total_anggaran', 'nama_lengkap_pengusul',
        'nip', 'jabatan', 'unit_kerja', 'fakultas', 'email', 'whatsapp', 'tahun_anggaran',
        'status', 'nama_opd', 'jenis_usulan', 'kelompok_kode', 'kode_rekening',
        'spesifikasi', 'satuan', 'harga_2026', 'harga_penyedia_1', 'link_penyedia_1', 'foto_penyedia_1',
        'harga_penyedia_2', 'link_penyedia_2', 'foto_penyedia_2', 'harga_penyedia_3', 'link_penyedia_3', 'foto_penyedia_3',
        'jenis_tkdn', 'usulan_harga_2027', 'detail_uraian', 'subjek_kegiatan', 'volume_kegiatan',
        'kebutuhan_anggaran', 'ketersediaan_anggaran', 'tupoksi'
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
