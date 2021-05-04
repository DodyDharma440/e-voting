<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Pemilih_model;
use App\Models\Kandidat_model;

class Kandidat extends Controller
{
    public function __construct()
    {
        helper(['form', 'url']);
        $this->kandidat_model = new Kandidat_model;
        $this->pemilih_model = new Pemilih_model;
    }

    public function index()
    {
        $data['content'] = "/pages/admin/kandidat/index";
        $data['title'] = "Kandidat";
        $data['active'] = "kandidat";
        $data['kandidat'] = $this->kandidat_model->getKandidat()->getResult();
        echo view('template/app/admin/body', $data);
    }

    public function detailKandidat($id)
    {
        $data['content'] = "/pages/admin/kandidat/detail";
        $data['title'] = "Kandidat";
        $data['active'] = "kandidat";
        $data['kelas'] = $this->pemilih_model->getKelas()->getResult();
        $data['kandidat'] = $this->kandidat_model->getKandidat($id)->getResult();
        $data['validation'] = $this->validator;
        echo view('template/app/admin/body', $data);
    }

    public function tambahKandidat($message = false)
    {
        $data['content'] = "/pages/admin/kandidat/tambah";
        $data['title'] = "Kandidat";
        $data['active'] = "kandidat";
        $data['kelas'] = $this->pemilih_model->getKelas()->getResult();
        $data['message'] = $message;
        $data['validation'] = $this->validator;
        echo view('template/app/admin/body', $data);
    }

    public function editKandidat($id, $message = false)
    {
        $data['content'] = "/pages/admin/kandidat/edit";
        $data['title'] = "Kandidat";
        $data['active'] = "kandidat";
        $data['kelas'] = $this->pemilih_model->getKelas()->getResult();
        $data['kandidat'] = $this->kandidat_model->getKandidat($id)->getResult();
        $data['message'] = $message;
        $data['validation'] = $this->validator;
        echo view('template/app/admin/body', $data);
    }

    public function simpanKandidat()
    {

        $rules = [
            'no_urut'           => ['label' => 'Nomor Urut', 'rules' => 'required'],
            'pasangan'          => ['label' => 'Nama Pasangan', 'rules' => 'required'],
            'jabatan'           => ['label' => 'Jabatan', 'rules' => 'required'],
            'nm_calon'          => ['label' => 'Nama Calon', 'rules' => 'required'],
            'nm_calon_wakil'    => ['label' => 'Nama Calon Wakil', 'rules' => 'required'],
            'kls_calon'         => ['label' => 'Kelas Calon', 'rules' => 'required'],
            'kls_calon_wakil'   => ['label' => 'Kelas Calon Wakil', 'rules' => 'required'],
            'visi'              => ['label' => 'Visi', 'rules' => 'required'],
            'misi'              => ['label' => 'Misi', 'rules' => 'required'],
        ];

        if ($this->validate($rules)) {
            $foto = [
                'foto_calon'        => 'mime_in[foto_calon,image/jpg,image/jpeg,image/png]',
                'foto_calon_wakil'  => 'mime_in[foto_calon_wakil,image/jpg,image/jpeg,image/png]',
            ];

            if ($this->validate($foto)) {

                //Request post file
                $foto_calon = $this->request->getFile('foto_calon');
                $foto_calon_wakil = $this->request->getFile('foto_calon_wakil');
                $no_urut = $this->request->getPost('no_urut');

                //Memberi nama berdasarkan waktu dari foto calon
                $fotoc_name = "";
                if ($_FILES['foto_calon']['name']) {
                    $fotoname_calon = $foto_calon->getName();
                    $arr_fotoc = explode('.', $fotoname_calon);
                    $extension_calon = end($arr_fotoc);
                    $fotoc_name = time() . '-foto-calon.' . $extension_calon;
                }

                //Memberi nama berdasarkan waktu dari foto calon wakil
                $fotocw_name = "";
                if ($_FILES['foto_calon_wakil']['name']) {
                    $fotoname_calonwakil = $foto_calon_wakil->getName();
                    $arr_fotocw = explode('.', $fotoname_calonwakil);
                    $extension_calon_wakil = end($arr_fotocw);
                    $fotocw_name = time() . '-foto-calon-wakil.' . $extension_calon_wakil;
                }


                //Data yang diinput ke database
                $data = [
                    'no_urut'           => $no_urut,
                    'pasangan'          => $this->request->getPost('pasangan'),
                    'jabatan'           => $this->request->getPost('jabatan'),
                    'nm_calon'          => $this->request->getPost('nm_calon'),
                    'nm_calon_wakil'    => $this->request->getPost('nm_calon_wakil'),
                    'kls_calon'         => $this->request->getPost('kls_calon'),
                    'kls_calon_wakil'   => $this->request->getPost('kls_calon_wakil'),
                    'foto_calon'        => $fotoc_name,
                    'foto_calon_wakil'  => $fotocw_name,
                    'visi'              => $this->request->getPost('visi'),
                    'misi'              => $this->request->getPost('misi')
                ];

                //Aksi input
                $this->kandidat_model->saveKandidat($data);

                //Mengganti nama file di direktori
                if ($_FILES['foto_calon']['name']) {
                    $foto_calon->move(ROOTPATH . 'assets/images/kandidat');
                    rename(ROOTPATH . 'assets/images/kandidat/' . $fotoname_calon, ROOTPATH . 'assets/images/kandidat/' . $fotoc_name);
                }

                if ($_FILES['foto_calon_wakil']['name']) {
                    $foto_calon_wakil->move(ROOTPATH . 'assets/images/kandidat');
                    rename(ROOTPATH . 'assets/images/kandidat/' . $fotoname_calonwakil, ROOTPATH . 'assets/images/kandidat/' . $fotocw_name);
                }

                return redirect()->to(base_url('admin/kandidat'))->with('sukses', 'Kandidat baru berhasil ditambahkan.');
            } else {
                $message = "Masukkan foto dengan ekstensi .jpg atau .jpeg atau .png";
                $this->tambahKandidat($message);
            }
        } else {
            $this->tambahKandidat();
        }
    }

