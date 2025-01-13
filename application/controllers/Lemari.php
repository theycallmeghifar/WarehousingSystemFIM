<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Lemari extends CI_Controller {

    public function __construct()
    { 
      parent::__construct();
      $this->load->model("model_Lemari");
      $this->load->library('session');
      $this->load->helper('url');

      if (!$this->session->userdata('idUser')) {
        redirect(site_url('Login'));
      } else {
          if ($this->session->userdata('role') != 0) {    // kalo bukan admin
              redirect(site_url('Login'));
          }
      }
    }

//////////////////////////////////////////////////////////////////////////////////////LEMARI

    public function index()
    {
      $getData["getData"] = $this->model_Lemari->getLemariMod();
      $this->load->view('UI/Lemari', $getData);
    }

    public function saveLemariCon()
    {
        date_default_timezone_set('Asia/Jakarta');
        
        $data = array (     
                'deskripsiLemari' => $this->input->post('deskripsiLemari'),
                'ukuranLemari' => $this->input->post('ukuranLemari'),
                'status' => 1,
                'createdBy' => '',
                'createdDate' => date("Y-m-d H:i:s")
            );

        $insert = $this->model_Lemari->saveLemariMod($data);
        redirect(base_url('./Lemari'));
    }

    public function editLemariCon()
    {
      $this->model_Lemari->editLemariMod();
      redirect(base_url('./Lemari'));
    }

  }
?>