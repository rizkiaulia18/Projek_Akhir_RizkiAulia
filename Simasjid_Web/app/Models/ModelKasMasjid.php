<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKasMasjid extends Model
{
    public function AllData()
    {
        return $this->db->table('tb_kas')->orderBy('tanggal', 'DESC')
            ->get()->getResultArray();
    }

    public function AllDataKasMasuk()
    {
        return $this->db->table('tb_kas')
            ->where('status', 'Masuk')->orderBy('tanggal', 'DESC')
            ->get()->getResultArray();
    }

    public function AllDataKasKeluar()
    {
        return $this->db->table('tb_kas')
            ->where('status', 'Keluar')->orderBy('tanggal', 'DESC')
            ->get()->getResultArray();
    }

    public function InsertData($data)
    {
        $this->db->table('tb_kas')->insert($data);
    }

    public function updateData($data)
    {
        $this->db->table('tb_kas')
            ->where('id_kas', $data['id_kas'])
            ->update($data);
    }

    public function DeleteData($data)
    {
        $this->db->table('tb_kas')
            ->where('id_kas', $data['id_kas'])
            ->delete($data);
    }

    public function AllDataBulanan($bulan, $tahun)
    {
        return $this->db->table('tb_kas')
            ->where('month(tanggal)', $bulan)
            ->where('year(tanggal)', $tahun)
            ->get()->getResultArray();
    }
}
