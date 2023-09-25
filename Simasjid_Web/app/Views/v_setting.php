<div class="col-md-12">
    <div class="card card-secondary">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h class="card-title"><?= $judul ?></h>
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
            <?php echo form_open_multipart('Admin/UpdateSetting') ?>
            <div class="form-group">
                <label>Nama Masjid</label>
                <input name="nama_masjid" value="<?= $setting['nama_masjid'] ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Kab/Kota</label>
                <select name="id_kota" class="form-control select2">
                    <?php foreach ($kota as $key => $kota) { ?>
                        <option value="<?= $kota['id'] ?>" <?= $kota['id'] == $setting['id_kota'] ? 'selected' : '' ?>><?= $kota['lokasi'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input name="alamat" value="<?= $setting['alamat'] ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Rekening Bank</label>
                <input name="rek" value="<?= $setting['rek'] ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Logo</label>
                <input type="file" name="logo" id="preview_gambar" value="" class="form-control" accept="image/*">
            </div>
            <div class="col-sm-6">
                <label>Preview Logo</label>
                <div class="form-group">
                    <img src="<?= base_url('logo/' . $setting['logo']) ?>" id="gambar_load" height="200">
                </div>
            </div>
            <button class="btn btn-secondary">Simpan</button>
            <?php echo form_close() ?>

        </div>
    </div>
</div>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
    });

    function bacaGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#gambar_load').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#preview_gambar').change(function() {
        bacaGambar(this);
    });
</script>