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
          if ($this->session->userdata('role') != 0 && $this->session->userdata('role') != 2 && $this->session->userdata('role') != 3) {
              redirect(site_url('Login'));
          }
      }
    }

////////////////////////////////////////////////////////////////////////////////////////CETAKBARANGKELUAR

    public function index()
    {
      $userSession = $this->session->userdata();
      
      $fromDate = $this->input->post('fromDate');
      $endDate = $this->input->post('endDate');

      if($fromDate || $endDate != '') {
        if ($userSession['role'] == 0) {
          $getData["getData"] = $this->model_HistoryBarang->getFilterTanggalKeluarMod($fromDate, $endDate);
        } else {
          $getData["getData"] = $this->model_HistoryBarang->getFilterTanggalItemKeluarMod($fromDate, $endDate);
        }
      } else {
        if ($userSession['role'] == 0) {
          $getData["getData"] = $this->model_HistoryBarang->getCetakExcelKeluarMod();
        } else {
          $getData["getData"] = $this->model_HistoryBarang->getItemKeluarMod();
        }
      }
      $this->load->view('UI/CetakBarangKeluar', $getData);
    }

    public function ExportExcelKeluarCon(){
      $userSession = $this->session->userdata();

      $fromDate = $this->input->post('fromDate');
      $endDate = $this->input->post('endDate');
      $endDate = date('Y-m-d H:i:s', strtotime($endDate . ' +1 day'));

      if (!empty($_POST['btnCari'])) 
      {
          if ($fromDate || $endDate != '') {
            if ($userSession['role'] == 0) {
              $getData["getData"] = $this->model_HistoryBarang->getFilterTanggalKeluarMod($fromDate, $endDate);
            } else {
              $getData["getData"] = $this->model_HistoryBarang->getFilterTanggalItemKeluarMod($fromDate, $endDate);
            }
          } 
          else {
            if ($userSession['role'] == 0) {
              $getData["getData"] = $this->model_HistoryBarang->getCetakExcelKeluarMod();
            } else {
              $getData["getData"] = $this->model_HistoryBarang->getItemKeluarMod();
            }
          }
          $this->load->view('UI/CetakBarangKeluar', $getData);
      }
      else if (!empty($_POST['export'])) 
      {
          if($fromDate || $endDate != ''){
            if ($userSession['role'] == 0) {
              $getData = $this->model_HistoryBarang->getFilterTanggalKeluarMod($fromDate, $endDate);
              $this->model_HistoryBarang->updateFilterTanggalKeluarMod($fromDate, $endDate); 
            } else {
              $getData = $this->model_HistoryBarang->getFilterTanggalItemKeluarMod($fromDate, $endDate);
              $this->model_HistoryBarang->updateHistoryItemKeluarFilterTanggalMod($fromDate, $endDate); 
            }
          } 
          else {
            if ($userSession['role'] == 0) {
              $this->model_HistoryBarang->updateCetakExcelKeluarMod();
              $getData["getData"] = $this->model_HistoryBarang->getCetakExcelKeluarMod();
            } else {
              $this->model_HistoryBarang->updateHistoryItemKeluarMod();
              $getData["getData"] = $this->model_HistoryBarang->getItemKeluarMod();
            }
          }
          
          $object = new PHPExcel();
          $object->setActiveSheetIndex(0);

          if ($userSession['role'] == 0) {  
            $table_columns = array("Tanggal", "Main Item Code", "Main Item Name", "Item Code", "Item Name", "whFrom", "whTo", "Qty");
            $range = 'A1:H1';
          } else {  
            $table_columns = array("Item Code", "Item Name", "Jumlah", "Tanggal");
            $range = 'A1:D1';
          }
          $column = 0;

          foreach($table_columns as $field)
          {
              $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
              $object->getActiveSheet()->getStyle('A:H')->getFont()->setSize(11);
              $object->getActiveSheet()->getStyle($range)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
              $object->getActiveSheet()->getStyle($range)->applyFromArray(
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
            if ($userSession['role'] == 0) {  
              $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $data->tanggal)->getColumnDimension('A')->setWidth(20);
              $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $data->mainItemCode)->getColumnDimension('B')->setWidth(25);
              $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $data->mainItemName)->getColumnDimension('C')->setWidth(30);
              $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $data->itemCode)->getColumnDimension('D')->setWidth(25);
              $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $data->itemName)->getColumnDimension('E')->setWidth(30);
              $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $data->whFrom)->getColumnDimension('F')->setWidth(15);
              $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $data->whTo)->getColumnDimension('G')->setWidth(15);
              $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $data->qty)->getColumnDimension('H')->setWidth(15);
            } else { 
              $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $data->itemCode)->getColumnDimension('A')->setWidth(25);
              $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $data->itemName)->getColumnDimension('B')->setWidth(30);
              $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $data->jumlahKeluar)->getColumnDimension('C')->setWidth(18);
              $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $data->tanggal)->getColumnDimension('D')->setWidth(25);
            }
              $excel_row++;
          }
  
          date_default_timezone_set('Asia/Jakarta');
          $fileName = ($userSession['role'] == 0 ? "HistoryBarangKeluar_" : "HistoryItemKeluar_") . str_replace(':', '_', date('Y-m-d H:i:s')) . ".xls";

          $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
          header("Content-Type: application/vnd.ms-excel"); 
          header("Content-Disposition: attachment; filename=\"$fileName\""); 
          $object_writer->save('php://output');

        }
    }

  }
?>