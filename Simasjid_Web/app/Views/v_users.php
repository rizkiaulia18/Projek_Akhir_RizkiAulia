<div class="col-md-12">
    <div class="card card-secondary">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h class="card-title">Data <?= $judul ?></h>
                <div class="card-tools">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-tambah-user">
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
            <table class="table" id="example1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pengguna</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($users as $user) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $user['nama_users'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td>
                                <button class="btn btn-flat btn-sm btn-danger" data-toggle="modal" data-target="#delete_users<?= $user['id_users'] ?>"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
    <!-- /.card-body -->
</div>


<!-- Modal Tambah User -->
<div class="modal fade" id="modal-tambah-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah <?= $judul ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('Users/InsertData') ?>
                <div class="form-group">
                    <label for="nama_users">Nama Pengguna</label>
                    <input type="text" class="form-control" id="nama_users" name="nama_users" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary">Simpan</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<!-- delete -->
<?php foreach ($users as $key => $value) { ?>
    <div class="modal fade" id="delete_users<?= $value['id_users'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete <?= $judul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Ingin Hapus Data User? <br>
                    <b><?= $value['nama_users'] ?></b>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('Users/DeleteData/' . $value['id_users']) ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div> <!-- /.modal-dialog -->
    </div>
<?php } ?>