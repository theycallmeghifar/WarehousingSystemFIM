<?php defined('BASEPATH') or exit('No direct script access allowed');

  class Model_TransaksiDandori extends CI_Model
  {
    ///TABLE
    private $tableHistoryBarang = "historybarang";

    ///////////////////////////////////////////////////////////////////////////////////////////////

    public function getHistoryBarangMod()
    {
      $query = $this->db->query(
        "SELECT 
            idHistory, 
            itemCode,
            jumlahMasuk, 
            jumlahKeluar,  
            tanggal,
            CASE 
              WHEN jumlahMasuk = 0  then 'Item Keluar' 
              WHEN jumlahKeluar = 0 then 'Item Masuk' 
            End AS keterangan,
            CASE
              WHEN status = 1 then 'Batal'
              WHEN status = 0 then 'Selesai'
              WHEN status = 2 then 'Dicetak'
            END AS status,
            createdBy, 
            (case when createdDate = '0000-00-00 00:00:00' THEN '-' else createdDate end) as createdDate, 
            modifiedBy, 
            (case when modifiedDate = '0000-00-00 00:00:00' THEN '-' else modifiedDate end) as modifiedDate 
        from historybarang WHERE warehouse = 115 AND DATE(tanggal) = CURDATE()");

      return $query->result();
    }

    public function getItemByItemCodeMod($itemCode)
    {
      return $this->db->get_where("item", ["itemCode" => $itemCode, "warehouse" => 115])->row();
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

    public function getFilterHistoryItemMod($fromDate, $endDate, $status)
    {
      $query = $this->db->query(
        "SELECT 
            idHistory, 
            itemCode,
            jumlahMasuk, 
            jumlahKeluar,  
            tanggal,
            CASE 
              WHEN jumlahMasuk = 0  then 'Item Keluar' 
              WHEN jumlahKeluar = 0 then 'Item Masuk' 
            End AS keterangan,
            CASE
              WHEN status = 1 then 'Batal'
              WHEN status = 0 then 'Selesai'
              WHEN status = 2 then 'Dicetak'
            END AS status,
            createdBy, 
            (case when createdDate = '0000-00-00 00:00:00' THEN '-' else createdDate end) as createdDate, 
            modifiedBy, 
            (case when modifiedDate = '0000-00-00 00:00:00' THEN '-' else modifiedDate end) as modifiedDate 
        from historyBarang WHERE warehouse = 115 AND status = '".$status."' AND DATE(tanggal) between '".$fromDate."' and '".$endDate."' ");

      return $query->result();
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////

    /** Mengembalikan tabel data fk **/
    public function getAllPaletMod()
    {
        return $this->db->get_where("palet")->result();
    }

    public function getAllMainItemMod()
    {
        return $this->db->get_where("mainitem")->result();
    }

    public function getAllItemMod()
    {
        return $this->db->get_where("item")->result();
    }
  }
?>