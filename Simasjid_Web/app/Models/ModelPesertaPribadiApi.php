<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPesertaPribadiApi extends Model
{
    protected $table = 'tb_peserta_pribadi';
    protected $primaryKey = 'id_peserta_p';
    protected $allowedFields = ['id_tahun', 'nama_peserta', 'biaya'];

    public function getPesertaPribadi($tahun_m)
    {
        if ($tahun_m == 'all') {
            return $this->findAll();
        } else {
            if (!is_array($tahun_m)) {
                $tahun_m = [$tahun_m];
            }

            // Menggunakan JOIN untuk mengambil data peserta pribadi yang sesuai dengan tahun_m
            return $this->select('tb_peserta_pribadi.*')
                ->join('tb_tahun', 'tb_tahun.id_tahun = tb_peserta_pribadi.id_tahun')
                ->whereIn('tb_tahun.tahun_m', $tahun_m)
                ->orderBy('tb_peserta_pribadi.nama_peserta', 'asc')
                ->findAll();
        }
    }
}
