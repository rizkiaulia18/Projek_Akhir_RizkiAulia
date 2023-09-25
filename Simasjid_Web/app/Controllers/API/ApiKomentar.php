<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\ModelKomentar;

class ApiKomentar extends BaseController
{
    protected $modelKomentar;

    public function __construct()
    {
        $this->modelKomentar = new ModelKomentar();
    }

    public function index()
    {
        $comments = $this->modelKomentar->AllData();
        return $this->response->setJSON($comments);
    }

    public function getByEmail()
    {
        $email = $this->request->getGet('email'); // Ambil parameter email dari URL
        $model = new ModelKomentar();

        if ($email) {
            $data = $model->where('email', $email)->findAll();
        } else {
            $data = $model->findAll();
        }

        return $this->response->setJSON($data);
    }
    // public function getByEmailAndTo()
    // {
    //     $email = $this->request->getGet('email'); // Ambil parameter email dari URL
    //     $to = $this->request->getGet('to_email'); // Ambil parameter to dari URL
    //     $model = new ModelKomentar();

    //     if ($email && $to) {
    //         $data = $model
    //             ->where('email', $email)
    //             ->orWhere('to_email', $to)
    //             ->orderBy('created_at', 'DESC')
    //             ->findAll();
    //     } elseif ($email) {
    //         $data = $model
    //             ->where('email', $email)
    //             ->orderBy('created_at', 'DESC')
    //             ->findAll();
    //     } elseif ($to) {
    //         $data = $model
    //             ->where('to_email', $to)
    //             ->orderBy('created_at', 'DESC')
    //             ->findAll();
    //     } else {
    //         $data = $model->findAll();
    //     }

    //     return $this->response->setJSON($data);
    // }


    public function create()
    {
        $model = new ModelKomentar();
        $model->insert([
            'content' => esc($this->request->getPost('content')),
            'email' => esc($this->request->getPost('email')),
            'created_by' => esc($this->request->getPost('created_by')),
            'status' => 'belum' // default status
        ]);

        $response = [
            'status'   => 201,
            'error' => false,
            'message' => 'Komentar berhasil ditambahkan.',
        ];
        return $this->response->setJSON($response);
    }
}
