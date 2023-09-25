<?php

namespace App\Controllers;

use App\Models\ModelNikah;
use App\Controllers\BaseController;
use App\Models\ModelAdmin;
use CodeIgniter\Email\Email;

class Nikah extends BaseController
{
    protected $ModelNikah;
    public function __construct()
    {
        $this->ModelNikah = new ModelNikah();
        $this->ModelAdmin = new ModelAdmin();
    }

    public function index()
    {
        $data = [
            'judul' => 'Nikah',
            'menu' => 'nikah',
            'submenu' => '',
            'page' => 'v_nikah',
            'nikah' => $this->ModelNikah->AllData(),
            'setting' => $this->ModelAdmin->ViewSetting(),
        ];
        return view('v_template_admin', $data);
    }

    public function InsertData()
    {
        $data = [
            'nama_pengantin_p' => $this->request->getPost('pengantin_p'),
            'nama_pengantin_w' => $this->request->getPost('pengantin_w'),
            'nama_penghulu' => $this->request->getPost('penghulu'),
            'nama_wali' => $this->request->getPost('wali'),
            'nama_qori' => $this->request->getPost('qori'),
            'tgl_nikah' => $this->request->getPost('tanggal'),
            'jam_nikah' => $this->request->getPost('jam'),
            'status' => $this->request->getPost('status'),
        ];
        $this->ModelNikah->InsertData($data);
        session()->setFlashdata('pesan', 'Data Berhasil DiTambahkan !!');
        return redirect()->to(base_url('Nikah'));
    }

    public function UpdateData($id_nikah)
    {
        $data = [
            'id_nikah' => $id_nikah,
            'nama_pengantin_p' => $this->request->getPost('pengantin_p'),
            'nama_pengantin_w' => $this->request->getPost('pengantin_w'),
            'nama_penghulu' => $this->request->getPost('penghulu'),
            'nama_wali' => $this->request->getPost('wali'),
            'nama_qori' => $this->request->getPost('qori'),
            'tgl_nikah' => $this->request->getPost('tanggal'),
            'jam_nikah' => $this->request->getPost('jam'),
        ];
        $this->ModelNikah->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil DiUbah !!');
        return redirect()->to(base_url('Nikah'));
    }

    public function DeleteData($id_nikah)
    {
        $data = $this->ModelNikah->getDataById($id_nikah);

        if (!empty($data['bukti_dp'])) {
            // Menghapus file gambar dari direktori jika ada
            $imagePath = FCPATH . 'bukti_dp' . DIRECTORY_SEPARATOR . $data['bukti_dp'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $this->ModelNikah->DeleteData($id_nikah);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus !!');
        return redirect()->to(base_url('Nikah'));
    }

    private function sendEmail($recipient, $subject, $message)
    {
        $email = new Email();

        $email->setTo($recipient);
        $email->setFrom('admin@simasjid.com', 'Simasjid Team');
        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {
            return true; // Email berhasil terkirim
        } else {
            return false; // Gagal mengirim email
        }
    }

    public function Komfirmasi($id_nikah)
    {
        $data = [
            'id_nikah' => $id_nikah,
            'status' => 'aktif',
        ];
        $this->ModelNikah->UpdateData($data);
        // Mendapatkan alamat email penerima dari data yang Anda punya
        $nikahData = $this->ModelNikah->getDataById($id_nikah);
        $recipientEmail = $nikahData['email']; // Gantilah dengan kolom email yang sesuai dalam tabel Anda
        $email = service('email');

        $email->setTo($recipientEmail);
        $email->setFrom('simasjid.id@gmail.com', 'Simasjid Team');
        $email->setSubject('Konfirmasi Pernikahan');
        $email->setMessage('Pernikahan Anda telah dikonfirmasi. Terima kasih!');
        if ($email->send()) {
            session()->setFlashdata('pesankf', 'Data Nikah Di Konfirmasi dan Email Telah Terkirim Ke User!!');
        } else {
            session()->setFlashdata('pesankf', 'Data Nikah Di Konfirmasi, Tetapi Email Gagal Terkirim.');
        }
        // session()->setFlashdata('pesankf', 'Data Nikah Di Konfirmasi!!');
        return redirect()->to(base_url('Nikah'));
    }

    public function Tolak($id_nikah)
    {
        // Get the marriage data from the database
        $data = $this->ModelNikah->getDataById($id_nikah);
        $alasan_tolak = $this->request->getPost('alasan_tolak');
        if (!empty($data['bukti_dp'])) {
            // Menghapus file gambar dari direktori jika ada
            $imagePath = FCPATH . 'bukti_dp' . DIRECTORY_SEPARATOR . $data['bukti_dp'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        // Mendapatkan alamat email penerima dari data yang Anda punya
        $recipientEmail = $data['email']; // Gantilah dengan kolom email yang sesuai dalam tabel Anda
        $email = service('email');

        $email->setTo($recipientEmail);
        $email->setFrom('simasjid.id@gmail.com', 'Simasjid Team');
        $email->setSubject('Penolakan Daftar Nikah');
        $email->setMessage('Maaf, pendaftaran nikah Anda tidak dapat di konfirmasi, dengan alasan : ' . $alasan_tolak . ', silahkan menghubungi admin untuk informasi lebih lanjut', '');
        if ($email->send()) {
            session()->setFlashdata('pesantk', 'Data Nikah Ditolak dan Email Terkirim ke User!!');
        } else {
            session()->setFlashdata('pesantk', 'Data Nikah Ditolak, Tetapi Email Gagal Terkirim.');
        }

        // Delete the marriage data from the database
        $this->ModelNikah->DeleteData($id_nikah);

        // session()->setFlashdata('pesantk', 'Data Nikah Ditolak !!');
        return redirect()->to(base_url('Nikah'));
    }
}
