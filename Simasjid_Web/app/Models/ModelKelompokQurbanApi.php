<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKelompokQurbanApi extends Model
{
    protected $table = 'tb_kelompok_qurban';
    protected $primaryKey = 'id_kelompok';
    protected $allowedFields = ['id_tahun', 'nama_kelompok'];

    public function getKelompokWithTahun()
    {
        return $this->select('tb_kelompok_qurban.*, tb_tahun.tahun_m')
            ->join('tb_tahun', 'tb_tahun.id_tahun = tb_kelompok_qurban.id_tahun')
            ->findAll();
    }
}
