<?php ob_start();?>


<!-- HEADER -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Riwayat Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Menu</a></li>
              <li class="breadcrumb-item active">Transaksi</li>
              <li class="breadcrumb-item active">Riwayat Barang</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- END HEADER -->
  
<!-- TABLE -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

      	<div class="col-lg-12">
      	 <div class="card">

      	   <div class="card-header border-0">
              <!-- <form method='post' action="<?php echo base_url(); ?>Functions/HistoryBarang" class="d-flex justify-content-flex-start"  style="padding-top:10px;">  
                  <label>Status</label>
                  <div class="btn-group btn-group-toggle" style="padding-left:10px;">
                      <button class="btn btn-outline-primary" onclick="highlight('A')" type="submit" name="status" id="A" value="0">Selesai</button>
                      <button class="btn btn-outline-primary" onclick="highlight('B')" type="submit" name="status" id="B" value="1">Batal</button>

                  </div>
             </form> -->
              <form method='post' action="<?php echo base_url(); ?>HistoryBarang" class="d-flex justify-content-flex-start"  style="padding-top:10px;">  
                  <label style="padding-right:10px;padding-top:15px;">Status</label>
                  <button id="tglSelesai" type="submit" style="margin-top: 10px; margin-right: 5px;" class="btn btn-success pull-left" name="status" value="0">
                        <i style="margin-right: 8px;" class="fas fa-check"></i>Selesai
                  </button>
                  <button id="tglBatal" type="submit" style="margin-top: 10px; margin-right: 5px;" class="btn btn-danger pull-left" name="status" value="1">
                      <i style="margin-right: 8px;" class="fas fa-times"></i>Batal
                  </button>
                  <button id="tglBatal" type="submit" style="margin-top: 10px; margin-right: 5px;" class="btn btn-primary pull-left" name="status" value="2">
                      <i style="margin-right: 8px;" class="fas fa-print"></i>Dicetak
                  </button>
                  <button id="tglBatal" type="submit" style="margin-top: 10px; margin-right: 5px;" class="btn btn-secondary pull-left" name="status" value="">
                      <i style="margin-right: 8px;" class="fas fa-tasks"></i>Semua
                  </button>
              </form>
      	   </div>

      	   <div class="card-body">
                  <table id="dataTable" data-order='[[5, "desc"]]' class="display nowrap table-striped table" style="width:100%" >
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Palet</th>
                              <th>Main Item</th>
                              <th>Item Code</th>
                              <th>Jumlah</th>
                              <th>Tanggal</th>
 
                              <th>Keterangan</th>
                              <th>Status</th>                    
                              <th hidden="true">Created By</th>
                              <th hidden="true">Created Date</th>
                              <th hidden="true">Modified By</th>
                              <th hidden="true">Modified Date</th>

                              <th hidden="true">Palet Int</th>
                              <th hidden="true">Main Item Int</th>
                              <th hidden="true">Item Int</th>
                              <th hidden="true">Main Item Name</th>
                              <th hidden="true">Item Name</th>
                              <th hidden="true">Purchase Order</th>
                              <th hidden="true">Delivery Note</th>
                              <th>Aksi</th>
                         </tr>
                      </thead>
                      <tbody>
                        <?php
                            foreach($getData as $data){
                        ?>
                        <tr>                             
                            <td><?php echo $data->idHistory?></td>
                            <td><?php 
                                  foreach ($palet as $row) {
                                    if ($data->idPalet == $row->idPalet) {
                                    echo $row->deskripsiPalet;
                                    }
                                  }
                                  if ($data->idPalet == "0" ){
                                    echo "-";
                                  }
                                ?></td>
                            <td><?php 
                                    if ($data->mainItemCode != "-") {
                                     echo $data->mainItemCode;
                                    }
                                    else{
                                      echo "-";
                            }
                            ?></td>
                            <td><?php foreach ($item as $row) {
                                    if ($data->itemCode == $row->itemCode) {
                                    echo $row->itemCode;
                                    }
                            }
                            if ($data->itemCode == "" ){
                              echo "-";
                            }
                            ?></td>  
                            <td><?php
                                if($data->jumlahMasuk == 0){
                                  echo $data->jumlahKeluar;
                                }
                                else{
                                  echo $data->jumlahMasuk;
                            }?></td>
                            <td><?php 
                              //echo date('d F Y', strtotime(str_replace('/', '-', $data->tanggal)))
                              echo date('m-d-Y', strtotime($data->tanggal))
                            ?></td>

                            <td><?php echo $data->keterangan?></td>
                            <td><?php 
                                if($data->status == 'Selesai'){
                                  echo "Selesai";
                                }else if($data->status == 'Batal'){
                                  echo "Batal";
                                }else if($data->status == 'Dicetak'){
                                  echo "Dicetak";
                                }?></td>
                            <td hidden="true"><?php echo $data->createdBy?></td>
                            <td hidden="true"><?php echo $data->createdDate?></td>
                            <td hidden="true"><?php echo $data->modifiedBy?></td>
                            <td hidden="true"><?php echo $data->modifiedDate?></td>
                            
                            <td hidden="true"><?php 
                                if ($data->idPalet != "" ){          
                                  echo $data->idPalet;
                                }
                                else
                                {
                                  echo "-";
                                }?></td>
                            <td hidden="true"><?php 
                                if ($data->mainItemCode == "-" ){
                                  echo "-";
                                }
                                else
                                {
                                  echo $data->mainItemCode;
                                }?></td>
                            <td hidden="true"><?php 
                                if ($data->itemCode == "" ){
                                  echo "-";
                                }
                                else
                                {
                                  echo $data->itemCode;
                                }?></td>
                            <td hidden="true"><?php 
                                foreach ($mainitem as $row) {
                                    if ($data->itemCode != ""){
                                      if ($data->mainItemCode == $row->mainItemCode && $data->itemCode == $row->itemCode) {
                                        echo $row->mainItemName;
                                      }
                                    }else{
                                      if ($data->mainItemCode == $row->mainItemCode) {
                                        echo $row->mainItemName;
                                      }
                                    }
                                    
                                } 
                                if ($data->mainItemCode == "-" ){
                                  echo "-";
                                }?></td>
                            <td hidden="true"><?php 
                                foreach ($item as $row) {
                                    if ($data->itemCode == $row->itemCode) {
                                    echo $row->itemName;
                                    }
                                } 
                                if ($data->itemCode == "" ){
                                  echo "-";
                                } ?></td>
                            <td hidden="true"><?php 
                                if ($data->purchaseOrder == "" ){
                                  echo "-";
                                }
                                else
                                {
                                  echo $data->purchaseOrder;
                                }?></td>
                            <td hidden="true"><?php 
                                if ($data->deliveryNote == "" ){
                                  echo "-";
                                }
                                else
                                {
                                  echo $data->deliveryNote;
                                }?></td>
                            <td>
                                <a href="javascript:void(0);" class="fa fa-tasks color-muted detailbtn" title="Detail"></a>
                            </td>
                          </tr>
                          <?php } ?>
                      </tbody>
                  </table>
      	   </div>

           <br/><br/><br/>

      	 </div>
      	</div>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- END TABLE -->

    <!-- DETAIL-->
        <div class="modal fade" id="detailData" tabindex="-1" role="dialog" aria-labelledby="detailData" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" >
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      <div class="form-group row align-items-center">
                        <label class="col-sm-3 col-form-label text-label">ID</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                            <input type="text" id="idD" name="idD" class="form-control form-control-user" disabled required></input>
                          </div> 
                        </div>
                      </div>                     
                      <!-- <div class="form-group row align-items-center">
                        <label class="col-sm-3 col-form-label text-label">Palet</label>
                        <div class="col-sm-9">
                          <select class="form-control" name="idPaletD" id="idPaletD" disabled required>
                            <option disabled selected>-- Pilih Palet --</option>
                            <?php
                            foreach ($palet as $row) : 
                            ?>
                              <option
                                value="<?= $row->idPalet ?>" 
                                <?= ($row->idPalet == $data->idPalet ? 'selected' : '') ?>
                              >
                                <?= $row->deskripsiPalet ?>
                              </option>
                            <?php
                            endforeach;
                            ?>
                          </select>
                        </div>
                      </div> -->
                      <div class="form-group row align-items-center">
                        <label class="col-sm-3 col-form-label text-label">Palet</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                            <input type="text" id="idPaletD" name="idPaletD" class="form-control form-control-user" style="justify-content: left;" disabled required></input>
                          </div> 
                        </div>
                      </div> 
                      <div class="form-group row align-items-center">
                        <label class="col-sm-3 col-form-label text-label">Purchase Order</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                            <input type="text" id="purchaseOrderD" name="purchaseOrderD" class="form-control form-control-user" style="justify-content: left;" disabled required></input>
                          </div> 
                        </div>
                      </div> 
                      <div class="form-group row align-items-center">
                        <label class="col-sm-3 col-form-label text-label">Delivery Note</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                            <input type="text" id="deliveryNoteD" name="deliveryNoteD" class="form-control form-control-user" style="justify-content: left;" disabled required></input>
                          </div> 
                        </div>
                      </div> 
                      <div class="form-group row align-items-center">
                        <label class="col-sm-3 col-form-label text-label">Main Item Code</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                            <input type="text" id="mainItemCodeD" name="mainItemCodeD" class="form-control form-control-user" style="justify-content: left;" disabled required></input>
                          </div> 
                        </div>
                      </div> 
                      <div class="form-group row align-items-center">
                        <label class="col-sm-3 col-form-label text-label">Main Item Name</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                            <input type="text" id="mainItemNameD" name="mainItemNameD" class="form-control form-control-user" style="justify-content: left;" disabled required></input>
                          </div> 
                        </div>
                      </div>  
                      <div class="form-group row align-items-center">
                        <label class="col-sm-3 col-form-label text-label">Item Code</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                            <input type="text" id="itemCodeD" name="itemCodeD" class="form-control form-control-user" style="justify-content: left;" disabled required></input>
                          </div> 
                        </div>
                      </div> 
                      <div class="form-group row align-items-center">
                        <label class="col-sm-3 col-form-label text-label">Item Name</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                            <input type="text" id="itemNameD" name="itemNameD" class="form-control form-control-user" style="justify-content: left; margin-left: 0px;" disabled></input>
                          </div> 
                        </div>
                      </div> 
                      <div class="form-group row align-items-center">
                        <label class="col-sm-3 col-form-label text-label">Jumlah</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                            <input type="text" id="jumlahD" name="jumlahD" class="form-control form-control-user" style="justify-content: left;" disabled required></input>
                          </div> 
                        </div>
                      </div> 
                      <div class="form-group row align-items-center">
                        <label class="col-sm-3 col-form-label text-label">Tanggal</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                            <input type="text" id="tanggalD" name="tanggalD" class="form-control form-control-user" disabled required></input>
                          </div> 
                        </div>
                      </div> 
                      <div class="form-group row align-items-center">
                        <label class="col-sm-3 col-form-label text-label">Keterangan</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                            <input type="text" id="keteranganD" name="keteranganD" class="form-control form-control-user" style="justify-content: left;" disabled required></input>
                          </div> 
                        </div>
                      </div>  
                      <div class="form-group row align-items-center">
                        <label class="col-sm-3 col-form-label text-label">Status</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                            <input type="text" id="statusD" name="statusD" class="form-control form-control-user" style="justify-content: left;" disabled required></input>
                          </div> 
                        </div>
                      </div>  
                      <div class="form-group row align-items-center">
                        <label class="col-sm-3 col-form-label text-label">Tanggal dibuat</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                            <input type="text" id="creadateD" name="creadateD" class="form-control form-control-user" disabled required></input>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label class="col-sm-3 col-form-label text-label">Tanggal diubah</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                            <input type="text" id="modidateD" name="modidateD" class="form-control form-control-user" disabled required></input>
                          </div>
                        </div>
                      </div>  
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                      </div>
                    </div>
            </div>
        </div>
    <!-- end DETAIL DATA-->

        </div>
      </div>
    </section>
  </div>
