<div class="col-md-12">
    <?php
    if ($kas == null) {
        $pemasukan[] = 0;
        $pengeluaran[] = 0;
    } else {
        foreach ($kas as $key => $value) {
            $pemasukan[] = $value['kas_masuk'];
            $pengeluaran[] = $value['kas_keluar'];
        }
    }

    $saldoakhir = array_sum($pemasukan) - array_sum($pengeluaran);
    ?>

    <div class="alert alert-secondary alert-dismissible">
        <h5><i class="fas fa-money-bill-wave"></i> Saldo Kas Masjid</h5>
        Pemasukan : Rp. <?= number_format(array_sum($pemasukan), 0) ?><br>
        Pengeluaran : Rp. <?= number_format(array_sum($pengeluaran), 0) ?>
        <hr>
        <h3>Saldo Akhir : Rp. <?= number_format($saldoakhir, 0) ?></h3>
    </div>
</div>
<div class="col-md-12">
<div class="card card-secondary">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h class="card-title">Data <?= $judul ?></h>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <!-- Filter Form -->
            <!-- <div class="row mb-3">
                <div class="col-md-4">
                    <label for="tanggal_mulai">Tanggal Mulai:</label>
                    <input type="date" class="form-control" id="tanggal_mulai">
                </div>
                <div class="col-md-4">
                    <label for="tanggal_akhir">Tanggal Akhir:</label>
                    <input type="date" class="form-control" id="tanggal_akhir">
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary mt-4" id="filter_tanggal_btn">Filter</button>
                </div>
            </div> -->

            <table class="table" id="example1">
                <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th width="100 px">Tanggal</th>
                        <th>Keterangan</th>
                        <th>Kas Masuk</th>
                        <th>Kas Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($kas as $key => $value) { ?>
                        <tr class="<?= $value['status'] == 'Masuk' ? 'text-success' : 'text-danger' ?>">
                            <td><?= $no++; ?></td>
                            <td><?= $value['tanggal'] ?></td>
                            <td><?= $value['ket'] ?></td>
                            <td class="text-right">Rp. <?= number_format($value['kas_masuk'], 0) ?></td>
                            <td class="text-right">Rp. <?= number_format($value['kas_keluar'], 0) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>