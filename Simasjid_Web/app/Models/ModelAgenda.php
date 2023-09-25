<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAgenda extends Model
{
    public function AllData()
    {
        return $this->db->table('tb_agenda')
            ->get()->getResultArray();
    }

    public function InsertData($data)
    {
        $this->db->table('tb_agenda')->insert($data);
    }
   
    public function updateData($data)
    {
        $this->db->table('tb_agenda')
            ->where('id_kegiatan', $data['id_kegiatan'])
            ->update($data);
    }
    
    public function DeleteData($data)
    {
        $this->db->table('tb_agenda')
            ->where('id_kegiatan', $data['id_kegiatan'])
            ->delete($data);
    }
}
