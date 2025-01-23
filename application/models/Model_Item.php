<?php defined('BASEPATH') or exit('No direct script access allowed');

  class Model_Item extends CI_Model
  {
    
    ///TABLE
    private $tableItem = "item";
    private $tableItemHistory = "itemhistory";

///////////////////////////////////////////////////////////////////////////////////////////////ITEM

    public function getItemMod($warehouse)
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
          WHERE warehouse = ?
      ";

      $query = $this->db->query($sql, array($warehouse));

      return $query->result();
    }


    public function getItemQrMod($id)
    {
      $query = $this->db->query(
        "select
            itemCode, 
            itemName
        from item
        where itemCode = '".$id."' ");

      return $query->result();
    }

    public function getItemByCodeAndWarehouse($itemCode, $warehouse)
    {
        return $this->db->where('itemCode', $itemCode)->where('warehouse', $warehouse)->get($this->tableItem)->row_array();
    }

    public function saveItemMod($data)
    {
      return $this->db->insert($this->tableItem, $data);
    }

    public function saveItemHistoryMod($data)
    {
      return $this->db->insert($this->tableItemHistory, $data);
    }

    public function updateItemMod($data)
    {
        $where = array(
          'itemCode' => $data['itemCode'],
        );

        $this->db->where($where);
        return $this->db->update($this->tableItem, $data);
    }

    public function editItemMod()
    {
        date_default_timezone_set('Asia/Jakarta');

        $post = $this->input->post();
        $data = array (
                  'itemName' => strtoupper($this->input->post('itemNameU')),
                  'jumlahItem' => $this->input->post('jumlahItemU'),                  
                  'netQuantity' => $this->input->post('netQuantityU'),
                  'status' => $this->input->post('statusU'),           
                  'modifiedBy' => '',
                  'modifiedDate' => date("Y-m-d H:i:s")
              );
      
        $where = array(
          'itemCode' => $this->input->post('itemCodeU'),
        );

        $this->db->where($where);
        return $this->db->update($this->tableItem, $data);
    }

    public function getItemAutoMod($postData)
    {
        $response = array();
  
        if(isset($postData['search']) ){
          // Select record
          $this->db->select('*');
          $this->db->where("itemCode like '%".$postData['search']."%' ");
          $this->db->distinct();
  
          $records = $this->db->get('item')->result();
  
          foreach($records as $row ){
            $response[] = array("value"=>$row->itemCode,"label"=>$row->itemCode);
          }
        }
        return $response;
    }

  }
?>