<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKasMasjidApi extends Model
{
    protected $table = 'tb_kas';
    protected $primaryKey = 'id_kas';
    protected $allowedFields = ['tanggal', 'ket', 'kas_masuk', 'kas_keluar', 'status'];

    // public function getAllData()
    // {
    //     return $this->findAll();
    // }

    // public function getDataById($id_kas)
    // {
    //     return $this->find($id_kas);
    // }

    // public function insertData($data)
    // {
    //     return $this->insert($data);
    // }

    // public function updateData($id_kas, $data)
    // {
    //     return $this->update($id_kas, $data);
    // }

    // public function deleteData($id_kas)
    // {
    //     return $this->delete($id_kas);
    // }

    // public function getAllDataKasMasuk()
    // {
    //     return $this->where('status', 'Masuk')->findAll();
    // }

    // public function getAllDataKasKeluar()
    // {
    //     return $this->where('status', 'Keluar')->findAll();
    // }

    // public function getAllDataBulanan($bulan, $tahun)
    // {
    //     return $this->where('MONTH(tanggal)', $bulan)
    //         ->where('YEAR(tanggal)', $tahun)
    //         ->findAll();
    // }

}
