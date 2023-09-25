<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ModelNikahApi;

class ApiNikah extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $status = $this->request->getGet('status'); // Ambil parameter status dari URL
        $model = new ModelNikahApi();

        // Jika status ada dan sama dengan "aktif" atau "pending", ambil data dengan status yang sesuai
        if ($status && ($status === 'aktif' || $status === 'pending')) {
            $data = $model->where('status', $status)->findAll();
        } else {
            $data = $model->findAll();
        }

        return $this->respond($data);
    }


    public function show($id = null)
    {
        $model = new ModelNikahApi();
        $data = $model->find($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    }
    public function create()
    {
        $model = new ModelNikahApi();
        $rules = [
            'nama_pengantin_p' => 'required',
            'nama_pengantin_w' => 'required',
            // 'nama_penghulu'    => 'required',
            'nama_wali'        => 'required', // Tambahkan aturan untuk nama_qori
            // 'nama_qori'        => 'required', // Tambahkan aturan untuk nama_qori
            'tgl_nikah'        => 'required|valid_date[Y-m-d]',
            'jam_nikah'        => 'required',
            'bukti_dp'         => 'uploaded[bukti_dp]|max_size[bukti_dp,4096]|is_image[bukti_dp]|mime_in[bukti_dp,image/jpg,image/jpeg,image/png]',
            'no_hp'        => 'required',
            'status'        => 'required',
        ];

        // Validasi ukuran gambar
        if ($_FILES['bukti_dp']['size'] > 4096000) { // 4096000 bytes = 4 MB
            $response['message'] = 'Gagal membuat data nikah';
            $response['error'] = true;
            $response['errors']['max_size'] = 'Ukuran Gambar melebihi 4096 kb';
            return $this->respond($response);
        }

        if (!$this->validate($rules)) {
            $response = [
                'error' => true,
                'message' => $this->validator->getErrors()
            ];
            return $this->respond($response);
        }

        $bukti_dp = $this->request->getFile('bukti_dp');
        $namaBukti = $bukti_dp->getRandomName();
        $bukti_dp->move('bukti_dp', $namaBukti);

        $model->insert([
            'nama_pengantin_p' => esc($this->request->getPost('nama_pengantin_p')),
            'nama_pengantin_w' => esc($this->request->getPost('nama_pengantin_w')),
            'nama_penghulu'    => '-',
            'nama_wali'        => esc($this->request->getPost('nama_wali')),
            'nama_qori'        => '-',
            'no_hp'        => esc($this->request->getPost('no_hp')),
            'tgl_nikah'        => esc($this->request->getPost('tgl_nikah')),
            'jam_nikah'        => esc($this->request->getPost('jam_nikah')),
            'bukti_dp'         => $namaBukti,
            'status'        => esc($this->request->getPost('status')),
            'email'        => esc($this->request->getPost('email')),
            'created_by'        => esc($this->request->getPost('created_by')),
            'created_at'        => esc($this->request->getPost('created_at')),
        ]);

        $response = [
            'status'   => 201,
            'error' => false,
            'message' => 'Data nikah berhasil dibuat',
        ];
        return $this->respond($response);
    }


    // public function create()
    // {
    //     $model = new ModelNikahApi();

    //     $bukti_dp = $this->request->getFile('bukti_dp');

    //     if ($bukti_dp->isValid() && $bukti_dp->getSize() < 4096000 && in_array($bukti_dp->getClientMimeType(), ['image/jpeg', 'image/png', 'image/gif'])) {
    //         $namaBukti_dp = $bukti_dp->getRandomName();
    //         $bukti_dp->move('bukti_dp', $namaBukti_dp);

    //         $data = [
    //             'nama_pengantin_p' => $this->request->getVar('nama_pengantin_p'),
    //             'nama_pengantin_w' => $this->request->getVar('nama_pengantin_w'),
    //             'nama_penghulu'    => $this->request->getVar('nama_penghulu'),
    //             'nama_wali'        => $this->request->getVar('nama_wali'),
    //             'nama_qori'        => $this->request->getVar('nama_qori'),
    //             'tgl_nikah'        => $this->request->getVar('tgl_nikah'),
    //             'jam_nikah'        => $this->request->getVar('jam_nikah'),
    //             'bukti_dp'         => $namaBukti_dp,
    //         ];

    //         $model->insert($data);

    //         $response = [
    //             'status'   => 201,
    //             'error'    => false,
    //             'messages' => 'Data nikah berhasil ditambahkan',
    //         ];

    //         return $this->respondCreated($response);
    //     } else {
    //         // Jika unggahan tidak valid, berikan respons error
    //         $response = [
    //             'status' => 400,
    //             'error' => true,
    //             'messages' => 'Unggahan gambar tidak valid, melebihi batas ukuran, atau bukan tipe gambar yang diizinkan.'
    //         ];
    //         return $this->respond($response, 400);
    //     }
    // }
}
