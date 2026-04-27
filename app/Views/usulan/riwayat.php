<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div style="display: flex; justify-content: space-between; align-items: flex-end;" class="page-title-box">
    <div>
        <h1 class="page-title">Riwayat Pengajuan</h1>
        <p class="page-subtitle">Kelola dan pantau seluruh status usulan SBU yang telah diajukan.</p>
    </div>
    <div style="display: flex; gap: 10px;">
        <a href="<?= base_url('usulan/exportPdf') ?>" class="btn btn-outline" style="display:flex; align-items:center; gap:5px;"><i class='bx bx-download'></i> Unduh Laporan PDF</a>
        <a href="<?= base_url('usulan/exportExcel') ?>" class="btn btn-primary" style="display:flex; align-items:center; gap:5px;"><i class='bx bx-grid-alt'></i> Ekspor Data Excel</a>
    </div>
</div>

<div class="stats-grid" style="grid-template-columns: repeat(4, 1fr); margin-bottom: 25px;">
    <div class="stat-card" style="align-items:flex-start; flex-direction:row; gap:15px; padding: 25px 20px;">
        <div style="background:var(--primary-light); color:var(--primary); padding:15px; border-radius:12px; font-size:1.5rem;"><i class='bx bx-file'></i></div>
        <div>
            <div class="title" style="margin-bottom:0">Total Pengajuan</div>
            <div class="value" style="font-size: 1.5rem;"><?= esc($summary['total']) ?></div>
        </div>
    </div>
    <div class="stat-card" style="align-items:flex-start; flex-direction:row; gap:15px; padding: 25px 20px;">
        <div style="background:#e3f8ec; color:var(--success); padding:15px; border-radius:12px; font-size:1.5rem;"><i class='bx bx-check-circle'></i></div>
        <div>
            <div class="title" style="margin-bottom:0">Disetujui</div>
            <div class="value" style="font-size: 1.5rem;"><?= esc($summary['disetujui']) ?></div>
        </div>
    </div>
    <div class="stat-card" style="align-items:flex-start; flex-direction:row; gap:15px; padding: 25px 20px;">
        <div style="background:#fdf5d3; color:var(--warning); padding:15px; border-radius:12px; font-size:1.5rem;"><i class='bx bx-time'></i></div>
        <div>
            <div class="title" style="margin-bottom:0">Dalam Proses</div>
            <div class="value" style="font-size: 1.5rem;"><?= esc($summary['proses']) ?></div>
        </div>
    </div>
    <div class="stat-card" style="align-items:flex-start; flex-direction:row; gap:15px; padding: 25px 20px;">
        <div style="background:#fde8e7; color:var(--danger); padding:15px; border-radius:12px; font-size:1.5rem;"><i class='bx bx-x-circle'></i></div>
        <div>
            <div class="title" style="margin-bottom:0">Ditolak/Revisi</div>
            <div class="value" style="font-size: 1.5rem;"><?= esc($summary['ditolak']) ?></div>
        </div>
    </div>
</div>

