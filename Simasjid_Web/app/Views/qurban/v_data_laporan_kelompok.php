<table class="table table-bordered" border="1px solid" style="width: 100%;">
    <tr class="text-center">
        <th width="50px">No</th>
        <th>Nama Peserta</th>
        <th>Kelompok</th>
        <th>Biaya</th>
    </tr>
        <?php $no = 1;
        foreach ($laporan_qurban_kelompok as $peserta) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $peserta['nama_peserta']; ?></td>
                <td><?= $peserta['nama_kelompok']; ?></td>
                <td class="text-right">Rp. <?= number_format($peserta['biaya'], 0); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <th colspan="3">Total</th>
            <th class="text-right">Rp.<?= number_format(array_sum(array_column($laporan_qurban_kelompok, 'biaya')), 0) ?></th>
        </tr>
</table>
