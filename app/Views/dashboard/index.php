<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('content') ?>

<!-- Grid untuk kartu statistik -->
<div class="stats-grid">
    <!-- Kartu Total Kas -->
    <div class="stat-card">
        <div class="card-header">
            <!-- ICON BARU -->
            <i class="bi bi-safe-fill card-icon"></i>
            <div class="card-title">Total Kas</div>
        </div>
        <div class="card-value">Rp <?= number_format($total_kas, 0, ',', '.') ?></div>
        <div class="card-description">Total kas setelah perhitungan.</div>
    </div>

    <!-- Kartu Total Pemasukan -->
    <div class="stat-card">
        <div class="card-header">
            <!-- ICON BARU -->
            <i class="bi bi-box-arrow-in-down card-icon"></i>
            <div class="card-title">Total Pemasukan</div>
        </div>
        <div class="card-value">Rp <?= number_format($total_pemasukkan, 0, ',', '.') ?></div>
        <div class="card-description">Total semua pemasukan diterima.</div>
    </div>

    <!-- Kartu Total Pengeluaran -->
    <div class="stat-card">
        <div class="card-header">
            <!-- ICON BARU -->
            <i class="bi bi-box-arrow-up card-icon"></i>
            <div class="card-title">Total Pengeluaran</div>
        </div>
        <div class="card-value">Rp <?= number_format($total_pengeluaran, 0, ',', '.') ?></div>
        <div class="card-description">Total semua pengeluaran dilakukan.</div>
    </div>
    
    <!-- Kartu Total Donasi -->
    <div class="stat-card">
        <div class="card-header">
            <!-- ICON BARU -->
            <i class="bi bi-gift-fill card-icon"></i>
            <div class="card-title">Total Donasi</div>
        </div>
        <div class="card-value">Rp 0</div>
        <div class="card-description">Total semua donasi diterima.</div>
    </div>
</div>

<!-- Grid untuk Grafik (Tetap sama) -->
<div class="charts-grid">
    <div class="chart-container">
        <div class="chart-title">Statistik Keuangan</div>
        <img src="<?= base_url('img/group-3.png') ?>" alt="Grafik Keuangan">
    </div>

    <div class="chart-container">
        <div class="chart-title">Status Qurban</div>
        <img src="<?= base_url('img/image.png') ?>" alt="Grafik Qurban">
    </div>
</div>

<?= $this->endSection() ?>