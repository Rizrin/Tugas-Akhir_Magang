<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .wizard-container { max-width: 900px; margin: 0 auto; }
    .wizard-header { text-align: center; margin-bottom: 40px; }
    .wizard-title { font-size: 1.8rem; font-weight: 700; color: #1a202c; margin-bottom: 10px; }
    .wizard-subtitle { color: var(--text-muted); font-size: 1rem; }
    
    .stepper { display: flex; justify-content: space-between; position: relative; margin-bottom: 40px; }
    .stepper::before { content: ''; position: absolute; top: 25px; left: 10%; right: 10%; height: 2px; background: var(--border-color); z-index: 1; }
    .step { text-align: center; position: relative; z-index: 2; flex: 1; opacity: 0.5; transition: 0.3s; }
    .step.active { opacity: 1; }
    .step-icon { width: 50px; height: 50px; background: white; border: 2px solid var(--border-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; font-size: 1.3rem; color: var(--text-muted); transition: 0.3s; }
    .step.active .step-icon { background: var(--primary); border-color: var(--primary); color: white; box-shadow: 0 4px 10px rgba(78, 115, 223, 0.3); }
    .step-title { font-size: 0.75rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; }
    .step.active .step-title { color: var(--primary); }

    .form-card { background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); padding: 40px; margin-bottom: 100px; }
    .form-section-header { display: flex; align-items: flex-start; gap: 15px; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid var(--border-color); }
    .form-section-icon { background: var(--primary-light); color: var(--primary); width: 45px; height: 45px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
    .form-section-title { font-size: 1.1rem; font-weight: 600; color: #333; margin-bottom: 3px; }
    .form-section-subtitle { font-size: 0.85rem; color: var(--text-muted); }

    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 25px; }
    .form-grid.full { grid-template-columns: 1fr; }

    /* Fixed Footer */
    .wizard-footer { position: fixed; bottom: 0; left: 250px; right: 0; background: white; border-top: 1px solid var(--border-color); padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; z-index: 90; transition: left 0.3s;}
    .sidebar.collapsed ~ .main-wrapper .wizard-footer { left: 80px; }
    
    .footer-left { display: flex; gap: 30px; align-items: center; }
    .btn-back-link { color: var(--text-muted); font-weight: 500; cursor: pointer; }
    .btn-cancel { color: var(--danger); font-weight: 500; cursor: pointer;}
    .btn-next { background: var(--primary); color: white; padding: 12px 30px; border-radius: 8px; font-weight: 600; font-size: 1rem; border:none; cursor:pointer;}
    .btn-next:hover { background: var(--primary-hover); }

    .step-content { display: none; }
    .step-content.active { display: block; animation: fadeIn 0.4s ease; }
    
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    .radio-group { display: flex; gap: 20px; margin-top: 8px; }
    .radio-label { display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 0.95rem; }
    
    .provider-card { background: var(--light); padding: 20px; border-radius: 10px; border: 1px solid var(--border-color); margin-bottom: 20px; }
    .provider-title { font-size: 0.95rem; font-weight: 600; margin-bottom: 15px; color: var(--primary); }
</style>

<div class="wizard-container">
    <div class="wizard-header">
        <h2 class="wizard-title">Penyusunan Usulan SBU Baru</h2>
        <p class="wizard-subtitle">Lengkapi seluruh formulir di bawah ini untuk mengajukan standar biaya baru atau pembaruan standar biaya yang sudah ada.</p>
    </div>

    <div class="stepper">
        <div class="step active" id="stepper-1">
            <div class="step-icon"><i class='bx bx-user'></i></div>
            <div class="step-title">Data Pengusul</div>
        </div>
        <div class="step" id="stepper-2">
            <div class="step-icon"><i class='bx bx-cube'></i></div>
            <div class="step-title">Usulan SBU</div>
        </div>
        <div class="step" id="stepper-3">
            <div class="step-icon"><i class='bx bx-wallet'></i></div>
            <div class="step-title">Penyedia & Anggaran</div>
        </div>
        <div class="step" id="stepper-4">
            <div class="step-icon"><i class='bx bx-check-shield'></i></div>
            <div class="step-title">Review & Submit</div>
        </div>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div style="background: #f8d7da; color: #842029; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center; border: 1px solid #f5c2c7;">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form id="wizardForm" action="<?= base_url('usulan/submit') ?>" method="post" enctype="multipart/form-data">
        
        <!-- STEP 1: DATA PENGUSUL -->
        <div class="step-content active" id="content-1">
            <div class="form-card">
                <div class="form-section-header">
                    <div class="form-section-icon"><i class='bx bx-user-circle'></i></div>
                    <div>
                        <div class="form-section-title">Informasi Profil Pengusul</div>
                        <div class="form-section-subtitle">Pastikan data diri Anda sudah sesuai dengan sistem kepegawaian.</div>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Nama Lengkap Pengusul</label><input type="text" name="nama_lengkap_pengusul" class="form-control" required></div>
                    <div class="form-group"><label class="form-label">NIP / NIM / NIDN</label><input type="text" name="nip" class="form-control" required></div>
                    <div class="form-group"><label class="form-label">Jabatan</label><input type="text" name="jabatan" class="form-control" required></div>
                    <div class="form-group"><label class="form-label">Unit Kerja</label><input type="text" name="unit_kerja" class="form-control" required></div>
                    <div class="form-group"><label class="form-label">Fakultas / Instansi</label><input type="text" name="fakultas" class="form-control" required></div>
                    <div class="form-group"><label class="form-label">Alamat Email Resmi</label><input type="email" name="email" class="form-control" required></div>
                    <div class="form-group"><label class="form-label">Nomor Handphone (WhatsApp)</label><input type="text" name="whatsapp" class="form-control" required></div>
                    <div class="form-group">
                        <label class="form-label">Tahun Anggaran Usulan</label>
                        <select name="tahun_anggaran" class="form-control" required>
                            <option value="2026" selected>2026</option>
                            <option value="2027">2027</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- STEP 2: USULAN SBU -->
        <div class="step-content" id="content-2">
            <div class="form-card">
                <div class="form-section-header">
                    <div class="form-section-icon"><i class='bx bx-cube'></i></div>
                    <div>
                        <div class="form-section-title">Informasi Usulan SBU</div>
                        <div class="form-section-subtitle">Detail mengenai SBU yang diusulkan.</div>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Nama OPD</label>
                        <select name="nama_opd" class="form-control" required>
                            <option value="">-- Pilih OPD --</option>
                            <option value="DINDIK">DINDIK</option>
                            <option value="DINKES">DINKES</option>
                            <option value="BLUD PUSKESMAS BENDAN">BLUD PUSKESMAS BENDAN</option>
                            <option value="BLUD PUSKESMAS BUARAN">BLUD PUSKESMAS BUARAN</option>
                            <option value="BLUD PUSKESMAS JENGGOT">BLUD PUSKESMAS JENGGOT</option>
                            <option value="BLUD PUSKESMAS KLEGO">BLUD PUSKESMAS KLEGO</option>
                            <option value="BLUD PUSKESMAS KRAMATSARI">BLUD PUSKESMAS KRAMATSARI</option>
                            <option value="BLUD PUSKESMAS KRAPYAK">BLUD PUSKESMAS KRAPYAK</option>
                            <option value="BLUD PUSKESMAS KUSUMABANGSA">BLUD PUSKESMAS KUSUMABANGSA</option>
                            <option value="BLUD PUSKESMAS MEDONO">BLUD PUSKESMAS MEDONO</option>
                            <option value="BLUD PUSKESMAS PEKALONGAN SELATAN">BLUD PUSKESMAS PEKALONGAN SELATAN</option>
                            <option value="BLUD PUSKESMAS TIRTO">BLUD PUSKESMAS TIRTO</option>
                            <option value="BLUD PUSKESMAS TONDANO">BLUD PUSKESMAS TONDANO</option>
                            <option value="BLUD BPSJ">BLUD BPSJ</option>
                            <option value="DPUPR">DPUPR</option>
                            <option value="DINPERINAKER">DINPERINAKER</option>
                            <option value="DINAS PEMBERDADAYAAN">DINAS PEMBERDADAYAAN</option>
                            <option value="DINAS PERTANIAN DAN PANGAN">DINAS PERTANIAN DAN PANGAN</option>
                            <option value="DLH">DLH</option>
                            <option value="DISDUKCAPIL">DISDUKCAPIL</option>
                            <option value="DINHUB">DINHUB</option>
                            <option value="DINKOMINFO">DINKOMINFO</option>
                            <option value="DINAS PERDAGANGAN, KOPERAASI, USAHA KECIL DAN MENENGAH">DINAS PERDAGANGAN, KOPERAASI, USAHA KECIL DAN MENENGAH</option>
                            <option value="DINARPUS">DINARPUS</option>
                            <option value="DINAS KELAUTAN DAN PERIKANAN">DINAS KELAUTAN DAN PERIKANAN</option>
                            <option value="BAPRIDA">BAPRIDA</option>
                            <option value="BAG. HUKUM">BAG. HUKUM</option>
                            <option value="BAG. UMUM">BAG. UMUM</option>
                            <option value="INSPEKTORAT">INSPEKTORAT</option>
                            <option value="KECAMATAN PKL UTARA">KECAMATAN PKL UTARA</option>
                            <option value="KELURAHAN PANJANG WETAN">KELURAHAN PANJANG WETAN</option>
                            <option value="KELURAHAN DEGAYU">KELURAHAN DEGAYU</option>
                            <option value="KELURAHAN KRAPYAK">KELURAHAN KRAPYAK</option>
                            <option value="KECAMATAN PEKALONGAN BARAT">KECAMATAN PEKALONGAN BARAT</option>
                            <option value="KELURAHAN MEDONO">KELURAHAN MEDONO</option>
                            <option value="KELURAHAN PODOSUGIH">KELURAHAN PODOSUGIH</option>
                            <option value="KELURAHAN TIRTO">KELURAHAN TIRTO</option>
                            <option value="KELURAHAN KEBULEN">KELURAHAN KEBULEN</option>
                            <option value="KELURAHAN BENDAN KERGON">KELURAHAN BENDAN KERGON</option>
                            <option value="KELURAHAN PASIRKRATONKRAMAT">KELURAHAN PASIRKRATONKRAMAT</option>
                            <option value="KELURAHAN PRINGREJO">KELURAHAN PRINGREJO</option>
                            <option value="KELURAHAN KAUMAN">KELURAHAN KAUMAN</option>
                            <option value="KECAMATAN PKL TIMUR">KECAMATAN PKL TIMUR</option>
                            <option value="KELURAHAN SETONO">KELURAHAN SETONO</option>
                            <option value="KELURAHAN KALIBAROS">KELURAHAN KALIBAROS</option>
                            <option value="KELURAHAN JENGGOT">KELURAHAN JENGGOT</option>
                            <option value="KELURAHAN BUARAN KRADENAN">KELURAHAN BUARAN KRADENAN</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jenis Usulan</label>
                        <div class="radio-group">
                            <label class="radio-label"><input type="radio" name="jenis_usulan" value="SBU PERUBAHAN" checked> SBU PERUBAHAN</label>
                            <label class="radio-label"><input type="radio" name="jenis_usulan" value="SBU BARU"> SBU BARU</label>
                        </div>
                    </div>
                    <div class="form-group"><label class="form-label">Kelompok/Kode Barang/Jasa</label><input type="text" name="kelompok_kode" class="form-control" required></div>
                    <div class="form-group"><label class="form-label">Kode rekening Belanja</label><input type="text" name="kode_rekening" class="form-control" required></div>
                    <div class="form-group full"><label class="form-label">Spesifikasi</label><textarea name="spesifikasi" class="form-control" rows="3" required></textarea></div>
                    
                    <div class="form-group">
                        <label class="form-label">Satuan</label>
                        <select name="satuan" class="form-control" required>
                            <option value="Buah">Buah</option><option value="Unit">Unit</option><option value="Meter">Meter</option><option value="Paket">Paket</option><option value="Orang/Bulan">Orang/Bulan</option>
                        </select>
                    </div>
                    <div class="form-group"><label class="form-label">Harga 2026 bagi usulan (Rp)</label><input type="number" name="harga_2026" class="form-control" min="0" required></div>
                </div>
            </div>
        </div>

        <!-- STEP 3: PENYEDIA & ANGGARAN -->
        <div class="step-content" id="content-3">
            <div class="form-card">
                <div class="form-section-header">
                    <div class="form-section-icon"><i class='bx bx-store'></i></div>
                    <div>
                        <div class="form-section-title">Data Penyedia</div>
                        <div class="form-section-subtitle">Informasi survei harga dari 3 penyedia berbeda.</div>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="provider-card">
                        <div class="provider-title">Penyedia 1</div>
                        <div class="form-group"><label class="form-label">Harga Penyedia 1 (Rp)</label><input type="number" name="harga_penyedia_1" class="form-control" min="0" required></div>
                        <div class="form-group"><label class="form-label">Link Sumber Dokumen</label><input type="url" name="link_penyedia_1" class="form-control" placeholder="https://" required></div>
                        <div class="form-group"><label class="form-label">Foto Penyedia 1 (png/jpg)</label><input type="file" name="foto_penyedia_1" class="form-control" accept="image/png, image/jpeg" required></div>
                    </div>
                    
                    <div class="provider-card">
                        <div class="provider-title">Penyedia 2</div>
                        <div class="form-group"><label class="form-label">Harga Penyedia 2 (Rp)</label><input type="number" name="harga_penyedia_2" class="form-control" min="0" required></div>
                        <div class="form-group"><label class="form-label">Link Sumber Dokumen</label><input type="url" name="link_penyedia_2" class="form-control" placeholder="https://" required></div>
                        <div class="form-group"><label class="form-label">Foto Penyedia 2 (png/jpg)</label><input type="file" name="foto_penyedia_2" class="form-control" accept="image/png, image/jpeg" required></div>
                    </div>
                    
                    <div class="provider-card">
                        <div class="provider-title">Penyedia 3</div>
                        <div class="form-group"><label class="form-label">Harga Penyedia 3 (Rp)</label><input type="number" name="harga_penyedia_3" class="form-control" min="0" required></div>
                        <div class="form-group"><label class="form-label">Link Sumber Dokumen</label><input type="url" name="link_penyedia_3" class="form-control" placeholder="https://" required></div>
                        <div class="form-group"><label class="form-label">Foto Penyedia 3 (png/jpg)</label><input type="file" name="foto_penyedia_3" class="form-control" accept="image/png, image/jpeg" required></div>
                    </div>
                </div>

                <div class="form-section-header" style="margin-top: 30px;">
                    <div class="form-section-icon"><i class='bx bx-bar-chart-alt-2'></i></div>
                    <div>
                        <div class="form-section-title">Detail Anggaran & Kegiatan</div>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Jenis</label>
                        <div class="radio-group">
                            <label class="radio-label"><input type="radio" name="jenis_tkdn" value="TKDN" checked> TKDN</label>
                            <label class="radio-label"><input type="radio" name="jenis_tkdn" value="NON TKDN"> NON TKDN</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tupoksi / Diluar Tupoksi</label>
                        <div class="radio-group">
                            <label class="radio-label"><input type="radio" name="tupoksi" value="tupoksi" checked> Tupoksi</label>
                            <label class="radio-label"><input type="radio" name="tupoksi" value="diluar tupoksi"> Diluar Tupoksi</label>
                        </div>
                    </div>
                    <div class="form-group"><label class="form-label">Usulan Harga 2027 (Rp)</label><input type="number" name="usulan_harga_2027" class="form-control" min="0" required></div>
                    <div class="form-group"><label class="form-label">Subjek / Pelaksanaan Kegiatan</label><input type="text" name="subjek_kegiatan" class="form-control" required></div>
                    <div class="form-group full"><label class="form-label">Detail Uraian Kegiatan</label><textarea name="detail_uraian" class="form-control" rows="3" required></textarea></div>
                    <div class="form-group"><label class="form-label">Volume Kegiatan</label><input type="text" name="volume_kegiatan" class="form-control" required></div>
                    <div class="form-group"><label class="form-label">Kebutuhan Anggaran Pertahun (Rp)</label><input type="number" name="kebutuhan_anggaran" class="form-control" min="0" required></div>
                    <div class="form-group"><label class="form-label">Ketersediaan Anggaran (Rp)</label><input type="number" name="ketersediaan_anggaran" class="form-control" min="0" required></div>
                </div>
            </div>
        </div>

        <!-- STEP 4: REVIEW -->
        <div class="step-content" id="content-4">
            <div class="form-card">
                <div class="form-section-header">
                    <div class="form-section-icon"><i class='bx bx-check-shield'></i></div>
                    <div>
                        <div class="form-section-title">Review & Validasi</div>
                        <div class="form-section-subtitle">Pastikan semua data sudah terisi dengan benar sebelum mengirimkan form.</div>
                    </div>
                </div>
                <div style="background:var(--light); padding:30px; border-radius:10px; text-align:center;">
                    <i class='bx bx-check-circle' style="font-size:3rem; color:var(--success); margin-bottom:15px;"></i>
                    <h3 style="margin-bottom:10px;">Semua Data Siap Disubmit</h3>
                    <p style="color:var(--text-muted); font-size:0.9rem;">Menekan tombol "Simpan & Submit" akan menyimpan data ke database dan merekam aktivitas pembuatan draft. Lampiran penyedia akan diupload ke server lokal.</p>
                </div>
            </div>
        </div>

        <!-- FOOTER NAVIGATION -->
        <div class="wizard-footer">
            <div class="footer-left">
                <span class="btn-back-link" id="btnBack"><i class='bx bx-chevron-left'></i> Kembali</span>
                <a href="<?= base_url('dashboard') ?>" class="btn-cancel">Batalkan</a>
            </div>
            <div>
                <button type="button" class="btn-next" id="btnNext">Selanjutnya <i class='bx bx-chevron-right'></i></button>
            </div>
        </div>

    </form>
</div>

<div style="height: 100px;"></div>

<script>
    let currentStep = 1;
    const totalSteps = 4;
    const btnNext = document.getElementById('btnNext');
    const btnBack = document.getElementById('btnBack');
    const form = document.getElementById('wizardForm');

    function updateWizard() {
        // Update content visibility
        for(let i=1; i<=totalSteps; i++) {
            document.getElementById('content-'+i).classList.remove('active');
            document.getElementById('stepper-'+i).classList.remove('active');
        }
        document.getElementById('content-'+currentStep).classList.add('active');
        
        // Update stepper
        for(let i=1; i<=currentStep; i++) {
            document.getElementById('stepper-'+i).classList.add('active');
        }

        // Update buttons
        if(currentStep === 1) {
            btnBack.innerHTML = "<i class='bx bx-home'></i> Ke Dashboard";
            btnNext.innerHTML = "Selanjutnya <i class='bx bx-chevron-right'></i>";
        } else if(currentStep === totalSteps) {
            btnBack.innerHTML = "<i class='bx bx-chevron-left'></i> Kembali";
            btnNext.innerHTML = "<i class='bx bx-save'></i> Simpan & Submit";
        } else {
            btnBack.innerHTML = "<i class='bx bx-chevron-left'></i> Kembali";
            btnNext.innerHTML = "Selanjutnya <i class='bx bx-chevron-right'></i>";
        }
    }

    btnNext.addEventListener('click', function(e) {
        // Very basic validation check for current step
        const fields = document.getElementById('content-'+currentStep).querySelectorAll('input[required], select[required], textarea[required]');
        let valid = true;
        fields.forEach(f => {
            if(!f.value) {
                f.style.borderColor = 'red';
                valid = false;
            } else {
                f.style.borderColor = '#ced4da';
            }
        });

        if(!valid && currentStep < totalSteps) {
            alert('Mohon isi semua field yang diwajibkan!');
            return;
        }

        if(currentStep < totalSteps) {
            currentStep++;
            updateWizard();
        } else {
            // Submit form
            form.submit();
        }
    });

    btnBack.addEventListener('click', function() {
        if(currentStep === 1) {
            window.location.href = "<?= base_url('dashboard') ?>";
        } else {
            currentStep--;
            updateWizard();
        }
    });

    // File validation
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!validTypes.includes(file.type)) {
                    alert('Format file harus berupa JPG atau PNG!');
                    this.value = '';
                    return;
                }
                if (file.size > 512 * 1024) {
                    alert('Ukuran file maksimal adalah 512Kb!');
                    this.value = '';
                    return;
                }
            }
        });
    });

    // Initialize layout
    updateWizard();
</script>

<?= $this->endSection() ?>
