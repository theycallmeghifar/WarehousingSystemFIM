<?php defined('BASEPATH') or exit('No direct script access allowed');

  class Model_Palet extends CI_Model
  {

    ///TABLE
    private $tablePalet = "palet";

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
    
///////////////////////////////////////////////////////////////////////////////////////////////PALET

    public function getPaletMod()
    {
      $query = $this->db->query(
        "SELECT 
            p.idPalet,
            p.idRak,
            p.deskripsiPalet,
            p.maxBarang,
            i.jumlahItem,
            p.status,
            p.ipAddress,
            p.gpio1,
            p.gpio2,
            p.gpio3,  
            p.createdBy, 
            (case when p.createdDate = '0000-00-00 00:00:00' THEN '-' else p.createdDate end) as createdDate, 
            p.modifiedBy, 
            (case when p.modifiedDate = '0000-00-00 00:00:00' THEN '-' else p.modifiedDate end) as modifiedDate 
        from palet as p
        
        LEFT JOIN barang as b ON p.idPalet = b.idPalet
        LEFT JOIN item as i ON b.itemCode = i.itemCode
        
        ");

      return $query->result();
    }

    public function getPaletQrMod($id)
    {
        $query = $this->db->query(
          "select 
              idPalet,
              deskripsiPalet
          from palet
          where idPalet = '".$id."' ");

        return $query->result();
    }

    public function savePaletMod($data)
    {
      return $this->db->insert($this->tablePalet, $data);
    }

    public function editPaletMod()
    {
        date_default_timezone_set('Asia/Jakarta');

        $post = $this->input->post();
        $data = array (
                  'idRak' => $this->input->post('idRakU'),
                  'deskripsiPalet' => $this->input->post('deskripsiPaletU'),
                  'maxBarang' => $this->input->post('maxBarangU'),
                  'status' => $this->input->post('statusU'),
                  'ipAddress' => $this->input->post('ipAddressU'),
                  'gpio1' => $this->input->post('gpio1U'),
                  'gpio2' => $this->input->post('gpio2U'),
                  'gpio3' => $this->input->post('gpio3U'),   
                  'modifiedBy' => '',
                  'modifiedDate' => date("Y-m-d H:i:s")
              );
      
        $where = array(
          'idPalet' => $this->input->post('idU'),
        );

        $this->db->where($where);
        return $this->db->update($this->tablePalet, $data);
    }

    /** Mengembalikan tabel data fk Berstatus aktif **/
    public function getAllRakAktifMod()
    {
        return $this->db->get_where("rak", ["status" => 1])->result();
    }

    /** Mengembalikan tabel data fk **/
    public function getAllRakMod()
    {
        return $this->db->get_where("rak")->result();
    }

  }
?>