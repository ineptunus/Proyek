<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; }
        .header p { margin: 0; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .total-row { font-weight: bold; }
        .saldo-row { font-weight: bold; background-color: #e3f2fd; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Keuangan Masjid</h1>
        <p>Periode: <?= date('d F Y', strtotime($start_date)) ?> - <?= date('d F Y', strtotime($end_date)) ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Tanggal</th>
                <th>Keterangan</th>
                <th style="width: 20%;">Pemasukkan</th>
                <th style="width: 20%;">Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($transaksi)): ?>
                <?php $no = 1; foreach($transaksi as $item): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= date('d-m-Y', strtotime($item['tanggal'])) ?></td>
                    <td><?= esc($item['keterangan']) ?></td>
                    <td class="text-right"><?= $item['masuk'] > 0 ? number_to_currency($item['masuk'], 'IDR', 'id_ID', 0) : '-' ?></td>
                    <td class="text-right"><?= $item['keluar'] > 0 ? number_to_currency($item['keluar'], 'IDR', 'id_ID', 0) : '-' ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada data transaksi.</td>
                </tr>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="3" class="text-right">Total</td>
                <td class="text-right"><?= number_to_currency($total_pemasukkan, 'IDR', 'id_ID', 0) ?></td>
                <td class="text-right"><?= number_to_currency($total_pengeluaran, 'IDR', 'id_ID', 0) ?></td>
            </tr>
            <tr class="saldo-row">
                <td colspan="3" class="text-right">Saldo Akhir</td>
                <td colspan="2" style="text-align: center;"><?= number_to_currency($saldo_akhir, 'IDR', 'id_ID', 0) ?></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>