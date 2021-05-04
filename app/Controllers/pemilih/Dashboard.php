<?php

namespace App\Controllers\Pemilih;

use CodeIgniter\Controller;

use App\Models\Dashboard_model;
use App\Models\Kandidat_model;
use App\Models\Pemilih_model;
use App\Models\Hitung_model;

class Dashboard extends Controller
{
    public function __construct()
    {
        $this->dashboard_model = new Dashboard_model;
        $this->kandidat_model = new Kandidat_model;
        $this->pemilih_model = new Pemilih_model;
        $this->hitung_model = new Hitung_model;
    }

    public function index()
    {
        $data['content'] = "pages/pemilih/dashboard/index";
        $data['title'] = "Dashboard";
        $data['active'] = "dashboard";

        $jabatan = "Calon Ketua OSIS - Calon Wakil Ketua OSIS";
        $data['osis'] = $this->hitung_model->getHasil($jabatan)->getResult();

        $jabatan = "Calon Ketua MPK - Calon Wakil Ketua MPK";
        $data['mpk'] = $this->hitung_model->getHasil($jabatan)->getResult();

        $jabatan = "Calon Ketua PKS - Calon Wakil Ketua PKS";
        $data['pks'] = $this->hitung_model->getHasil($jabatan)->getResult();

        echo view('template/app/pemilih/body', $data);
    }
}
