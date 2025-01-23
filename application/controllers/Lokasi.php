<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Lokasi extends CI_Controller {

    public function __construct()
    { 
      parent::__construct();
      $this->load->model("model_Lokasi");
      $this->load->library('session');
      $this->load->helper('url');
      $this->load->library('form_validation');

      if (!$this->session->userdata('idUser')) {
        redirect(site_url('Login'));
      } else {
          if ($this->session->userdata('role') != 2) {
              redirect(site_url('Login'));
          }
      }
    }

//////////////////////////////////////////////////////////////////////////////////////

    public function index()
    {
      // Set ddl fk
      $item = $this->model_Lokasi->getAllItemMod();
      $getData['item'] = $item;

      $getData["getData"] = $this->model_Lokasi->getLokasiMod();
      $this->load->view('UI/Lokasi', $getData);
    }

    public function saveLokasiCon()
    {
        date_default_timezone_set('Asia/Jakarta');

        $data = array (
                'itemCode' => $this->input->post('itemCode'),
                'lokasi' => $this->input->post('lokasi'),
                'status' => 1,
                'createdBy' => '',
                'createdDate' => date("Y-m-d H:i:s")
            );

        $this->model_Lokasi->saveLokasiMod($data);
        redirect(base_url('./Lokasi'));
    }

    public function editLokasiCon()
    {
      $this->model_Lokasi->editLokasiMod();
      redirect(base_url('./Lokasi'));
    }

  }
?>