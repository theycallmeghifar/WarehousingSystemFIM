<?php ob_start();?>


<!-- HEADER -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Rak</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Menu</a></li>
              <li class="breadcrumb-item active">Penyimpanan</li>
              <li class="breadcrumb-item active">Rak</li>
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
      	     <div class="d-flex justify-content-between">
      	       <!-- <h3 class="card-title">Daftar Rak</h3> -->
      	     </div>
             <button type="button" id="btnTambah" style="margin-top: 10px;" class="btn btn-primary pull-right" data-toggle="modal" data-target="#tambahData">Tambah Data</button>
      	   </div>

      	   <div class="card-body">
                  <table id="dataTable" class="display nowrap table-striped table" style="width:100%" >
                      <thead>
                          <tr>
                              <th>ID</th>
							                <th>Deskripsi</th>
                              <th>Lemari</th>
                              <th>Kapasitas Sekarang</th>
                              <th>Kapasitas Maksimal</th>
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
                            <td><?php echo $data->idRak?></td>
                            <td><?php echo $data->deskripsiRak?></td> 
                            <td><?php 
                                foreach ($lemari as $row) {
                                  if ($data->idLemari == $row->idLemari) {
                                    echo $row->deskripsiLemari;
                                  }  
                                }                               
                                if ($data->idLemari == "" ){
                                  echo "-";
                                }                       
                                ?></td>
							              <td><?php echo $data->currentVolume?></td>
                            <td><?php echo $data->maxVolume?></td>                     
                            <td><?php if($data->status == 0){
                                  echo "Tidak Aktif";
                                }else{ 
                                  echo "Aktif";
                            }?></td>
                            <td hidden="true"><?php echo $data->status?></td>
                            <td hidden="true"><?php echo $data->createdBy?></td>
                            <td hidden="true"><?php echo $data->createdDate?></td>
                            <td hidden="true"><?php echo $data->modifiedBy?></td>
                            <td hidden="true"><?php echo $data->modifiedDate?></td>
                            <td hidden="true"><?php 
                                if ($data->idLemari != "" ){          
                                  echo $data->idLemari;
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
                <form action="<?php echo base_url('Rak/saveRakCon')?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" style="width: 410px;">
                              <form role="form" action="<?php echo site_url('Rak/saveRakCon')?>" method="post" autocomplete="off">
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-5 col-form-label text-label">Deskripsi<span style="color: red">*</span></label>
                                         <div class="col-sm-7">
                                            <div class="input-group">
                                                  <input type="text" id="deskripsiRak" name="deskripsiRak" class="form-control form-control-user" placeholder="Contoh: Rak Z1" required></input>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                      <label class="col-sm-5 col-form-label text-label">Lemari</label>
                                      <div class="col-sm-7">
                                        <select class="form-control" name="idLemari" id="idLemari">
                                          <option disabled selected>-- Pilih Lemari --</option>
                                          <?php
                                          foreach ($lemari as $row) : 
                                          ?>
                                            <option
                                              value="<?= $row->idLemari ?>" 
                                              <?= ($row->idLemari == set_value('idLemari') ? 'selected' : '') ?>
                                            >
                                              <?= $row->deskripsiLemari ?>
                                            </option>
                                          <?php
                                          endforeach;
                                          ?>
                                        </select>
                                      </div>
                                    </div>
									                  <div class="form-group row align-items-center">
                                      <label class="col-sm-5 col-form-label text-label">Kapasitas Sekarang<span style="color: red">*</span></label>
                                      <div class="col-sm-7">
                                          <div class="input-group">
                                               <input type="number" id="currentVolume" name="currentVolume" class="form-control form-control-user" placeholder="Masukkan Hanya Angka" required></input>
                                          </div> 
                                      </div>
                                  </div>
								                  <div class="form-group row align-items-center">
                                      <label class="col-sm-5 col-form-label text-label">Kapasitas Maksimal<span style="color: red">*</span></label>
                                      <div class="col-sm-7">
                                          <div class="input-group">
                                               <input type="number" id="maxVolume" name="maxVolume" class="form-control form-control-user" placeholder="Masukkan Hanya Angka" required></input>
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
                <form action="<?php echo base_url('Rak/editRakCon')?>" method="POST" enctype="multipart/form-data">
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
                                <form role="form" action="<?php echo site_url('Rak/editRakCon')?>" method="post" autocomplete="off" enctype="multipart/form-data">
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-5 col-form-label text-label">ID</label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                 <input type="text" id="idU" name="idU" class="form-control form-control-user" readonly required></input>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-5 col-form-label text-label">Deskripsi<span style="color: red">*</span></label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                               <input type="text" id="deskripsiRakU" name="deskripsiRakU" class="form-control form-control-user" placeholder="Contoh: Rak Z1" required></input>
                                            </div> 
                                        </div>
                                    </div>   
                                    <div class="form-group row align-items-center">
                                      <label class="col-sm-5 col-form-label text-label">Lemari</label>
                                      <div class="col-sm-7">
                                        <select class="form-control" name="idLemariU" id="idLemariU">
                                          <option disabled selected>-- Pilih Lemari --</option>
                                          <?php
                                          foreach ($lemari as $row) : 
                                          ?>
                                            <option
                                              value="<?= $row->idLemari ?>" 
                                              <?= ($row->idLemari == $data->idLemari ? 'selected' : '') ?>
                                            >
                                              <?= $row->deskripsiLemari ?>
                                            </option>
                                          <?php
                                          endforeach;
                                          ?>
                                        </select>
                                      </div>
                                    </div> 
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-5 col-form-label text-label">Kapasitas Sekarang<span style="color: red">*</span></label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <input type="number" id="currentVolumeU" name="currentVolumeU" class="form-control form-control-user" placeholder="Masukkan Hanya Angka" required></input>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                      <label class="col-sm-5 col-form-label text-label">Kapasitas Maksimal<span style="color: red">*</span></label>
                                      <div class="col-sm-7">
                                        <div class="input-group">
                                          <input type="number" id="maxVolumeU" name="maxVolumeU" class="form-control form-control-user" placeholder="Masukkan Hanya Angka" required></input>
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
                            <input type="text" id="idD" name="idD" class="form-control form-control-user" disabled required></input>
                          </div> 
                        </div>
                      </div>    
                      <div class="form-group row align-items-center">
                        <label class="col-sm-5 col-form-label text-label">Deskripsi<span style="color: red">*</span></label>
                        <div class="col-sm-7">
                          <div class="input-group">
                            <input type="text" id="deskripsiRakD" name="deskripsiRakD" class="form-control form-control-user" disabled required></input>
                          </div> 
                        </div>
                      </div>                  
                      <!-- <div class="form-group row align-items-center">
                        <label class="col-sm-3 col-form-label text-label">Lemari</label>
                        <div class="col-sm-9">
                          <select class="form-control" name="idLemariD" id="idLemariD" disabled required>
                            <option disabled selected>-- Pilih Lemari --</option>
                            <?php
                            foreach ($lemari as $row) : 
                            ?>
                              <option
                                value="<?= $row->idLemari ?>" 
                                <?= ($row->idLemari == $data->idLemari ? 'selected' : '') ?>
                              >
                                <?= $row->deskripsiLemari ?>
                              </option>
                            <?php
                            endforeach;
                            ?>
                          </select>
                        </div>
                      </div>   -->
                      <div class="form-group row align-items-center">
                        <label class="col-sm-5 col-form-label text-label">Lemari</label>
                        <div class="col-sm-7">
                          <div class="input-group">
                            <input type="text" id="idLemariD" name="idLemariD" class="form-control form-control-user" style="justify-content: left;" disabled required></input>
                          </div> 
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label class="col-sm-5 col-form-label text-label">Kapasitas Sekarang<span style="color: red">*</span></label>
                        <div class="col-sm-7">
                          <div class="input-group">
                            <input type="number" id="currentVolumeD" name="currentVolumeD" class="form-control form-control-user" disabled required></input>
                          </div> 
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label class="col-sm-5 col-form-label text-label">Kapasitas Maksimal<span style="color: red">*</span></label>
                        <div class="col-sm-7">
                          <div class="input-group">
                            <input type="number" id="maxVolumeD" name="maxVolumeD" class="form-control form-control-user" disabled required></input>
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

                $('#idU').val(data[0]);
                $('#deskripsiRakU').val(data[1]);
                $('#idLemariU').val(data[11]);
                $('#currentVolumeU').val(data[3]);
                $('#maxVolumeU').val(data[4]);
                $('#statusU').val(data[6]);     
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

                $('#idD').val(data[0]);
                $('#deskripsiRakD').val(data[1]);
                $('#idLemariD').val(data[2]);
                $('#currentVolumeD').val(data[3]);
                $('#maxVolumeD').val(data[4]);
                $('#statusD').val(data[6]); 
                $('#creadateD').val(data[8]); 
                $('#modidateD').val(data[10]); 
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