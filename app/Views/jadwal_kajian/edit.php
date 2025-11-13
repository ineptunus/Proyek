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

        <form action="<?= site_url('jadwal-kajian/' . $kajian->id) ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            
            <div class="mb-3">
                <label for="tema" class="form-label">Tema Kajian</label>
                <input type="text" class="form-control" id="tema" name="tema" value="<?= old('tema', $kajian->tema) ?>" required>
            </div>
            <div class="mb-3">
                <label for="penceramah" class="form-label">Nama Penceramah</label>
                <input type="text" class="form-control" id="penceramah" name="penceramah" value="<?= old('penceramah', $kajian->penceramah) ?>" required>
            </div>
             <div class="mb-3">
                <label for="lokasi" class="form-label">Lokasi</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= old('lokasi', $kajian->lokasi) ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_waktu" class="form-label">Tanggal dan Waktu</label>
                <input type="datetime-local" class="form-control" id="tanggal_waktu" name="tanggal_waktu" value="<?= old('tanggal_waktu', date('Y-m-d\TH:i', strtotime($kajian->tanggal_waktu))) ?>" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="Akan Datang" <?= old('status', $kajian->status) == 'Akan Datang' ? 'selected' : '' ?>>Akan Datang</option>
                    <option value="Selesai" <?= old('status', $kajian->status) == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                    <option value="Dibatalkan" <?= old('status', $kajian->status) == 'Dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                </select>
            </div>
            
            <a href="<?= site_url('jadwal-kajian') ?>" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>