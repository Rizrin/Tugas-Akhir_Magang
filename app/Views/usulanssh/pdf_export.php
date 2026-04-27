<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Export PDF - Riwayat Pengajuan SSH</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .text-right {
            text-align: right !important;
        }
        .text-center {
            text-align: center !important;
        }
    </style>
</head>
<body>

    <h2>Laporan Riwayat Pengajuan SSH</h2>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Usulan</th>
                <th>Kelompok Kode Barang/Jasa</th>
                <th>Tahun</th>
                <th>Tanggal Submit</th>
                <th>Pengusul</th>
                <th class="text-right">Total Anggaran</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($riwayat)): ?>
            <tr>
                <td colspan="8" class="text-center">Belum ada riwayat pengajuan SSH.</td>
            </tr>
            <?php else: ?>
            <?php $no = 1; foreach ($riwayat as $r): ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= esc($r['nomor_usulan']) ?></td>
                <td><?= esc($r['kelompok_kode']) ?></td>
                <td><?= esc($r['tahun_anggaran']) ?></td>
                <td><?= date('d M Y', strtotime($r['created_at'])) ?></td>
                <td><?= esc($r['nama_lengkap_pengusul']) ?></td>
                <td class="text-right">Rp <?= number_format($r['total_anggaran'], 0, ',', '.') ?></td>
                <td class="text-center"><?= esc($r['status']) ?></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
