<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class CetakBarangKeluar extends CI_Controller {

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

////////////////////////////////////////////////////////////////////////////////////////CETAKBARANGKELUAR

    public function index()
    {
        $fromDate = $this->input->post('fromDate');
        $endDate = $this->input->post('endDate');

        if($fromDate || $endDate != ''){
          $getData["getData"] = $this->model_HistoryBarang->getFilterTanggalKeluarMod($fromDate, $endDate);
        } else {
          $getData["getData"] = $this->model_HistoryBarang->getCetakExcelKeluarMod();       
        }
        $this->load->view('UI/CetakBarangKeluar', $getData);
    }

    public function ExportExcelKeluarCon(){
      $fromDate = $this->input->post('fromDate');
      $endDate = $this->input->post('endDate');
      $endDate = date('Y-m-d H:i:s', strtotime($endDate . ' +1 day'));

      if (!empty($_POST['btnCari'])) 
      {
          if($fromDate || $endDate != ''){
              $getData["getData"] = $this->model_HistoryBarang->getFilterTanggalKeluarMod($fromDate, $endDate);
          } 
          else {
              $getData["getData"] = $this->model_HistoryBarang->getCetakExcelKeluarMod();       
          }
          $this->load->view('UI/CetakBarangKeluar', $getData);
      }
      else if (!empty($_POST['export'])) 
      {
          if($fromDate || $endDate != ''){
              $getData = $this->model_HistoryBarang->getFilterTanggalKeluarMod($fromDate, $endDate);
              $this->model_HistoryBarang->updateFilterTanggalKeluarMod($fromDate, $endDate);          
          } 
          else {
              $this->model_HistoryBarang->updateCetakExcelKeluarMod();   
              $getData = $this->model_HistoryBarang->getCetakExcelKeluarMod();         
          }
          
          $object = new PHPExcel();
          $object->setActiveSheetIndex(0);

          $table_columns = array("Tanggal", "Main Item Code", "Main Item Name", "Item Code", "Item Name", "whFrom", "whTo", "Qty");
          $column = 0;

          foreach($table_columns as $field)
          {
              $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
              $object->getActiveSheet()->getStyle('A:H')->getFont()->setSize(11);
              $object->getActiveSheet()->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
              $object->getActiveSheet()->getStyle('A1:H1')->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '0F4ED8')
                    ),
                    'font'  => array(
                      'bold'  => true,
                      'color' => array('rgb' => 'FFFFFF'),
                      'size'  => 11,
                    ),
                )
              );
              $column++;
          }

          $excel_row = 2;
          
          foreach($getData as $data)
          {
              $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $data->tanggal)->getColumnDimension('A')->setWidth(20);
              $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $data->mainItemCode)->getColumnDimension('B')->setWidth(25);
              $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $data->mainItemName)->getColumnDimension('C')->setWidth(30);
              $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $data->itemCode)->getColumnDimension('D')->setWidth(25);
              $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $data->itemName)->getColumnDimension('E')->setWidth(30);
              $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $data->whFrom)->getColumnDimension('F')->setWidth(15);
              $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $data->whTo)->getColumnDimension('G')->setWidth(15);
              $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $data->qty)->getColumnDimension('H')->setWidth(15);
              $excel_row++;
          }
  
          date_default_timezone_set('Asia/Jakarta');
          $fileName = "HistoryBarangKeluar_" . date('Y-m-d H:i:s') . ".xls";

          $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
          header("Content-Type: application/vnd.ms-excel"); 
          header("Content-Disposition: attachment; filename=\"$fileName\""); 
          $object_writer->save('php://output');

        }
    }

  }
?>