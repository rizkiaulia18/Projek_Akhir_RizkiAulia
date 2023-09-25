<div class="col-md-12">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Data Boking Jadwal <?= $judul ?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php
            if (session()->getFlashdata('pesankf')) {
                echo '<div class="alert alert-success">';
                echo session()->getFlashdata('pesankf');
                echo '</div>';
            }
            if (session()->getFlashdata('pesantk')) {
                echo '<div class="alert alert-danger">';
                echo session()->getFlashdata('pesantk');
                echo '</div>';
            }
            ?>
            <table class="table" id="example1">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama User</th>
                        <th>Nama Pengantin</th>
                        <th>No HP/WA</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($nikah as $key => $value) {
                        if ($value['status'] == 'pending') { // Filter data berdasarkan status "pending"
                    ?>
                            <tr>
                                <td>
                                    <?= $value['created_at'] ?>
                                </td>
                                <td>
                                    <?= $value['created_by'] ?>
                                </td>
                                <td>
                                    <?= $value['nama_pengantin_p'] ?> & <?= $value['nama_pengantin_w'] ?>
                                </td>
                                <td><?= $value['no_hp'] ?></td>
                                <td>
                                    <button class="btn btn-flat btn-sm btn-success" data-toggle="modal" data-target="#modal-detail-kf<?= $value['id_nikah'] ?>"><i class="fas fa-eye"></i></button>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<div class="col-md-12">
    <div class="card card-secondary card-outline">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h class="card-title">Jadwal <?= $judul ?></h>
                <div class="card-tools">
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-tambah">
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
            <div id="calendarNikah"></div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- modal tambah -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah <?= $judul ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('Nikah/InsertData') ?>
                <div class="form-group">
                    <label>Nama Pengantin Pria</label>
                    <input type="text" name="pengantin_p" class="form-control" required></input>
                </div>
                <div class="form-group">
                    <label>Nama Pengantin Wanita</label>
                    <input type="text" name="pengantin_w" class="form-control" required></input>
                </div>
                <div class="form-group">
                    <label>Nama Penghulu</label>
                    <input type="text" name="penghulu" class="form-control" required></input>
                </div>
                <div class="form-group">
                    <label>Nama Wali</label>
                    <input type="text" name="wali" class="form-control" required></input>
                </div>
                <div class="form-group">
                    <label>Qori</label>
                    <input type="text" name="qori" class="form-control" required></input>
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" id="tgl_nikah" name="tanggal" class="form-control" required></input>
                </div>
                <div class="form-group">
                    <label>Jam</label>
                    <input type="time" name="jam" class="form-control" required></input>
                </div>
                <input type="text" name="status" value="aktif" hidden></input>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary">Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
</div>

<!-- modal Detail -->
<?php foreach ($nikah as $key => $value) { ?>
    <div class="modal fade" id="modal-detail<?= $value['id_nikah'] ?>">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail <?= $judul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <th>Nama Pengantin</th>
                            <td><?= $value['nama_pengantin_p'] ?> & <?= $value['nama_pengantin_w'] ?></td>
                        </tr>
                        <tr>
                            <th>Nama Penghulu</th>
                            <td><?= $value['nama_penghulu'] ?></td>
                        </tr>
                        <tr>
                            <th>Nama Wali</th>
                            <td><?= $value['nama_wali'] ?></td>
                        </tr>
                        <tr>
                            <th>Qori</th>
                            <td><?= $value['nama_qori'] ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td><?= date('d-m-Y', strtotime($value['tgl_nikah'])) ?></td>
                        </tr>
                        <tr>
                            <th>Jam</th>
                            <td><?= $value['jam_nikah'] ?></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"> Close</i></button>
                    <button class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#modal-edit<?= $value['id_nikah'] ?>"><i class="fas fa-pencil-alt"> Edit</i></button>
                    <button class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#modal-delete<?= $value['id_nikah'] ?>"><i class="fas fa-trash"></i> Hapus</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div> <!-- /.modal-dialog -->
    </div>

    <!-- modal edit -->
    <div class="modal fade" id="modal-edit<?= $value['id_nikah'] ?>">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit <?= $judul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('Nikah/UpdateData/' . $value['id_nikah']) ?>
                    <div class="form-group">
                        <label>Nama Pengantin Pria</label>
                        <input type="text" name="pengantin_p" value="<?= $value['nama_pengantin_p'] ?>" class="form-control" required></input>
                    </div>
                    <div class="form-group">
                        <label>Nama Pengantin Wanita</label>
                        <input type="text" name="pengantin_w" value="<?= $value['nama_pengantin_w'] ?>" class="form-control" required></input>
                    </div>
                    <div class="form-group">
                        <label>Nama Penghulu</label>
                        <input type="text" name="penghulu" value="<?= $value['nama_penghulu'] ?>" class="form-control" required></input>
                    </div>
                    <div class="form-group">
                        <label>Nama Wali</label>
                        <input type="text" name="wali" value="<?= $value['nama_wali'] ?>" class="form-control" required></input>
                    </div>
                    <div class="form-group">
                        <label>Qori</label>
                        <input type="text" name="qori" value="<?= $value['nama_qori'] ?>" class="form-control" required></input>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" value="<?= $value['tgl_nikah'] ?>" class="form-control" required></input>
                    </div>
                    <div class="form-group">
                        <label>Jam</label>
                        <input type="time" name="jam" value="<?= $value['jam_nikah'] ?>" class="form-control" required></input>
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
    <div class="modal fade" id="modal-delete<?= $value['id_nikah'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete <?= $judul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Ingin Hapus Data Nikah ? <br>
                    <b><?= $value['nama_pengantin_p'] ?> & <?= $value['nama_pengantin_w'] ?> </b>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('Nikah/DeleteData/' . $value['id_nikah']) ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div> <!-- /.modal-dialog -->
    </div>

<?php } ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendarNikah');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [
                // Masukkan data nikah dari database ke sini
                <?php foreach ($nikah as $key => $value) {
                    if ($value['status'] == 'aktif') {
                ?> {
                            title: '<?= $value['nama_pengantin_p'] ?> & <?= $value['nama_pengantin_w'] ?>',
                            start: '<?= date('Y-m-d', strtotime($value['tgl_nikah'])) ?>',
                            end: '<?= date('Y-m-d', strtotime($value['tgl_nikah'])) ?>',
                            url: '#modal-detail<?= $value['id_nikah'] ?>', // Ganti dengan URL detail nikah
                            backgroundColor: 'blue'
                        },
                <?php }
                }
                ?>
            ],
            eventClick: function(info) {
                info.jsEvent.preventDefault(); // Menghentikan link default pada event click

                // Tampilkan modal detail nikah
                var targetModal = $(info.el).attr('href');
                $(targetModal).modal('show');
            },
            // dateClick: function(info) {
            //     // Tangkap tanggal yang diklik
            //     var clickedDate = info.date;

            //     // Konversi tanggal menjadi format yang sesuai (misalnya: YYYY-MM-DD)
            //     var formattedDate = clickedDate.toISOString().split('T')[0];

            //     // Set input tanggal di modal tambah
            //     $('#tgl_nikah').val(formattedDate);

            //     // Tampilkan modal tambah
            //     $('#modal-tambah').modal('show');
            // }
            dateClick: function(info) {
                // Tangkap tanggal yang diklik
                var clickedDate = info.date;

                // Tambahkan satu hari ke tanggal yang diklik
                var nextDay = new Date(clickedDate);
                nextDay.setDate(nextDay.getDate() + 1);

                // Konversi tanggal menjadi format yang sesuai (misalnya: YYYY-MM-DD)
                var formattedDate = nextDay.toISOString().split('T')[0];

                // Set input tanggal di modal tambah
                $('#tgl_nikah').val(formattedDate);

                // Tampilkan modal tambah
                $('#modal-tambah').modal('show');
            }

        });
        calendar.render();
    });
