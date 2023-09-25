<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAgenda;
use App\Models\ModelAdmin;

class Agenda extends BaseController
{
    protected $ModelAgenda;
    public function __construct()
    {
        $this->ModelAgenda = new ModelAgenda();
        $this->ModelAdmin = new ModelAdmin();
    }

    public function index()
    {
        $data = [
            'judul' => 'Agenda',
            'sub-judul' => '',
            'menu' => 'agenda',
            'submenu' => '',
            'page' => 'v_agenda',
            'agenda' => $this->ModelAgenda->AllData(),
            'setting' => $this->ModelAdmin->ViewSetting(),
        ];
        return view('v_template_admin', $data);
    }

    public function InsertData()
    {
        $data = [
            'nama_kegiatan' => $this->request->getPost('nama_kegiatan'),
            'plk_kegiatan' => $this->request->getPost('pelaksana_kegiatan'),
            'tmp_kegiatan' => $this->request->getPost('tempat_kegiatan'),
            'tgl_kegiatan' => $this->request->getPost('tanggal_kegiatan'),
            'wkt_kegiatan' => $this->request->getPost('jam_kegiatan'),
        ];
        $this->ModelAgenda->InsertData($data);
        session()->setFlashdata('pesan', 'Data Berhasil DiTambahkan !!');
        return redirect()->to(base_url('Agenda'));
    }

    public function UpdateData($id_kegiatan)
    {
        $data = [
            'id_kegiatan' => $id_kegiatan,
            'nama_kegiatan' => $this->request->getPost('nama_kegiatan'),
            'plk_kegiatan' => $this->request->getPost('pelaksana_kegiatan'),
            'tmp_kegiatan' => $this->request->getPost('tempat_kegiatan'),
            'tgl_kegiatan' => $this->request->getPost('tanggal_kegiatan'),
            'wkt_kegiatan' => $this->request->getPost('jam_kegiatan'),
        ];
        $this->ModelAgenda->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil DiUbah !!');
        return redirect()->to(base_url('Agenda'));
    }

    public function DeleteData($id_kegiatan)
    {
        $data = [
            'id_kegiatan' => $id_kegiatan,
        ];
        $this->ModelAgenda->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus !!');
        return redirect()->to(base_url('Agenda'));
    }
}
