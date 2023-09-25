
<div class="col-md-12">
<div class="card card-secondary">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h class="card-title">Laporan Qurban</h>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Jenis Qurban</label>
                        <div class="input-group">
                            <select name="jenis_peserta" id="jenis_peserta" class="form-control">
                                <option value="">--Pilih Jenis Peserta--</option>
                                <option value="pribadi">Peserta Pribadi</option>
                                <option value="kelompok">Peserta Kelompok</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tahun</label>
                        <div class="col-10 input-group">
                            <select name="tahun" id="tahun" class="form-control">
                                <option value="">--Pilih Tahun--</option>
                                <?php foreach ($tahun as $row) { ?>
                                    <option value="<?= $row['id_tahun']; ?>"><?= $row['tahun_h'] . " H / " . $row['tahun_m'] . " M"; ?></option>
                                <?php } ?>
                            </select>
                            <span class="input-group-append">
                                <button class="btn btn-primary" onclick="ViewLaporan()">Tampilkan</button>
                                <button class="btn btn-secondary" onclick="PrintLaporan()"><i class="fas fa-print"></i> Cetak</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12" id="printarea_pribadi" style="display: none;">
                <div class="text-center">
                    <p class="text-center">
                        <h3><b><?= $setting['nama_masjid'] ?></b></h3>
                        <p><?= $setting['alamat'] ?><br>
                            <b>Laporan Qurban - Peserta Pribadi</b>
                        </p>
                    </p>
                </div>
                <div class="TabelPribadi">
                    <!-- Tabel laporan qurban peserta pribadi akan ditampilkan disini menggunakan JavaScript -->
                </div>
            </div>

            <div class="col-sm-12" id="printarea_kelompok" style="display: none;">
                <div class="text-center">
                    <p class="text-center">
                        <h3><b><?= $setting['nama_masjid'] ?></b></h3>
                        <p><?= $setting['alamat'] ?><br>
                            <b>Laporan Qurban - Peserta Kelompok</b>
                        </p>
                    </p>
                </div>
                <div class="TabelKelompok">
                    <!-- Tabel laporan qurban peserta kelompok akan ditampilkan disini menggunakan JavaScript -->
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // Fungsi JavaScript untuk memuat dan menampilkan data tabel peserta pribadi
    function ViewLaporanPribadi() {
        let tahun = $('#tahun').val();
        if (tahun == '') {
            alert('Tahun belum dipilih');
        } else {
            $.ajax({
                type: "POST",
                url: "<?= base_url('PesertaQurban/ViewLaporanPribadi') ?>",
                data: {
                    tahun: tahun,
                },
                dataType: "JSON",
                success: function (response) {
                    if (response.data) {
                        $('.TabelPribadi').html(response.data);
                    }
                }
            });
        }
    }

    // Fungsi JavaScript untuk memuat dan menampilkan data tabel peserta kelompok
    function ViewLaporanKelompok() {
        let tahun = $('#tahun').val();
        if (tahun == '') {
            alert('Tahun belum dipilih');
        } else {
            $.ajax({
                type: "POST",
                url: "<?= base_url('PesertaQurban/ViewLaporanKelompok') ?>",
                data: {
                    tahun: tahun,
                },
                dataType: "JSON",
                success: function (response) {
                    if (response.data) {
                        $('.TabelKelompok').html(response.data);
                    }
                }
            });
        }
    }

    // Fungsi JavaScript untuk memuat dan menampilkan data tabel sesuai dengan jenis peserta yang dipilih
    function ViewLaporan() {
        let jenisPeserta = $('#jenis_peserta').val();
        if (jenisPeserta === 'pribadi') {
            $('#printarea_pribadi').show();
            $('#printarea_kelompok').hide();
            ViewLaporanPribadi();
        } else if (jenisPeserta === 'kelompok') {
            $('#printarea_kelompok').show();
            $('#printarea_pribadi').hide();
            ViewLaporanKelompok();
        } else {
            $('#printarea_kelompok').hide();
            $('#printarea_pribadi').hide();
        }
    }

    // Fungsi JavaScript untuk mencetak laporan
    // function PrintLaporan() {
    //     var print = document.getElementById('printarea_kelompok').style.display === 'block' ? document.getElementById('printarea_kelompok') : document.getElementById('printarea_pribadi');
    //     newWin = window.open('', 'newWin', 'toolbar=no, width=1500, height=800, scrollbars=yes');
    //     newWin.document.write(print.innerHTML);
    //     newWin.document.close();
    //     newWin.focus();
    //     newWin.print();
    //     newWin.close();
    // }
    function PrintLaporan() {
        var printContent = '';
        var jenisPeserta = $('#jenis_peserta').val();
        if (jenisPeserta === 'pribadi') {
            printContent += document.getElementById('printarea_pribadi').innerHTML;
        } else if (jenisPeserta === 'kelompok') {
            printContent += document.getElementById('printarea_kelompok').innerHTML;
        } else {
            // Tampilkan pesan jika belum memilih jenis peserta
            alert('Pilih jenis peserta terlebih dahulu');
            return;
        }

        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    }
    // function PrintLaporan() {
    //     var print = document.getElementById('printarea_pribadi').style.display === 'block' ? document.getElementById('printarea_pribadi') : document.getElementById('printarea_kelompok');
    //     var printContent = print.innerHTML;
    //     var originalContent = document.body.innerHTML;
    //     newWindocument.body.innerHTML = printContent;
    //     window.print();
    //     document.body.innerHTML = originalContent;
    // }
</script>
<!-- ... (kode HTML lainnya) ... -->
