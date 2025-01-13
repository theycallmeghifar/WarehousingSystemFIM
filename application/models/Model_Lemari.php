<?php defined('BASEPATH') or exit('No direct script access allowed');

  class Model_Lemari extends CI_Model
  {

    ///TABLE
    private $tableLemari = "lemari";

///////////////////////////////////////////////////////////////////////////////////////////////LEMARI

    public function getLemariMod()
    {
      $query = $this->db->query(
        "SELECT 
          idLemari, 
          deskripsiLemari, 
          ukuranLemari, 
          status, 
          createdBy, 
          (CASE WHEN createdDate = '0000-00-00 00:00:00' THEN '-' ELSE createdDate END) AS createdDate,
          modifiedBy, 
          (CASE WHEN modifiedDate = '0000-00-00 00:00:00' THEN '-' ELSE modifiedDate END) AS modifiedDate    
        FROM lemari");

      return $query->result();
    }

    public function saveLemariMod($data)
    {
      return $this->db->insert($this->tableLemari, $data);
    }

    public function editLemariMod()
    {
        date_default_timezone_set('Asia/Jakarta');

        $post = $this->input->post();
        $data = array (
                  'deskripsiLemari' => $this->input->post('deskripsiLemariU'),
                  'ukuranLemari' => $this->input->post('ukuranLemariU'),
                  'status' => $this->input->post('statusU'),          
                  'modifiedBy' => '',
                  'modifiedDate' => date("Y-m-d H:i:s")
              );
       
        $where = array(
          'idLemari' => $this->input->post('idU'),
        );

        $this->db->where($where);
        return $this->db->update($this->tableLemari, $data);
    }

  }
?>