<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class CetakBarangMasuk extends CI_Controller {

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

/////////////////////////////////////////////////////////////////////////////////////////CETAKBARANGMASUK

    public function index()
    {
        $fromDate = $this->input->post('fromDate');
        $endDate = $this->input->post('endDate');

        if($fromDate || $endDate != '')
        {
          $getData["getData"] = $this->model_HistoryBarang->getFilterTanggalMasukMod($fromDate, $endDate);
        } 
        else 
        {
          $getData["getData"] = $this->model_HistoryBarang->getCetakExcelMasukMod();       
        }
        $this->load->view('UI/CetakBarangMasuk', $getData);
    }

    public function ExportExcelMasukCon(){
      $fromDate = $this->input->post('fromDate');
      $endDate = $this->input->post('endDate');
      $endDate = date('Y-m-d H:i:s', strtotime($endDate . ' +1 day'));

      if (!empty($_POST['btnCari'])) 
      {
          if($fromDate || $endDate != ''){
              $getData["getData"] = $this->model_HistoryBarang->getFilterTanggalMasukMod($fromDate, $endDate);
          } 
          else {
              $getData["getData"] = $this->model_HistoryBarang->getCetakExcelMasukMod();       
          }
          $this->load->view('UI/CetakBarangMasuk', $getData);
      }
      else if (!empty($_POST['export'])) 
      {
          if($fromDate || $endDate != ''){
              $getData = $this->model_HistoryBarang->getFilterTanggalMasukMod($fromDate, $endDate);
              $this->model_HistoryBarang->updateFilterTanggalMasukMod($fromDate, $endDate);          
          } 
          else {
              $this->model_HistoryBarang->updateCetakExcelMasukMod();   
              $getData = $this->model_HistoryBarang->getCetakExcelMasukMod();         
          }
          
          $object = new PHPExcel();
          $object->setActiveSheetIndex(0);

          $table_columns = array("Purchase Order", "Delivery Note", "Tanggal", "Item Code", "Item Name", "whFrom", "whTo", "Qty");
          $column = 0;

          foreach($table_columns as $field)
          {
              $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
              $object->getActiveSheet()->getStyle('A:H')->getFont()->setSize(11);
              $object->getActiveSheet()->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
              $object->getActiveSheet()->getStyle('A')->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
              $object->getActiveSheet()->getStyle('B')->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_NUMBER );
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
              $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $data->purchaseOrder)->getColumnDimension('A')->setWidth(20);
              $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $data->deliveryNote)->getColumnDimension('B')->setWidth(20);           
              $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $data->tanggal)->getColumnDimension('C')->setWidth(20);
              $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $data->itemCode)->getColumnDimension('D')->setWidth(25);
              $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $data->itemName)->getColumnDimension('E')->setWidth(30);
              $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $data->whFrom)->getColumnDimension('F')->setWidth(18);
              $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $data->whTo)->getColumnDimension('G')->setWidth(15);
              $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $data->qty)->getColumnDimension('H')->setWidth(15);
              $excel_row++;
          }
  
          date_default_timezone_set('Asia/Jakarta');
          $fileName = "HistoryBarangMasuk_" . date('Y-m-d H:i:s') . ".xls";

          $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
          header("Content-Type: application/vnd.ms-excel"); 
          header("Content-Disposition: attachment; filename=\"$fileName\""); 
          $object_writer->save('php://output');

        }
    }

  }
?>