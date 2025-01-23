<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Dandori extends CI_Controller {

    public function __construct()
    { 
      parent::__construct();
      $this->load->model("model_Dandori");
      $this->load->library('session');
      $this->load->helper('url');

      if (!$this->session->userdata('idUser')) {
        redirect(site_url('Login'));
      } else {
        if ($this->session->userdata('role') != 2 && $this->session->userdata('role') != 3) {
            redirect(site_url('Login'));
        }
      }
    }

///////////////////////////////////////////////////////////////////////////////////////DASHBOARD

    public function index()
    {
      $data["item"] = $this->model_Dandori->getItemMod();
      $data["lokasi"] = $this->model_Dandori->getLokasiMod();
      $this->load->view('UI/Dandori', $data);
    }

    public function checkItemCode()
    {
      $itemCode = $this->input->post('itemCode');

      // Query ke database untuk mengecek itemCode
      $item = $this->model_Dandori->getItemByItemCodeMod($itemCode);

      if ($item) {
        echo json_encode(['exists' => true, 'data' => $item]);
      } else {
        echo json_encode(['exists' => false]);
      }
    }

    public function itemMasukCon()
    {
      $itemCodes = $this->input->post('itemCode');
      $qtys = $this->input->post('qty');

      if (!empty($itemCodes) && !empty($qtys) && count($itemCodes) === count($qtys)) {
          $dataToInsert = [];

          foreach ($itemCodes as $key => $itemCode) {
              $qty = $qtys[$key];

              if (!empty($itemCode) && is_numeric($qty) && $qty > 0) {
                  $item = $this->model_Dandori->getItemByItemCodeMod($itemCode);

                  $dataToInsert[] = [
                      'itemCode' => $itemCode,
                      'jumlahMasuk' => $qty,
                      'jumlahKeluar' => 0,
                      'warehouse' => 115,
                      'tanggal' => date('Y-m-d H:i:s'),
                      'status' => 0,
                      'createdBy' => '',
                      'createdDate' => date('Y-m-d H:i:s'),
                  ];

                  
                  $jumlahItem = $item->jumlahItem + $qty;
                  $this->model_Dandori->updateJumlahItemMod($itemCode, $jumlahItem);
              }
          }

          if (!empty($dataToInsert)) {
              $isSaved = $this->model_Dandori->saveItemMasukBatch($dataToInsert);

              if ($isSaved) {
                  $this->session->set_flashdata('success', 'Data berhasil disimpan.');
                  redirect(site_url('Dandori'));
              } else {
                  $this->session->set_flashdata('error', 'Terjadi kesalahan saat menyimpan data.');
                  redirect(site_url('Dandori'));
              }
          } else {
              $this->session->set_flashdata('error', 'Tidak ada data valid untuk disimpan.');
              redirect(site_url('Dandori'));
          }
      } else {
          $this->session->set_flashdata('error', 'Input tidak valid. Pastikan semua data telah diisi.');
          redirect(site_url('Dandori'));
      }
    }

    public function itemKeluarCon()
    {
        $itemCodes = $this->input->post('itemCode');
        $qtys = $this->input->post('qty');

        if (!empty($itemCodes) && !empty($qtys) && count($itemCodes) === count($qtys)) {
            $dataToInsert = [];
            $errorItems = []; // Untuk menyimpan error jika qty melebihi jumlahItem

            foreach ($itemCodes as $key => $itemCode) {
                $qty = $qtys[$key];

                if (!empty($itemCode) && is_numeric($qty) && $qty > 0) {
                    $item = $this->model_Dandori->getItemByItemCodeMod($itemCode);

                    if ($item && $qty <= $item->jumlahItem) {
                        // Validasi berhasil, tambahkan ke data untuk di-insert
                        $dataToInsert[] = [
                            'itemCode' => $itemCode,
                            'jumlahMasuk' => 0,
                            'jumlahKeluar' => $qty,
                            'warehouse' => 115,
                            'tanggal' => date('Y-m-d H:i:s'),
                            'status' => 0,
                            'createdBy' => '',
                            'createdDate' => date('Y-m-d H:i:s'),
                        ];

                        // Update jumlahItem di database
                        $jumlahItem = $item->jumlahItem - $qty;
                        $this->model_Dandori->updateJumlahItemMod($itemCode, $jumlahItem);
                    } else {
                        // Jika qty melebihi jumlahItem, tambahkan ke error
                        $errorItems[] = $itemCode;
                    }
                }
            }

            if (!empty($errorItems)) {
                // Jika ada error, kirim pesan error dan kembalikan ke halaman sebelumnya
                $this->session->set_flashdata(
                    'error',
                    'Jumlah item untuk kode berikut melebihi stok yang tersedia: ' . implode(', ', $errorItems)
                );
                redirect(site_url('Dandori'));
            }

            if (!empty($dataToInsert)) {
                $isSaved = $this->model_Dandori->saveItemMasukBatch($dataToInsert);

                if ($isSaved) {
                    $this->session->set_flashdata('success', 'Data berhasil disimpan.');
                    redirect(site_url('Dandori'));
                } else {
                    $this->session->set_flashdata('error', 'Terjadi kesalahan saat menyimpan data.');
                    redirect(site_url('Dandori'));
                }
            } else {
                $this->session->set_flashdata('error', 'Tidak ada data valid untuk disimpan.');
                redirect(site_url('Dandori'));
            }
        } else {
            $this->session->set_flashdata('error', 'Input tidak valid. Pastikan semua data telah diisi.');
            redirect(site_url('Dandori'));
        }
    }
  }
?>