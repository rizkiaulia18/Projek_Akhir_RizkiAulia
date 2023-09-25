<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAgendaApi extends Model
{
    protected $table = 'tb_agenda';
    protected $primaryKey = 'id_kegiatan';
    protected $allowedFields = ['nama_kegiatan', 'plk_kegiatan', 'tmp_kegiatan', 'tgl_kegiatan', 'wkt_kegiatan'];

    // public function updateAgenda($id, $data)
    // {
    //     $this->db->table($this->table)->where('id_kegiatan', $id)->update($data);
    // }
}

