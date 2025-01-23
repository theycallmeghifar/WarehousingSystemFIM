<?php defined('BASEPATH') or exit('No direct script access allowed');

  class Model_HistoryBarang extends CI_Model
  {
    
    ///TABLE
    private $tableHistoryBarang = "historybarang";

///////////////////////////////////////////////////////////////////////////////////////////////HISTORYBARANG

    public function getHistoryBarangMod()
    {
      $query = $this->db->query(
        "SELECT 
            idHistory, 
            (case when purchaseOrder = '' THEN '-' else purchaseOrder end) as purchaseOrder,
            (case when deliveryNote = '' THEN '-' else deliveryNote end) as deliveryNote, 
            idPalet,
            (case when mainItemCode = '' THEN '-' else mainItemCode end) as mainItemCode,
            itemCode,
            jumlahMasuk, 
            jumlahKeluar,  
            tanggal,
            CASE 
              WHEN jumlahMasuk = 0  then 'Barang Keluar' 
              WHEN jumlahKeluar = 0 then 'Barang Masuk' 
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
        from historybarang WHERE warehouse = 100");

      return $query->result();
    }

    public function getFilterHistoryBarangMod($status)
    {
      $query = $this->db->query(
        "SELECT 
            idHistory, 
            (case when purchaseOrder = '' THEN '-' else purchaseOrder end) as purchaseOrder,
            (case when deliveryNote = '' THEN '-' else deliveryNote end) as deliveryNote, 
            idPalet,
            (case when mainItemCode = '' THEN '-' else mainItemCode end) as mainItemCode,
            itemCode,
            jumlahMasuk, 
            jumlahKeluar,  
            tanggal,
            CASE 
              WHEN jumlahMasuk = 0  then 'Barang Keluar' 
              WHEN jumlahKeluar = 0 then 'Barang Masuk' 
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
        from historybarang where status = '".$status."' AND warehouse = 100");

      return $query->result();
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////CETAKEXCEL

    //status 0 = selesai; 1 = batal; 2 = sudah dicetak

    ////-- BARANG MASUK
    public function getCetakExcelMasukMod()
    {
      $query = $this->db->query(
        "SELECT DISTINCT
            h.idHistory, 
            (case when h.purchaseOrder = '' THEN '-' else h.purchaseOrder end) as purchaseOrder,
            (case when h.deliveryNote = '' THEN '-' else h.deliveryNote end) as deliveryNote, 
            h.tanggal, 
            h.itemCode,

            CASE 
              WHEN h.jumlahMasuk = 0 then 100 
              WHEN h.jumlahKeluar = 0 then 0
            END AS whFrom,

            CASE 
              WHEN h.jumlahMasuk = 0 then 200 
              WHEN h.jumlahKeluar = 0 then 0
            END AS whTo,
            
            CASE 
              WHEN h.jumlahMasuk = 0 then h.jumlahKeluar 
              WHEN h.jumlahKeluar = 0 then h.jumlahMasuk 
            End AS qty,

            (case when m.itemName = '' THEN '-' else m.itemName end) as itemName 
        
        from historybarang as h
      
      INNER join item as m
      on h.itemCode = m.itemCode
      
      where h.warehouse = 100 and h.status=0 and h.jumlahMasuk!=0 GROUP BY h.idHistory"
      );

      return $query->result();
    }

    public function getFilterTanggalMasukMod($fromDate, $endDate)
    {
      $query = $this->db->query(
        "SELECT DISTINCT
          h.idHistory, 
          (case when h.purchaseOrder = '' THEN '-' else h.purchaseOrder end) as purchaseOrder,
          (case when h.deliveryNote = '' THEN '-' else h.deliveryNote end) as deliveryNote, 
          h.tanggal, 
          h.itemCode,

          CASE 
            WHEN h.jumlahMasuk = 0 then 100 
            WHEN h.jumlahKeluar = 0 then 0
          END AS whFrom,

          CASE 
            WHEN h.jumlahMasuk = 0 then 200 
            WHEN h.jumlahKeluar = 0 then 0
          END AS whTo,
          
          CASE 
            WHEN h.jumlahMasuk = 0 then h.jumlahKeluar 
            WHEN h.jumlahKeluar = 0 then h.jumlahMasuk 
          End AS qty,
          (case when m.itemName = '' THEN '-' else m.itemName end) as itemName 

          from historybarang as h
    
      INNER join item as m
      on h.itemCode = m.itemCode
      
      where h.warehouse = 100 and h.status = 0 AND h.tanggal between '".$fromDate."' and '".$endDate."' and h.jumlahMasuk != 0 GROUP BY h.idHistory");

      return $query->result();
    }

    public function updateCetakExcelMasukMod()
    {
      $query = $this->db->query(
        "UPDATE historybarang as t,	
        (
            SELECT DISTINCT
                h.idHistory, 
                (case when h.purchaseOrder = '' THEN '-' else h.purchaseOrder end) as purchaseOrder,
                (case when h.deliveryNote = '' THEN '-' else h.deliveryNote end) as deliveryNote, 
                h.tanggal, 
                h.itemCode,

                CASE 
                  WHEN h.jumlahMasuk = 0 then 100 
                  WHEN h.jumlahKeluar = 0 then 0
                END AS whFrom,

                CASE 
                  WHEN h.jumlahMasuk = 0 then 200 
                  WHEN h.jumlahKeluar = 0 then 0
                END AS whTo,
                
                CASE 
                  WHEN h.jumlahMasuk = 0 then h.jumlahKeluar 
                  WHEN h.jumlahKeluar = 0 then h.jumlahMasuk 
                End AS qty,

                (case when m.itemName = '' THEN '-' else m.itemName end) as itemName 

                from historybarang as h
      
                INNER join item as m
                on h.itemCode = m.itemCode

                where h.warehouse = 100 and h.status = 0 and h.jumlahMasuk!=0 GROUP BY h.idHistory
        ) as temp
                
        SET status=2 where t.idHistory = temp.idHistory");

      return $query->result();
    }

    public function updateFilterTanggalMasukMod($fromDate, $endDate)
    {
      $query = $this->db->query(
        "UPDATE historybarang as t,	
        (
            SELECT DISTINCT
                h.idHistory, 
                (case when h.purchaseOrder = '' THEN '-' else h.purchaseOrder end) as purchaseOrder,
                (case when h.deliveryNote = '' THEN '-' else h.deliveryNote end) as deliveryNote, 
                h.tanggal, 
                h.itemCode,

                CASE 
                  WHEN h.jumlahMasuk = 0 then 100 
                  WHEN h.jumlahKeluar = 0 then 0
                END AS whFrom,

                CASE 
                  WHEN h.jumlahMasuk = 0 then 200 
                  WHEN h.jumlahKeluar = 0 then 0
                END AS whTo,
                
                CASE 
                  WHEN h.jumlahMasuk = 0 then h.jumlahKeluar 
                  WHEN h.jumlahKeluar = 0 then h.jumlahMasuk 
                End AS qty,

                (case when m.itemName = '' THEN '-' else m.itemName end) as itemName 
                
              from historybarang as h
      
                INNER join item as m
                on h.itemCode = m.itemCode

              where h.warehouse = 100 and h.status = 0 AND h.tanggal between '".$fromDate."' and '".$endDate."' and h.jumlahMasuk!=0 GROUP BY h.idHistory
        ) as temp
                
        SET status=2 where t.idHistory = temp.idHistory");
        
      //return $query->result();
    }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     ////-- BARANG KELUAR
     public function getCetakExcelKeluarMod()
     {
       $query = $this->db->query(
         "SELECT DISTINCT
                h.idHistory, 
                h.tanggal, 
                h.itemCode,
                i.itemName,

                CASE 
                  WHEN h.jumlahMasuk = 0 then 100 
                  WHEN h.jumlahKeluar = 0 then 0
                END AS whFrom,

                CASE 
                  WHEN h.jumlahMasuk = 0 then 200 
                  WHEN h.jumlahKeluar = 0 then 0
                END AS whTo,
                
                CASE 
                  WHEN h.jumlahMasuk = 0 then h.jumlahKeluar 
                  WHEN h.jumlahKeluar = 0 then h.jumlahMasuk 
                End AS qty,
                (case when h.mainItemCode = '' THEN '-' else h.mainItemCode end) as mainItemCode, 
                (case when m.mainItemCode = '' THEN '-' else m.mainItemName end) as mainItemName 
            
            from historybarang as h
          
          INNER join mainitem as m
          on h.mainItemCode = m.mainItemCode
          INNER JOIN item as i
          on h.itemCode = i.itemCode
          
          where h.warehouse = 100 and h.status = 0 and h.jumlahMasuk = 0 GROUP BY h.idHistory"
       );
 
       return $query->result();
     }
 
     public function getFilterTanggalKeluarMod($fromDate, $endDate)
     {
       $query = $this->db->query(
         "SELECT DISTINCT
           h.idHistory, 
           h.tanggal, 
           h.itemCode,
           i.itemName,
 
           CASE 
             WHEN h.jumlahMasuk = 0 then 100 
             WHEN h.jumlahKeluar = 0 then 0
           END AS whFrom,
 
           CASE 
             WHEN h.jumlahMasuk = 0 then 200 
             WHEN h.jumlahKeluar = 0 then 0
           END AS whTo,
           
           CASE 
             WHEN h.jumlahMasuk = 0 then h.jumlahKeluar 
             WHEN h.jumlahKeluar = 0 then h.jumlahMasuk 
           End AS qty,
           (case when h.mainItemCode = '' THEN '-' else h.mainItemCode end) as mainItemCode, 
           (case when m.mainItemName = '' THEN '-' else m.mainItemName end) as mainItemName 
 
           from historybarang as h
     
       INNER join mainitem as m
       on h.mainItemCode = m.mainItemCode
       INNER JOIN item as i
       on h.itemCode = i.itemCode
       
       where h.warehouse = 100 and h.status = 0 AND h.tanggal between '".$fromDate."' and '".$endDate."' and h.jumlahMasuk = 0 GROUP BY h.idHistory"
       );
 
       return $query->result();
     }
 
     public function updateCetakExcelKeluarMod()
     {
       $query = $this->db->query(
         "UPDATE historybarang as t,	
         (
             SELECT DISTINCT
                 h.idHistory, 
                 h.tanggal, 
                 h.itemCode,
                 h.itemName,
 
                 CASE 
                   WHEN h.jumlahMasuk = 0 then 100 
                   WHEN h.jumlahKeluar = 0 then 0
                 END AS whFrom,
 
                 CASE 
                   WHEN h.jumlahMasuk = 0 then 200 
                   WHEN h.jumlahKeluar = 0 then 0
                 END AS whTo,
                 
                 CASE 
                   WHEN h.jumlahMasuk = 0 then h.jumlahKeluar 
                   WHEN h.jumlahKeluar = 0 then h.jumlahMasuk 
                 End AS qty,
                 
                 (case when h.mainItemCode = '' THEN '-' else h.mainItemCode end) as mainItemCode, 
                 (case when m.mainItemName = '' THEN '-' else m.mainItemName end) as mainItemName 
 
                 from historybarang as h
       
                 INNER join mainitem as m
                 on h.mainItemCode = m.mainItemCode
                 INNER JOIN item as i
                 on h.itemCode = i.itemCode
 
                 where h.warehouse = 100 and h.status = 0 and h.jumlahMasuk=0 GROUP BY h.idHistory
         ) as temp
                 
         SET status=2 where t.idHistory = temp.idHistory");
 
       return $query->result();
     }
 
     public function updateFilterTanggalKeluarMod($fromDate, $endDate)
     {
       $query = $this->db->query(
         "UPDATE historybarang as t,	
         (
             SELECT DISTINCT
                 h.idHistory, 
                 h.tanggal, 
                 h.itemCode,
                 i.itemName,
 
                 CASE 
                   WHEN h.jumlahMasuk = 0 then 100 
                   WHEN h.jumlahKeluar = 0 then 0
                 END AS whFrom,
 
                 CASE 
                   WHEN h.jumlahMasuk = 0 then 200 
                   WHEN h.jumlahKeluar = 0 then 0
                 END AS whTo,
                 
                 CASE 
                   WHEN h.jumlahMasuk = 0 then h.jumlahKeluar 
                   WHEN h.jumlahKeluar = 0 then h.jumlahMasuk 
                 End AS qty,
 
                 (case when h.mainItemCode = '' THEN '-' else h.mainItemCode end) as mainItemCode, 
                 (case when m.mainItemName = '' THEN '-' else m.mainItemName end) as mainItemName 
                 
               from historybarang as h
       
                 INNER join mainitem as m
                 on h.mainItemCode = m.mainItemCode
                 INNER JOIN item as i
                 on h.itemCode = i.itemCode
 
               where h.warehouse = 100 and h.status = 0 AND h.tanggal between '".$fromDate."' and '".$endDate."' and h.jumlahMasuk=0 GROUP BY h.idHistory
         ) as temp
                 
         SET status=2 where t.idHistory = temp.idHistory");
         
       //return $query->result();
     }

     ///////////////////////////////////////////////////////////////////////////////////////////////////////////ITEM MASUK
     public function getItemMasukMod()
     {
       $query = $this->db->query(
         "SELECT DISTINCT
             h.idHistory, 
             h.itemCode,
             i.itemName,
             h.jumlahMasuk,
             h.tanggal
             from historybarang as h
         INNER JOIN item as i
         on h.itemCode = i.itemCode
         where h.warehouse = 115 and h.status = 0 and h.jumlahKeluar = 0 GROUP BY h.idHistory"
       );
 
       return $query->result();
     }
 
     public function getFilterTanggalItemMasukMod($fromDate, $endDate)
     {
       $query = $this->db->query(
         "SELECT DISTINCT
             h.idHistory, 
             h.itemCode,
             i.itemName,
             h.jumlahMasuk,
             h.tanggal
             from historybarang as h
         INNER JOIN item as i
         on h.itemCode = i.itemCode
         
         where h.warehouse = 115 AND h.tanggal between '".$fromDate."' AND '".$endDate."' AND h.status = 0 and h.jumlahKeluar = 0 GROUP BY h.idHistory"
       );
 
       return $query->result();
     }
 
     public function updateHistoryItemMasukMod() {
       $query = $this->db->query(
         "UPDATE historybarang as t,	
         (
           SELECT DISTINCT
               h.idHistory, 
               h.itemCode,
               i.itemName,
               h.jumlahMasuk,
               h.tanggal
               from historybarang as h
           INNER JOIN item as i
           on h.itemCode = i.itemCode
           where h.warehouse = 115 and h.status = 0 and h.jumlahKeluar = 0 GROUP BY h.idHistory
         ) as temp
  
         SET status = 2 where t.idHistory = temp.idHistory"
         );
     }
     
     public function updateHistoryItemMasukFilterTanggalMod($fromDate, $endDate) {
       $query = $this->db->query(
         "UPDATE historybarang as t,	
         (
           SELECT DISTINCT
               h.idHistory, 
               h.itemCode,
               i.itemName,
               h.jumlahMasuk,
               h.tanggal
               from historybarang as h
           INNER JOIN item as i
           on h.itemCode = i.itemCode
           where h.warehouse = 115 AND h.tanggal between '".$fromDate."' AND '".$endDate."' AND h.status = 0 and h.jumlahKeluar = 0 GROUP BY h.idHistory
         ) as temp
   
         SET status = 2 where t.idHistory = temp.idHistory"
         );
     }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////ITEM KELUAR
    public function getItemKeluarMod()
    {
      $query = $this->db->query(
        "SELECT DISTINCT
            h.idHistory, 
            h.itemCode,
            i.itemName,
            h.jumlahKeluar,
            h.tanggal
            from historybarang as h
        INNER JOIN item as i
        on h.itemCode = i.itemCode
        where h.warehouse = 115 and h.status = 0 and h.jumlahMasuk = 0 GROUP BY h.idHistory"
      );

      return $query->result();
    }

    public function getFilterTanggalItemKeluarMod($fromDate, $endDate)
    {
      $query = $this->db->query(
        "SELECT DISTINCT
            h.idHistory, 
            h.itemCode,
            i.itemName,
            h.jumlahKeluar,
            h.tanggal
            from historybarang as h
        INNER JOIN item as i
        on h.itemCode = i.itemCode
        
        where h.warehouse = 115 AND h.tanggal between '".$fromDate."' AND '".$endDate."' AND h.status = 0 and h.jumlahMasuk = 0 GROUP BY h.idHistory"
      );

      return $query->result();
    }

    public function updateHistoryItemKeluarMod() {
      $query = $this->db->query(
        "UPDATE historybarang as t,	
        (
          SELECT DISTINCT
              h.idHistory, 
              h.itemCode,
              i.itemName,
              h.jumlahKeluar,
              h.tanggal
              from historybarang as h
          INNER JOIN item as i
          on h.itemCode = i.itemCode
          where h.warehouse = 115 and h.status = 0 and h.jumlahMasuk = 0 GROUP BY h.idHistory
        ) as temp
 
        SET status = 2 where t.idHistory = temp.idHistory"
        );
    }
    
    public function updateHistoryItemKeluarFilterTanggalMod($fromDate, $endDate) {
      $query = $this->db->query(
        "UPDATE historybarang as t,	
        (
          SELECT DISTINCT
              h.idHistory, 
              h.itemCode,
              i.itemName,
              h.jumlahKeluar,
              h.tanggal
              from historybarang as h
          INNER JOIN item as i
          on h.itemCode = i.itemCode
          where h.warehouse = 115 AND h.tanggal between '".$fromDate."' AND '".$endDate."' AND h.status = 0 and h.jumlahMasuk = 0 GROUP BY h.idHistory
        ) as temp
  
        SET status = 2 where t.idHistory = temp.idHistory"
        );
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