<?php
$data = ob_get_clean();
?>

<?php ob_start();?>

<!-- SCRIPT -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

    <script type="text/javascript">
      $(document).ready(function(){
        var modiDate = $('#modidateD').val();

        if (modiDate === '0000-00-00 00:00:00') {
            $('#modidateD').val('-');
        }else{
          
        }
      });
    </script>

    <script>

        $(document).ready(function(){
            $('.detailbtn').on('click', function(){
                $('#detailData').modal('show');
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();
                console.log(data);

                $('#idD').val(data[0]);
                $('#purchaseOrderD').val(data[17]);
                $('#deliveryNoteD').val(data[18]);
                $('#jumlahD').val(data[4]);
                $('#tanggalD').val(data[5]);
                $('#keteranganD').val(data[6]);
                $('#statusD').val(data[7])
                $('#creadateD').val(data[9]); 
                $('#modidateD').val(data[11]); 
                $('#idPaletD').val(data[1]);
                $('#mainItemCodeD').val(data[13]);
                $('#itemCodeD').val(data[14]);
                $('#mainItemNameD').val(data[15]);
                $('#itemNameD').val(data[16]);
            });
        });
    </script>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- END SCRIPT -->

<?php
$script = ob_get_clean();
include('master_page.php');
ob_flush();
?>