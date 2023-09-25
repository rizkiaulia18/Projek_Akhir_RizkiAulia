<?php


namespace App\Models;

use CodeIgniter\Model;

class ModelSettingApi extends Model
{
    protected $table = 'tb_setting';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_masjid', 'id_kota', 'alamat','rek','logo'];
}