    public function updateKandidat()
    {
        $id = $this->request->getPost('kandidat_id');

        $rules = [
            'no_urut'           => ['label' => 'Nomor Urut', 'rules' => 'required'],
            'pasangan'          => ['label' => 'Nama Pasangan', 'rules' => 'required'],
            'jabatan'           => ['label' => 'Jabatan', 'rules' => 'required'],
            'nm_calon'          => ['label' => 'Nama Calon', 'rules' => 'required'],
            'nm_calon_wakil'    => ['label' => 'Nama Calon Wakil', 'rules' => 'required'],
            'kls_calon'         => ['label' => 'Kelas Calon', 'rules' => 'required'],
            'kls_calon_wakil'   => ['label' => 'Kelas Calon Wakil', 'rules' => 'required'],
            'visi'              => ['label' => 'Visi', 'rules' => 'required'],
            'misi'              => ['label' => 'Misi', 'rules' => 'required'],
        ];

        if ($this->validate($rules)) {
            $foto = [
                'foto_calon'        => 'mime_in[foto_calon,image/jpg,image/jpeg,image/png]',
                'foto_calon_wakil'  => 'mime_in[foto_calon_wakil,image/jpg,image/jpeg,image/png]',
            ];

            if ($this->validate($foto)) {
                $no_urut = $this->request->getPost('no_urut');
                $pasangan = $this->request->getPost('pasangan_default');
                //Request post file

                $default_filec = $this->request->getPost('foto_calon_default');
                if (empty($_FILES['foto_calon']['name'])) {
                    $fotoc_name = $default_filec;
                } else {
                    //Memberi nama berdasarkan waktu dari foto calon
                    $foto_calon = $this->request->getFile('foto_calon');
                    $fotoname_calon = $foto_calon->getName();
                    $arr_fotoc = explode('.', $fotoname_calon);
                    $extension_calon = end($arr_fotoc);
                    $fotoc_name = time() . '-foto-calon.' . $extension_calon;
                }

                $default_filecw = $this->request->getPost('foto_calon_wakil_default');
                if (empty($_FILES['foto_calon_wakil']['name'])) {
                    $fotocw_name = $default_filecw;
                } else {
                    //Memberi nama berdasarkan waktu dari foto calon wakil
                    $foto_calon_wakil = $this->request->getFile('foto_calon_wakil');
                    $fotoname_calonwakil = $foto_calon_wakil->getName();
                    $arr_fotocw = explode('.', $fotoname_calonwakil);
                    $extension_calon_wakil = end($arr_fotocw);
                    $fotocw_name = time() . '-foto-calon-wakil.' . $extension_calon_wakil;
                }

                $data = [
                    'no_urut'           => $no_urut,
                    'pasangan'          => $this->request->getPost('pasangan'),
                    'jabatan'           => $this->request->getPost('jabatan'),
                    'nm_calon'          => $this->request->getPost('nm_calon'),
                    'nm_calon_wakil'    => $this->request->getPost('nm_calon_wakil'),
                    'kls_calon'         => $this->request->getPost('kls_calon'),
                    'kls_calon_wakil'   => $this->request->getPost('kls_calon_wakil'),
                    'foto_calon'        => $fotoc_name,
                    'foto_calon_wakil'  => $fotocw_name,
                    'visi'              => $this->request->getPost('visi'),
                    'misi'              => $this->request->getPost('misi'),
                ];

                $this->kandidat_model->updateKandidat($data, $id);

                if ($_FILES['foto_calon']['name']) {
                    $foto_calon->move(ROOTPATH . 'assets/images/kandidat');
                    rename(ROOTPATH . 'assets/images/kandidat/' . $fotoname_calon, ROOTPATH . 'assets/images/kandidat/' . $fotoc_name);
                    $default_filec ? unlink('./assets/images/kandidat/' . $default_filec) : false;
                }

                if ($_FILES['foto_calon_wakil']['name']) {
                    $foto_calon_wakil->move(ROOTPATH . 'assets/images/kandidat');
                    rename(ROOTPATH . 'assets/images/kandidat/' . $fotoname_calonwakil, ROOTPATH . 'assets/images/kandidat/' . $fotocw_name);
                    $default_filecw ? unlink('./assets/images/kandidat/' . $default_filecw) : false;
                }

                return redirect()->to(base_url('admin/kandidat'))->with('sukses', 'Data dengan nama pasangan <b>' . $pasangan . '</b> berhasil diperbarui.');
            } else {
                $message = "Masukkan foto dengan ekstensi .jpg atau .jpeg atau .png";
                $this->editKandidat($id, $message);
            }
        } else {
            $this->editKandidat($id);
        }
    }

    public function hapusKandidat()
    {
        $id = $this->request->getPost('kandidat_id');
        $kandidat = $this->kandidat_model->getKandidat($id)->getResult();
        foreach ($kandidat as $kand) {
            $pasangan = $kand->pasangan;
            $kand->foto_calon ? unlink('./assets/images/kandidat/' . $kand->foto_calon) : null;
            $kand->foto_calon_wakil ? unlink('./assets/images/kandidat/' . $kand->foto_calon_wakil) : null;
        }
        $this->kandidat_model->deleteKandidat($id);
        return redirect()->to(base_url('admin/kandidat'))->with('sukses', 'Kandidat dengan nama pasangan <b>' . $pasangan . '</b> berhasil dihapus.');
    }
}
