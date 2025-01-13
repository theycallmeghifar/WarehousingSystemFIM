<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Login extends CI_Controller {

    public function __construct()
    { 
      parent::__construct();
      $this->load->model("model_Login");
      $this->load->library('session');
      $this->load->helper('url');

      // if (!$this->session->userdata('idUser')) {
      //   redirect(site_url('Functions/Login'));
      // } else {
        //   if ($this->session->userdata('role') != 0) {    // kalo bukan admin
        //       redirect(site_url('Login'));
        //   }
      // }
    }

///////////////////////////////////////////////////////////////////////////////////////LOGIN
    
    public function index()
    {
        $this->load->library('session');
        $this->session->sess_destroy();
        $this->load->view('UI/Login');
    }

    public function getLogin()
    {
        $uname = $_POST['uname'];
        $pass = $_POST['password'];

        $data = $this->model_Login->cekLoginMod($uname);

        $cek = 0;
        $msg = "Username atau password salah!";
        $role = -1;
        
        foreach ($data as $d) {
            if ($d->username == $uname && $d->password == $pass) {
                $cek = 1;
                $msg = "Selamat datang";
                        $cek = 1;
                        $role = $d->role;
                        if ($role == 0) $msg = "Selamat datang Administrator";
                        else if ($role == 1) $msg = "Selamat datang Supplier";
                        $session = array(
                            'idUser' => $d->idUser,
                            'role' => $d->role,
                            'username' => $d->username
                        );
                        $this->session->set_userdata($session);
            } else if ($d->username != $uname || $d->password != $pass) {
                $msg = "Username atau password salah!";
                $cek = -1;
            }
        }
        echo json_encode(array("cek" => $cek, "msg" => $msg, "role" => $role));
    }
  }
?>