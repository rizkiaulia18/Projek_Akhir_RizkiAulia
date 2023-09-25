<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTahunApi extends Model
{
    protected $table = 'tb_tahun';
    protected $primaryKey = 'id_tahun';
    protected $allowedFields = ['tahun_h', 'tahun_m'];

}
