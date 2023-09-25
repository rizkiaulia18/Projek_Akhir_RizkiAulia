<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelNikahApi extends Model
{
    protected $table = 'tb_nikah';
    protected $primaryKey = 'id_nikah';
    protected $allowedFields = [
        'nama_pengantin_p',
        'nama_pengantin_w',
        'nama_penghulu',
        'nama_wali',
        'nama_qori',
        'no_hp',
        'tgl_nikah',
        'jam_nikah',
        'bukti_dp',
        'status',
        'email', 
        'created_by', 
        'created_at'
    ];

    protected $useAutoIncrement = true; // Tambahkan baris ini untuk menggunakan auto-increment pada primary key
}
