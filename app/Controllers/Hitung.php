<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\Hitung_model;

class Hitung extends Controller
{
    public function __construct()
    {
        $this->hitung_model = new Hitung_model;
    }

    public function index()
    {
        $level = session()->level;
        $data['content'] = "/pages/common/hitung/index";
        $data['title'] = "Quick Count";
        $data['active'] = "hitung";

        $jabatan = "Calon Ketua OSIS - Calon Wakil Ketua OSIS";
        $data['osis'] = $this->hitung_model->getHasil($jabatan)->getResult();

        $jabatan = "Calon Ketua MPK - Calon Wakil Ketua MPK";
        $data['mpk'] = $this->hitung_model->getHasil($jabatan)->getResult();

        $jabatan = "Calon Ketua PKS - Calon Wakil Ketua PKS";
        $data['pks'] = $this->hitung_model->getHasil($jabatan)->getResult();
        echo view('template/app/' . $level . '/body', $data);
    }
}
