<?php defined('BASEPATH') or exit('No direct script access allowed');

  class Model_Rak extends CI_Model
  {

    ///TABLE
    private $tableRak = "rak";

    // public function rules()
    // {
    //     return [
    //         [
    //             'field' => 'deskripsiRak',
    //             'label' => 'Deskripsi',
    //             'rules' => 'required'
    //         ],
		// 	      [
    //             'field' => 'idLemari',
    //             'label' => 'Lemari',
    //             'rules' => 'required'
    //         ]
    //     ];
    // }

///////////////////////////////////////////////////////////////////////////////////////////////RAK

    public function getRakMod()
    {
      $query = $this->db->query(
        "SELECT 
            idRak, 
            idLemari,
            deskripsiRak, 
            currentVolume, 
            maxVolume,
            status, 
            createdBy, 
            (case when createdDate = '0000-00-00 00:00:00' THEN '-' else createdDate end) as createdDate, 
            modifiedBy, 
            (case when modifiedDate = '0000-00-00 00:00:00' THEN '-' else modifiedDate end) as modifiedDate 
        from rak");

      return $query->result();
    }

    public function saveRakMod($data)
    {
      return $this->db->insert($this->tableRak, $data);
    }

    public function editRakMod()
    {
        date_default_timezone_set('Asia/Jakarta');

        $post = $this->input->post();
        $data = array (
                  'idLemari' => $this->input->post('idLemariU'),
                  'deskripsiRak' => $this->input->post('deskripsiRakU'),
                  'currentVolume' => $this->input->post('currentVolumeU'),
                  'maxVolume' => $this->input->post('maxVolumeU'),
                  'status' => $this->input->post('statusU'),
                  'modifiedBy' => '',
                  'modifiedDate' => date("Y-m-d H:i:s")
              );
      
        $where = array(
          'idRak' => $this->input->post('idU'),
        );

        $this->db->where($where);
        return $this->db->update($this->tableRak, $data);
    }

    /** Mengembalikan tabel data fk Berstatus aktif **/
    public function getAllLemariAktifMod()
    {
        return $this->db->get_where("lemari", ["status" => 1])->result();
    }

    /** Mengembalikan tabel data fk **/
    public function getAllLemariMod()
    {
        return $this->db->get_where("lemari")->result();
    }

  }
?>