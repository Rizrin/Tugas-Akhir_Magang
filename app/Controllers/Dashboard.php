<?php

namespace App\Controllers;

use App\Models\UsulanModel;
use App\Models\AktivitasModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $usulanModel = new UsulanModel();
        $aktivitasModel = new AktivitasModel();

        // Get Summary Counts
        $totalUsulan = $usulanModel->countAllResults();
        $draft = $usulanModel->where('status', 'Draft')->countAllResults();
        $menunggu = $usulanModel->where('status', 'Menunggu Review')->countAllResults();
        $disetujui = $usulanModel->where('status', 'Disetujui')->countAllResults();
        $ditolak = $usulanModel->where('status', 'Ditolak')->countAllResults();

        // Get Latest
        $query = $usulanModel->orderBy('created_at', 'DESC')->limit(5);
        $searchString = $this->request->getGet('q');
        if ($searchString) {
            $query->groupStart()
                  ->like('nomor_usulan', $searchString)
                  ->orLike('kelompok_kode', $searchString)
                  ->groupEnd();
        }
        $latestUsulan = $query->findAll();
        $latestAktivitas = $aktivitasModel->orderBy('created_at', 'DESC')->limit(5)->findAll();

        $data = [
            'q' => $searchString,
            'title' => 'Dashboard',
            'summary' => [
                'total' => $totalUsulan,
                'draft' => $draft,
                'menunggu' => $menunggu,
                'disetujui' => $disetujui,
                'ditolak' => $ditolak
            ],
            'usulanTerbaru' => $latestUsulan,
            'aktivitasTerbaru' => $latestAktivitas,
        ];

        return view('dashboard', $data);
    }
}
