<?php defined('BASEPATH') or exit('No direct script access allowed');

  class Model_MainItem extends CI_Model
  {

    ///TABLE
    private $tableMainItem = "mainitem";

///////////////////////////////////////////////////////////////////////////////////////////////MAIN ITEM

    public function getMainItemMod()
    {
      $query = $this->db->query(
        "SELECT 
            id,
            mainItemCode,
            (case when mainItemCode = '' THEN '-' else mainItemName end) as mainItemName,  
            itemCode, 
            position, 
            status, 
            createdBy, 
            (case when createdDate = '0000-00-00 00:00:00' THEN '-' else createdDate end) as createdDate, 
            modifiedBy, 
            (case when modifiedDate = '0000-00-00 00:00:00' THEN '-' else modifiedDate end) as modifiedDate 
        from mainitem");

      return $query->result();
    }

    public function getMainItemQrMod($id)
    {
      $query = $this->db->query(
        "select 
            mainItemCode,
            mainItemName
        from mainitem
        where id = '".$id."' ");
      return $query->result();
    }

    public function getMainItemBarangQrMod($id)
    {
      $query = $this->db->query(
        "select 
            mainItemCode,
            mainItemName
        from mainitem
        where itemCode = '".$id."' ");
      return $query->result();
    }

    public function saveMainItemMod($data)
    {
      return $this->db->insert($this->tableMainItem, $data);
    }

    public function editMainItemMod()
    {
        date_default_timezone_set('Asia/Jakarta');

        $post = $this->input->post();
        $data = array (
                  'mainItemCode' => strtoupper($this->input->post('mainItemCodeU')),
                  'mainItemName' => strtoupper($this->input->post('mainItemNameU')),
                  'itemCode' => strtoupper($this->input->post('itemCodeU')),
                  'position' => $this->input->post('positionU'),
                  'status' => $this->input->post('statusU'),           
                  'modifiedBy' => '',
                  'modifiedDate' => date("Y-m-d H:i:s")
              );
      
        $where = array(
          'id' => $this->input->post('idU'),
        );

        $this->db->where($where);
        return $this->db->update($this->tableMainItem, $data);
    }

    public function getMainItemAutoMod($postData)
    {
        $response = array();

        if(isset($postData['search']) ){
          
          // Select record
          $this->db->select('mainItemCode');
          $this->db->where("mainItemCode like '%".$postData['search']."%' ");
          $this->db->distinct();

          $records = $this->db->get('mainitem')->result();

          foreach($records as $row ){
            $response[] = array("value"=>$row->mainItemCode,"label"=>$row->mainItemCode);
          }
        }
        return $response;
    }

  }
?>