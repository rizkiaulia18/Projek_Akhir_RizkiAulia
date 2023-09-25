<?php

namespace App\Controllers;

use App\Models\ModelLogin;
use App\Models\ModelAdmin;
use App\Controllers\BaseController;
class Login extends BaseController
{
    protected $ModelLogin;
    public function __construct()
    {
        $this->ModelLogin = new ModelLogin();
        $this->ModelAdmin = new ModelAdmin();
    }
    public function index()
    {   
        $data = [
            'judul' => 'Login',
            'validation' => \Config\Services::validation(),
            'setting' => $this->ModelAdmin->ViewSetting(),

        ];
        return view('v_login', $data);
    }
    public function CekLogin(){
        if ($this->validate([
            'email' => [
                'label' => 'E-mail',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Belum Diisi',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [ 
                    'required' => '{field} Belum Diisi',
                ]
            ]
        ])) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $CekLogin = $this->ModelLogin->CekUser($email);
            if ($CekLogin && password_verify($password, $CekLogin['password'])) {
                session()->set('nama_users', $CekLogin['nama_users']);
                session()->set('level', $CekLogin['level']);
                return redirect()->to(base_url('Admin'));
            } else{
                session()->setFlashdata('gagal', 'Email Atau Password Salah');
                return redirect()->to(base_url('Login'));
            }
        } else{
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Login'))->withInput('validation', \Config\Services::validation());
        }
    }
    public function LogOut(){
        session()->remove('nama_users');
        session()->remove('level');
        session()->setFlashdata('pesan', 'Anda Berhasil Logout');
        return redirect()->to(base_url('Login'));
    }


}
