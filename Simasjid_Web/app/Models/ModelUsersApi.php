<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUsersApi extends Model
{
    protected $table = 'tb_users_android';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['nama', 'email', 'created_at'];
}
