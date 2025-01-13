<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class ItemHistory extends CI_Controller {

    public function __construct()
    { 
      parent::__construct();
      $this->load->model("model_ItemHistory");
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

//////////////////////////////////////////////////////////////////////////////////////RIWAYATBARANG

    public function index()
    {
      //Set ddl fk
      $item = $this->model_ItemHistory->getAllItemMod();  
      $getData['item'] = $item;

      $getData["getData"] = $this->model_ItemHistory->getItemHistoryMod();  
      
      $this->load->view('UI/ItemHistory', $getData);
    }
  }
?>