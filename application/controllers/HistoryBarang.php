<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class HistoryBarang extends CI_Controller {

    public function __construct()
    { 
      parent::__construct();
      $this->load->model("model_HistoryBarang");
      $this->load->library('session');
      $this->load->helper('url');
      $this->load->library("excel");

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
      // Set ddl fk
      $palet = $this->model_HistoryBarang->getAllPaletMod();
      $mainitem = $this->model_HistoryBarang->getAllMainItemMod();
      $item = $this->model_HistoryBarang->getAllItemMod();
      
      $getData['palet'] = $palet;
      $getData['mainitem'] = $mainitem;
      $getData['item'] = $item;

      $status = $this->input->post('status');
      if ($status == '')
      {
        $getData["getData"] = $this->model_HistoryBarang->getHistoryBarangMod();
      }
      else
      {
        $getData["getData"] = $this->model_HistoryBarang->getFilterHistoryBarangMod($status);
      }
      
      $this->load->view('UI/HistoryBarang', $getData);
    }
  }
?>