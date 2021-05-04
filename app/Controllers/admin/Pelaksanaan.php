<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;

use App\Models\Pelaksanaan_model;

class Pelaksanaan extends Controller
{
    public function __construct()
    {
        helper(['form']);
        $this->pelaksanaan_model = new Pelaksanaan_model;
    }

    public function index()
    {
        $data['content'] = "/pages/admin/pelaksanaan/index";
        $data['title'] = "Pelaksanaan";
        $data['active'] = "pelaksanaan";
        $data['validation'] = $this->validator;
        $data['agenda'] = $this->pelaksanaan_model->getEvents()->getResult();
        echo view('template/app/admin/body', $data);
    }

    public function aturWaktu()
    {
        $data = [
            'tanggal'       => $this->request->getPost('tanggal'),
            'jam_mulai'     => $this->request->getPost('mulai'),
            'jam_selesai'   => $this->request->getPost('selesai'),
        ];
        $this->pelaksanaan_model->saveWaktu($data);
        return redirect()->to(base_url('admin/pelaksanaan'))->with('sukses', 'Waktu telah berhasil diatur');
    }

    public function editWaktu()
    {
        $id = $this->request->getPost('pelaksanaan_id');
        $data = [
            'tanggal'       => $this->request->getPost('tanggal'),
            'jam_mulai'     => $this->request->getPost('mulai'),
            'jam_selesai'   => $this->request->getPost('selesai'),
        ];
        $this->pelaksanaan_model->updateWaktu($data, $id);
        return redirect()->to(base_url('admin/pelaksanaan'))->with('sukses', 'Waktu telah berhasil diupdate');
    }
}
