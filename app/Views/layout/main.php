<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Dashboard') ?> - Sistem SBU</title>
    <!-- Use Boxicons for beautiful icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <style>
        .sidebar { transition: all 0.3s; }
        .sidebar.collapsed { width: 80px; }
        .sidebar.collapsed .brand span,
        .sidebar.collapsed .sidebar-menu a span { display: none; }
        .sidebar.collapsed .sidebar-menu a { justify-content: center; padding: 12px 0; }
        .sidebar.collapsed .sidebar-header { justify-content: center; }
        .main-wrapper.expanded { margin-left: 80px; transition: margin-left 0.3s; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="brand">
                <i class='bx bx-shield-quarter'></i>
                <span>Sistem SBU</span>
            </div>
        </div>

        <ul class="sidebar-menu">
            <?php 
                $uriService = service('uri');
                $totalSegs = $uriService->getTotalSegments();
                $uri = $totalSegs >= 1 ? $uriService->getSegment(1) : '';
                $uri2 = $totalSegs >= 2 ? $uriService->getSegment(2) : '';
            ?>
            <li class="<?= ($uri == '' || $uri == 'dashboard') ? 'active' : '' ?>">
                <a href="<?= base_url('dashboard') ?>">
                    <i class='bx bx-grid-alt'></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <!-- Menu SBU -->
            <li style="padding: 10px 20px; font-size: 0.75rem; color: #888; text-transform: uppercase; font-weight: bold; margin-top: 10px;">Usulan SBU</li>
            <li class="<?= ($uri == 'usulan' && $uri2 == 'input') ? 'active' : '' ?>">
                <a href="<?= base_url('usulan/input') ?>">
                    <i class='bx bx-plus-circle'></i>
                    <span>Input SBU Baru</span>
                </a>
            </li>
            <li class="<?= ($uri == 'usulan' && $uri2 == 'draft') ? 'active' : '' ?>">
                <a href="<?= base_url('usulan/draft') ?>">
                    <i class='bx bx-file-blank'></i>
                    <span>Draft SBU</span>
                </a>
            </li>
            <li class="<?= ($uri == 'usulan' && $uri2 == 'riwayat') ? 'active' : '' ?>">
                <a href="<?= base_url('usulan/riwayat') ?>">
                    <i class='bx bx-history'></i>
                    <span>Riwayat SBU</span>
                </a>
            </li>
            
            <!-- Menu SSH -->
            <li style="padding: 10px 20px; font-size: 0.75rem; color: #888; text-transform: uppercase; font-weight: bold; margin-top: 10px;">Usulan SSH</li>
            <li class="<?= ($uri == 'usulanssh' && $uri2 == 'input') ? 'active' : '' ?>">
                <a href="<?= base_url('usulanssh/input') ?>">
                    <i class='bx bx-plus-circle'></i>
                    <span>Input SSH Baru</span>
                </a>
            </li>
            <li class="<?= ($uri == 'usulanssh' && $uri2 == 'draft') ? 'active' : '' ?>">
                <a href="<?= base_url('usulanssh/draft') ?>">
                    <i class='bx bx-file-blank'></i>
                    <span>Draft SSH</span>
                </a>
            </li>
            <li class="<?= ($uri == 'usulanssh' && $uri2 == 'riwayat') ? 'active' : '' ?>">
                <a href="<?= base_url('usulanssh/riwayat') ?>">
                    <i class='bx bx-history'></i>
                    <span>Riwayat SSH</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <a href="#" id="toggleSidebar">
                <i class='bx bx-chevron-left'></i>
                <span>Collapse</span>
            </a>
            <a href="#" class="logout">
                <i class='bx bx-log-out'></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>

    <!-- Main Wrapper -->
    <div class="main-wrapper" id="mainWrapper">
        <!-- Topbar -->
        <header class="topbar">
            <div class="topbar-right">
                <div class="notification">
                    <i class='bx bx-bell'></i>
                </div>
                <div class="user-profile">
                    <div class="user-info">
                        <div class="name">Admin Pusat</div>
                        <div class="email">admin@sbu.go.id</div>
                    </div>
                    <img src="https://ui-avatars.com/api/?name=Admin+Pusat&background=random" alt="Avatar" class="user-avatar">
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="content-area">
            <?= $this->renderSection('content') ?>
        </main>
        
        <footer style="margin-top: auto; padding: 20px 30px; font-size: 0.8rem; color: #888; border-top: 1px solid #eee; display: flex; justify-content: space-between;">
            <div>Terakhir diperbarui: <?= date('d F Y, H:i') ?> WIB</div>
            <div style="display: flex; gap: 15px;">
                <a href="#" style="color: var(--primary);">Kebijakan Privasi</a>
                <a href="#" style="color: var(--primary);">Syarat Ketentuan</a>
                <a href="#" style="color: var(--primary);">Pusat Bantuan</a>
            </div>
        </footer>
    </div>

    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('mainWrapper').classList.toggle('expanded');
            let icon = this.querySelector('i');
            if(icon.classList.contains('bx-chevron-left')) {
                icon.classList.replace('bx-chevron-left', 'bx-chevron-right');
            } else {
                icon.classList.replace('bx-chevron-right', 'bx-chevron-left');
            }
        });
    </script>
</body>
</html>
