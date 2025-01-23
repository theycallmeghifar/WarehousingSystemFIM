<?php defined('BASEPATH') or exit('No direct script access allowed');

  class Model_Lokasi extends CI_Model
  {

    ///TABLE
    private $tableRak = "lokasi";

///////////////////////////////////////////////////////////////////////////////////////////////RAK

    public function getLokasiMod()
    {
      $query = $this->db->query(
        "SELECT 
        idLokasi, 
        itemCode,
        lokasi, 
        status, 
        createdBy, 
        (case when createdDate = '0000-00-00 00:00:00' THEN '-' else createdDate end) as createdDate, 
        modifiedBy, 
        (case when modifiedDate = '0000-00-00 00:00:00' THEN '-' else modifiedDate end) as modifiedDate 
      from lokasi");

      return $query->result();
    }

    public function saveLokasiMod($data)
    {
      return $this->db->insert($this->tableRak, $data);
    }

    public function editLokasiMod()
    {
        date_default_timezone_set('Asia/Jakarta');

        $post = $this->input->post();
        $data = array (
                  'itemCode' => $this->input->post('itemCodeU'),
                  'lokasi' => $this->input->post('lokasiU'),
                  'status' => $this->input->post('statusU'),
                  'modifiedBy' => '',
                  'modifiedDate' => date("Y-m-d H:i:s")
              );
      
        $where = array(
          'idLokasi' => $this->input->post('idLokasiU'),
        );

        $this->db->where($where);
        return $this->db->update($this->tableRak, $data);
    }

    /** Mengembalikan tabel data fk Berstatus aktif **/
    public function getAllItemAktifMod()
    {
        return $this->db->get_where("item", ["status" => 1, "warehouse" => 115])->result();
    }

    /** Mengembalikan tabel data fk **/
    public function getAllItemMod()
    {
        return $this->db->get_where("item", ["status" => 1, "warehouse" => 115])->result();
    }

  }
?>