<div class="col-md-12">
<div class="card card-secondary">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h class="card-title">Data <?= $judul ?></h>
            </div>
        </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table" id="example1" >
            <thead>
                <tr>
                    <th width="50px">No</th>
                    <th>Tahun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; 
                foreach($tahun as $key => $value) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>
                            <?= $value['tahun_h'] ?> H / <?= $value['tahun_m'] ?> M <?= date('Y') == $value['tahun_m'] ? ' <span class="right badge badge-success">Active</span>' : '' ?>
                        </td>
                        <td>
                            <a href="<?= base_url('PesertaQurban/KelompokQurban/' . $value['id_tahun']) ?>" class="btn btn-flat btn-sm btn-primary"><i class="fas fa-layer-group"></i> Kelompok Qurban</a>
                            <a href="<?= base_url('PesertaQurban/PesertaPribadi/' . $value['id_tahun']) ?>" class="btn btn-flat btn-sm btn-success"><i class="fas fa-user-plus"></i>Peserta Pribadi</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
