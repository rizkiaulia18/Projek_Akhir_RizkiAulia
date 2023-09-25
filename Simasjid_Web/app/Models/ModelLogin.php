<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLogin extends Model
{
    public function CekUser($email){
        return $this->db->table('tb_users')
        ->where('email', $email)
        ->get()->getRowArray();
    }
    
    public function AllData()
    {
        return $this->db->table('tb_users')
            ->get()->getResultArray();
    }
    protected $table = 'tb_users';
    public function InsertData($data)
    {
        // Hash password sebelum disimpan
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        return $this->db->table($this->table)->insert($data);
    }

    public function DeleteData($data)
    {
        $this->db->table('tb_users')
            ->where('id_users', $data['id_users'])
            ->delete($data);
    }
}
