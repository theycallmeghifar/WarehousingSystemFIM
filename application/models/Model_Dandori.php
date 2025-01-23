<?php defined('BASEPATH') or exit('No direct script access allowed');

  class Model_Dandori extends CI_Model
  {

    private $tableHistoryBarang = "historybarang";
  
    ///////////////////////////////////////////////////////////////////////////////////////////////LEMARI

    public function getItemMod()
    {
      $sql = "
          SELECT
              itemCode, 
              (CASE WHEN itemCode = '' THEN '-' ELSE itemName END) AS itemName, 
              jumlahItem,
              netQuantity, 
              status, 
              createdBy, 
              (CASE WHEN createdDate = '0000-00-00 00:00:00' THEN '-' ELSE createdDate END) AS createdDate, 
              modifiedBy, 
              (CASE WHEN modifiedDate = '0000-00-00 00:00:00' THEN '-' ELSE modifiedDate END) AS modifiedDate
          FROM item 
          WHERE warehouse = 115
      ";

      // Menggunakan query binding untuk keamanan
      $query = $this->db->query($sql);

      return $query->result();
    }

    public function getLokasiMod()
    {
      $sql = "
          SELECT 
            idLokasi, 
            itemCode,
            lokasi, 
            status, 
            createdBy, 
            (case when createdDate = '0000-00-00 00:00:00' THEN '-' else createdDate end) as createdDate, 
            modifiedBy, 
            (case when modifiedDate = '0000-00-00 00:00:00' THEN '-' else modifiedDate end) as modifiedDate 
          from lokasi
      ";

      // Menggunakan query binding untuk keamanan
      $query = $this->db->query($sql);

      return $query->result();
    }

    public function getItemByItemCodeMod($itemCode)
    {
      return $this->db->get_where("item", ["itemCode" => $itemCode, "warehouse" => 115, "status" => 1])->row();
    }

    public function updateJumlahItemMod($itemCode, $jumlahItem)
    {
      $this->db->where('itemCode', $itemCode);
      $this->db->update("item", ['jumlahItem' => $jumlahItem]);
    }

    public function saveItemMasukBatch($data)
    {
      return $this->db->insert_batch($this->tableHistoryBarang, $data);
    }
  }
?>