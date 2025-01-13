<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  require 'vendor/autoload.php';
  use PhpOffice\PhpSpreadsheet\IOFactory;

  class Item extends CI_Controller {

    public function __construct()
    { 
      parent::__construct();
      $this->load->model("model_Item");
      $this->load->library('session');
      $this->load->library('phpqrcode/qrlib');
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

///////////////////////////////////////////////////////////////////////////////////////////////ITEM

    public function index()
    {
      $getData["getData"] = $this->model_Item->getItemMod();
      $this->load->view('UI/Item', $getData);
    }

    public function saveItemCon()
    {
        date_default_timezone_set('Asia/Jakarta');

        $data = array (
          
                'itemCode' => strtoupper($this->input->post('itemCode')),
                'itemName' => strtoupper($this->input->post('itemName')),
                'jumlahItem' => $this->input->post('jumlahItem'),
                'netQuantity' => $this->input->post('netQuantity'),
                'status' => 1,
                'createdBy' => '',
                'createdDate' => date("Y-m-d H:i:s")
            );

        $insert = $this->model_Item->saveItemMod($data);
        redirect(base_url('./Item'));
    }

    public function editItemCon()
    {
      date_default_timezone_set('Asia/Jakarta');

      $data = array (
        
              'itemCode' => strtoupper($this->input->post('itemCodeU')),
              'jumlahSebelum' => $this->input->post('jumlahSebelum'),
              'jumlahSesudah' => $this->input->post('jumlahItemU'),
              'createdBy' => 'admin',
              'createdDate' => date("Y-m-d H:i:s")
          );

      $this->model_Item->saveItemHistoryMod($data);
      $this->model_Item->editItemMod();
      redirect(base_url('./Item'));
    }

    function printQRCodeItemCon()
    {
        $post = $this->input->post();
        $dataPrint = $post['listPrint'];
        $listPrint = explode("|", $dataPrint);

        $listDataPrint = array();
        $count = 1;
        foreach ($listPrint as $l) {
            $listDataPrint[] = json_encode($this->model_Item->getItemQrMod($l), true);
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

    public function ExportExcelItemCon()
    {
        $getData = $this->model_Item->getItemMod();
        
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
        
        $table_columns = ["Item Code", "Item Name", "Jumlah Item", "Net Quantity", "Status"];
        $column = 0;

        // Set header columns and style
        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $object->getActiveSheet()->getStyle('A:E')->getFont()->setSize(11);
            $object->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $object->getActiveSheet()->getStyle('A1:E1')->applyFromArray(
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
            
            $object->getActiveSheet()->getColumnDimensionByColumn($column)->setAutoSize(true);

            $column++;
        }
        
        // Set data
        $excel_row = 2;
        foreach ($getData as $data) {
            $status = ($data->status == 0) ? "Tidak Aktif" : "Aktif";
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $data->itemCode);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $data->itemName);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $data->jumlahItem);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $data->netQuantity);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $status);
            $excel_row++;
        }

        date_default_timezone_set('Asia/Jakarta');
        $fileName = "DataItem_" . date('Y-m-d_H:i:s') . ".xls";
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        $object_writer->save('php://output');
    }
    
    public function importExcelItemCon()
    {
        date_default_timezone_set('Asia/Jakarta');
        if (isset($_FILES['file'])) {
            $uploadDir = 'uploads/';
            $fileName = basename($_FILES['file']['name']);
            $filePath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
                try {
                    $spreadsheet = IOFactory::load($filePath);
                    $sheet = $spreadsheet->getActiveSheet();
                    $data = $sheet->toArray();

                    $itemCodesFromExcel = [];
                    foreach ($data as $key => $row) {
                        if ($key == 0) {
                            continue;
                        }
                        $itemCodesFromExcel[] = $row[0];
                    }

                    $missingItemCodes = [];
                    foreach ($itemCodesFromExcel as $itemCode) {
                        $existData = $this->model_Item->getItemQrMod($itemCode);
                        if ($existData == null) {
                            $missingItemCodes[] = $itemCode;
                        }
                    }

                    if (!empty($missingItemCodes)) {
                        $this->session->set_flashdata('error', 'ItemCode berikut tidak ditemukan di database: ' . implode(', ', $missingItemCodes));
                        redirect(base_url('./Item'));
                        return;
                    }

                    foreach ($data as $key => $row) {
                        if ($key == 0) {
                            continue;
                        }

                        $tempData = array(
                            'itemCode'    => $row[0],
                            'itemName'    => $row[1],
                            'jumlahItem'  => $row[2],
                            'netQuantity' => $row[3],
                            'status'      => ($row[4] == "Aktif") ? 1 : 0,
                            'modifiedBy'  => '',
                            'modifiedDate'=> date("Y-m-d H:i:s"),
                        );
                        $this->model_Item->updateItemMod($tempData);
                    }

                    $this->session->set_flashdata('success', 'Data berhasil diimport!');
                    redirect(base_url('./Item'));
                } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
                    echo $e->getMessage();
                }
            } else {
                echo "Error mengunggah file.";
            }
        } else {
            echo "Tidak ada file yang diunggah.";
        }
    }
  }
?>