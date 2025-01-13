<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Dashboard extends CI_Controller {

    public function __construct()
    { 
      parent::__construct();
      $this->load->model("model_Dashboard");
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

///////////////////////////////////////////////////////////////////////////////////////DASHBOARD

    public function index()
    {
      $data["dash_lemari"] = $this->model_Dashboard->getLemariMod();
      $data["dash_rak"] = $this->model_Dashboard->getRakMod();
      $data["dash_palet"] = $this->model_Dashboard->getPaletMod();
      $data["dash_barang"] = $this->model_Dashboard->getBarangMod();
      $data["dash_mainitem"] = $this->model_Dashboard->getMainItemMod();
      $data["dash_item"] = $this->model_Dashboard->getItemMod();

      $this->load->view('UI/Dashboard', $data);
    }

  }
?>