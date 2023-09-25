<?php

namespace App\Controllers\Api;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelKasMasjidAPI;
use CodeIgniter\RESTful\ResourceController;

class ApiKasMasjid extends ResourceController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->model = new ModelKasMasjidAPI();
    }

    // Mendapatkan semua data kas masjid
    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond($data);
    }

    // // Mendapatkan data kas masjid berdasarkan id_kas
    // public function show($id_kas = null)
    // {
    //     $data = $this->model->getDataById($id_kas);
    //     if ($data) {
    //         return $this->respond($data);
    //     } else {
    //         return $this->failNotFound('Data kas masjid tidak ditemukan');
    //     }
    // }

    // // Menambah data kas masjid baru
    // public function create()
    // {
    //     $data = $this->request->getPost();
    //     $this->model->insertData($data);
    //     $response = [
    //         'status' => 201,
    //         'error' => null,
    //         'messages' => [
    //             'success' => 'Data kas masjid berhasil ditambahkan'
    //         ]
    //     ];
    //     return $this->respondCreated($response);
    // }

    // // Mengupdate data kas masjid berdasarkan id_kas
    // public function update($id_kas = null)
    // {
    //     $data = $this->request->getRawInput();
    //     $this->model->updateData($id_kas, $data);
    //     $response = [
    //         'status' => 200,
    //         'error' => null,
    //         'messages' => [
    //             'success' => 'Data kas masjid berhasil diupdate'
    //         ]
    //     ];
    //     return $this->respond($response);
    // }

    // // Menghapus data kas masjid berdasarkan id_kas
    // public function delete($id_kas = null)
    // {
    //     $data = $this->model->getDataById($id_kas);
    //     if ($data) {
    //         $this->model->deleteData($id_kas);
    //         $response = [
    //             'status' => 200,
    //             'error' => null,
    //             'messages' => [
    //                 'success' => 'Data kas masjid berhasil dihapus'
    //             ]
    //         ];
    //         return $this->respondDeleted($response);
    //     } else {
    //         return $this->failNotFound('Data kas masjid tidak ditemukan');
    //     }
    // }
}
