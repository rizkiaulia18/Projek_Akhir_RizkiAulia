<div class="col-sm-12">
    <div class="card card-secondary card-outline">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">Data <?= $judul ?></h3>
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
            <div id="calendar"></div>
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
                <?= form_open('Agenda/InsertData') ?>
                <div class="form-group">
                    <label>Nama Kegiatan</label>
                    <textarea rows="6" name="nama_kegiatan" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label>Pelaksana Kegiatan</label>
                    <input type="text" name="pelaksana_kegiatan" class="form-control" required></input>
                </div>
                <div class="form-group">
                    <label>Tempat Kegiatan</label>
                    <input type="text" name="tempat_kegiatan" class="form-control" required></input>
                </div>
                <div class="form-group">
                    <label>Tanggal Kegiatan</label>
                    <input type="date" id="tanggal_kegiatan" name="tanggal_kegiatan" class="form-control" required></input>
                </div>
                <div class="form-group">
                    <label>Jam Kegiatan</label>
                    <input type="time" name="jam_kegiatan" class="form-control" required></input>
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

<!-- modal Detail -->
<?php foreach ($agenda as $key => $value) { ?>
    <div class="modal fade" id="modal-detail<?= $value['id_kegiatan'] ?>">
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
                            <th>Nama Kegiatan</th>
                            <td><?= $value['nama_kegiatan'] ?></td>
                        </tr>
                        <tr>
                            <th>Pelaksana Kegiatan</th>
                            <td><?= $value['plk_kegiatan'] ?></td>
                        </tr>
                        </tr>
                        <tr>
                            <th>Tempat Kegiatan</th>
                            <td><?= $value['tmp_kegiatan'] ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td><?= date('d-m-Y', strtotime($value['tgl_kegiatan'])) ?></td>
                        </tr>
                        <tr>
                            <th>Jam</th>
                            <td><?= $value['wkt_kegiatan'] ?></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"> Close</i></button>
                    <button class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#modal-edit<?= $value['id_kegiatan'] ?>"><i class="fas fa-pencil-alt"> Edit</i></button>
                    <button class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#modal-delete<?= $value['id_kegiatan'] ?>"><i class="fas fa-trash"></i> Hapus</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div> <!-- /.modal-dialog -->
    </div>

    <!-- modal edit -->
    <div class="modal fade" id="modal-edit<?= $value['id_kegiatan'] ?>">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit <?= $judul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('Agenda/UpdateData/' . $value['id_kegiatan']) ?>
                    <div class="form-group">
                        <label>Nama Kegiatan</label>
                        <textarea rows="6" name="nama_kegiatan" class="form-control" required><?= $value['nama_kegiatan'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Pelaksana Kegiatan</label>
                        <input type="text" name="pelaksana_kegiatan" value="<?= $value['plk_kegiatan'] ?>" class="form-control" required></input>
                    </div>
                    <div class="form-group">
                        <label>Tempat Kegiatan</label>
                        <input type="text" name="tempat_kegiatan" value="<?= $value['tmp_kegiatan'] ?>" class="form-control" required></input>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Kegiatan</label>
                        <input type="date" name="tanggal_kegiatan" value="<?= $value['tgl_kegiatan'] ?>" class="form-control" required></input>
                    </div>
                    <div class="form-group">
                        <label>Jam Kegiatan</label>
                        <input type="time" name="jam_kegiatan" value="<?= $value['wkt_kegiatan'] ?>" class="form-control" required></input>
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
    <div class="modal fade" id="modal-delete<?= $value['id_kegiatan'] ?>">
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
                    <b><?= $value['nama_kegiatan'] ?></b>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('Agenda/DeleteData/' . $value['id_kegiatan']) ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div> <!-- /.modal-dialog -->
    </div>
<?php } ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [
                // Masukkan data agenda dari database ke sini
                <?php foreach ($agenda as $key => $value) { ?> {
                        title: '<?= $value['nama_kegiatan'] ?>',
                        start: '<?= date('Y-m-d', strtotime($value['tgl_kegiatan'])) ?>',
                        end: '<?= date('Y-m-d', strtotime($value['tgl_kegiatan'])) ?>',
                        url: '#modal-detail<?= $value['id_kegiatan'] ?>', // Ganti dengan URL detail agenda
                        backgroundColor: 'grey'
                    },
                <?php } ?>
            ],
            eventClick: function(info) {
                info.jsEvent.preventDefault(); // Menghentikan link default pada event click

                // Tampilkan modal detail agenda
                var targetModal = $(info.el).attr('href');
                $(targetModal).modal('show');
            },
            dateClick: function(info) {
                // Tangkap tanggal yang diklik
                var clickedDate = info.date;

                // Tambahkan satu hari ke tanggal yang diklik
                var nextDay = new Date(clickedDate);
                nextDay.setDate(nextDay.getDate() + 1);

                // Konversi tanggal menjadi format yang sesuai (misalnya: YYYY-MM-DD)
                var formattedDate = nextDay.toISOString().split('T')[0];

                // Set input tanggal di modal tambah
                $('#tanggal_kegiatan').val(formattedDate);

                // Tampilkan modal tambah
                $('#modal-tambah').modal('show');
            }
        });

        calendar.render();
    });
</script>

