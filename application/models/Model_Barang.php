<?php defined('BASEPATH') or exit('No direct script access allowed');

  class Model_Barang extends CI_Model
  {

    ///TABLE
    private $tableBarang = "barang";

    // public function rules()
    // {
    //     return [
    //         [
    //             'field' => 'deskripsiRak',
    //             'label' => 'Deskripsi',
    //             'rules' => 'required'
    //         ],
	// 		      [
    //             'field' => 'idLemari',
    //             'label' => 'Lemari',
    //             'rules' => 'required'
    //         ]
    //     ];
    // }

///////////////////////////////////////////////////////////////////////////////////////////////BARANG

    public function getBarangMod()
    {
      $query = $this->db->query(
        "SELECT 
            b.idBarang, 
            b.idPalet,
            (case when b.itemCode = '' THEN '-' else b.itemCode end) as itemCode,
            i.jumlahItem,
            b.tanggalMasuk,
            b.status, 
            b.createdBy, 
            (case when b.createdDate = '0000-00-00 00:00:00' THEN '-' else b.createdDate end) as createdDate, 
            b.modifiedBy, 
            (case when b.modifiedDate = '0000-00-00 00:00:00' THEN '-' else b.modifiedDate end) as modifiedDate 
        from barang as b
        
        INNER join item as i
        on b.itemCode = i.itemCode
        ");

      return $query->result();
    }

    public function saveBarangMod($data)
    {
      return $this->db->insert($this->tableBarang, $data);
    }

    public function editBarangMod()
    {
        date_default_timezone_set('Asia/Jakarta');

        $post = $this->input->post();
        $data = array (
                  'idPalet' => $this->input->post('idPaletU'),
                  'itemCode' => $this->input->post('itemCodeU'),
                  'tanggalMasuk' => $this->input->post('tanggalMasukU'),
                  'status' => $this->input->post('statusU'),
                  'modifiedBy' => '',
                  'modifiedDate' => date("Y-m-d H:i:s")
              );
      
        $where = array(
          'idBarang' => $this->input->post('idU'),
        );

        $this->db->where($where);
        return $this->db->update($this->tableBarang, $data);
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

    /** Mengembalikan tabel data fk Berstatus aktif **/
    public function getAllPaletAktifMod()
    {
        return $this->db->get_where("palet", ["status" => 1])->result();
    }

    public function getAllMainItemAktifMod()
    {
        return $this->db->get_where("mainitem", ["status" => 1])->result();
    }

    public function getAllItemAktifMod()
    {
        return $this->db->get_where("item", ["status" => 1])->result();
    }

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