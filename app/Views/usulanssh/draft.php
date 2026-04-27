<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div style="display: flex; justify-content: space-between; align-items: flex-end;" class="page-title-box">
    <div>
        <h1 class="page-title">Manajemen Draf SSH</h1>
        <p class="page-subtitle">Kelola dan lanjutkan usulan SSH yang sedang dalam proses pengerjaan.</p>
    </div>
    <div style="display: flex; gap: 10px;">
        <button class="btn btn-outline" style="display:flex; align-items:center; gap:5px;"><i class='bx bx-download'></i> Ekspor Data</button>
        <a href="<?= base_url('usulanssh/input') ?>" class="btn btn-primary" style="display:flex; align-items:center; gap:5px;"><i class='bx bx-plus'></i> Usulan SSH Baru</a>
    </div>
</div>

<div class="card">
    <form method="get" action="<?= base_url('usulanssh/draft') ?>" style="display: flex; gap: 15px; margin-bottom: 20px;">
        <div style="position: relative; flex: 1;">
            <i class='bx bx-search' style="position: absolute; left: 15px; top: 12px; color: #999;"></i>
            <input type="text" name="q" value="<?= esc($q ?? '') ?>" class="form-control" placeholder="Cari nomor draf atau nama uraian barang/jasa..." style="padding-left: 40px; border-radius:30px;">
        </div>
        <button type="button" class="btn btn-outline" style="border-radius:30px; display:flex; align-items:center; gap:8px"><i class='bx bx-calendar'></i> Tanggal Edit <i class='bx bx-chevron-down'></i></button>
        <button type="button" class="btn btn-outline" style="border-radius:30px; display:flex; align-items:center; gap:8px"><i class='bx bx-filter-alt'></i> Status: Semua</button>
        <button type="submit" style="display:none"></button>
    </form>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 40px;"><input type="checkbox"></th>
                    <th style="cursor: pointer;">Nomor Draft <i class='bx bx-sort-down'></i></th>
                    <th>Kelompok Kode Barang/Jasa</th>
                    <th>Terakhir Diedit</th>
                    <th style="text-align: right;">Estimasi Biaya</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($drafts)): ?>
                <tr>
                    <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 30px;">Tidak ada draft usulan SSH yang ditemukan.</td>
                </tr>
                <?php else: ?>
                <?php foreach ($drafts as $d): ?>
                <tr>
                    <td><input type="checkbox"></td>
                    <td style="font-weight: 600; color: var(--primary);"><?= esc($d['nomor_usulan']) ?></td>
                    <td><?= esc($d['kelompok_kode']) ?></td>
                    <td style="color: var(--text-muted); font-size: 0.85rem"><?= date('d M Y, H:i', strtotime($d['updated_at'])) ?></td>
                    <td style="text-align: right; font-weight: 600;">Rp <?= number_format($d['total_anggaran'], 0, ',', '.') ?></td>
                    <td style="text-align: center;"><span class="badge badge-draft"><?= esc($d['status']) ?></span></td>
                    <td style="text-align: center; color: var(--primary); font-size: 1.2rem;">
                        <i class='bx bx-edit-alt' style="cursor: pointer; margin-right: 10px;"></i>
                        <i class='bx bx-dots-vertical-rounded' style="cursor: pointer; color:var(--text-muted)"></i>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; font-size: 0.85rem; color: var(--text-muted)">
        <div>Menampilkan <strong>1- <?= count($drafts) ?></strong> dari <strong><?= count($drafts) ?></strong> draf usulan SSH</div>
        <div style="display:flex; gap: 5px;">
            <button class="btn btn-outline" style="padding: 5px 10px; font-size: 0.8rem; border-radius:4px;" disabled>< Sebelumnya</button>
            <button class="btn btn-primary" style="padding: 5px 10px; font-size: 0.8rem; border-radius:4px;">1</button>
            <button class="btn btn-outline" style="padding: 5px 10px; font-size: 0.8rem; border-radius:4px;" disabled>Selanjutnya ></button>
        </div>
    </div>
</div>

<div class="bottom-cards" style="margin-top: 25px;">
    <div class="info-card blue">
        <div class="icon" style="background:#e8edff; color:var(--primary); font-size: 1.2rem"><i class='bx bx-info-circle'></i></div>
        <div>
            <h4 style="color:var(--primary)">Batas Waktu Simpan</h4>
            <p style="font-size: 0.75rem">Draf akan tersimpan selama 30 hari sejak terakhir kali diedit sebelum dihapus otomatis.</p>
        </div>
    </div>
    <div class="info-card green">
        <div class="icon" style="background:#e3f8ec; color:var(--success); font-size: 1.2rem"><i class='bx bx-copy'></i></div>
        <div>
            <h4 style="color:var(--success)">Duplikasi Cepat</h4>
            <p style="font-size: 0.75rem">Gunakan fitur duplikat untuk membuat usulan serupa tanpa harus mengisi ulang data pengusul.</p>
        </div>
    </div>
    <div class="info-card gray">
        <div class="icon" style="background:#f0f1f3; color:var(--dark); font-size: 1.2rem"><i class='bx bx-download'></i></div>
        <div>
            <h4 style="color:#555">Batch Export</h4>
            <p style="font-size: 0.75rem">Anda dapat memilih beberapa draf sekaligus untuk diekspor ke format PDF atau Excel.</p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
