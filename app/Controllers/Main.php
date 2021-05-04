<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\Hitung_model;
use App\Models\Main_model;
use App\Models\Dashboard_model;
use App\Models\Kandidat_model;
use App\Models\Pemilih_model;

class Main extends Controller
{
    public function __construct()
    {
        $this->hitung_model = new Hitung_model;
        $this->main_model = new Main_model;
        $this->dashboard_model = new Dashboard_model;
        $this->kandidat_model = new Kandidat_model;
        $this->pemilih_model = new Pemilih_model;
    }

    public function index()
    {
        if (session()->logged_in) {
            if (session()->level == "admin") {
                return redirect()->to(base_url('/admin/dashboard'));
            } else {
                return redirect()->to(base_url('pemilih'));
            }
        }
        $data['title'] = "Home";
        $data['content'] = "pages/home";
        $data['validation'] = $this->validator;

        $data['jumlah_pemilih'] = $this->dashboard_model->getLevel()->getResult();
        $data['sudah_memilih'] = $this->dashboard_model->getStatus()->getResult();
        $data['kandidat'] = $this->kandidat_model->getKandidat()->getResult();
        $data['kelas'] = $this->pemilih_model->getKelas()->getResult();

        $data['hasil_hitung'] = $this->hitung_model->getHasil()->getResult();

        $jabatan = "Calon Ketua OSIS - Calon Wakil Ketua OSIS";
        $data['osis'] = $this->hitung_model->getHasil($jabatan)->getResult();

        $jabatan = "Calon Ketua MPK - Calon Wakil Ketua MPK";
        $data['mpk'] = $this->hitung_model->getHasil($jabatan)->getResult();

        $jabatan = "Calon Ketua PKS - Calon Wakil Ketua PKS";
        $data['pks'] = $this->hitung_model->getHasil($jabatan)->getResult();

        echo view('template/home/body', $data);
    }

    public function sendMail()
    {
        $rules = [
            'email_user'    => ['label' => 'Email', 'rules' => 'required|valid_email'],
            'nama_user'     => ['label' => 'Nama Lengkap', 'rules' => 'required'],
            'judul'         => ['label' => 'Judul Email', 'rules' => 'required'],
            'pesan_user'    => ['label' => 'Pesan', 'rules' => 'required'],
        ];

        if ($this->validate($rules)) {
            $email_user = $this->request->getPost('email_user');
            $nama = $this->request->getPost('nama_user');
            $judul = $this->request->getPost('judul');
            $pesan = $this->request->getPost('pesan_user');

            $email = \Config\Services::email();

            $email->setFrom($email_user, $nama);
            $email->setTo('dodiaridharma@gmail.com');

            $email->setSubject($judul);
            $email->setMessage($pesan);

            $email->send();

            return redirect()->to(base_url('#kontak'))->with('sukses', 'Email berhasil terkirim.');
        } else {
            $this->index();
        }
    }
}
