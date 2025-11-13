<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="m-0"><?= $title ?></h2>
    <a href="<?= site_url('jadwal-kajian/new') ?>" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Jadwal
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
                        <th>Tema Kajian</th>
                        <th>Penceramah</th>
                        <th>Lokasi</th>
                        <th>Waktu Pelaksanaan</th>
                        <th>Status</th>
                        <th>Dicatat Oleh</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($kajian)): ?>
                        <?php $no = 1; foreach($kajian as $item): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($item->tema) ?></td>
                            <td><?= esc($item->penceramah) ?></td>
                            <td><?= esc($item->lokasi) ?></td>
                            <td><?= format_indo(date('Y-m-d H:i:s', strtotime($item->tanggal_waktu)), 'd MMMM Y, HH:mm') ?> WIB</td>
                            <td>
                                <?php 
                                    $statusClass = 'bg-secondary';
                                    if ($item->status == 'Akan Datang') $statusClass = 'bg-primary';
                                    if ($item->status == 'Selesai') $statusClass = 'bg-success';
                                    if ($item->status == 'Dibatalkan') $statusClass = 'bg-danger';
                                ?>
                                <span class="badge <?= $statusClass ?>"><?= esc($item->status) ?></span>
                            </td>
                            <td><?= esc($item->nama_pengurus) ?></td>
                            <td>
                                <a href="<?= site_url('jadwal-kajian/' . $item->id . '/edit') ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i></a>
                                <form action="<?= site_url('jadwal-kajian/' . $item->id) ?>" method="post" class="d-inline">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">Belum ada jadwal kajian.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>