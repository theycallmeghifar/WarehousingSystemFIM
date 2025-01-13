<?php defined('BASEPATH') or exit('No direct script access allowed');

  class Model_ItemHistory extends CI_Model
  {

///////////////////////////////////////////////////////////////////////////////////////////////HISTORYBARANG

    public function getItemHistoryMod()
    {
      $query = $this->db->query(
        "SELECT 
            id, 
            (case when itemCode = '' THEN '-' else itemCode end) as itemCode,
            jumlahSebelum, 
            jumlahSesudah,  
            createdBy, 
            (case when createdDate = '0000-00-00 00:00:00' THEN '-' else createdDate end) as createdDate
        from itemhistory");

      return $query->result();
    }

    /** Mengembalikan tabel data fk **/
    public function getAllItemMod()
    {
        return $this->db->get_where("item")->result();
    }

  }
?>