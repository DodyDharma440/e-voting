<?php

namespace App\Controllers\Admin;

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
        $data['content'] = "/pages/admin/dashboard/index";
        $data['title'] = "Dashboard";
        $data['active'] = "dashboard";
        $data['jumlah_pemilih'] = $this->dashboard_model->getLevel()->getResult();
        $data['sudah_memilih'] = $this->dashboard_model->getStatus()->getResult();

        $jabatan = "Calon Ketua OSIS - Calon Wakil Ketua OSIS";
        $data['osis'] = $this->hitung_model->getHasil($jabatan)->getResult();

        $jabatan = "Calon Ketua MPK - Calon Wakil Ketua MPK";
        $data['mpk'] = $this->hitung_model->getHasil($jabatan)->getResult();

        $jabatan = "Calon Ketua PKS - Calon Wakil Ketua PKS";
        $data['pks'] = $this->hitung_model->getHasil($jabatan)->getResult();

        $data['kandidat'] = $this->kandidat_model->getKandidat()->getResult();
        $data['kelas'] = $this->pemilih_model->getKelas()->getResult();
        $data['status'] = $this->dashboard_model->getPemilih()->getResult();
        $data['pemilih_terbaru'] = $this->dashboard_model->newPemilih()->getResult();
        echo view('template/app/admin/body', $data);
    }
}
