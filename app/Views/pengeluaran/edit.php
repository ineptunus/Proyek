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

        <!-- ACTION YANG BENAR: mengirim (POST) ke method update($id) -->
        <form action="<?= site_url('pengeluaran/' . $pengeluaran->id) ?>" method="post">
            <?= csrf_field() ?>
            <!-- METHOD SPOOFING: Wajib ada untuk update -->
            <input type="hidden" name="_method" value="PUT">
            
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= old('tanggal', $pengeluaran->tanggal) ?>" required>
            </div>
            <div class="mb-3">
                <label for="keperluan" class="form-label">Keperluan Pengeluaran</label>
                <input type="text" class="form-control" id="keperluan" name="keperluan" value="<?= old('keperluan', $pengeluaran->keperluan) ?>" required>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah (Rp)</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= old('jumlah', $pengeluaran->jumlah) ?>" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= old('deskripsi', $pengeluaran->deskripsi) ?></textarea>
            </div>
            
            <a href="<?= site_url('pengeluaran') ?>" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>