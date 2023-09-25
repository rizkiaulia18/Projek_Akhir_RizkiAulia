<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKomentar;
use App\Models\ModelAdmin;
use DateTime;
use DateTimeZone;

class Komentar extends BaseController
{
    protected $ModelKomentar;

    public function __construct()
    {
        $this->ModelKomentar = new ModelKomentar();
        $this->ModelAdmin = new ModelAdmin();
    }

    public function index()
    {
        $data = [
            'judul' => 'Komentar',
            'sub-judul' => '',
            'menu' => 'komentar',
            'submenu' => '',
            'page' => 'komentar/v_komentar',
            'comment' => $this->ModelKomentar->AllData(),
            'setting' => $this->ModelAdmin->ViewSetting(),
        ];

        return view('v_template_admin', $data);
    }
    public function SimpanBalasan($id_comment)
    {
        // $id_comment = $this->request->getPost('id_comment');
        $timezone = new DateTimeZone('Asia/Jakarta'); // Ganti dengan zona waktu yang sesuai
        $now = new DateTime('now', $timezone);
        $data = [
            'content_admin' => $this->request->getPost('isi_balasan'),
            
            'created_at_admin' => $now->format('Y-m-d H:i:s'),
            'status' => 'dibalas' // Ubah status komentar menjadi 'replied'
        ];

        $this->ModelKomentar->ubahData($id_comment, $data);
        session()->setFlashdata('pesanBerhasil', 'Balasan berhasil dikirim.');
        return redirect()->to(base_url('Komentar'));
    }

    public function HapusKomentar($id_comment)
    {
        $this->ModelKomentar->DeleteData($id_comment);
        session()->setFlashdata('pesanHapus', 'Komentar berhasil dihapus.');
        return redirect()->to(base_url('Komentar'));
    }
}
