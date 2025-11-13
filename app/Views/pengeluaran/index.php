<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="m-0"><?= $title ?></h2>
    <!-- LINK YANG BENAR: mengarah ke method new() -->
    <a href="<?= site_url('pengeluaran/new') ?>" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Data
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
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Keperluan Pengeluaran</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Dicatat Oleh</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col" style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($pengeluaran)): ?>
                        <?php $no = 1; foreach($pengeluaran as $item): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= date('d F Y', strtotime($item->tanggal)) ?></td>
                            <td><?= esc($item->keperluan) ?></td>
                            <td><?= number_to_currency($item->jumlah, 'IDR', 'id_ID', 2) ?></td>
                            <td><?= esc($item->nama_pengurus) ?></td>
                            <td><?= esc($item->deskripsi) ?></td>
                            <td>
                                <!-- LINK EDIT YANG BENAR -->
                                <a href="<?= site_url('pengeluaran/' . $item->id . '/edit') ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i></a>
                                
                                <!-- FORM DELETE YANG BENAR -->
                                <form action="<?= site_url('pengeluaran/' . $item->id) ?>" method="post" class="d-inline">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data pengeluaran.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>