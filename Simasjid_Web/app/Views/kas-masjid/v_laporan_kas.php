<div class="col-md-12">
    <div class="card card-secondary">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h class="card-title">Laporan Kas Masjid</h>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="bulan">Bulan</label>
                        <select name="bulan" id="bulan" class="form-control">
                            <?php
                            $namaBulan = array(
                                1 => "Januari",
                                2 => "Februari",
                                3 => "Maret",
                                4 => "April",
                                5 => "Mei",
                                6 => "Juni",
                                7 => "Juli",
                                8 => "Agustus",
                                9 => "September",
                                10 => "Oktober",
                                11 => "November",
                                12 => "Desember"
                            );

                            for ($bulan = 1; $bulan <= 12; $bulan++) {
                                $selected = ($bulan == date("n")) ? "selected" : "";
                                echo "<option value='$bulan' $selected>$namaBulan[$bulan]</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <div class="col-10 input-group">
                            <select name="tahun" id="tahun" class="form-control">
                                <?php
                                $tahunSekarang = date("Y");
                                for ($tahun = $tahunSekarang; $tahun >= 2000; $tahun--) {
                                    echo "<option value='$tahun'>$tahun</option>";
                                }
                                ?>
                            </select>
                            <span class="input-group-append">
                                <button class="btn btn-primary" onclick="ViewLaporan()">View</button>
                                <button class="btn btn-secondary" onclick="PrintLaporan()">Print</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12" id="printarea" style="display: none;">
                <div class="text-center">
                    <p class="text-center">
                        <h3><b><?= $setting['nama_masjid'] ?></b></h3>
                        <p><?= $setting['alamat'] ?><br>
                            <b>Laporan Kas Masjid</b>
                        </p>
                    </p>
                </div>
                <div class="Tabel">
                    <!-- Tabel laporan kas akan ditampilkan di sini menggunakan JavaScript -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function ViewLaporan() {
        let bulan = $('#bulan').val();
        let tahun = $('#tahun').val();
        if (bulan == '') {
            alert('Bulan belum dipilih');
        } else if (tahun == '') {
            alert('Tahun belum dipilih');
        } else {
            $.ajax({
                type: "POST",
                url: "<?= base_url('KasMasjid/ViewLaporan') ?>",
                data: {
                    bulan: bulan,
                    tahun: tahun,
                },
                dataType: "JSON",
                success: function (response) {
                    if (response.data) {
                        $('.Tabel').html(response.data);
                        $('#printarea').show();
                    }
                }
            });
        }
    }

    function PrintLaporan() {
        var printContent = document.getElementById('printarea').innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    }
</script>
