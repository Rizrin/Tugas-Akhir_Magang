<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SBUSeeder extends Seeder
{
    public function run()
    {
        $usulanData = [
            [
                'nomor_usulan' => 'SBU-2024-001',
                'nama_kegiatan' => 'Pengadaan Laptop Kerja High-End',
                'total_anggaran' => 245000000,
                'nama_lengkap_pengusul' => 'Budi Santoso',
                'nip' => '198506122010121003',
                'jabatan' => 'Kepala Bagian Infrastruktur IT',
                'unit_kerja' => 'Fakultas Teknik',
                'fakultas' => 'Universitas Gadjah Mada',
                'email' => 'budi.setiawan@mail.ugm.ac.id',
                'whatsapp' => '081234567890',
                'tahun_anggaran' => 2024,
                'status' => 'Disetujui',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nomor_usulan' => 'SBU-2024-002',
                'nama_kegiatan' => 'Renovasi Laboratorium Kimia Dasar',
                'total_anggaran' => 1200000000,
                'nama_lengkap_pengusul' => 'Siti Aminah',
                'nip' => '198205152008122001',
                'jabatan' => 'Dosen',
                'unit_kerja' => 'Fakultas MIPA',
                'fakultas' => 'Universitas Gadjah Mada',
                'email' => 'siti@mail.ugm.ac.id',
                'whatsapp' => '081234567891',
                'tahun_anggaran' => 2024,
                'status' => 'Menunggu Review',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nomor_usulan' => 'SBU-2024-003',
                'nama_kegiatan' => 'Langganan Jurnal Internasional 2024',
                'total_anggaran' => 850000000,
                'nama_lengkap_pengusul' => 'Andi Wijaya',
                'nip' => '197901012005011002',
                'jabatan' => 'Kepala Perpustakaan',
                'unit_kerja' => 'Perpustakaan Pusat',
                'fakultas' => 'Universitas Gadjah Mada',
                'email' => 'andi@mail.ugm.ac.id',
                'whatsapp' => '081234567892',
                'tahun_anggaran' => 2024,
                'status' => 'Draft',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nomor_usulan' => 'SBU-2024-004',
                'nama_kegiatan' => 'Maintenance AC Gedung Rektorat',
                'total_anggaran' => 45000000,
                'nama_lengkap_pengusul' => 'Dewi Lestari',
                'nip' => '198807102015042001',
                'jabatan' => 'Staf Umum',
                'unit_kerja' => 'Biro Umum',
                'fakultas' => 'Universitas Gadjah Mada',
                'email' => 'dewi@mail.ugm.ac.id',
                'whatsapp' => '081234567893',
                'tahun_anggaran' => 2024,
                'status' => 'Ditolak',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $this->db->table('usulan')->insertBatch($usulanData);

        $aktivitasData = [
            [
                'usulan_id' => 1,
                'judul' => 'Mengubah status SBU-2024-001',
                'deskripsi' => 'Draft -> Menunggu Review',
                'oleh' => 'Budi Santoso',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'usulan_id' => null,
                'judul' => 'Update Standar Harga 2024 KEMARIN',
                'deskripsi' => 'Penyesuaian Inflasi 3.2%',
                'oleh' => 'Admin Sistem',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
            ]
        ];

        $this->db->table('aktivitas')->insertBatch($aktivitasData);
    }
}
