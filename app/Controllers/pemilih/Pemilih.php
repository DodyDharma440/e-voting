<?php

namespace App\Controllers\Pemilih;

use CodeIgniter\Controller;

use App\Models\Pilih_model;
use App\Models\Kandidat_model;
use App\Models\Pemilih_model;
use App\Models\Hitung_model;
use App\Models\Profil_model;
use App\Models\Pelaksanaan_model;

class Pemilih extends Controller
{
    public function __construct()
    {
        helper(['form']);
        $this->kandidat_model = new Kandidat_model;
        $this->pilih_model = new Pilih_model;
        $this->kelas_model = new Pemilih_model;
        $this->hitung_model = new Hitung_model;
        $this->pelaksanaan_model = new Pelaksanaan_model;
        $this->profil_model = new Profil_model;
    }

    public function index()
    {
        $id = session()->user_id;
        $data['active'] = "bilik_suara";
        $data['title'] = "Bilik Suara";
        $data['content'] = "pages/pemilih/bilik_suara/index";
        $data['validation'] = $this->validator;

        $data['password'] = $this->profil_model->getPassword($id)->getResult();
        $data['kandidat'] = $this->kandidat_model->getKandidat()->getResult();
        $data['kelas'] = $this->kelas_model->getKelas()->getResult();

        $jabatan = "Calon Ketua OSIS - Calon Wakil Ketua OSIS";
        $data['osis'] = $this->hitung_model->getHasil($jabatan)->getResult();

        $jabatan = "Calon Ketua MPK - Calon Wakil Ketua MPK";
        $data['mpk'] = $this->hitung_model->getHasil($jabatan)->getResult();

        $jabatan = "Calon Ketua PKS - Calon Wakil Ketua PKS";
        $data['pks'] = $this->hitung_model->getHasil($jabatan)->getResult();

        $data['pelaksanaan'] = $this->pelaksanaan_model->getEvents()->getResult();
        echo view('template/app/pemilih/body', $data);
    }

    public function pilihKandidat()
    {
        $rules = [
            'osis' => 'required',
            'mpk' => 'required',
            'pks' => 'required'
        ];

        $pelaksanaan = $this->pelaksanaan_model->getEvents()->getResult();

        if ($pelaksanaan) {
            foreach ($pelaksanaan as $waktu) {
                $tanggal = $waktu->tanggal;
                $jam_mulai = $waktu->jam_mulai;
                $jam_selesai = $waktu->jam_selesai;

                $tgl_sekarang = date('Y-m-d');
                $jam_sekarang = date('H:i:s');
            }
        } else {
            $tanggal = "";
            $jam_mulai = "";
            $jam_selesai = "";

            $tgl_sekarang = date('Y-m-d');
            $jam_sekarang = date('H:i:s');
        }

        if ($tgl_sekarang == $tanggal && $jam_sekarang > $jam_mulai) {
            if ($this->validate($rules)) {
                $session = session();
                $osis = $this->request->getPost('osis');
                $mpk = $this->request->getPost('mpk');
                $pks = $this->request->getPost('pks');

                $data = [
                    'kandidat_id_pilihan' => $osis,
                ];
                $this->pilih_model->saveSuara($data);

                $data = [
                    'kandidat_id_pilihan' => $mpk,
                ];
                $this->pilih_model->saveSuara($data);

                $data = [
                    'kandidat_id_pilihan' => $pks,
                ];
                $this->pilih_model->saveSuara($data);

                $user_id = $session->user_id;
                $data = [
                    'status' => 'Sudah Memilih'
                ];
                $this->pilih_model->updateStatus($data, $user_id);

                $kelas_id = $session->kelas_id_user;
                $kelas = $this->kelas_model->getKelas($kelas_id)->getResult();
                foreach ($kelas as $kls) {
                    $status = $kls->sudah_memilih;
                    $data = [
                        'sudah_memilih' => $status + 1,
                    ];
                    $this->pilih_model->updateKelas($data, $kelas_id);
                }

                $session->set(['status' => 'Sudah Memilih']);
                return redirect()->to(base_url('pemilih/bilik_suara'))->with('sukses', 'Terima kasih telah menggunakan hak pilih Anda.');
            } else {
                return redirect()->to(base_url('pemilih/bilik_suara'))->with('gagal', 'Anda harus memilih salah satu masing-masing dari kandidat OSIS, MPK, dan PKS');
            }
        }


        /*$session = session();
        $id = $this->request->getPost('kandidat_id');
        $data = [
            'kandidat_id_pilihan' => $id,
        ];
        $this->pilih_model->saveSuara($data);

        $user_id = $session->user_id;
        $data = [
            'status' => 'Sudah Memilih'
        ];
        $this->pilih_model->updateStatus($data, $user_id);

        $kelas_id = $session->kelas_id_user;
        $kelas = $this->kelas_model->getKelas($kelas_id)->getResult();
        foreach ($kelas as $kls) {
            $status = $kls->sudah_memilih;
            $data = [
                'sudah_memilih' => $status + 1,
            ];
            $this->pilih_model->updateKelas($data, $kelas_id);
        }

        $session->set(['status' => 'Sudah Memilih']);

        return redirect()->to(base_url('pemilih'))->with('sukses', 'Terima kasih telah mengirimkan suara Anda.');*/
    }

    public function cekPassword()
    {
        $id = $this->request->getPost('user_id');
        $data = [
            'password' => $this->request->getVar('password_default'),
        ];
        $password = $this->profil_model->getPassword($id)->getResult();
        foreach ($password as $pwd) {
            if ($pwd->password != "") {
                $verify_pass = password_verify($data['password'], $pwd->password);
            } else {
                $verify_pass = $data['password'] == $pwd->password;
            }

            if ($verify_pass) {
                echo json_encode($data);
            }
        }
    }

    public function gantiPassword()
    {
        $id = $this->request->getPost('user_id');
        $rules = [
            'new_password' => ['label' => 'Password Baru', 'rules' => 'required|min_length[8]'],
            're_password'  => ['label' => 'Konfirmasi Password', 'rules' => 'matches[new_password]']
        ];

        if ($this->validate($rules)) {
            $data = [
                'password' => password_hash($this->request->getVar('new_password'), PASSWORD_DEFAULT)
            ];
            $this->profil_model->updatePassword($data, $id);
            return redirect()->to(base_url('pemilih'))->with('sukses', 'Password berhasil diganti');
        } else {
            $this->index();
?>
            <script>
                $('#modalPassword').modal('show');
            </script>
<?php
        }
    }
}
