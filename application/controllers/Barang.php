<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Barang extends CI_Controller {

    public function __construct()
    { 
      parent::__construct();
      $this->load->model("model_Barang");
      $this->load->model("model_Item");
      
      $this->load->library('session');
      $this->load->library('phpqrcode/qrlib');
      $this->load->helper('url');

      if (!$this->session->userdata('idUser')) {
        redirect(site_url('Login'));
      } else {
          if ($this->session->userdata('role') != 0) {    // kalo bukan admin
              redirect(site_url('Login'));
          }
      }
    }

///////////////////////////////////////////////////////////////////////////////////////////////BARANG

    public function index()
    {
      // Set ddl fk
      $palet = $this->model_Barang->getAllPaletMod();
      $item = $this->model_Barang->getAllItemMod();
      
      $getData['palet'] = $palet;
      $getData['item'] = $item;

      $getData["getData"] = $this->model_Barang->getBarangMod();
      $this->load->view('UI/Barang', $getData);
    }

    public function saveBarangCon()
    {
        date_default_timezone_set('Asia/Jakarta');

        $data = array (
                'idPalet' => $this->input->post('idPalet'),
                'itemCode' => $this->input->post('itemCode'),
                'tanggalMasuk' => $this->input->post('tanggalMasuk'),
                'status' => 1,
                'createdBy' => '',
                'createdDate' => date("Y-m-d H:i:s")
            );

        $insert = $this->model_Barang->saveBarangMod($data);
        redirect(base_url('./Barang'));
    }

    public function editBarangCon()
    {
      $this->model_Barang->editBarangMod();
      redirect(base_url('./Barang'));
    }

    function printQRCodeMainItemBarangCon()
    {
        $post = $this->input->post();
        $dataPrint = $post['listPrintMI'];
        $listPrint = explode("|", $dataPrint);

        $listDataPrint = array();
        $count = 1;
        foreach ($listPrint as $l) {
            $listDataPrint[] = json_encode($this->model_Barang->getMainItemBarangQrMod($l), true);
        }

        $data["print"] = $listDataPrint;

        $this->load->view('UI/QrCodeMainItem', $data);
    }

    function printQRCodeItemCon()
    {
        $post = $this->input->post();
        $dataPrint = $post['listPrint'];
        $listPrint = explode("|", $dataPrint);

        $listDataPrint = array();
        $count = 1;
        foreach ($listPrint as $l) {
            $listDataPrint[] = json_encode($this->model_Barang->getItemQrMod($l), true);
        }

        $data["print"] = $listDataPrint;

        $this->load->view('UI/QrCodeItem', $data);
    }

    public function itemAutoCon() 
    {
        // POST data
        $postData = $this->input->post();
        // Get data
        $data = $this->model_Item->getItemAutoMod($postData);
        echo json_encode($data);
    }

  }
?>