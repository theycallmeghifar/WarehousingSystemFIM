<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class MainItem extends CI_Controller {

    public function __construct()
    { 
      parent::__construct();
      $this->load->model("model_MainItem");
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

///////////////////////////////////////////////////////////////////////////////////////////////MAINITEM

    public function index()
    {
      $getData["getData"] = $this->model_MainItem->getMainItemMod();
      $this->load->view('UI/MainItem', $getData);
    }

    public function saveMainItemCon()
    {
        date_default_timezone_set('Asia/Jakarta');

        $data = array (
                'mainItemCode' => strtoupper($this->input->post('mainItemCode')),
                'mainItemName' => strtoupper($this->input->post('mainItemName')),
                'itemCode' => strtoupper($this->input->post('itemCode')),
                'position' => $this->input->post('position'),
                'status' => 1,
                'createdBy' => '',
                'createdDate' => date("Y-m-d H:i:s")
            );

        $insert = $this->model_MainItem->saveMainItemMod($data);
        redirect(base_url('./MainItem'));
    }

    public function editMainItemCon()
    {
      $this->model_MainItem->editMainItemMod();
      redirect(base_url('./MainItem'));
    }

    public function printQRCodeMainItemCon()
    {
        $post = $this->input->post();
        $dataPrint = $post['listPrint'];
        $listPrint = explode("|", $dataPrint);

        $listDataPrint = array();
        $count = 1;
        foreach ($listPrint as $l) {
            $listDataPrint[] = json_encode($this->model_MainItem->getMainItemQrMod($l), true);
        }

        $data["print"] = $listDataPrint;

        $this->load->view('UI/QrCodeMainItem', $data);
    }

    public function mainItemAutoCon() 
    {
        // POST data
        $postData = $this->input->post();
        // Get data
        $data = $this->model_MainItem->getMainItemAutoMod($postData);
        echo json_encode($data);
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