<?php

namespace App\Controllers\Api;

use App\Models\ModelUsersApi;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class ApiUsers extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model = new ModelUsersApi();
        $users = $model->findAll();

        return $this->respond($users);
    }
    public function show($email = null)
    {
        $model = new ModelUsersApi();

        if ($email === null) {
            return $this->fail('Email tidak boleh kosong');
        }

        $user = $model->where('email', $email)->first();

        if ($user) {
            return $this->respond($user);
        } else {
            return $this->fail('Pengguna tidak ditemukan');
        }
    }

    public function create()
    {
        $model = new ModelUsersApi();

        $rules = [
            'nama' => 'required',
            'email' => 'required|valid_email'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email')
        ];

        $model->insert($data);

        return $this->respondCreated([
            'status'   => 201,
            'error' => false, 'message' => 'Pengguna berhasil dibuat'
        ]);
    }

    // Tambahkan method CRUD lain sesuai kebutuhan (update, delete, dll.)
}