</script>


<!-- Modal Komfirmasi Data Nikah -->
<?php foreach ($nikah as $key => $value) { ?>
    <div class="modal fade" id="modal-detail-kf<?= $value['id_nikah'] ?>">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Komfirmasi <?= $judul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <th><?= $value['created_at'] ?> </th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Nama User</th>
                            <td><?= $value['created_by'] ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= $value['email'] ?></td>
                        </tr>
                        <tr>
                            <th>Nama Pengantin</th>
                            <td><?= $value['nama_pengantin_p'] ?> & <?= $value['nama_pengantin_w'] ?></td>
                        </tr>
                        <tr>
                            <th>Nama Penghulu</th>
                            <td><?= $value['nama_penghulu'] ?></td>
                        </tr>
                        </tr>
                        <tr>
                            <th>Nama Orangtua / Wali</th>
                            <td><?= $value['nama_wali'] ?></td>
                        </tr>
                        <tr>
                            <th>Qori</th>
                            <td><?= $value['nama_qori'] ?></td>
                        </tr>
                        <tr>
                            <th>Nomor HP / WA</th>
                            <td><?= $value['no_hp'] ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td><?= date('d-m-Y', strtotime($value['tgl_nikah'])) ?></td>
                        </tr>
                        <tr>
                            <th>Jam</th>
                            <td><?= $value['jam_nikah'] ?></td>
                        </tr>
                        <tr>
                            <th>Bukti Bayar DP</th>
                            <td>
                                <?php if ($value['bukti_dp']) : ?>
                                    <a href="#" data-toggle="modal" data-target="#modal-detail-kfs<?= $value['id_nikah'] ?>">
                                        <img src="<?= base_url('bukti_dp/' . $value['bukti_dp']) ?>" alt="Bukti DP" width="100">
                                    </a>
                                <?php else : ?>
                                    Tidak ada bukti DP
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"> Close</i></button>
                    <a href="<?= base_url('nikah/Komfirmasi/' . $value['id_nikah']) ?>" class="btn btn-primary"><i class="fas fa-check"> Terima</i></a>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal-tolak<?= $value['id_nikah'] ?>"><i class="fas fa-trash"></i> Tolak</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div> <!-- /.modal-dialog -->
    </div>
    <!-- Tambahkan modal untuk alasan penolakan -->
    <div class="modal fade" id="modal-tolak<?= $value['id_nikah'] ?>">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Penolakan <?= $judul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk memasukkan alasan penolakan -->
                    <?= form_open('nikah/Tolak/' . $value['id_nikah']) ?>
                    <div class="form-group">
                        <label for="alasan_tolak">Alasan Penolakan</label>
                        <textarea id="alasan_tolak" name="alasan_tolak" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"> Close</i></button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Tolak</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- Modal Large Gambar -->
    <div class="modal fade" id="modal-detail-kfs<?= $value['id_nikah'] ?>">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Bukti Pembayaran DP</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img src="<?= base_url('bukti_dp/' . $value['bukti_dp']) ?>" alt="Bukti DP" style="max-width: 100%; height: auto;">
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"> Close</i></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div> <!-- /.modal-dialog -->
    </div>
<?php } ?>