<div class="card">
    <form method="get" action="<?= base_url('usulan/riwayat') ?>" style="display: flex; gap: 15px; margin-bottom: 20px;">
        <div style="position: relative; flex: 1;">
            <i class='bx bx-search' style="position: absolute; left: 15px; top: 12px; color: #999;"></i>
            <input type="text" name="q" value="<?= esc($q ?? '') ?>" class="form-control" placeholder="Cari nomor usulan atau nama uraian barang/jasa..." style="padding-left: 40px; border-radius:8px;">
        </div>
        <button type="button" class="btn btn-outline" style="border-radius:8px; display:flex; align-items:center; width: 150px; justify-content:space-between"><i class='bx bx-calendar'></i> <i class='bx bx-chevron-down'></i></button>
        <button type="button" class="btn btn-outline" style="border-radius:8px; display:flex; align-items:center; width: 150px; justify-content:space-between"><i class='bx bx-filter-alt'></i> <i class='bx bx-chevron-down'></i></button>
        <button type="submit" class="btn btn-outline" style="border-radius:8px; background: #f8f9fa;">Terapkan Filter</button>
    </form>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID Usulan</th>
                    <th>Kelompok Kode Barang/Jasa</th>
                    <th>Tahun</th>
                    <th>Tanggal Submit</th>
                    <th>Pengusul</th>
                    <th style="text-align: right;">Total Anggaran</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($riwayat)): ?>
                <tr>
                    <td colspan="8" style="text-align: center; color: var(--text-muted); padding: 30px;">Belum ada riwayat pengajuan.</td>
                </tr>
                <?php else: ?>
                <?php foreach ($riwayat as $r): ?>
                <tr>
                    <td style="font-weight: 600; color: var(--primary);"><?= esc($r['nomor_usulan']) ?></td>
                    <td><?= esc($r['kelompok_kode']) ?></td>
                    <td><?= esc($r['tahun_anggaran']) ?></td>
                    <td style="color: var(--text-muted); font-size: 0.85rem"><?= date('d M Y', strtotime($r['created_at'])) ?></td>
                    <td>
                        <div style="font-weight: 500; color: #333"><?= esc($r['nama_lengkap_pengusul']) ?></div>
                        <div style="font-size: 0.7rem; color: var(--text-muted); text-transform:uppercase">UNIT KERJA A</div>
                    </td>
                    <td style="text-align: right; font-weight: 600;">Rp <?= number_format($r['total_anggaran'], 0, ',', '.') ?></td>
                    <td style="text-align: center;">
                        <?php 
                        $badgeClass = '';
                        if($r['status'] == 'Draft') $badgeClass = 'badge-draft';
                        elseif($r['status'] == 'Disetujui') $badgeClass = 'badge-disetujui';
                        elseif($r['status'] == 'Menunggu Review' || $r['status'] == 'Review Sekretariat') $badgeClass = 'badge-menunggu';
                        elseif($r['status'] == 'Ditolak') $badgeClass = 'badge-ditolak';
                        ?>
                        <span class="badge <?= $badgeClass ?>"><?= esc($r['status']) ?></span>
                    </td>
                    <td style="text-align: center; color: var(--primary); font-size: 1.2rem;">
                        <i class='bx bx-info-circle' style="cursor: pointer; margin-right: 10px;"></i>
                        <i class='bx bx-dots-vertical-rounded' style="cursor: pointer; color:var(--text-muted)"></i>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; font-size: 0.85rem; color: var(--text-muted)">
        <div>Menampilkan <strong>1- <?= count($riwayat) ?></strong> dari <strong><?= count($riwayat) ?></strong> usulan</div>
        <div style="display:flex; gap: 5px;">
            <button class="btn btn-outline" style="padding: 5px 10px; font-size: 0.8rem; border-radius:4px;" disabled><</button>
            <button class="btn btn-primary" style="padding: 5px 10px; font-size: 0.8rem; border-radius:4px;">1</button>
            <button class="btn btn-outline" style="padding: 5px 10px; font-size: 0.8rem; border-radius:4px;" disabled>></button>
        </div>
    </div>
</div>

<div class="card" style="margin-top: 25px; background: #fafafa; border: 1px dashed var(--border-color); display:flex; gap: 15px; align-items: flex-start;">
    <i class='bx bx-check-shield' style="font-size: 1.5rem; color: var(--text-muted)"></i>
    <div>
        <h4 style="font-size: 0.95rem; margin-bottom: 5px; color:#333;">Informasi Pengajuan</h4>
        <p style="font-size: 0.8rem; color: var(--text-muted); margin: 0; line-height: 1.6;">Data yang tampil adalah riwayat pengajuan Anda dalam 3 tahun anggaran terakhir. Untuk usulan yang statusnya <strong>"Ditolak"</strong>, Anda dapat melihat alasan penolakan pada menu detail dan melakukan pengajuan ulang melalui menu Input SBU Baru.</p>
    </div>
</div>

<?= $this->endSection() ?>