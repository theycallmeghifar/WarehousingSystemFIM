<?php defined('BASEPATH') or exit('No direct script access allowed');

  class Model_Supplier extends CI_Model
  {

///////////////////////////////////////////////////////////////////////////////////////////////SUPPLIER

    public function getSupplierMod()
    {
      $query = $this->db->query(
        "SELECT
            itemCode, 
            (case when itemCode = '' THEN '-' else itemName end) as itemName, 
            jumlahItem,
            netQuantity, 
            status, 
            createdBy, 
            (case when createdDate = '0000-00-00 00:00:00' THEN '-' else createdDate end) as createdDate, 
            modifiedBy, 
            (case when modifiedDate = '0000-00-00 00:00:00' THEN '-' else modifiedDate end) as modifiedDate 
        from item where status!='3'");

      return $query->result();
    }

    public function getSupplierCartMod()
    {
      $query = $this->db->query(
        "SELECT
            itemCode
        from item
        where status='3'");

      return $query->result();
    }

    public function getSupplierQrMod($id)
    {
      $query = $this->db->query(
        "select
            itemCode, 
            itemName
        from item
        where itemCode = '".$id."' ");

      return $query->result();
    }

    public function setPlus($id) {
        $data = array(
            'status'=> '3'
        );
        $this->db->set($data);
        $this->db->where('itemCode', $id);
        $this->db->update('item');
    }

    public function setMinus($id) {
      $data = array(
          'status'=> '1'
      );
      $this->db->set($data);
      $this->db->where('itemCode', $id);
      $this->db->update('item');
  }

  }
?>