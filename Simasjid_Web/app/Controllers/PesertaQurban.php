<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAdmin;
use App\Models\ModelPesertaQurban;
use App\Models\ModelTahun;

class PesertaQurban extends BaseController
{
    protected $ModelPesertaQurban;
    protected $ModelTahun;
    protected $ModelAdmin;

    public function __construct()
    {
        $this->ModelPesertaQurban = new ModelPesertaQurban();
        $this->ModelTahun = new ModelTahun();
        $this->ModelAdmin = new ModelAdmin();
    }


    public function index()
    {
        $data = [
            'judul' => 'Peserta Qurban',
            'menu' => 'qurban',
            'submenu' => 'peserta-qurban',
            'page' => 'qurban/v_tahun_qurban',
            'tahun' => $this->ModelTahun->AllData(),
            'setting' => $this->ModelAdmin->ViewSetting(),
        ];
        return view('v_template_admin', $data);
    }

    public function KelompokQurban($id_tahun)
    {
        $tahun =  $this->ModelTahun->DetailData($id_tahun);
        $data = [
            'judul' => 'Peserta Qurban Kelompok Tahun ' . $tahun['tahun_h'] . ' H / ' . $tahun['tahun_m'] . ' M',
            'menu' => 'qurban',
            'submenu' => 'peserta-qurban',
            'page' => 'qurban/v_kelompok_qurban',
            'tahun' => $tahun,
            'setting' => $this->ModelAdmin->ViewSetting(),
            'kelompok' =>  $this->ModelPesertaQurban->AllDataKelompok($id_tahun),
        ];
        return view('v_template_admin', $data);
    }

    public function InsertKelompok()
    {
        $id_tahun = $this->request->getPost('id_tahun');
        $data = [
            'id_tahun' => $id_tahun,
            'nama_kelompok' => $this->request->getPost('nama_kelompok'),
        ];
        $this->ModelPesertaQurban->InsertKelompok($data);
        session()->setFlashdata('pesan', 'Data Berhasil DiTambahkan !!');
        return redirect()->to(base_url('PesertaQurban/KelompokQurban/' . $id_tahun));
    }

    public function DeleteKelompok($id_tahun, $id_kelompok)
    {
        $data = [
            'id_kelompok' => $id_kelompok,
        ];
        $this->ModelPesertaQurban->DeleteKelompok($data);
        session()->setFlashdata('pesan', 'Kelompok Berhasil DiHapus !!');
        return redirect()->to(base_url('PesertaQurban/KelompokQurban/' . $id_tahun));
    }

    public function InsertPeserta()
    {
        $id_tahun = $this->request->getPost('id_tahun');
        $id_kelompok = $this->request->getPost('id_kelompok');
        $data = [
            'id_kelompok' => $id_kelompok,
            'nama_peserta' => $this->request->getPost('nama_peserta'),
            'biaya' => $this->request->getPost('biaya'),
        ];
        $this->ModelPesertaQurban->InsertPeserta($data);
        session()->setFlashdata('pesan', 'Data Berhasil DiTambahkan !!');
        return redirect()->to(base_url('PesertaQurban/KelompokQurban/' . $id_tahun));
    }

    public function DeletePeserta($id_tahun, $id_peserta)
    {
        $data = [
            'id_peserta' => $id_peserta,
        ];
        $this->ModelPesertaQurban->DeletePeserta($data);
        session()->setFlashdata('pesan', 'Kelompok Berhasil DiHapus !!');
        return redirect()->to(base_url('PesertaQurban/KelompokQurban/' . $id_tahun));
    }
    public function PesertaPribadi($id_tahun)
    {
        $tahun =  $this->ModelTahun->DetailData($id_tahun);
        $data = [
            'judul' => 'Peserta Qurban Pribadi Tahun ' . $tahun['tahun_h'] . ' H / ' . $tahun['tahun_m'] . ' M',
            'menu' => 'qurban',
            'submenu' => 'peserta-qurban',
            'page' => 'qurban/v_peserta_pribadi',
            'tahun' => $tahun,
            'setting' => $this->ModelAdmin->ViewSetting(),
            'peserta_pribadi' =>  $this->ModelPesertaQurban->AllDataPribadi($id_tahun),
        ];
        return view('v_template_admin', $data);
    }

    public function InsertPesertaPribadi()
    {
        $id_tahun = $this->request->getPost('id_tahun');
        $data = [
            'id_tahun' => $id_tahun,
            'nama_peserta' => $this->request->getPost('nama_peserta'),
            'biaya' => $this->request->getPost('biaya'),
        ];
        $this->ModelPesertaQurban->InsertPesertaPribadi($data);
        session()->setFlashdata('pesan', 'Data Berhasil DiTambahkan !!');
        return redirect()->to(base_url('PesertaQurban/PesertaPribadi/' . $id_tahun));
    }

    public function DeletePesertaPribadi($id_tahun, $id_peserta_p)
    {
        $data = [
            'id_peserta_p' => $id_peserta_p,
        ];
        $this->ModelPesertaQurban->DeletePesertaPribadi($data);
        session()->setFlashdata('pesan', 'Data Berhasil DiHapus !!');
        return redirect()->to(base_url('PesertaQurban/PesertaPribadi/' . $id_tahun));
    }

    public function UpdatePesertaPribadi($id_tahun, $id_peserta_p)
    {
        $data = [
            'nama_peserta' => $this->request->getPost('nama_peserta'),
            'biaya' => $this->request->getPost('biaya'),
        ];
        $this->ModelPesertaQurban->UpdatePesertaPribadi($id_peserta_p, $data);
        session()->setFlashdata('pesan', 'Data Berhasil DiUpdate !!');
        return redirect()->to(base_url('PesertaQurban/PesertaPribadi/' . $id_tahun));
    }

    public function Laporan()
    {
        $data = [
            'judul' => 'Laporan Qurban',
            'menu' => 'laporan',
            'submenu' => 'laporan-qurban',
            'page' => 'qurban/v_laporan_qurban',
            'tahun' => $this->ModelTahun->AllData(),
            'setting' => $this->ModelAdmin->ViewSetting(),
        ];
        return view('v_template_admin', $data);
    }

    public function ViewLaporanPribadi()
    {
        $id_tahun = $this->request->getPost('tahun');
        $data = [
            'laporan_qurban_pribadi' => $this->ModelPesertaQurban->AllDataLaporanPribadi($id_tahun),
        ];
        $view = view('qurban/v_data_laporan_pribadi', $data); // Load the view for the table data
        return $this->response->setJSON(['data' => $view]);
    }

    public function ViewLaporanKelompok()
    {
        $id_tahun = $this->request->getPost('tahun');
        $data = [
            'laporan_qurban_kelompok' => $this->ModelPesertaQurban->AllDataLaporanKelompok($id_tahun),
        ];
        $view = view('qurban/v_data_laporan_kelompok', $data); // Load the view for the table data
        return $this->response->setJSON(['data' => $view]);
    }
}
