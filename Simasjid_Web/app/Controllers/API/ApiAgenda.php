<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ModelAgendaApi;

class ApiAgenda extends ResourceController
{
    use ResponseTrait;
    // all users
    public function index()
    {
        $model = new ModelAgendaApi();
        $data = $model->orderBy('id_kegiatan', 'DESC')->findAll();
        return $this->respond($data, 200);
    }
    // create
    public function create()
    {
        $model = new ModelAgendaApi();

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'nama_kegiatan' => 'required',
            'plk_kegiatan' => 'required',
            'tmp_kegiatan' => 'required',
            'tgl_kegiatan' => 'required',
            'wkt_kegiatan' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $response = [
                'status' => 400,
                'error' => $validation->getErrors(),
                'messages' => null
            ];
            return $this->respond($response, 400);
        }

        $data = [
            'nama_kegiatan' => $this->request->getVar('nama_kegiatan'),
            'plk_kegiatan' => $this->request->getVar('plk_kegiatan'),
            'tmp_kegiatan' => $this->request->getVar('tmp_kegiatan'),
            'tgl_kegiatan' => $this->request->getVar('tgl_kegiatan'),
            'wkt_kegiatan' => $this->request->getVar('wkt_kegiatan')
        ];

        $model->insert($data);


        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Data Agenda berhasil ditambahkan.'
            ]
        ];

        return $this->respondCreated($response);
    }
    // single user
    public function show($id = null)
    {
        $model = new ModelAgendaApi();
        $data = $model->where('id_kegiatan', $id)->findAll();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    }
    
   

    // delete
    public function delete($id = null)
    {
        $model = new ModelAgendaApi();
    
        // Cek apakah data dengan ID yang diberikan ada dalam database
        $data = $model->find($id);
        if (!$data) {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    
        $deleted = $model->delete($id);
    
        if ($deleted) {
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => 'Data agenda berhasil dihapus.'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            $response = [
                'status' => 500,
                'error' => 'FailedToDelete',
                'messages' => [
                    'error' => 'Gagal menghapus data agenda.'
                ]
            ];
            return $this->respond($response, 500);
        }
    }
    
}
