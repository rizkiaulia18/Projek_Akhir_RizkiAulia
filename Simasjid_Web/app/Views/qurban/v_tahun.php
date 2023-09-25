<div class="col-md-12">
    <div class="card card-secondary">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h class="card-title">Data <?= $judul ?></h>
                <div class="card-tools">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-tambah">
                        <i class="fas fa-plus"></i> <b>Tambah</b>
                    </button>
                </div>
            </div>
        </div>
        <!-- /.card-tools -->
        <!-- /.card-header -->
        <div class="card-body">
            <?php
            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-success">';
                echo session()->getFlashdata('pesan');
                echo '</div>';
            }
            ?>
            <table class="table" id="example1">
                <thead>
                    <tr>
                        <th width="50px">No</th>
                        <th>Tahun</th>
                        <th width="100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($tahun as $key => $value) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <?= $value['tahun_h'] ?> H / <?= $value['tahun_m'] ?> M <?= date('Y') == $value['tahun_m'] ? ' <span class="right badge badge-success">Active</span>' : '' ?>
                            </td>
                            <td>
                                <button class="btn btn-flat btn-sm btn-primary" data-toggle="modal" data-target="#modal-edit<?= $value['id_tahun'] ?>"><i class="fas fa-pencil-alt"></i></button>
                                <button class="btn btn-flat btn-sm btn-danger" data-toggle="modal" data-target="#modal-delete<?= $value['id_tahun'] ?>"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- /.card-body -->
</div>

<!-- modal tambah -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah <?= $judul ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('Tahun/InsertData') ?>
                <div class="form-group">
                    <label>Tahun Hijriah</label>
                    <input type="number" min="1444" value="1444" name="tahun_h" class="form-control" required></input>
                </div>
                <div class="form-group">
                    <label>Tahun Masehi</label>
                    <input type="number" min="1444" value="2023" name="tahun_m" class="form-control" required></input>
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

<?php foreach ($tahun as $key => $value) { ?>
    <!-- modal edit -->
    <div class="modal fade" id="modal-edit<?= $value['id_tahun'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit <?= $judul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('Tahun/UpdateData/' . $value['id_tahun']) ?>
                    <div class="form-group">
                        <label>Tahun Hijriah</label>
                        <input type="number" min="1444" value="<?= $value['tahun_h'] ?>" name="tahun_h" class="form-control" required></input>
                    </div>
                    <div class="form-group">
                        <label>Tahun Masehi</label>
                        <input type="number" min="1444" value="<?= $value['tahun_m'] ?>" name="tahun_m" class="form-control" required></input>
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

    <!-- delete -->
    <div class="modal fade" id="modal-delete<?= $value['id_tahun'] ?>">
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
                    <b>Tahun <?= $value['tahun_h'] ?> H / <?= $value['tahun_m'] ?> M</b>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('Tahun/DeleteData/' . $value['id_tahun']) ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>

<?php } ?>