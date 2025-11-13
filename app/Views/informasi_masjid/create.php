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

        <form action="<?= site_url('informasi-masjid') ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Informasi</label>
                <input type="text" class="form-control" id="judul" name="judul" value="<?= old('judul') ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal Publikasi</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= old('tanggal', date('Y-m-d')) ?>" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Isi Informasi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="10" required><?= old('deskripsi') ?></textarea>
            </div>
            
            <a href="<?= site_url('informasi-masjid') ?>" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Publikasikan</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>