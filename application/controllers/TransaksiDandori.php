<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class TransaksiDandori extends CI_Controller {

    public function __construct()
    { 
      parent::__construct();
      $this->load->model("model_TransaksiDandori");
      $this->load->library('session');
      $this->load->helper('url');

      if (!$this->session->userdata('idUser')) {
        redirect(site_url('Login'));
      } else {
          if ($this->session->userdata('role') != 2 && $this->session->userdata('role') != 3) {    // kalo bukan admin
              redirect(site_url('Login'));
          }
      }
    }

///////////////////////////////////////////////////////////////////////////////////////DASHBOARD

    public function index()
    {
      $item = $this->model_TransaksiDandori->getAllItemMod();
      $getData['item'] = $item;

      $getData["getData"] = $this->model_TransaksiDandori->getHistoryBarangMod();
      
      $this->load->view('UI/TransaksiDandori', $getData);
    }

    public function filterHistoryItemCon(){
        $fromDate = $this->input->post('fromDate');
        $endDate = $this->input->post('endDate');
        $status = $this->input->post('status');

        $getData["getData"] = $this->model_TransaksiDandori->getFilterHistoryItemMod($fromDate, $endDate, $status);
        $item = $this->model_TransaksiDandori->getAllItemMod();
        $getData['item'] = $item;

        $this->load->view('UI/TransaksiDandori', $getData);
    }
  }
?>