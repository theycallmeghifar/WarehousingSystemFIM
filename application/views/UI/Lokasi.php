<?php ob_start();?>


<!-- HEADER -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Lokasi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Menu</a></li>
              <li class="breadcrumb-item active">Lokasi</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- END HEADER -->
  
<!-- TABLE -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
      	  <div class="col-lg-12">
      	    <div class="card">
              <div class="card-header border-0">
      	        <div class="d-flex justify-content-between">
      	        </div>
                <button type="button" id="btnTambah" style="margin-top: 10px;" class="btn btn-primary pull-right" data-toggle="modal" data-target="#tambahData">Tambah Data</button>
      	      </div>

      	      <div class="card-body">
                <table id="dataTable" class="display nowrap table-striped table" style="width:100%" >
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Item</th>
                      <th>Lokasi</th>
                      <th>Status</th>
                      <th hidden="true">Status Int</th>
                      <th hidden="true">Created By</th>
                      <th hidden="true">Created Date</th>
                      <th hidden="true">Modified By</th>
                      <th hidden="true">Modified Date</th>
                      <th hidden="true">Lemari Int</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        foreach($getData as $data){
                    ?>
                    <tr>                            
                      <td><?php echo $data->idLokasi?></td>
                      <td><?php 
                        foreach ($item as $row) {
                          if ($data->itemCode == $row->itemCode) {
                            echo $row->itemName;
                          }  
                        }                               
                        if ($data->itemCode == "" ) {
                          echo "-";
                        }                     
                      ?></td>
                      <td><?php echo $data->lokasi?></td> 
                      <td><?php if($data->status == 0) {
                          echo "Tidak Aktif";
                        } else { 
                          echo "Aktif";
                      }?></td>
                      <td hidden="true"><?php echo $data->status?></td>
                      <td hidden="true"><?php echo $data->createdBy?></td>
                      <td hidden="true"><?php echo $data->createdDate?></td>
                      <td hidden="true"><?php echo $data->modifiedBy?></td>
                      <td hidden="true"><?php echo $data->modifiedDate?></td>
                      <td hidden="true"><?php 
                        if ($data->itemCode != "" ) {          
                          echo $data->itemCode;
                        }
                        else
                        {
                          echo "-";
                      }?></td>
                      <td>
                        <a href="javascript:void(0);" class="fa fa-pencil-square-o color-muted editbtn" title="Ubah Data"></a>
                        <a href="javascript:void(0);" class="fa fa-tasks color-muted detailbtn" title="Detail Data" style="margin-left: 25px;"></a>
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


<!-- MODAL -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

        <!-- TAMBAH DATA -->
        <div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="tambahData" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" >
                <form action="<?php echo base_url('Lokasi/saveLokasiCon')?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" style="width: 410px;">
                              <form role="form" action="<?php echo site_url('Lokasi/saveLokasiCon')?>" method="post" autocomplete="off">
                                    <div class="form-group row align-items-center">
                                      <label class="col-sm-5 col-form-label text-label">Item</label>
                                      <div class="col-sm-7">
                                        <select class="form-control" name="itemCode" id="itemCode">
                                          <option disabled selected>-- Pilih Item --</option>
                                          <?php
                                          foreach ($item as $row):
                                          ?>
                                            <option
                                              value="<?= $row->itemCode ?>" 
                                              <?= ($row->itemCode == set_value('itemCode') ? 'selected' : '') ?>
                                            >
                                              <?= $row->itemName ?>
                                            </option>
                                          <?php
                                          endforeach;
                                          ?>
                                        </select>
                                      </div>
                                    </div>
									                  <div class="form-group row align-items-center">
                                      <label class="col-sm-5 col-form-label text-label">Lokasi<span style="color: red">*</span></label>
                                      <div class="col-sm-7">
                                          <div class="input-group">
                                               <input type="text" id="lokasi" name="lokasi" class="form-control form-control-user" placeholder="Masukkan lokasi item" required></input>
                                          </div> 
                                      </div>
                                    </div>     									     
                              </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button ID="submit" name="submit" class="btn btn-primary shadow-sm" Text="Create">Tambah</button>
                      </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end TAMBAH DATA-->


        <!-- UBAH DATA -->
        <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" >
                <form action="<?php echo base_url('Lokasi/editLokasiCon')?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Ubah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" style="width: 410px;">
                            <div class="row match-height">
                                <div class="col-12">
                                <form role="form" action="<?php echo site_url('Lokasi/editLokasiCon')?>" method="post" autocomplete="off" enctype="multipart/form-data">
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-5 col-form-label text-label">ID</label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                 <input type="text" id="idLokasiU" name="idLokasiU" class="form-control form-control-user" readonly required></input>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                      <label class="col-sm-5 col-form-label text-label">Item</label>
                                      <div class="col-sm-7">
                                        <select class="form-control" name="itemCodeU" id="itemCodeU">
                                          <option disabled selected>-- Pilih Item --</option>
                                          <?php
                                          foreach ($item as $row) : 
                                          ?>
                                            <option
                                              value="<?= $row->itemCode ?>" 
                                              <?= ($row->itemCode == $data->itemCode ? 'selected' : '') ?>
                                            >
                                              <?= $row->itemName ?>
                                            </option>
                                          <?php
                                          endforeach;
                                          ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                      <label class="col-sm-5 col-form-label text-label">Lokasi<span style="color: red">*</span></label>
                                      <div class="col-sm-7">
                                        <div class="input-group">
                                          <input type="text" id="lokasiU" name="lokasiU" class="form-control form-control-user" placeholder="Masukkan lokasi item" required></input>
                                        </div> 
                                      </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-5 col-form-label text-label">Status<span style="color: red">*</span></label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                              <select name="statusU" id="statusU" class="form-control form-control-user" style="width: 180px;">
                                                <option value='1'>Aktif</option>
                                                <option value='0'>Tidak Aktif</option>
                                              </select>
                                            </div>
                                        </div>
                                    </div>                                            
                                </div>
                            </div>
                            </form>   
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button ID="submit" name="updateData" class="btn btn-primary shadow-sm">Ubah</button>
                      </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end UBAH DATA-->

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
                      <div class="modal-body" style="width: 410px;">
                      <div class="form-group row align-items-center">
                        <label class="col-sm-5 col-form-label text-label">ID</label>
                        <div class="col-sm-7">
                          <div class="input-group">
                            <input type="text" id="idLokasiD" name="idLokasiD" class="form-control form-control-user" disabled required></input>
                          </div> 
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label class="col-sm-5 col-form-label text-label">Item</label>
                        <div class="col-sm-7">
                          <div class="input-group">
                            <input type="text" id="itemCodeD" name="itemCodeD" class="form-control form-control-user" style="justify-content: left;" disabled required></input>
                          </div> 
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label class="col-sm-5 col-form-label text-label">Lokasi<span style="color: red">*</span></label>
                        <div class="col-sm-7">
                          <div class="input-group">
                            <input type="text" id="lokasiD" name="lokasiD" class="form-control form-control-user" disabled required></input>
                          </div> 
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                              <label class="col-sm-5 col-form-label text-label">Status<span style="color: red">*</span></label>
                              <div class="col-sm-7">
                                  <div class="input-group">
                                  <select disabled name="statusD" id="statusD" class="form-control form-control-user" style="width: 180px;">
                                    <option value='1'>Aktif</option>
                                    <option value='0'>Tidak Aktif</option>
                                  </select>
                                  </div>
                              </div>
                          </div>
                      <div class="form-group row align-items-center">
                        <label class="col-sm-5 col-form-label text-label">Tanggal dibuat</label>
                        <div class="col-sm-7">
                          <div class="input-group">
                            <input type="text" id="creadateD" name="creadateD" class="form-control form-control-user" disabled required></input>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label class="col-sm-5 col-form-label text-label">Tanggal diubah</label>
                        <div class="col-sm-7">
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

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- END MODAL -->

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
            $('.editbtn').on('click', function(){
                $('#editmodal').modal('show');
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();
                console.log(data);

                $('#idLokasiU').val(data[0]);
                $('#lokasiU').val(data[2]);
                $('#statusU').val(data[4]);
            });
        });

        $(document).ready(function(){
            $('.detailbtn').on('click', function(){
                $('#detailData').modal('show');
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();
                console.log(data);

                $('#idLokasiD').val(data[0]);
                $('#itemCodeD').val(data[1]);
                $('#lokasiD').val(data[2]);
                $('#statusD').val(data[4]);
                $('#creadateD').val(data[6]); 
                $('#modidateD').val(data[8]);
            });
        });
    </script>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- END SCRIPT -->

<?php
$script = ob_get_clean();
include('master_page_dandori.php');
ob_flush();
?>