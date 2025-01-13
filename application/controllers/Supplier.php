<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Supplier extends CI_Controller {

    public function __construct()
    { 
      parent::__construct();
      $this->load->model("model_Supplier");
      $this->load->library('session');
      $this->load->library('phpqrcode/qrlib');
      $this->load->helper('url');
      $this->load->library('cart');

      if (!$this->session->userdata('idUser')) {
        redirect(site_url('Login'));
      } else {
        if ($this->session->userdata('role') != 1) {    // kalo bukan admin
            redirect(site_url('Login'));
        }
      }

    }

    function qrCodeCon($id)
    {
        qrcode::png(
            $id,
            $outfile = false,
            $level = QR_ECLEVEL_H,
            $size = 12,
            $margin = 0
        );
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////ITEM

    public function index()
    {
      $getData["getData"] = $this->model_Supplier->getSupplierMod();
      $getData["getDataCart"] = $this->model_Supplier->getSupplierCartMod();
      $this->load->view('UI/Supplier', $getData);
    }

    function printQRCodeSupplierCon()
    {
        $post = $this->input->post();
        $dataPrint = $post['listPrint'];
        $listPrint = explode("|", $dataPrint);

        $listDataPrint = array();
        $count = 1;
        foreach ($listPrint as $l) {
            $listDataPrint[] = json_encode($this->model_Supplier->getSupplierQrMod($l), true);
        }

        $data["print"] = $listDataPrint;

        $this->load->view('UI/QrCodeSupplier', $data);
    }

    function printQRCodeSupplierCart()
    {
        
        $post = $this->input->post();
        $dataPrint = $post['listPrintx'];
        $listPrintx = explode("|", $dataPrint);

        $listDataPrint = array();
        $count = 1;
        
            foreach ($listPrintx as $l) {
                $listDataPrint[] = json_encode($this->model_Supplier->getSupplierQrMod($l), true);
                // $this->model_Supplier->setMinus($itemCode);
                json_encode($this->model_Supplier->setMinus($l), true);
            }
        
        $data["print"] = $listDataPrint;
        $this->load->view('UI/QrCodeSupplier', $data);
      
    }

    public function plusbtn($itemCode)
    {
      $this->model_Supplier->setPlus($itemCode);
      redirect(base_url('./Supplier'));
    }

    public function minusbtn($itemCode)
    {
      $this->model_Supplier->setMinus($itemCode);
      redirect(base_url('./Supplier'));
    }

    public function resetbtn()
    {
      $post = $this->input->post();
        $dataPrint = $post['listPrintClear'];
        $listPrintClear = explode("|", $dataPrint);

        $listDataPrint = array();
        $count = 1;
        
            foreach ($listPrintClear as $l) {
                $listDataPrint[] = json_encode($this->model_Supplier->getSupplierQrMod($l), true);
                // $this->model_Supplier->setMinus($itemCode);
                json_encode($this->model_Supplier->setMinus($l), true);
            }
        redirect(base_url('./Supplier'));
    }
  }
?>