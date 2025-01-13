<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Rak extends CI_Controller {

    public function __construct()
    { 
      parent::__construct();
      $this->load->model("model_Rak");
      $this->load->library('session');
      $this->load->helper('url');
      $this->load->library('form_validation');

      if (!$this->session->userdata('idUser')) {
        redirect(site_url('Login'));
      } else {
          if ($this->session->userdata('role') != 0) {    // kalo bukan admin
              redirect(site_url('Login'));
          }
      }
    }

//////////////////////////////////////////////////////////////////////////////////////RAK

    public function index()
    {
      // Set ddl fk
      $lemari = $this->model_Rak->getAllLemariMod();
      $getData['lemari'] = $lemari;

      $getData["getData"] = $this->model_Rak->getRakMod();
      $this->load->view('UI/Rak', $getData);
    }

    public function saveRakCon()
    {
        date_default_timezone_set('Asia/Jakarta');

        // $validation = $this->form_validation;
        // $validation->set_rules($this->model_Rak->rules());

        $data = array (
                'idLemari' => $this->input->post('idLemari'),
                'deskripsiRak' => $this->input->post('deskripsiRak'),
                'currentVolume' => $this->input->post('currentVolume'),
                'maxVolume' => $this->input->post('maxVolume'),
                'status' => 1,
                'createdBy' => '',
                'createdDate' => date("Y-m-d H:i:s")
            );

        // if ($this->model_Rak->validate($user)){
          $this->model_Rak->saveRakMod($data);
          redirect(base_url('./Rak'));
        // }
    }

    public function editRakCon()
    {
      $this->model_Rak->editRakMod();
      redirect(base_url('./Rak'));
    }

  }
?>