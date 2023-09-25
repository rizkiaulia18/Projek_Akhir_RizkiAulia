<?php

namespace App\Controllers\Api;

use App\Models\ModelPesertaPribadiApi;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class ApiPesertaPribadi extends ResourceController
{
    use ResponseTrait;

    protected $model;

    public function __construct()
    {
        $this->model = new ModelPesertaPribadiApi();
    }

    public function index()
    {
        $tahun_m = $this->request->getVar('tahun_m'); // Ubah id_tahun menjadi tahun_m

        $pesertaPribadi = $this->model->getPesertaPribadi($tahun_m);

        if ($pesertaPribadi) {
            return $this->respond([
                'message' => 'success',
                'peserta_pribadi' => $pesertaPribadi,
            ], 200);
        } else {
            return $this->respond([
                'status' => 'false',
                'message' => 'data tidak ditemukan'
            ], 200);
        }
    }
}
