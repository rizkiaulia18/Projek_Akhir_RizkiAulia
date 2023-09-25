<?php

namespace App\Controllers\Api;

use App\Models\ModelTahunApi;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class ApiTahun extends ResourceController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->model = new ModelTahunApi();
    }

    // GET all data
    public function index()
    {
        // Ambil nilai tahun_h dari query string
        $tahun_h = $this->request->getVar('tahun_h');

        // Jika tahun_h tidak ada dalam query string, ambil semua data tahun
        if (empty($tahun_h)) {
            $tahun = $this->model->findAll();
            return $this->respond($tahun);
        }

        // Jika tahun_h ada dalam query string, ambil data tahun berdasarkan tahun_h
        $tahun = $this->model->where('tahun_h', $tahun_h)->findAll();

        if ($tahun) {
            return $this->respond([
                'message' => 'success',
                'tahun' => $tahun
            ], 200);
        } else {
            return $this->respond([
                'status' => 'false',
                'message' => 'data tidak ditemukan'
            ], 200);
        }
    }
}
