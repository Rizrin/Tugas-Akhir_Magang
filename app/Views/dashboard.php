<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<style>
    .welcome-banner {
        background: linear-gradient(135deg, #4F82FF, #2E5EE6);
        color: white;
        padding: 30px;
        border-radius: 12px;
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 5px 15px rgba(79, 130, 255, 0.3);
    }
    .welcome-banner-text h2 { font-size: 1.5rem; margin-bottom: 10px; }
    .welcome-banner-text p { font-size: 0.95rem; opacity: 0.9; max-width: 600px; margin-bottom: 20px;}
    .welcome-banner .btn { background: white; color: var(--primary); font-weight: 600; padding: 10px 20px; border-radius: 8px;}
    .welcome-banner .status-badge { background: rgba(255,255,255,0.2); padding: 10px 15px; border-radius: 8px; font-size: 0.85rem; display: flex; align-items: center; gap: 10px; }
    
    .stats-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 20px; margin-bottom: 25px; }
    .stat-card { background: white; padding: 20px; border-radius: 12px; border: 1px solid var(--border-color); display: flex; flex-direction: column; position: relative;}
    .stat-card .title { font-size: 0.85rem; color: var(--text-muted); font-weight: 600; margin-bottom: 10px; }
    .stat-card .value { font-size: 1.8rem; font-weight: 700; color: #333; }
    .stat-card .desc { font-size: 0.75rem; color: var(--text-muted); margin-top: 5px; }
    .stat-card .icon-placeholder { position: absolute; top: 20px; right: 20px; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
    
    .stat-card.blue .icon-placeholder { background: var(--primary-light); color: var(--primary); }
    .stat-card.gray .icon-placeholder { background: #f0f1f3; color: #858796; }
    .stat-card.yellow .icon-placeholder { background: #fdf5d3; color: #b78a0c; }
    .stat-card.green .icon-placeholder { background: #e3f8ec; color: #158b5a; }
    .stat-card.red .icon-placeholder { background: #fde8e7; color: #c43026; }

    .main-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 25px; margin-bottom: 25px; }
    .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .card-title { font-size: 1.1rem; font-weight: 600; }
    .card-actions a { color: var(--primary); font-size: 0.85rem; font-weight: 500; }

    .timeline { position: relative; padding-left: 20px; border-left: 2px solid var(--border-color); }
    .timeline-item { position: relative; margin-bottom: 20px; }
    .timeline-item::before { content: ''; position: absolute; left: -27px; top: 5px; width: 12px; height: 12px; border-radius: 50%; background: var(--border-color); border: 2px solid white; box-shadow: 0 0 0 1px var(--border-color); }
    .timeline-item.primary::before { background: var(--primary); border-color: white; box-shadow: 0 0 0 1px var(--primary); }
    .timeline-item .time { font-size: 0.7rem; color: var(--text-muted); position: absolute; right: 0; top: 0; }
    .timeline-item .title { font-size: 0.9rem; font-weight: 600; margin-bottom: 3px; padding-right: 60px; }
    .timeline-item .author { font-size: 0.75rem; color: var(--text-muted); margin-bottom: 5px; }
    .timeline-item .desc { font-size: 0.8rem; background: var(--light); padding: 8px 12px; border-radius: 6px; color: var(--dark); border: 1px solid var(--border-color);}

    .bottom-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;}
    .info-card { background: white; padding: 20px; border-radius: 12px; border: 1px solid var(--border-color); display: flex; align-items: flex-start; gap: 15px;}
    .info-card .icon { background: var(--light); padding: 12px; border-radius: 10px; font-size: 1.5rem; }
    .info-card.green .icon { background: #e3f8ec; color: #158b5a; }
    .info-card.blue .icon { background: var(--primary-light); color: var(--primary); }
    .info-card.gray .icon { background: #f0f1f3; color: var(--dark); }
    .info-card h4 { font-size: 0.95rem; margin-bottom: 5px; }
    .info-card p { font-size: 0.8rem; color: var(--text-muted); margin: 0; }

    /* Search highlight */
    .highlight { background-color: #fff3cd; border-radius: 3px; padding: 0 2px; }
    #noResult { display: none; text-align: center; padding: 20px; color: var(--text-muted); font-size: 0.9rem; }
</style>

<div style="display: flex; justify-content: space-between; align-items: flex-end;" class="page-title-box">
    <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Ringkasan aktivitas dan status usulan SBU Anda.</p>
    </div>
    <div style="display: flex; gap: 10px;">
        <form method="get" action="<?= base_url('dashboard') ?>" style="display:flex; margin:0;">
            <div style="position: relative;">
                <i class='bx bx-search' style="position: absolute; left: 10px; top: 10px; color: #999; z-index:1;"></i>
                <input type="text" name="q" value="<?= esc($q ?? '') ?>" class="form-control" placeholder="Cari usulan..." 
                       style="padding-left: 35px; width: 250px;">
                <button type="submit" style="display:none"></button>
            </div>
        </form>
        <select class="form-control" style="width: auto;"><option>2024</option></select>
        <button class="btn btn-outline"><i class='bx bx-filter-alt'></i></button>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card blue">
        <div class="title">Total Usulan</div>
        <div class="value"><?= esc($summary['total']) ?></div>
        <div class="desc"><i class='bx bx-trending-up' style="color: var(--success)"></i> +12 dari bulan lalu</div>
        <div class="icon-placeholder"><i class='bx bx-food-menu'></i></div>
    </div>
    <div class="stat-card gray">
        <div class="title">Draft</div>
        <div class="value"><?= esc($summary['draft']) ?></div>
        <div class="desc">Membutuhkan penyelesaian</div>
        <div class="icon-placeholder"><i class='bx bx-file-blank'></i></div>
    </div>
    <div class="stat-card yellow">
        <div class="title">Menunggu Review</div>
        <div class="value"><?= esc($summary['menunggu']) ?></div>
        <div class="desc">Sedang diproses tim ahli</div>
        <div class="icon-placeholder"><i class='bx bx-time'></i></div>
    </div>
    <div class="stat-card green">
        <div class="title">Disetujui</div>
        <div class="value"><?= esc($summary['disetujui']) ?></div>
        <div class="desc">Telah dipublikasi ke sistem</div>
        <div class="icon-placeholder"><i class='bx bx-check-circle'></i></div>
    </div>
    <div class="stat-card red">
        <div class="title">Ditolak</div>
        <div class="value"><?= esc($summary['ditolak']) ?></div>
        <div class="desc">Perlu revisi mendalam</div>
        <div class="icon-placeholder"><i class='bx bx-x-circle'></i></div>
    </div>
</div>

<div class="welcome-banner">
    <div class="welcome-banner-text">
        <h2>Selamat Datang Kembali, Admin Pusat!</h2>
        <p>Anda memiliki <strong>42 usulan baru</strong> yang memerlukan review hari ini. Pastikan semua spesifikasi sesuai dengan standar regulasi terbaru tahun anggaran 2024.</p>
        <a href="<?= base_url('usulan/input') ?>" class="btn"><i class='bx bx-plus'></i> Tambah Usulan Baru</a>
        <a href="#" class="btn btn-outline" style="color: blue; border-color: rgba(0, 157, 255, 1); margin-left:10px;">Pelajari Panduan SBU</a>
    </div>
    <div class="status-badge">
        <i class='bx bx-check-circle'></i> Sistem SBU Update<br>Berjalan Normal
    </div>
</div>

<div class="main-grid">
    <div class="card">
        <div class="card-header">
            <div>
                <h3 class="card-title">Usulan Terbaru</h3>
                <p style="font-size: 0.8rem; color: var(--text-muted)">Daftar 5 pengajuan terakhir yang masuk ke sistem.</p>
            </div>
            <div class="card-actions">
                <a href="<?= base_url('usulan/riwayat') ?>">Lihat Semua <i class='bx bx-chevron-right'></i></a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Usulan</th>
                        <th>Kelompok Kode Barang/Jasa</th>
                        <th>Unit Kerja</th>
                        <th style="text-align:right">Total Anggaran</th>
                        <th style="text-align:center">Status</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php foreach ($usulanTerbaru as $u): ?>
                    <tr>
                        <td style="color: var(--primary); font-weight: 600;"><?= esc($u['nomor_usulan']) ?></td>
                        <td><?= esc($u['kelompok_kode']) ?></td>
                        <td><?= esc($u['unit_kerja']) ?></td>
                        <td style="text-align:right; font-weight:600">Rp <?= number_format($u['total_anggaran'], 0, ',', '.') ?></td>
                        <td style="text-align:center">
                            <?php 
                            $badgeClass = '';
                            if($u['status'] == 'Draft') $badgeClass = 'badge-draft';
                            elseif($u['status'] == 'Disetujui') $badgeClass = 'badge-disetujui';
                            elseif($u['status'] == 'Menunggu Review' || $u['status'] == 'Review Sekretariat') $badgeClass = 'badge-menunggu';
                            elseif($u['status'] == 'Ditolak') $badgeClass = 'badge-ditolak';
                            ?>
                            <span class="badge <?= $badgeClass ?>"><?= esc($u['status']) ?></span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div id="noResult">
                <i class='bx bx-search' style="font-size: 2rem; display:block; margin-bottom:8px;"></i>
                Tidak ada usulan yang cocok dengan pencarian.
            </div>
        </div>
    </div>
    
    <div>
        <div class="card" style="margin-bottom: 25px;">
            <div class="card-header">
                <div>
                    <h3 class="card-title"><i class='bx bx-line-chart'></i> Tren Pengajuan</h3>
                    <p style="font-size: 0.8rem; color: var(--text-muted)">Jumlah usulan per bulan (Jan - Jun)</p>
                </div>
            </div>
            <div style="height: 150px; display: flex; align-items: flex-end; gap: 15px; justify-content: space-between; padding-top: 20px; border-bottom: 1px dashed #ddd; position:relative;">
                <div style="position:absolute; left:0; top:0; width:100%; height:100%; background: linear-gradient(rgba(255,255,255,0) 90%, #f9f9f9 100%); pointer-events: none;"></div>
                <div style="width: 15%; background: var(--primary); height: 50%; border-radius: 4px 4px 0 0; opacity: 0.8"></div>
                <div style="width: 15%; background: var(--primary); height: 60%; border-radius: 4px 4px 0 0; opacity: 0.8"></div>
                <div style="width: 15%; background: var(--primary); height: 40%; border-radius: 4px 4px 0 0; opacity: 0.8"></div>
                <div style="width: 15%; background: var(--primary); height: 80%; border-radius: 4px 4px 0 0; opacity: 0.9"></div>
                <div style="width: 15%; background: var(--primary); height: 55%; border-radius: 4px 4px 0 0; opacity: 0.8"></div>
                <div style="width: 15%; background: var(--primary); height: 75%; border-radius: 4px 4px 0 0; opacity: 0.9"></div>
            </div>
            <div style="display: flex; justify-content: space-between; margin-top: 10px; font-size: 0.7rem; color: #888;">
                <span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span><span>Mei</span><span>Jun</span>
            </div>
        </div>

        <div class="card">
            <h3 class="card-title" style="margin-bottom: 20px;">Aktivitas Terbaru</h3>
            <div class="timeline">
                <?php foreach ($aktivitasTerbaru as $i => $a): ?>
                <div class="timeline-item <?= $i == 0 ? 'primary' : '' ?>">
                    <div class="time"><?= date('H:i', strtotime($a['created_at'])) ?><br><span style="font-size:0.6rem"><?= date('d/m', strtotime($a['created_at'])) ?></span></div>
                    <div class="title"><?= esc($a['judul']) ?></div>
                    <div class="author">Oleh: <?= esc($a['oleh']) ?></div>
                    <?php if($a['deskripsi']): ?>
                    <div class="desc"><?= esc($a['deskripsi']) ?></div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
                <div style="text-align: center; margin-top: 15px;">
                    <a href="#" style="font-size: 0.8rem; color: var(--text-muted)">Lihat Log Lengkap</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bottom-cards">
    <div class="info-card green">
        <div class="icon"><i class='bx bx-calendar-event'></i></div>
        <div>
            <h4>Batas Waktu Input</h4>
            <p>Input SBU 2025 ditutup dalam 12 hari lagi.</p>
        </div>
    </div>
    <div class="info-card blue">
        <div class="icon"><i class='bx bx-info-circle'></i></div>
        <div>
            <h4>Aturan Baru</h4>
            <p>Kenaikan batas harga satuan IT sebesar 5%.</p>
        </div>
    </div>
    <div class="info-card gray" style="align-items: center; justify-content: space-between">
        <div style="display:flex; gap:15px; align-items:center">
            <div class="icon"><i class='bx bx-sync'></i></div>
            <div>
                <h4>Quick Sync</h4>
                <p>Sinkronisasi data standar harga.</p>
            </div>
        </div>
        <i class='bx bx-right-arrow-alt' style="font-size: 1.5rem"></i>
    </div>
</div>

<script>
function searchUsulan() {
    const input = document.getElementById('searchInput').value.toLowerCase().trim();
    const rows = document.querySelectorAll('#tableBody tr');
    const noResult = document.getElementById('noResult');
    let found = 0;

    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        if (text.includes(input)) {
            row.style.display = '';
            found++;
            
            // Highlight teks yang cocok
            if (input !== '') {
                row.querySelectorAll('td').forEach(td => {
                    const original = td.getAttribute('data-original') || td.innerText;
                    td.setAttribute('data-original', original);
                    const regex = new RegExp(`(${input})`, 'gi');
                    td.innerHTML = original.replace(regex, '<span class="highlight">$1</span>');
                });
            } else {
                // Reset highlight kalau input kosong
                row.querySelectorAll('td').forEach(td => {
                    const original = td.getAttribute('data-original');
                    if (original) td.innerHTML = original;
                });
            }
        } else {
            row.style.display = 'none';
        }
    });

    // Tampilkan pesan jika tidak ada hasil
    noResult.style.display = found === 0 ? 'block' : 'none';
}
</script>

<?= $this->endSection() ?>