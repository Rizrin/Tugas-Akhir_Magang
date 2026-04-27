<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<style>
    .success-container { max-width: 900px; margin: 0 auto; text-align: center; padding-top: 20px; }
    .success-icon { font-size: 5rem; color: var(--success); margin-bottom: 20px; display: inline-flex; align-items: center; justify-content: center; width: 100px; height: 100px; background: #e3f8ec; border-radius: 50%; }
    h2 { font-size: 2rem; color: #333; margin-bottom: 10px; }
    p.subtitle { color: var(--text-muted); margin-bottom: 40px; font-size: 1rem; max-width: 600px; margin-left: auto; margin-right: auto; }

    .details-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; text-align: left; }
    
    .card-detail { background: white; padding: 30px; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); margin-bottom: 20px; }
    .detail-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 1px solid var(--border-color); padding-bottom: 15px; }
    
    .detail-row { display: flex; justify-content: space-between; margin-bottom: 15px; }
    .detail-label { color: var(--text-muted); font-size: 0.9rem; }
    .detail-value { font-weight: 600; color: #333; font-size: 0.95rem; }

    .action-buttons { display: flex; gap: 15px; margin-top: 30px; }
    .btn-submit { background: var(--primary); color: white; border-radius: 8px; padding: 10px 20px; font-weight: 500; display:flex; align-items:center; gap: 8px;}
    .btn-back { background: white; border: 1px solid var(--border-color); border-radius: 8px; padding: 10px 20px; font-weight: 500; color: #333; display:flex; align-items:center; gap: 8px; }

    .side-card { background: white; padding: 20px; border-radius: 12px; border: 1px solid var(--border-color); margin-bottom: 20px; }
    .side-card h4 { font-size: 0.9rem; color: var(--text-muted); margin-bottom: 5px; }
    .side-card .val { font-size: 1.2rem; font-weight: 600; color: #333; }
    .side-card p { font-size: 0.75rem; color: var(--text-muted); margin-top: 5px;}

    .process-timeline { border-left: 2px solid var(--border-color); margin-left: 10px; padding-left: 20px; margin-top: 15px; }
    .p-step { position: relative; margin-bottom: 15px; }
    .p-step::before { content:''; position: absolute; left: -27px; top: 3px; width: 12px; height: 12px; border-radius: 50%; background: white; border: 2px solid var(--border-color); }
    .p-step.active::before { background: var(--primary); border-color: var(--primary-light); box-shadow: 0 0 0 3px var(--primary-light); }
    .p-step.done::before { background: var(--success); border-color: white; box-shadow: 0 0 0 2px var(--success); }
    .p-title { font-weight: 600; font-size: 0.85rem; color: #333; }
    .p-desc { font-size: 0.75rem; color: var(--text-muted); }
</style>

<div class="success-container">
    <div class="success-icon">
        <i class='bx bx-check'></i>
    </div>
    <h2>Pengajuan Berhasil Dikirim!</h2>
    <p class="subtitle">Usulan SSH Anda telah berhasil didaftarkan ke dalam sistem dan akan segera diproses oleh tim validator.</p>

    <div class="details-grid">
        <div>
            <div class="card-detail">
                <div class="detail-header">
                    <h3 style="font-size: 1.1rem">Detail Konfirmasi</h3>
                    <span class="badge badge-menunggu">Menunggu Review</span>
                </div>
                
                <div style="margin-bottom: 25px;">
                    <div class="detail-label" style="margin-bottom: 5px;">Nomor Usulan Resmi</div>
                    <div class="detail-value" style="font-size: 1.3rem; color: var(--primary)"><?= esc($usulan['nomor_usulan']) ?> <i class='bx bx-search' style="color:var(--text-muted); font-size:1rem; cursor:pointer"></i></div>
                </div>

                <div class="detail-row">
                    <div class="detail-label"><i class='bx bx-calendar'></i> Tanggal Pengajuan</div>
                    <div class="detail-value"><?= date('d F Y, H:i', strtotime($usulan['created_at'])) ?> WIB</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label"><i class='bx bx-file'></i> Jenis Usulan</div>
                    <div class="detail-value">SSH Perubahan <?= esc($usulan['tahun_anggaran']) ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label"><i class='bx bx-wallet'></i> Total Anggaran</div>
                    <div class="detail-value">Rp <?= number_format($usulan['total_anggaran'], 0, ',', '.') ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label"><i class='bx bx-buildings'></i> Unit Kerja</div>
                    <div class="detail-value"><?= esc($usulan['unit_kerja']) ?></div>
                </div>

                <div class="action-buttons">
                    <a href="<?= base_url('usulanssh/input') ?>" class="btn-submit"><i class='bx bx-plus-circle'></i> Input Usulan SSH Baru</a>
                    <a href="<?= base_url('dashboard') ?>" class="btn-back"><i class='bx bx-grid-alt'></i> Kembali ke Dashboard</a>
                </div>
            </div>
        </div>

        <div>
            <div class="side-card">
                <div style="display:flex; align-items:center; gap:8px;">
                    <i class='bx bx-time-five' style="color:var(--primary); font-size:1.2rem"></i>
                    <h4 style="margin:0">Estimasi Review</h4>
                </div>
                <div class="val" style="margin-top: 10px;">3 - 5 Hari Kerja</div>
                <p>Estimasi verifikasi dokumen tahap awal oleh Sekretariat SSH.</p>
            </div>

            <div class="side-card">
                <h4 style="margin-bottom: 10px; color:#333; font-weight:600">Alur Proses</h4>
                <div class="process-timeline">
                    <div class="p-step done">
                        <div class="p-title">Berhasil Disubmit</div>
                        <div class="p-desc"><?= date('d M Y') ?></div>
                    </div>
                    <div class="p-step active">
                        <div class="p-title" style="color: var(--primary)">Review Sekretariat</div>
                        <div class="p-desc">Sedang diproses</div>
                    </div>
                    <div class="p-step">
                        <div class="p-title">Persetujuan Pimpinan</div>
                        <div class="p-desc">Menunggu antrean</div>
                    </div>
                    <div class="p-step">
                        <div class="p-title">Finalisasi SSH</div>
                        <div class="p-desc">Tahap akhir</div>
                    </div>
                </div>
            </div>

            <div class="side-card" style="background:var(--primary-light); cursor:pointer; display:flex; align-items:center; justify-content:space-between">
                <div style="display:flex; align-items:center; gap: 15px;">
                    <div style="background:white; padding:10px; border-radius:8px; display:flex;">
                        <i class='bx bxs-file-pdf' style="color:var(--primary); font-size:1.5rem"></i>
                    </div>
                    <div>
                        <div style="font-weight:600; color:var(--primary); font-size:0.8rem; text-transform:uppercase">Bukti Digital</div>
                        <div style="font-weight:700; color:#333; font-size:0.95rem">Download Bukti PDF</div>
                    </div>
                </div>
                <i class='bx bx-right-arrow-alt' style="color:var(--primary); font-size:1.5rem"></i>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
