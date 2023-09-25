<div class="col-md-12">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Kalender <?= $judul ?></h3>

            <!-- /.card-tools -->
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
                        url: '#modal-detail<?= $value['id_kegiatan'] ?>' // Ganti dengan URL detail agenda
                    },
                <?php } ?>
            ],
            eventClick: function(info) {
                info.jsEvent.preventDefault(); // Menghentikan link default pada event click

                // Tampilkan modal detail agenda
                var targetModal = $(info.el).attr('href');
                $(targetModal).modal('show');
            }
        });

        calendar.render();
    });
</script>