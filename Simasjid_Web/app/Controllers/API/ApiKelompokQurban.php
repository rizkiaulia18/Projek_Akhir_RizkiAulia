<?php
// app/Controllers/Api/ApiKelompokQurban.php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ModelApi;
use App\Models\ModelKelompokQurbanApi;

class ApiKelompokQurban extends ResourceController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->model = new ModelKelompokQurbanApi();
    }

    // GET all data
    public function index()
    {
        $kelompok = $this->model->findAll();

        if ($kelompok) {
            return $this->respond([
                'message' => 'success',
                'kelompok_qurban' => $kelompok
            ], 200);
        } else {
            return $this->respond([
                'status' => 'false',
                'message' => 'data tidak ditemukan'
            ], 200);
        }
    }

    // GET data kelompok berdasarkan tahun
    public function getByYear($tahun)
    {
        // Jika menggunakan parameter berbasis query string, gunakan $this->request->getGet('tahun')
        $kelompok = $this->model->where('id_tahun', $tahun)->findAll();

        if ($kelompok) {
            return $this->respond([
                'message' => 'success',
                'kelompok_qurban' => $kelompok
            ], 200);
        } else {
            return $this->respond([
                'status' => 'false',
                'message' => 'data tidak ditemukan'
            ], 200);
        }
    }

    // GET all data kelompok beserta tahun
    public function getAllKelompokWithTahun()
    {
        $kelompok = $this->model->getKelompokWithTahun();

        if ($kelompok) {
            return $this->respond([
                'message' => 'success',
                'kelompok_qurban_with_tahun' => $kelompok
            ], 200);
        } else {
            return $this->respond([
                'status' => 'false',
                'message' => 'data tidak ditemukan'
            ], 200);
        }
    }
}
