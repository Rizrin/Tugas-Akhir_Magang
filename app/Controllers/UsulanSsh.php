<?php

namespace App\Controllers;

use App\Models\UsulanSshModel;

class UsulanSsh extends BaseController
{
    public function input()
    {
        $data = [
            'title' => 'Input SSH Baru'
        ];
        return view('usulanssh/input', $data);
    }

    public function submit()
    {
        $usulanModel = new UsulanSshModel();
        
        $data = [
            'nomor_usulan' => 'SSH-' . date('Y') . '-' . str_pad($usulanModel->countAllResults() + 1, 3, '0', STR_PAD_LEFT),
            'nama_lengkap_pengusul' => $this->request->getPost('nama_lengkap_pengusul'),
            'nip'          => $this->request->getPost('nip'),
            'jabatan'      => $this->request->getPost('jabatan'),
            'unit_kerja'   => $this->request->getPost('unit_kerja'),
            'fakultas'     => $this->request->getPost('fakultas'),
            'email'        => $this->request->getPost('email'),
            'whatsapp'     => $this->request->getPost('whatsapp'),
            'tahun_anggaran' => $this->request->getPost('tahun_anggaran'),
            'status'       => 'Review Sekretariat',
            // Step 2
            'nama_opd'      => $this->request->getPost('nama_opd'),
            'jenis_usulan'  => $this->request->getPost('jenis_usulan'),
            'kelompok_kode' => $this->request->getPost('kelompok_kode'),
            'kode_rekening' => $this->request->getPost('kode_rekening'),
            'spesifikasi'   => $this->request->getPost('spesifikasi'),
            'satuan'        => $this->request->getPost('satuan'),
            'harga_2026'    => $this->request->getPost('harga_2026'),
            // Shared mapped fields
            'nama_kegiatan'  => $this->request->getPost('kelompok_kode') ?: 'Usulan SSH',
            'total_anggaran' => $this->request->getPost('kebutuhan_anggaran') ?: 0,
            // Step 3
            'harga_penyedia_1' => $this->request->getPost('harga_penyedia_1'),
            'link_penyedia_1'  => $this->request->getPost('link_penyedia_1'),
            'harga_penyedia_2' => $this->request->getPost('harga_penyedia_2'),
            'link_penyedia_2'  => $this->request->getPost('link_penyedia_2'),
            'harga_penyedia_3' => $this->request->getPost('harga_penyedia_3'),
            'link_penyedia_3'  => $this->request->getPost('link_penyedia_3'),
            
            'jenis_tkdn'            => $this->request->getPost('jenis_tkdn'),
            'usulan_harga_2027'     => $this->request->getPost('usulan_harga_2027'),
            'detail_uraian'         => $this->request->getPost('detail_uraian'),
            'subjek_kegiatan'       => $this->request->getPost('subjek_kegiatan'),
            'volume_kegiatan'       => $this->request->getPost('volume_kegiatan'),
            'kebutuhan_anggaran'    => $this->request->getPost('kebutuhan_anggaran'),
            'ketersediaan_anggaran' => $this->request->getPost('ketersediaan_anggaran'),
            'tupoksi'               => $this->request->getPost('tupoksi'),
        ];

        // File validation rules
        $rules = [
            'foto_penyedia_1' => [
                'rules' => 'uploaded[foto_penyedia_1]|max_size[foto_penyedia_1,512]|ext_in[foto_penyedia_1,png,jpg,jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran foto penyedia 1 maksimal 512Kb',
                    'ext_in' => 'Format foto penyedia 1 harus PNG atau JPG'
                ]
            ],
            'foto_penyedia_2' => [
                'rules' => 'uploaded[foto_penyedia_2]|max_size[foto_penyedia_2,512]|ext_in[foto_penyedia_2,png,jpg,jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran foto penyedia 2 maksimal 512Kb',
                    'ext_in' => 'Format foto penyedia 2 harus PNG atau JPG'
                ]
            ],
            'foto_penyedia_3' => [
                'rules' => 'uploaded[foto_penyedia_3]|max_size[foto_penyedia_3,512]|ext_in[foto_penyedia_3,png,jpg,jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran foto penyedia 3 maksimal 512Kb',
                    'ext_in' => 'Format foto penyedia 3 harus PNG atau JPG'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors()['foto_penyedia_1'] ?? $this->validator->getErrors()['foto_penyedia_2'] ?? $this->validator->getErrors()['foto_penyedia_3'] ?? 'Terjadi kesalahan pada file yang diupload.');
        }

        // Handle File Uploads
        $files = ['foto_penyedia_1', 'foto_penyedia_2', 'foto_penyedia_3'];
        foreach ($files as $fc) {
            $file = $this->request->getFile($fc);
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(FCPATH . 'uploads', $newName);
                $data[$fc] = 'uploads/' . $newName;
            }
        }

        $usulanModel->insert($data);
        $insertId = $usulanModel->getInsertID();

        // Redirect to success
        return redirect()->to('/usulanssh/success/' . $insertId);
    }

    public function success($id)
    {
        $usulanModel = new UsulanSshModel();
        $usulan = $usulanModel->find($id);

        $data = [
            'title' => 'Pengajuan Berhasil',
            'usulan' => $usulan
        ];
        return view('usulanssh/success', $data);
    }

    public function draft()
    {
        $usulanModel = new UsulanSshModel();
        
        $query = $usulanModel->where('status', 'Draft')->orderBy('updated_at', 'DESC');
        $searchString = $this->request->getGet('q');
        if ($searchString) {
            $query->groupStart()
                  ->like('nomor_usulan', $searchString)
                  ->orLike('kelompok_kode', $searchString)
                  ->groupEnd();
        }
        $drafts = $query->findAll();

        $data = [
            'q' => $searchString,
            'title' => 'Manajemen Draf SSH',
            'drafts' => $drafts
        ];
        return view('usulanssh/draft', $data);
    }

    public function riwayat()
    {
        $usulanModel = new UsulanSshModel();
        
        // for summary across all history regardless of search filter
        $allHistory = $usulanModel->findAll(); 

        $query = $usulanModel->orderBy('created_at', 'DESC');
        $searchString = $this->request->getGet('q');
        if ($searchString) {
            $query->groupStart()
                  ->like('nomor_usulan', $searchString)
                  ->orLike('kelompok_kode', $searchString)
                  ->groupEnd();
        }
        $history = $query->findAll();

        $data = [
            'q' => $searchString,
            'title' => 'Riwayat Pengajuan SSH',
            'riwayat' => $history,
            'summary' => [
                'total' => count($allHistory),
                'disetujui' => count(array_filter($allHistory, fn($i) => $i['status'] === 'Disetujui')),
                'proses' => count(array_filter($allHistory, fn($i) => in_array($i['status'], ['Menunggu Review', 'Review Sekretariat']))),
                'ditolak' => count(array_filter($allHistory, fn($i) => $i['status'] === 'Ditolak')),
            ]
        ];
        return view('usulanssh/riwayat', $data);
    }

    public function exportPdf()
    {
        $usulanModel = new UsulanSshModel();
        
        $query = $usulanModel->orderBy('created_at', 'DESC');
        $searchString = $this->request->getGet('q');
        if ($searchString) {
            $query->groupStart()
                  ->like('nomor_usulan', $searchString)
                  ->orLike('kelompok_kode', $searchString)
                  ->groupEnd();
        }
        $history = $query->findAll();

        $data = [
            'riwayat' => $history,
        ];

        $html = view('usulanssh/pdf_export', $data);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        
        $dompdf->stream("Riwayat_Pengajuan_SSH.pdf", ["Attachment" => true]);
        exit;
    }

    public function exportExcel()
    {
        $usulanModel = new UsulanSshModel();
        
        $query = $usulanModel->orderBy('created_at', 'DESC');
        $searchString = $this->request->getGet('q');
        if ($searchString) {
            $query->groupStart()
                  ->like('nomor_usulan', $searchString)
                  ->orLike('kelompok_kode', $searchString)
                  ->groupEnd();
        }
        $history = $query->findAll();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Riwayat Pengajuan SSH');

        // Set Headers
        $headers = ['ID Usulan', 'Kelompok Kode Barang/Jasa', 'Tahun', 'Tanggal Submit', 'Pengusul', 'Total Anggaran', 'Status'];
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '1', $header);
            $col++;
        }

        // Set bold for headers
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);

        // Data
        $row = 2;
        foreach ($history as $h) {
            $sheet->setCellValue('A' . $row, $h['nomor_usulan']);
            $sheet->setCellValue('B' . $row, $h['kelompok_kode']);
            $sheet->setCellValue('C' . $row, $h['tahun_anggaran']);
            $sheet->setCellValue('D' . $row, date('d M Y', strtotime($h['created_at'])));
            $sheet->setCellValue('E' . $row, $h['nama_lengkap_pengusul']);
            $sheet->setCellValue('F' . $row, $h['total_anggaran']);
            $sheet->setCellValue('G' . $row, $h['status']);
            $row++;
        }
        
        // Auto width for columns
        foreach (range('A', 'G') as $colId) {
            $sheet->getColumnDimension($colId)->setAutoSize(true);
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'Riwayat_Pengajuan_SSH_' . date('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit;
    }
}
