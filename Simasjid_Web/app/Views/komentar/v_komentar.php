<div class="col-md-12">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Data <?= $judul ?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php
            if (session()->getFlashdata('pesanBerhasil')) {
                echo '<div class="alert alert-success">';
                echo session()->getFlashdata('pesanBerhasil');
                echo '</div>';
            } else if (session()->getFlashdata('pesanHapus')) {
                echo '<div class="alert alert-danger">';
                echo session()->getFlashdata('pesanHapus');
                echo '</div>';
            }
            ?>
            <table class="table" id="example1">
                <thead>
                    <tr>
                        <th width="50px">No</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Isi Komentar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $belumDibalas = array();
                    $sudahDibalas = array();

                    foreach ($comment as $comments) {
                        if ($comments['status'] == 'belum') {
                            $belumDibalas[] = $comments;
                        } else {
                            $sudahDibalas[] = $comments;
                        }
                    }

                    foreach ($belumDibalas as $comments) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= date('d-m-Y H:i:s', strtotime($comments['created_at'])) ?></td>
                            <td><?= $comments['created_by'] ?></td>
                            <td><?= $comments['email'] ?></td>
                            <td>
                                <?php
                                $maxChar = 20;
                                $content = $comments['content'];
                                if (strlen($content) > $maxChar) {
                                    $trimmedContent = substr($content, 0, $maxChar) . '...';
                                    echo htmlspecialchars($trimmedContent);
                                } else {
                                    echo htmlspecialchars($content);
                                }
                                ?>
                            </td>
                            <td><span class="right badge badge-warning"><?= $comments['status'] ?></span></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#modalBalas<?= $comments['id_comment'] ?>"><i class="fas fa-comment"></i> Balas</button>
                                <button class="btn btn-sm btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#modal-delete<?= $comments['id_comment'] ?>"><i class="fas fa-trash"></i> Hapus</button>
                            </td>
                        </tr>
                    <?php
                    }

                    foreach ($sudahDibalas as $comments) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= date('d-m-Y H:i:s', strtotime($comments['created_at'])) ?></td>
                            <td><?= $comments['created_by'] ?></td>
                            <td><?= $comments['email'] ?></td>
                            <td>
                                <?php
                                $maxChar = 20;
                                $content = $comments['content'];
                                if (strlen($content) > $maxChar) {
                                    $trimmedContent = substr($content, 0, $maxChar) . '...';
                                    echo htmlspecialchars($trimmedContent);
                                } else {
                                    echo htmlspecialchars($content);
                                }
                                ?>
                            </td>
                            <td><span class="right badge badge-success"><?= $comments['status'] ?></span></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#modalBalas<?= $comments['id_comment'] ?>"><i class="fas fa-comment"></i> Balas</button>
                                <button class="btn btn-sm btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#modal-delete<?= $comments['id_comment'] ?>"><i class="fas fa-trash"></i> Hapus</button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<?php foreach ($comment as $comments) { ?>
    <!-- Modal Balas Komentar -->
    <div class="modal fade" id="modalBalas<?= $comments['id_comment'] ?>" tabindex="-1" aria-labelledby="modalBalasLabel<?= $comments['id_comment'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalBalasLabel<?= $comments['id_comment'] ?>">Balas Komentar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('Komentar/SimpanBalasan/' . $comments['id_comment']) ?>
                    <table class="table border-bottom">
                        <tr>
                            <th>Nama</th>
                            <td><?= $comments['created_by'] ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= $comments['email'] ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td><?= $comments['created_at'] ?></td>
                        </tr>
                    </table>
                    <div class="form-group">
                        <label>Komentar</label>
                        <textarea class="form-control" rows="3" readonly><?= $comments['content'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="isi_balasan">Isi Balasan</label>
                        <textarea class="form-control" id="isi_balasan" name="isi_balasan" rows="3" required><?= $comments['content_admin'] ?></textarea>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-secondary">Kirim Balasan</button>
                    </div>

                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>

    <!-- delete -->
    <div class="modal fade" id="modal-delete<?= $comments['id_comment'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete <?= $judul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Ingin Hapus Data Komentar ? <br>
                    <b><?= $comments['created_by'] ?></b>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('Komentar/HapusKomentar/' . $comments['id_comment']) ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div> <!-- /.modal-dialog -->
    </div>
<?php } ?>