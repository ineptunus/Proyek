<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('content') ?>

<h2 class="mb-4"><?= $title ?></h2>

<div class="card">
    <div class="card-body">
        <!-- (Error handling tetap sama) -->
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
        <form action="<?= site_url('pemasukkan/' . $pemasukkan->id) ?>" method="post">
            <?= csrf_field() ?>
            <!-- METHOD SPOOFING: Wajib ada untuk update -->
            <input type="hidden" name="_method" value="PUT">
            
            <!-- (Isi form tetap sama) -->
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= old('tanggal', $pemasukkan->tanggal) ?>" required>
            </div>
            <div class="mb-3">
                <label for="sumber" class="form-label">Sumber Pemasukkan</label>
                <input type="text" class="form-control" id="sumber" name="sumber" value="<?= old('sumber', $pemasukkan->sumber) ?>" required>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah (Rp)</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= old('jumlah', $pemasukkan->jumlah) ?>" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= old('deskripsi', $pemasukkan->deskripsi) ?></textarea>
            </div>
            
            <a href="<?= site_url('pemasukkan') ?>" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>