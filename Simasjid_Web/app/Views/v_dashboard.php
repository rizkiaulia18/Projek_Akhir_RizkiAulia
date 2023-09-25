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

$saldokasmasjid = array_sum($pemasukan) - array_sum($pengeluaran);

?>
<div class="col-lg-3 col-12">
  <!-- small box -->
  <div class="small-box bg-secondary">
    <div class="inner">
      <h4>Saldo Kas Masjid</h4>
      <h3>Rp. <?= number_format($saldokasmasjid) ?>,-</h3>
    </div>
    <div class="icon">
      <i class="fas fa-money-bill-wave"></i>
    </div>
    <a href="<?= base_url('KasMasjid') ?>" class="small-box-footer">Rincian <i class="fas fa-arrow-circle-right"></i></a>
  </div>

  <!-- Small box for "Tempat" -->
  <div class="small-box card card-secondary card-outline">
    <div class="inner">
      <h4>Keterangan Kalender</h4>
      <label>
        <h5><i class="fas fa-circle text-blue"></i> Jadwal Nikah</h5>
      </label><br>
      <label>
        <h5><i class="fas fa-circle text-secondary"></i> Jadwal Agenda</h5>
      </label><br>
      <label>
        <h5><i class="fas fa-circle" style="color:rgb(255,250,223);"></i> Tanggal Hari Ini</h5>
      </label>
    </div>
    <div class="icon">
      <i class="fas fa-exclamation-circle"></i>
    </div>
    <!-- ... Tombol atau tautan lainnya ... -->
  </div>
</div>

<!-- ./col -->
<div class="col-sm-9">
  <div class="card card-secondary">
    <div class="card-header">
      <h3 class="card-title">Jadwal Kegiatan</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div id="calendar"></div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

<!-- modal Detail -->
<?php foreach ($nikah as $key => $value) { ?>
  <div class="modal fade" id="modal-detailNikah<?= $value['id_nikah'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Nikah</h4>
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
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
<?php } ?>

<?php foreach ($agenda as $key => $value) { ?>
  <div class="modal fade" id="modal-detailAgenda<?= $value['id_kegiatan'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Agenda</h4>
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
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
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
            url: '#modal-detailAgenda<?= $value['id_kegiatan'] ?>', // Ganti dengan URL detail agenda
            backgroundColor: 'grey'
          },
        <?php } ?>

        // Masukkan data nikah dari database ke sini
        <?php foreach ($nikah as $key => $value) {
          if ($value['status'] == 'aktif') { ?> {
              title: '<?= $value['nama_pengantin_p'] ?> & <?= $value['nama_pengantin_w'] ?>',
              start: '<?= date('Y-m-d', strtotime($value['tgl_nikah'])) ?>',
              end: '<?= date('Y-m-d', strtotime($value['tgl_nikah'])) ?>',
              url: '#modal-detailNikah<?= $value['id_nikah'] ?>', // Ganti dengan URL detail nikah
              backgroundColor: 'blue' // Ganti warna latar belakang sesuai keinginan
            },
        <?php }
        } ?>
      ],
      eventClick: function(info) {
        info.jsEvent.preventDefault(); // Menghentikan link default pada event click

        // Tampilkan modal detail acara (agenda atau nikah)
        var targetModal = $(info.el).attr('href');
        $(targetModal).modal('show');
      }
    });

    calendar.render();
  });
</script>