<div class="col-md-12">
<div class="card card-secondary">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h class="card-title">Data <?= $judul ?></h>
                <div class="card-tools">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#tambah-peserta">
                        <i class="fas fa-plus"></i> <b>Tambah</b>
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
            <div class="table-responsive">
                <table class="table" id="example1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Peserta</th>
                            <th>Biaya</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($peserta_pribadi as $key => $Value) {
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $Value['nama_peserta'] ?></td>
                                <td>Rp. <?= number_format($Value['biaya'], 0) ?></td>
                                <td>
                                    <button class="btn btn-flat btn-sm btn-primary" data-toggle="modal" data-target="#modal-edit<?= $Value['id_peserta_p'] ?>"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="btn btn-flat btn-sm btn-danger" data-toggle="modal" data-target="#delete-peserta<?= $Value['id_peserta_p'] ?>"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- Tambah Peserta Pribadi -->
<div class="modal fade" id="tambah-peserta">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Peserta Pribadi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('PesertaQurban/InsertPesertaPribadi') ?>
                    <input value="<?= $tahun['id_tahun'] ?>" name="id_tahun" hidden></input>
                <div class="form-group">
                    <label>Nama Peserta</label>
                    <input name="nama_peserta" class="form-control" required></input>
                </div>
                <div class="form-group">
                    <label>Biaya</label>
                    <input value="0" min="0" type="number" name="biaya" class="form-control" required></input>
                </div>
            </div>   
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary">Simpan</button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>   
</div>

<?php foreach ($peserta_pribadi as $key => $value) { ?>

<!-- Modal Edit Peserta Pribadi -->
<div class="modal fade" id="modal-edit<?= $value['id_peserta_p'] ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Peserta Pribadi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('PesertaQurban/UpdatePesertaPribadi/' . $tahun['id_tahun'] . '/' . $value['id_peserta_p']) ?>
                <div class="form-group">
                    <label>Nama Peserta</label>
                    <input name="nama_peserta" class="form-control" value="<?= $value['nama_peserta'] ?>" required>
                </div>
                <div class="form-group">
                    <label>Biaya</label>
                    <input value="<?= $value['biaya'] ?>" min="0" type="number" name="biaya" class="form-control" required>
                </div>
            </div>   
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary">Update</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>   
</div>

<!-- delete kelompok -->
<div class="modal fade" id="delete-peserta<?= $Value['id_peserta_p'] ?>">
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
                <b><?= $value['nama_peserta'] ?></b>
            </div>   
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="<?= base_url('PesertaQurban/DeletePesertaPribadi/' . $tahun['id_tahun'] .'/'.$value['id_peserta_p']) ?>" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>   
</div>

<?php } ?>