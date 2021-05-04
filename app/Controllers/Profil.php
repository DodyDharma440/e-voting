<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Profil_model;

class Profil extends Controller
{
    public function __construct()
    {
        helper(['form']);
        $this->profil_model = new Profil_model;
    }

    public function index()
    {
        $level = session()->level;
        $data['level'] = $level;
        $data['content'] = "/pages/common/profil/index";
        $data['title'] = "Edit Profil";
        $data['active'] = "edit";
        $data['user'] = $this->profil_model->getAdmin()->getResult();
        $data['validation'] = $this->validator;
        echo view('template/app/' . $level . '/body', $data);
    }

    public function updateNama()
    {
        $level = session()->level;
        $no_induk = $this->request->getPost('no_induk');
        $no_induk_default = $this->request->getPost('no_induk_default');
        if ($no_induk == $no_induk_default) {
            $ni = $no_induk_default;
            $unique = "required";
        } else {
            $ni = $no_induk;
            $unique = 'required|is_unique[user.no_induk]';
        }

        $rules = [
            'no_induk' => ['label' => 'Username', 'rules' => $unique],
            'nama'     => ['label' => 'Nama', 'rules' => 'required'],
        ];

        if ($this->validate($rules)) {
            $id = $this->request->getPost('user_id');
            $data = [
                'no_induk' => $ni,
                'nama'     => $this->request->getPost('nama'),
            ];
            $this->profil_model->updateNama($data, $id);
            session()->set($data);
            return redirect()->to(base_url($level . '/edit_profil'))->with('sukses', 'Data berhasil diupdate.');
        } else {
            $this->index();
        }
    }

    public function hapusAkun()
    {
        $id = $this->request->getPost('user_id');
        $this->profil_model->deleteAkun($id);
        session()->destroy();
        return redirect()->to(base_url());
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
        $level = session()->level;
        $id = $this->request->getPost('user_id');
        $rules = [
            'new_password' => ['label' => 'Password Baru', 'rules' => 'required|min_length[8]'],
            're_password'  => ['label' => 'Konfirmasi Password', 'rules' => 'matches[new_password]'],
        ];

        if ($this->validate($rules)) {
            $data = [
                'password' => password_hash($this->request->getVar('new_password'), PASSWORD_DEFAULT),
            ];
            $this->profil_model->updatePassword($data, $id);
            return redirect()->to(base_url($level . '/edit_profil'))->with('sukses', 'Password berhasil diupdate.');
        } else {
            $this->index();
        }
    }
}
