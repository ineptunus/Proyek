<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('content') ?>

<h2 class="mb-4"><?= $title ?></h2>

<!-- Form Filter Tanggal -->
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Filter Laporan</h5>
        <form action="<?= site_url('laporan') ?>" method="get" class="row g-3 align-items-end">
            <div class="col-md-5">
                <label for="start_date" class="form-label">Dari Tanggal</label>
                <input type="date" class="form-control" name="start_date" id="start_date" value="<?= esc($start_date) ?>">
            </div>
            <div class="col-md-5">
                <label for="end_date" class="form-label">Sampai Tanggal</label>
                <input type="date" class="form-control" name="end_date" id="end_date" value="<?= esc($end_date) ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </form>
    </div>
</div>

<!-- Kartu Rangkuman -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Total Pemasukkan</h5>
                <h3><?= number_to_currency($total_pemasukkan, 'IDR', 'id_ID', 2) ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <h5 class="card-title">Total Pengeluaran</h5>
                <h3><?= number_to_currency($total_pengeluaran, 'IDR', 'id_ID', 2) ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Saldo Akhir</h5>
                <h3><?= number_to_currency($saldo_akhir, 'IDR', 'id_ID', 2) ?></h3>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Laporan -->
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5>Detail Transaksi Periode <?= date('d M Y', strtotime($start_date)) ?> s/d <?= date('d M Y', strtotime($end_date)) ?></h5>
        <a href="<?= site_url('laporan/cetak?start_date='.$start_date.'&end_date='.$end_date) ?>" target="_blank" class="btn btn-secondary">
            <i class="bi bi-printer-fill"></i> Cetak Laporan
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Pemasukkan (Debit)</th>
                        <th>Pengeluaran (Kredit)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($transaksi)): ?>
                        <?php $no = 1; foreach($transaksi as $item): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= date('d F Y', strtotime($item['tanggal'])) ?></td>
                            <td><?= esc($item['keterangan']) ?></td>
                            <td><?= $item['masuk'] > 0 ? number_to_currency($item['masuk'], 'IDR', 'id_ID', 2) : '-' ?></td>
                            <td><?= $item['keluar'] > 0 ? number_to_currency($item['keluar'], 'IDR', 'id_ID', 2) : '-' ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data transaksi pada periode ini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr class="fw-bold">
                        <td colspan="3" class="text-end">Total</td>
                        <td><?= number_to_currency($total_pemasukkan, 'IDR', 'id_ID', 2) ?></td>
                        <td><?= number_to_currency($total_pengeluaran, 'IDR', 'id_ID', 2) ?></td>
                    </tr>
                    <tr class="fw-bold table-primary">
                        <td colspan="3" class="text-end">Saldo Akhir</td>
                        <td colspan="2" class="text-center"><?= number_to_currency($saldo_akhir, 'IDR', 'id_ID', 2) ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>