<?php

namespace App\Controllers;

use App\Models\ModelKasMasjid;
use App\Models\ModelAdmin;
use App\Controllers\BaseController;

class KasMasjid extends BaseController
{
    public function __construct()
    {
        $this->ModelAdmin = new ModelAdmin();
        $this->ModelKasMasjid = new ModelKasMasjid();
    }

    public function index()
    {
        $data = [
            'judul' => 'Rekap Kas Masjid',
            'sub-judul' => '',
            'menu' => 'kas-masjid',
            'submenu' => 'rekap-kas',
            'page' => 'kas-masjid/v_rekap_kas',
            'kas' => $this->ModelKasMasjid->AllData(),
            'setting' => $this->ModelAdmin->ViewSetting(),

        ];
        return view('v_template_admin', $data);
    }

    public function KasMasuk()
    {
        $data = [
            'judul' => 'Kas Masjid Masuk',
            'sub-judul' => '',
            'menu' => 'kas-masjid',
            'submenu' => 'kas-masuk',
            'page' => 'kas-masjid/v_kas_masuk',
            'kas' => $this->ModelKasMasjid->AllDataKasMasuk(),
            'setting' => $this->ModelAdmin->ViewSetting(),

        ];
        return view('v_template_admin', $data);
    }

    public function KasKeluar()
    {
        $data = [
            'judul' => 'Kas Masjid Keluar',
            'sub-judul' => '',
            'menu' => 'kas-masjid',
            'submenu' => 'kas-keluar',
            'page' => 'kas-masjid/v_kas_keluar',
            'kas' => $this->ModelKasMasjid->AllDataKasKeluar(),
            'setting' => $this->ModelAdmin->ViewSetting(),

        ];
        return view('v_template_admin', $data);
    }

    public function InsertKasMasuk()
    {
        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'ket' => $this->request->getPost('ket'),
            'kas_masuk' => $this->request->getPost('kas_masuk'),
            'kas_keluar' => 0,
            'status' => 'Masuk',
        ];
        $this->ModelKasMasjid->InsertData($data);
        session()->setFlashdata('pesan', 'Data Berhasil DiTambahkan !!');
        return redirect()->to(base_url('KasMasjid/KasMasuk'));
    }

    public function InsertKasKeluar()
    {
        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'ket' => $this->request->getPost('ket'),
            'kas_masuk' => 0,
            'kas_keluar' => $this->request->getPost('kas_keluar'),
            'status' => 'Keluar',
        ];
        $this->ModelKasMasjid->InsertData($data);
        session()->setFlashdata('pesan', 'Data Berhasil DiTambahkan !!');
        return redirect()->to(base_url('KasMasjid/KasKeluar'));
    }

    public function UpdateKasMasuk($id_kas)
    {
        $data = [
            'id_kas' => $id_kas,
            'tanggal' => $this->request->getPost('tanggal'),
            'ket' => $this->request->getPost('ket'),
            'kas_masuk' => $this->request->getPost('kas_masuk'),
        ];
        $this->ModelKasMasjid->updateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil DiUpdate !!');
        return redirect()->to(base_url('KasMasjid/KasMasuk'));
    }

    public function UpdateKasKeluar($id_kas)
    {
        $data = [
            'id_kas' => $id_kas,
            'tanggal' => $this->request->getPost('tanggal'),
            'ket' => $this->request->getPost('ket'),
            'kas_keluar' => $this->request->getPost('kas_keluar'),
        ];
        $this->ModelKasMasjid->updateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil DiUpdate !!');
        return redirect()->to(base_url('KasMasjid/KasKeluar'));
    }

    public function DeleteKasMasuk($id_kas)
    {
        $data = [
            'id_kas' => $id_kas,
        ];
        $this->ModelKasMasjid->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil DiHapus !!');
        return redirect()->to(base_url('KasMasjid/KasMasuk'));
    }

    public function DeleteKasKeluar($id_kas)
    {
        $data = [
            'id_kas' => $id_kas,
        ];
        $this->ModelKasMasjid->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil DiHapus !!');
        return redirect()->to(base_url('KasMasjid/KasKeluar'));
    }

    public function Laporan()
    {
        $data = [
            'judul' => 'Laporan Kas Masjid',
            'menu' => 'laporan',
            'submenu' => 'laporan-kas',
            'page' => 'kas-masjid/v_laporan_kas',
            'setting' => $this->ModelAdmin->ViewSetting(),
    
        ];
        return view('v_template_admin', $data);
    }

    public function ViewLaporan()
    {


        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');
        $data = [
            'kas' => $this->ModelKasMasjid->AllDataBulanan($bulan, $tahun),
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];

        $response = [
            'data' => view('kas-masjid/v_data_laporan', $data),
        ];
        echo json_encode($response);
    }
}
