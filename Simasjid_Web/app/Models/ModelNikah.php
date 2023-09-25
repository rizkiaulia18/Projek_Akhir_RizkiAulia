<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelNikah extends Model
{
    protected $table = 'tb_nikah';
    public function AllData()
    {
        return $this->db->table('tb_nikah')
            ->get()->getResultArray();
    }

    public function InsertData($data)
    {
        $this->db->table('tb_nikah')->insert($data);
    }

    public function updateData($data)
    {
        $this->db->table('tb_nikah')
            ->where('id_nikah', $data['id_nikah'])
            ->update($data);
    }

    // public function DeleteData($data)
    // {
    //     $this->db->table('tb_nikah')
    //         ->where('id_nikah', $data['id_nikah'])
    //         ->delete($data);
    // }
    public function DeleteData($id_nikah)
    {
        $this->db->table('tb_nikah')
            ->where('id_nikah', $id_nikah)
            ->delete();
    }

    public function getDataById($id_nikah)
    {
        return $this->where('id_nikah', $id_nikah)->first();
    }
}
