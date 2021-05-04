<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\User_model;

class Login extends Controller
{
    public function __construct()
    {
        helper('form');
        helper('url');
        $this->user = new User_model;
    }

    public function index($message = false)
    {
        if (session()->logged_in) {
            if (session()->level == "admin") {
                return redirect()->to(base_url('admin/dashboard'));
            } elseif (session()->level == "pemilih") {
                return redirect()->to(base_url('pemilih'));
            }
        }
        $data['title'] = "Login";
        $data['validation'] = $this->validator;
        $data['message'] = $message;
        echo view("template/home/header", $data);
        echo view("pages/login", $data);
        echo view("template/home/footer", $data);
    }

    public function auth()
    {
        $rules = [
            'no_induk' => ['label' => 'NIS/NIP', 'rules' => 'required'],
            //'password' => ['label' => 'Password', 'rules' => 'required']
        ];

        if ($this->validate($rules)) {
            $session = session();
            $no_induk = $this->request->getPost('no_induk');
            $password = $this->request->getPost('password');
            $data = $this->user->getUser($no_induk)->getResult();
            if ($data) {
                foreach ($data as $d) {
                    $pass = $d->password;
                    if ($pass != "") {
                        $verify_pass = password_verify($password, $pass);
                    } else {
                        $verify_pass = $pass == $password;
                    }
                    if ($verify_pass) {
                        $sess_data = [
                            'logged_in'     => TRUE,
                            'user_id'       => $d->user_id,
                            'no_induk'      => $d->no_induk,
                            'nama'          => $d->nama,
                            'kelas_id_user' => $d->kelas_id_user,
                            'no_a'          => $d->no_a,
                            'level'         => $d->level,
                            'status'        => $d->status
                        ];
                        $session->set($sess_data);
                        if ($sess_data['level'] == "admin") {
                            return redirect()->to(base_url('/admin/dashboard'));
                        } else {
                            return redirect()->to(base_url('/pemilih'));
                        }
                    } else {
                        $message = "Password yang dimasukkan salah.";
                        $this->index($message);
                    }
                }
            } else {
                $message = "NIS/NIP yang dimasukkan tidak terdaftar";
                $this->index($message);
            }
        } else {
            $this->index();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url());
    }
}
