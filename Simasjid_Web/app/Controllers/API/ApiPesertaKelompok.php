<?php

namespace App\Controllers\Api;

use App\Models\ModelPesertaKelompokApi;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class ApiPesertaKelompok extends ResourceController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->model = new ModelPesertaKelompokApi();
    }

    // GET all data peserta kelompok
    public function index()
    {   
        $id_kelompok = $this->request->getVar('id_kelompok');
        $pesertaKelompok = $this->model->getPesertaKelompok($id_kelompok);

        if ($pesertaKelompok) {
            return $this->respond([
                'message' => 'success',
                'peserta_kelompok' => $pesertaKelompok
            ], 200);
        } else {
            return $this->respond([
                'status' => 'false',
                'message' => 'data tidak ditemukan'
            ], 200);
        }
    }

}