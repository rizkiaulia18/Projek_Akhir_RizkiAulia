<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPesertaQurban extends Model
{
    public function AllDataKelompok($id_tahun)
    {
        return $this->db->table('tb_kelompok_qurban')
            ->where('id_tahun', $id_tahun)
            ->get()->getResultArray();
    }

    public function InsertKelompok($data)
    {
        $this->db->table('tb_kelompok_qurban')->insert($data);
    }

    public function DeleteKelompok($data)
    {
        $this->db->table('tb_kelompok_qurban')
            ->where('id_kelompok', $data['id_kelompok'])
            ->delete($data);
    }

    public function InsertPeserta($data)
    {
        $this->db->table('tb_peserta_kelompok')->insert($data);
    }

    public function DeletePeserta($data)
    {
        $this->db->table('tb_peserta_kelompok')
            ->where('id_peserta', $data['id_peserta'])
            ->delete($data);
    }
    public function AllDataPribadi($id_tahun)
    {
        return $this->db->table('tb_peserta_pribadi')
            ->where('id_tahun', $id_tahun)
            ->get()->getResultArray();
    }

    public function InsertPesertaPribadi($data)
    {
        $this->db->table('tb_peserta_pribadi')->insert($data);
    }

    public function DeletePesertaPribadi($data)
    {
        $this->db->table('tb_peserta_pribadi')
            ->where('id_peserta_p', $data['id_peserta_p'])
            ->delete($data);
    }

    public function UpdatePesertaPribadi($id_peserta_p, $data)
    {
        $this->db->table('tb_peserta_pribadi')
            ->where('id_peserta_p', $id_peserta_p)
            ->update($data);
    }

    public function AllDataLaporanPribadi($id_tahun)
    {
        return $this->db->table('tb_peserta_pribadi')
            ->join('tb_tahun', 'tb_peserta_pribadi.id_tahun = tb_tahun.id_tahun')
            ->where('tb_tahun.id_tahun', $id_tahun)
            ->get()->getResultArray();
    }

    public function AllDataLaporanKelompok($id_tahun)
    {
        return $this->db->table('tb_peserta_kelompok')
            ->join('tb_kelompok_qurban', 'tb_peserta_kelompok.id_kelompok = tb_kelompok_qurban.id_kelompok')
            ->join('tb_tahun', 'tb_kelompok_qurban.id_tahun = tb_tahun.id_tahun')
            ->where('tb_tahun.id_tahun', $id_tahun)
            ->select('tb_peserta_kelompok.*, tb_kelompok_qurban.nama_kelompok')
            ->get()->getResultArray();
    }
}
