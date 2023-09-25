<?php
if ($kas == null) {
    $pemasukan = [0];
    $pengeluaran = [0];
} else {
    $pemasukan = [];
    $pengeluaran = [];
    foreach ($kas as $key => $value) {
        $pemasukan[] = $value['kas_masuk'];
        $pengeluaran[] = $value['kas_keluar'];
    }
}
$totalPemasukan = array_sum($pemasukan);
$totalPengeluaran = array_sum($pengeluaran);
$saldoAkhir = $totalPemasukan - $totalPengeluaran;
$saldoHinggaBulan = 0;
?>

<b>Bulan : <?= $bulan ?></b>
<b>Tahun : <?= $tahun ?></b>

<table class="table table-bordered" border="1px solid" style="width: 100%;">

        <tr class="text-center">
            <th width="50px">No</th>
            <th width="100 px">Tanggal</th>
            <th>Keterangan</th>
            <th>Kas Masuk</th>
            <th>Kas Keluar</th>
        </tr>

        <?php $no=1; 
        foreach($kas as $key => $value) { ?>
            <tr class="<?= $value['status'] == 'Masuk' ? 'text-success' : 'text-danger' ?>">
                <td><?= $no++; ?></td>
                <td><?= $value['tanggal'] ?></td>
                <td><?= $value['ket'] ?></td>
                <td class="text-right">Rp. <?= number_format($value['kas_masuk'], 0) ?></td>
                <td class="text-right">Rp. <?= number_format($value['kas_keluar'], 0) ?></td>
            </tr>
        <?php } ?>
        <tr>
            <th colspan="3">Total</th>
            <th class="text-success text-right">Rp.<?= number_format(array_sum($pemasukan), 0) ?></th>
            <th class="text-danger text-right">Rp.<?= number_format(array_sum($pengeluaran),0) ?></th>
        </tr>
        <tr>
            <th colspan="3">Saldo Bulan <?= $bulan ?></th>
            <th colspan="2" class="text-right">Rp. <?= number_format($saldoAkhir, 0) ?></th>
        </tr>
        <!-- <tr>
            <th colspan="3">Saldo Hingga Bulan <?= $bulan ?></th>
            <th colspan="2" class="text-right">Rp. <?php number_format($saldoHinggaBulan, 0) ?></th>
        </tr> -->
</table>

