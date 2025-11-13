<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="m-0"><?= $title ?></h2>
    <a href="<?= site_url('informasi-masjid/new') ?>" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Buat Informasi
    </a>
</div>

<?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Informasi</th>
                        <th>Deskripsi Singkat</th>
                        <th>Tanggal Publikasi</th>
                        <th>Diposting Oleh</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($informasi)): ?>
                        <?php $no = 1; foreach($informasi as $item): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($item->judul) ?></td>
                            <td><?= esc(substr($item->deskripsi, 0, 70)) . '...' ?></td>
                            <td><?= format_indo($item->tanggal, 'd MMMM Y') ?></td>
                            <td><?= esc($item->nama_pengurus) ?></td>
                            <td>
                                <a href="<?= site_url('informasi-masjid/' . $item->id . '/edit') ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i></a>
                                <form action="<?= site_url('informasi-masjid/' . $item->id) ?>" method="post" class="d-inline">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus informasi ini?');"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Belum ada informasi yang dipublikasikan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>