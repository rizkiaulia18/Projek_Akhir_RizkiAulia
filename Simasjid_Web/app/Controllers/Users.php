<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAdmin;


class Users extends BaseController
{

    public function __construct()
    {
        $this->ModelLogin = new \App\Models\ModelLogin();
        $this->ModelAdmin = new ModelAdmin();
    }
    public function index()
    {
        $data = [
            'judul' => 'User Admin',
            'menu' => 'user',
            'submenu' => '',
            'page' => 'v_users',
            'users' => $this->ModelLogin->AllData(),
            'setting' => $this->ModelAdmin->ViewSetting(),
        ];
        return view('v_template_admin', $data);
    }

    public function InsertData()
    {
        $data = [
            'nama_users' => $this->request->getPost('nama_users'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'level' => 1, // Ganti level sesuai kebutuhan
        ];
        $this->ModelLogin->InsertData($data);
        session()->setFlashdata('pesan', 'Data Berhasil DiTambahkan !!');
        return redirect()->to(base_url('Users'));
    }
    public function DeleteData($id_users)
    {
        $data = [
            'id_users' => $id_users,
        ];
        $this->ModelLogin->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus !!');
        return redirect()->to(base_url('Users'));
    }
}
