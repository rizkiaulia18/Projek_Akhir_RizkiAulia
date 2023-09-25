<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKomentar extends Model
{
    protected $table = 'tb_comment';
    protected $primaryKey = 'id_comment';
    protected $allowedFields = ['content', 'content_admin', 'email', 'created_by', 'created_at', 'created_at_admin', 'status'];

    public function AllData()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }

    public function getCommentById($id_comment)
    {
        return $this->find($id_comment);
    }

    public function ubahData($id_comment, $data)
    {
        return $this->update($id_comment, $data);
    }

    public function DeleteData($id_comment)
    {
        return $this->delete($id_comment);
    }
}
