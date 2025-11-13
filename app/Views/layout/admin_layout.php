<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard SIMAS</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Custom CSS (selalu paling bawah) -->
    <link rel="stylesheet" href="<?= base_url('css/admin_style.css') ?>">
</head>
<body>
    <div class="admin-wrapper">
        <!-- (Sidebar tetap sama) -->
        <div class="sidebar">
            <div class="sidebar-logo">
                <img src="<?= base_url('img/image-8.png') ?>" alt="Logo">
            </div>
            <ul class="sidebar-nav">
                <li class="nav-item active">
                    <a href="<?= site_url('dashboard') ?>"><i class="bi bi-house-door-fill"></i><span>Dashboard</span></a>
                </li>
                <li class="nav-item has-submenu">
                    <a href="#"><i class="bi bi-wallet2"></i><span>Kelola Keuangan</span><i class="bi bi-chevron-down submenu-arrow"></i></a>
                    <ul class="submenu">
                        <li><a href="<?= site_url('pemasukkan') ?>">Pemasukkan Kas</a></li>
                        <li><a href="<?= site_url('pengeluaran') ?>">Pengeluaran Kas</a></li>
                        <li><a href="<?= site_url("laporan")?>">Laporan Keuangan</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url("jadwal-kajian")?>"><i class="bi bi-calendar2-event-fill"></i><span>Jadwal Kajian</span></a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url("informasi-masjid")?>"><i class="bi bi-pencil-square"></i><span>Informasi Masjid</span></a>
                </li>
            </ul>
        </div>

        <!-- (Main Content tetap sama) -->
        <div class="main-content">
            <div class="topbar">
                <div class="topbar-title">Beranda</div>
                <div class="topbar-profile">
                    <div class="profile-text">
                        <div class="welcome-text">Assalamualaikum, Selamat Datang</div>
                        <div class="user-name"><?= esc(session()->get('nama')) ?></div>
                    </div>
                    <img class="profile-avatar" src="<?= base_url('img/ellipse-6.svg') ?>" alt="Avatar">
                     <a href="<?= site_url('logout') ?>" class="logout-button">Keluar</a>
                </div>
            </div>
            <main class="page-content">
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS Bundle CDN (Penting untuk notifikasi, dropdown, dll) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- (Script dropdown sidebar tetap sama) -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var submenuTriggers = document.querySelectorAll('.sidebar-nav .has-submenu > a');
            submenuTriggers.forEach(function(trigger) {
                trigger.addEventListener('click', function(e) {
                    e.preventDefault();
                    this.parentElement.classList.toggle('open');
                });
            });
        });
    </script>
</body>
</html>