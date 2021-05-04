<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Pemilih_model;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Pemilih extends Controller
{
    public function __construct()
    {
        helper(['form', 'url', 'upload']);
        $this->pemilih_model = new Pemilih_model;
    }

    //Controller Kelas
    public function index($message = false)
    {
        $data['content'] = "/pages/admin/pemilih/index";
        $data['title'] = "Data Pemilih";
        $data['active'] = "pemilih";
        $data['kelas'] = $this->pemilih_model->getKelas()->getResult();
        //$data['memilih'] = $this->pemilih_model->getPemilih()->getResult();
        $data['validation'] = $this->validator;
        $data['message'] = $message;
        echo view('template/app/admin/body', $data);
    }

    public function tambahKelas()
    {
        $rules = [
            'tingkat'       => ['label' => 'Tingkat', 'rules' => 'required'],
            'nama_kelas'    => ['label' => 'Nama Kelas', 'rules' => 'required'],
        ];

        if ($this->validate($rules)) {
            $data = [
                'tingkat'       => $this->request->getPost('tingkat'),
                'nama_kelas'    => $this->request->getPost('nama_kelas'),
                'anggota'       => '0',
                'sudah_memilih' => '0',
            ];
            $tingkat = $data['tingkat'];
            $nama_kelas = $data['nama_kelas'];

            $checkData = $this->pemilih_model->checkData($tingkat, $nama_kelas)->getResult();

            if ($checkData) {
                $message = "Kelas sudah ada.";
                $this->index($message);
            } else {
                $this->pemilih_model->addKelas($data);
                return redirect()->to(base_url('admin/pemilih'))->with('sukses', 'Data kelas baru berhasil ditambahkan.');
            }
        } else {
            $this->index();
        }
    }

    public function editKelas()
    {
        $rules = [
            'tingkat'       => ['label' => 'Tingkat', 'rules' => 'required'],
            'nama_kelas'    => ['label' => 'Nama Kelas', 'rules' => 'required'],
        ];

        if ($this->validate($rules)) {
            $id = $this->request->getPost('kelas_id');
            $data = [
                'tingkat'    => $this->request->getPost('tingkat'),
                'nama_kelas' => $this->request->getPost('nama_kelas'),
            ];
            $this->pemilih_model->updateKelas($data, $id);
            return redirect()->to(base_url('admin/pemilih'))->with('sukses', 'Data berhasil diupdate.');
        } else {
            $this->index();
        }
    }

    public function hapusKelas()
    {
        $id = $this->request->getPost('kelas_id');
        $this->pemilih_model->deleteKelas($id);
        return redirect()->to(base_url('admin/pemilih'))->with('sukses', 'Data berhasil dihapus.');
    }

    public function hapusKelasGanda()
    {
        $rules = ['kelas_id' => 'required'];
        if ($this->validate($rules)) {
            $kelas_id = $this->request->getVar('kelas_id');
            foreach ($kelas_id as $id) {
                $this->pemilih_model->deleteKelas($id);
            }
            return redirect()->to(base_url('admin/pemilih'))->with('sukses', 'Sebanyak <b> ' . count($kelas_id) . ' </b> kelas berhasil dihapus.');
        } else {
            return redirect()->to(base_url('admin/pemilih'));
        }
    }

    public function importExcel()
    {
        $file_mimes = [
            'application/vnd.ms-excel',
            'application/excel',
            'application/vnd.msexcel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];

        $file_name = $_FILES['import_excel']['name'];
        $file_type = $_FILES['import_excel']['type'];
        $file_tmp = $_FILES['import_excel']['tmp_name'];

        //echo $file_name, $file_type, $file_tmp;

        if ($file_name && in_array($file_type, $file_mimes)) {
            $arr_file = explode('.', $file_name);
            $extension = end($arr_file);

            if ($extension == "xlsx") {
                $reader = new Xlsx();
            } else {
                $reader = new Xls();
            }

            $spreadsheet = $reader->load($file_tmp);

            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            for ($i = 1; $i < count($sheetData); $i++) {
                $data = [
                    'tingkat'       => $sheetData[$i]['0'],
                    'nama_kelas'    => $sheetData[$i]['1'],
                    'anggota'       => '0',
                    'sudah_memilih' => '0',
                ];

                $tingkat = $data['tingkat'];
                $nama_kelas = $data['nama_kelas'];

                $checkData = $this->pemilih_model->checkData($tingkat, $nama_kelas)->getResult();
                if ($checkData) {
                    $message = "Data sudah ada.";
                } else {
                    $this->pemilih_model->addKelas($data);
                }
            }
            if (!$checkData) {
                return redirect()->to(base_url('admin/pemilih'))->with('sukses', 'Import data berhasil.');
            } else {
                $this->index($message);
            }
        } else {
            $message = "Harap input file dengan ekstensi .xls atau .xlsx";
            $this->index($message);
        }
    }
    //End Controller Kelas

    //Controller Anggota
    public function anggota($id, $message = false)
    {
        $data['content'] = "/pages/admin/pemilih/anggota";
        $data['title'] = "Data Pemilih";
        $data['active'] = "pemilih";
        $data['validation'] = $this->validator;
        $data['message'] = $message;
        $data['nama_kelas'] = $this->pemilih_model->namaKelas($id)->getResult();
        $data['anggota'] = $this->pemilih_model->getAnggota($id)->getResult();
        echo view('template/app/admin/body', $data);
    }

    public function tambahAnggota()
    {
        $rules = [
            'no_induk' => ['label' => 'Nomor Induk', 'rules' => 'required|is_unique[user.no_induk]'],
            'nama'     => ['label' => 'Nama', 'rules' => 'required'],
        ];

        $kelas_id = $this->request->getPost('kelas_id');
        if ($this->validate($rules)) {
            $waktu = date('Y-m-d H:i:s');
            $data = [
                'no_induk'      => $this->request->getPost('no_induk'),
                'nama'          => $this->request->getPost('nama'),
                'kelas_id_user' => $kelas_id,
                'no_a'          => $this->request->getPost('no_a'),
                'password'      => '',
                'dibuat'        => $waktu,
                'diganti'       => $waktu,
                'level'         => 'pemilih',
                'status'        => 'Belum Memilih',
            ];
            $this->pemilih_model->addAnggota($data);
            $kelas = $this->pemilih_model->getKelas($kelas_id)->getResult();
            foreach ($kelas as $kls) {
                $anggota = $kls->anggota;
                $data = [
                    'anggota' => $anggota + 1,
                ];
                $id = $kelas_id;
                $this->pemilih_model->updateKelas($data, $id);
            }
            return redirect()->to(base_url('admin/pemilih/anggota/' . $kelas_id))->with('sukses', 'Data anggota baru berhasil ditambahkan.');
        } else {
            $id = $kelas_id;
            $this->anggota($id);
        }
    }

    public function editAnggota()
    {

        $kelas_id = $this->request->getPost('kelas_id');

        $nomor_induk = $this->request->getPost('no_induk');
        $ni_default = $this->request->getPost('no_induk_default');
        if ($nomor_induk == $ni_default) {
            $ni = $ni_default;
            $rules = [
                'no_induk' => ['label' => 'Nomor Induk', 'rules' => 'required'],
                'nama'     => ['label' => 'Nama', 'rules' => 'required'],
            ];
        } else {
            $ni = $nomor_induk;
            $rules = [
                'no_induk' => ['label' => 'Nomor Induk', 'rules' => 'required|is_unique[user.no_induk]'],
                'nama'     => ['label' => 'Nama', 'rules' => 'required'],
            ];
        }

        if ($this->validate($rules)) {
            $id = $this->request->getPost('user_id');
            $data = [
                'no_induk' => $ni,
                'nama'     => $this->request->getPost('nama'),
                'no_a'     => $this->request->getPost('no_a'),
            ];
            print_r($data);
            $this->pemilih_model->updateAnggota($data, $id);
            return redirect()->to(base_url('admin/pemilih/anggota/' . $kelas_id))->with('sukses', 'Data berhasil diperbarui.');
        } else {
            $id = $kelas_id;
            $this->anggota($id);
        }
    }

    public function hapusAnggota()
    {
        $kelas_id = $this->request->getPost('kelas_id');
        $user_id = $this->request->getPost('user_id');
        $id = $user_id;
        $data_user = $this->pemilih_model->getUser($id)->getResult();
        $kelas = $this->pemilih_model->getKelas($kelas_id)->getResult();

        foreach ($data_user as $user) {
            $status_user = $user->status;
        }

        foreach ($kelas as $kls) {
            $anggota = $kls->anggota;
            $sudah_memilih = $kls->sudah_memilih;
            if ($status_user == "Sudah Memilih") {
                $status = $sudah_memilih - 1;
            } else {
                $status = $sudah_memilih;
            }

            $data = [
                'anggota' => $anggota - 1,
                'sudah_memilih' => $status,
            ];
            $id = $kelas_id;
            $this->pemilih_model->updateKelas($data, $id);
        }
        $id = $user_id;
        $this->pemilih_model->deleteAnggota($id);

        return redirect()->to(base_url('admin/pemilih/anggota/' . $kelas_id))->with('sukses', 'Data berhasil dihapus.');
    }

    public function hapusAnggotaGanda()
    {
        $rules = ['user_id' => 'required'];
        $nm_kelas = $this->request->getPost('nm_kelas');
        $kelas_id = $this->request->getPost('kelas_id');
        if ($this->validate($rules)) {
            $user_id = $this->request->getVar('user_id');
            foreach ($user_id as $userid) {
                $id = $userid;
                $data_user = $this->pemilih_model->getUser($id)->getResult();
                $kelas = $this->pemilih_model->getKelas($kelas_id)->getResult();

                foreach ($data_user as $user) {
                    $status_user = $user->status;
                }

                foreach ($kelas as $kls) {
                    $anggota = $kls->anggota;
                    $sudah_memilih = $kls->sudah_memilih;
                    if ($status_user == "Sudah Memilih") {
                        $status = $sudah_memilih - 1;
                    } else {
                        $status = $sudah_memilih;
                    }
                    $data = [
                        'anggota' => $anggota - 1,
                        'sudah_memilih' => $status,
                    ];
                    $id = $kelas_id;
                    $this->pemilih_model->updateKelas($data, $id);
                }
                $id = $userid;
                $this->pemilih_model->deleteAnggota($id);
            }
            return redirect()->to(base_url('admin/pemilih/anggota/' . $kelas_id))->with('sukses', 'Sebanyak <b> ' . count($user_id) . ' </b> anggota dari kelas <b>' . $nm_kelas . '</b> berhasil dihapus.');
        } else {
            return redirect()->to(base_url('admin/pemilih/anggota/' . $kelas_id));
        }
    }

    public function importAnggota()
    {
        $kelas_id = $this->request->getPost('kelas_id');
        $file_mimes = [
            'application/vnd.ms-excel',
            'application/excel',
            'application/vnd.msexcel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];

        $file_name = $_FILES['import_anggota']['name'];
        $file_type = $_FILES['import_anggota']['type'];
        $file_tmp = $_FILES['import_anggota']['tmp_name'];

        if ($file_name && in_array($file_type, $file_mimes)) {
            $arr_file = explode('.', $file_name);
            $extension = end($arr_file);

            if ($extension == "xlsx") {
                $reader = new Xlsx();
            } else {
                $reader = new Xls();
            }

            $spreadsheet = $reader->load($file_tmp);

            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            $waktu = date('Y-m-d H:i:s');
            for ($i = 0; $i < count($sheetData); $i++) {
                $nomor = $sheetData[$i]['0'];
                $checkData = $this->pemilih_model->checkNomor($nomor)->getResult();
                if ($checkData) {
                    $message = "NIS/NIP yang dimasukkan sudah ada. Silahkan periksa kembali file Ms. Excel Anda.";
                } else {
                    $data = [
                        'no_induk'      => $sheetData[$i]['0'],
                        'nama'          => $sheetData[$i]['1'],
                        'kelas_id_user' => $kelas_id,
                        'no_a'          => $sheetData[$i]['2'],
                        'dibuat'        => $waktu,
                        'diganti'       => $waktu,
                        'level'         => 'pemilih',
                        'status'        => 'Belum Memilih'
                    ];
                    $this->pemilih_model->addAnggota($data);
                    $kelas = $this->pemilih_model->getKelas($kelas_id)->getResult();
                    foreach ($kelas as $kls) {
                        $anggota = $kls->anggota;
                        $data = [
                            'anggota' => $anggota + 1,
                        ];
                        $id = $kelas_id;
                        $this->pemilih_model->updateKelas($data, $id);
                    }
                }
            }
            $id = $kelas_id;
            if (!$checkData) {
                return redirect()->to(base_url('admin/pemilih/anggota/' . $kelas_id))->with('sukses', 'Import data berhasil.');
            } else {
                $this->anggota($id, $message);
            }
        } else {
            $id = $kelas_id;
            $message = "Harap input file dengan ekstensi .xls atau .xlsx";
            $this->anggota($id, $message);
        }
    }
    //End Controller anggota
}
