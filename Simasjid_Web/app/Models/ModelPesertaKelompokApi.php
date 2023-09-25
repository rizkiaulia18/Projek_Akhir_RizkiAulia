<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPesertaKelompokApi extends Model
{
    protected $table = 'tb_peserta_kelompok';
    protected $primaryKey = 'id_peserta';
    protected $allowedFields = ['id_kelompok', 'nama_peserta', 'biaya'];

    public function getPesertaKelompok($id_kelompok)
    {
        if ($id_kelompok == 'all') {
            return $this->findAll();
        } else {
            if (!is_array($id_kelompok)) {
                $id_kelompok = [$id_kelompok];
            }

            return $this->whereIn('id_kelompok', $id_kelompok)->orderBy('nama_peserta', 'asc')->findAll();
        }
    }
}
