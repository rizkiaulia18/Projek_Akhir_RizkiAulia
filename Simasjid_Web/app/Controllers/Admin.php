<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAdmin;
use App\Models\ModelAgenda;
use App\Models\ModelKasMasjid;
use App\Models\ModelNikah;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->ModelAdmin = new ModelAdmin();
        $this->ModelKasMasjid = new ModelKasMasjid();
        $this->ModelAgenda = new ModelAgenda();
        $this->ModelNikah = new ModelNikah();
    }

    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'menu' => 'dashboard',
            'submenu' => '',
            'page' => 'v_dashboard',
            'agenda' => $this->ModelAgenda->AllData(),
            'kas' => $this->ModelKasMasjid->AllData(),
            'nikah' => $this->ModelNikah->AllData(),
            'setting' => $this->ModelAdmin->ViewSetting(),
        ];
        return view('v_template_admin', $data);
    }

    public function Setting()
    {
        $url = 'https://api.myquran.com/v1/sholat/kota/semua';
        $kota = json_decode(file_get_contents($url), true);
        $data = [
            'judul' => 'Setting',
            'menu' => 'setting',
            'submenu' => '',
            'page' => 'v_setting',
            'setting' => $this->ModelAdmin->ViewSetting(),
            'kota' => $kota,
        ];
        return view('v_template_admin', $data);
    }

    public function UpdateSetting()
    {
        $logo = $this->request->getFile('logo');
        $data = [
            'id' => 1,
            'nama_masjid' => $this->request->getPost('nama_masjid'),
            'id_kota' => $this->request->getPost('id_kota'),
            'alamat' => $this->request->getPost('alamat'),
            'rek' => $this->request->getPost('rek'),
        ];

        if ($logo->isValid() && !$logo->hasMoved()) {
            $nama_file = $logo->getRandomName();
            $logo->move('logo', $nama_file);
            $data['logo'] = $nama_file;

            // Menghapus logo sebelumnya jika ada
            $setting = $this->ModelAdmin->ViewSetting();
            if (!empty($setting['logo'])) {
                $logoPath = 'logo/' . $setting['logo'];
                if (file_exists($logoPath)) {
                    unlink($logoPath);
                }
            }
        }

        $this->ModelAdmin->UpdateSetting($data);
        session()->setFlashdata('pesan', 'Setting Berhasil DiUbah !!');
        return redirect()->to(base_url('Admin/Setting'));
    }
}
