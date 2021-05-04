<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends Controller
{
	public function index()
	{
		if (session()->logged_in) {
            if (session()->level == "admin") {
                return redirect()->to(base_url('/admin/dashboard'));            
            } elseif (session()->level == "pemilih") {
                return redirect()->to(base_url('/pemilih'));  
            }
		}
		$data['title'] = "";
		$data['content'] = "pages/main";
		echo view('template/home/body', $data);
	}

	//--------------------------------------------------------------------

}
