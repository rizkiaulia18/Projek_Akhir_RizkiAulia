<div class="col-md-12">
<div class="card card-secondary">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h class="card-title">Data <?= $judul ?></h>
                <div class="card-tools">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-tambah">
                        <i class="fas fa-plus"></i> <b>Tambah Kelompok</b>
                    </button>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php
            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-success">';
                echo session()->getFlashdata('pesan');
                echo '</div>';
            }
            ?>
            <div class="row">
                <?php foreach ($kelompok as $key => $value) { ?>
                    <div class="col-md-6">
                        <div class="card card-outline card-secondary">
                            <div class="card-header">
                                <h3 class="card-title"><?= $value['nama_kelompok'] ?></h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#tambah-peserta<?= $value['id_kelompok'] ?>"><i class="fas fa-plus"></i> Tambah peserta
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Peserta</th>
                                        <th>Biaya</th>
                                        <th></th>
                                    </tr>
                                    <?php
                                    $db = \Config\Database::connect();
                                    $peserta = $db->table('tb_peserta_kelompok')
                                        ->where('id_kelompok', $value['id_kelompok'])
                                        ->get()->getResultArray();
                                    $no = 1;

                                    foreach ($peserta as $key => $peserta) {
                                        $biaya = $db->table('tb_peserta_kelompok')
                                            ->where('id_kelompok', $peserta['id_kelompok'])
                                            ->select('tb_peserta_kelompok.id_kelompok')
                                            ->groupBy('tb_peserta_kelompok.id_kelompok')
                                            ->selectSum('tb_peserta_kelompok.biaya')
                                            ->get()->getRowArray();
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $peserta['nama_peserta'] ?></td>
                                            <td>Rp. <?= number_format($peserta['biaya'], 0) ?></td>
                                            <td>
                                                <a href="<?= base_url('PesertaQurban/DeletePeserta/' . $value['id_tahun'] . '/' . $peserta['id_peserta']) ?>" onclick="return confirm('Hapus Peserta ?')">
                                                    <i class="fas fa-times text-danger"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td></td>
                                        <td><b>Total Biaya :</b></td>
                                        <td><b>Rp. <?= $peserta == null ? '0' : number_format($biaya['biaya'], 0) ?></b></td>
                                    </tr>

                                </table>


                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-kelompok<?= $value['id_kelompok'] ?>"><i class="fas fa-trash"></i> Delete Kelompok
                                </button>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- modal tambah kelompok-->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kelompok</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('PesertaQurban/InsertKelompok') ?>
                <input value=" <?= $tahun['id_tahun'] ?>" name="id_tahun" hidden></input>
                <div class="form-group">
                    <label>Nama Kelompok</label>
                    <input name="nama_kelompok" class="form-control" value="Kelompok " required></input>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary">Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>


<?php foreach ($kelompok as $key => $value) { ?>

    <!-- delete kelompok -->
    <div class="modal fade" id="delete-kelompok<?= $value['id_kelompok'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete <?= $judul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Ingin Hapus Data ? <br>
                    <b><?= $value['nama_kelompok'] ?></b>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('PesertaQurban/DeleteKelompok/' . $tahun['id_tahun'] . '/' . $value['id_kelompok']) ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambah Peserta kelompok -->
    <div class="modal fade" id="tambah-peserta<?= $value['id_kelompok'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Peserta <?= $value['nama_kelompok'] ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    // Hitung jumlah peserta yang sudah ada di kelompok ini
                    $numParticipants = count($db->table('tb_peserta_kelompok')
                        ->where('id_kelompok', $value['id_kelompok'])
                        ->get()->getResultArray());
                    ?>

                    <?php if ($numParticipants < 7) { // Memungkinkan menambahkan peserta hanya jika jumlahnya kurang dari 7 
                    ?>
                        <?= form_open('PesertaQurban/InsertPeserta') ?>
                        <input value="<?= $tahun['id_tahun'] ?>" name="id_tahun" hidden></input>
                        <input name="id_kelompok" value="<?= $value['id_kelompok'] ?>" hidden></input>

                        <div class="form-group">
                            <label>Nama Peserta</label>
                            <input name="nama_peserta" class="form-control" required></input>
                        </div>
                        <div class="form-group">
                            <label>Biaya</label>
                            <input value="0" min="0" type="number" name="biaya" class="form-control" required></input>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-secondary">Simpan</button>
                        </div>
                        <?php echo form_close() ?>
                    <?php } else { // Tampilkan pesan jika kelompok sudah memiliki 7 peserta 
                    ?>
                        <div class="modal-body">
                            <h4><p class="text text-danger"><?= $value['nama_kelompok'] ?> sudah memiliki 7 peserta. Tidak dapat menambahkan lebih banyak.</p></h4>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>

<?php } ?>