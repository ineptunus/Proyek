<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('content') ?>

<h2 class="mb-4"><?= $title ?></h2>

<div class="card">
    <div class="card-body">
        <?php $errors = session()->getFlashdata('errors');
        if ($errors) : ?>
            <div class="alert alert-danger" role="alert">
                <ul class="m-0">
                    <?php foreach ($errors as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <!-- ACTION YANG BENAR: mengirim (POST) ke method create() -->
        <form action="<?= site_url('pengeluaran') ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= old('tanggal', date('Y-m-d')) ?>" required>
            </div>
            <div class="mb-3">
                <label for="keperluan" class="form-label">Keperluan Pengeluaran</label>
                <input type="text" class="form-control" id="keperluan" name="keperluan" value="<?= old('keperluan') ?>" placeholder="Contoh: Biaya Listrik, Bayar Penceramah" required>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah (Rp)</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= old('jumlah') ?>" placeholder="Hanya angka, contoh: 150000" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= old('deskripsi') ?></textarea>
            </div>
            
            <a href="<?= site_url('pengeluaran') ?>" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>