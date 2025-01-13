<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Palet extends CI_Controller {

    public function __construct()
    { 
      parent::__construct();
      $this->load->model("model_Palet");
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

///////////////////////////////////////////////////////////////////////////////////////////////PALET

    public function index()
    {
      // Set ddl fk
      $rak = $this->model_Palet->getAllRakMod();
      $getData['rak'] = $rak;

      $getData["getData"] = $this->model_Palet->getPaletMod();
      $this->load->view('UI/Palet', $getData);
    }

    public function savePaletCon()
    {
        date_default_timezone_set('Asia/Jakarta');

        $data = array (
                'idRak' => $this->input->post('idRak'),
                'deskripsiPalet' => $this->input->post('deskripsiPalet'),
                'maxBarang' => $this->input->post('maxBarang'),
                'status' => 1,
                'ipAddress' => $this->input->post('ipAddress'),
                'gpio1' => $this->input->post('gpio1'),
                'gpio2' => $this->input->post('gpio2'),
                'gpio3' => $this->input->post('gpio3'),
                'createdBy' => '',
                'createdDate' => date("Y-m-d H:i:s")
            );

        $insert = $this->model_Palet->savePaletMod($data);
        redirect(base_url('./Palet'));
    }

    public function editPaletCon()
    {
      $this->model_Palet->editPaletMod();
      redirect(base_url('./Palet'));
    }

    public function printQRCodePaletCon()
    {
        $post = $this->input->post();
        $dataPrint = $post['listPrint'];
        $listPrint = explode("|", $dataPrint);

        $listDataPrint = array();
        $count = 1;
        foreach ($listPrint as $l) {
            $listDataPrint[] = json_encode($this->model_Palet->getPaletQrMod($l), true);
        }

        $data["print"] = $listDataPrint;
        $this->load->view('UI/QrCodePalet', $data);
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

  }
?>