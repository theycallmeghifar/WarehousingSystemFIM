<?php ob_start();?>


<!-- HEADER -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Palet</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Menu</a></li>
              <li class="breadcrumb-item active">Penyimpanan</li>
              <li class="breadcrumb-item active">Palet</li>
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
      	       <!-- <h3 class="card-title">Daftar Palet</h3> -->
      	     </div>
               <button type="button" id="btnTambah" style="margin-top: 10px;" class="btn btn-primary pull-right" data-toggle="modal" data-target="#tambahData">Tambah Data</button>
               <form id="formPrint" target="_blank" method="post" role="form" action="<?php echo site_url('Palet/printQRCodePaletCon') ?>">
                   <input hidden="true" id="txtPrint" name="listPrint" />
                   <button class="btn btn-success pull-left" style="margin-top: 10px; margin-right: 5px;" id="btnPrint" type="button" class="btn btn-info">
                       Print QR Code Palet
                   </button>
               </form>
                <button id="btnCheck" type="button" onclick="check();" style="margin-top: 10px; margin-right: 5px;" class="btn btn-secondary pull-left">
                    <i style="margin-right: 8px;" class="fas fa-minus-square"></i>Pilih Semua QR Code
                </button>
                <button id="btnUncheck" type="button" onclick="uncheck();" style="margin-top: 10px; margin-right: 5px;" class="btn btn-secondary pull-left">
                    <i style="margin-right: 8px;" class="fas fa-times"></i>Batal Pilih Semua
                </button>

                <button id="show_all_records" type="button" style="margin-top: 10px; margin-right: 5px;" class="btn btn-info pull-left">
                    <i style="margin-right: 8px;" class="fas fa-tasks"></i>Lihat Semua Data
                </button>
                <button id="restore_records" type="button" style="margin-top: 10px; margin-right: 5px;" class="btn btn-info pull-left">
                    <i style="margin-right: 8px;" class="fas fa-times"></i>Reset Table
                </button>
      	   </div>

      	   <div class="card-body">
                  <table id="dataTable" class="display nowrap table-striped table" style="width:100%" >
                      <thead>
                          <tr>
                              <th>ID</th>
              							  <th>Deskripsi</th>
              							  <th>Rak</th>
                              <th>Jumlah Item</th>
                              <th>Maksimal Barang</th>
                              <th>IP Address</th>
                              <th hidden="true">GPIO 1</th>
                              <th hidden="true">GPIO 2</th>
                              <th hidden="true">GPIO 3</th>
                              <th>Status</th>
                              <th hidden="true">Status Int</th>
                              <th hidden="true">Created By</th>
                              <th hidden="true">Created Date</th>
                              <th hidden="true">Modified By</th>
                              <th hidden="true">Modified Date</th>
                              <th hidden="true">Rak Int</th>
                              <th>Aksi</th>
                         </tr>
                      </thead>
                      <tbody>
                        <?php
                            foreach($getData as $data){
                        ?>
                        <tr>                             
                            <td><?php echo $data->idPalet?></td>							
                            <td><?php echo $data->deskripsiPalet?></td>     
              							<td><?php 
                                foreach ($rak as $row) {
                                  if ($data->idRak == $row->idRak) {
                                    echo $row->deskripsiRak;
                                  }  
                                }                               
                                if ($data->idRak == "" ){
                                  echo "-";
                                }                       
                                ?></td> 
                            <td><?php
                                if($data->jumlahItem == 0){
                                  echo "0";
                                }
                                else{
                                  echo $data->jumlahItem;
                                } ?></td>
                            <td><?php echo $data->maxBarang?></td> 
                            <td><?php 
                                if($data->ipAddress == ""){
                                  echo "-";
                                }else{
                                  echo $data->ipAddress;
                                }?></td> 
                            <td hidden="true"><?php 
                                if($data->gpio1 == "0"){
                                  echo "-";
                                }else{
                                  echo $data->gpio1;
                                }?></td>  
                            <td hidden="true"><?php
                                if($data->gpio2 == "0"){
                                  echo "-";
                                }else{
                                  echo $data->gpio2;
                                }?></td>  
                            <td hidden="true"><?php
                                if($data->gpio3 == "0"){
                                  echo "-";
                                }else{
                                  echo $data->gpio3;
                                }?></td>              

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
                                if ($data->idRak != "" ){          
                                  echo $data->idRak;
                                }
                                else
                                {
                                  echo "-";
                                }?></td>
                            <td>
                                <input class='form-check-input' type='checkbox' id='checkPrint' value='<?php echo $data->idPalet?>'/>
                                <a href="javascript:void(0);" class="fa fa-pencil-square-o color-muted editbtn" title="Ubah Data" style="margin-left: 15px;"></a>
                                <a href="javascript:void(0);" class="fa fa-tasks color-muted detailbtn" title="Detail Data" style="margin-left: 15px;"></a>
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
                <form action="<?php echo base_url('Palet/savePaletCon')?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" style="width: 450px;">
                              <form role="form" action="<?php echo site_url('Palet/savePaletCon')?>" method="post" autocomplete="off">
                                <div class="form-group row align-items-center">
                                  <label class="col-sm-5 col-form-label text-label">Deskripsi<span style="color: red">*</span></label>
                                  <div class="col-sm-7">
                                    <div class="input-group">
                                      <input type="text" id="deskripsiPalet" name="deskripsiPalet" class="form-control form-control-user" placeholder="contoh : Z1.1" required></input>
                                    </div> 
                                  </div>
                                </div>        
                                <div class="form-group row align-items-center">
                                  <label class="col-sm-5 col-form-label text-label">Rak</label>
                                  <div class="col-sm-7">
                                    <select class="form-control" name="idRak" id="idRak">
                                      <option disabled selected>-- Pilih Rak --</option>
                                      <?php
                                      foreach ($rak as $row) : 
                                      ?>
                                        <option
                                          value="<?= $row->idRak ?>" 
                                          <?= ($row->idRak == set_value('idRak') ? 'selected' : '') ?>
                                        >
                                          <?= $row->deskripsiRak ?>
                                        </option>
                                      <?php
                                      endforeach;
                                      ?>
                                    </select>
                                  </div>
                                </div> 
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-5 col-form-label text-label">Maksimal Barang<span style="color: red">*</span></label>
                                    <div class="col-sm-7">
                                        <div class="input-group">
                                              <input type="number" id="maxBarang" name="maxBarang" class="form-control form-control-user" placeholder="Masukkan Hanya Angka" required></input>
                                        </div> 
                                    </div>
                                </div>   
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-5 col-form-label text-label">IP Address</label>
                                    <div class="col-sm-7">
                                        <div class="input-group">
                                              <input type="text" id="ipAddress" name="ipAddress" class="form-control form-control-user" placeholder="contoh: 192.168.1.1"></input>
                                        </div> 
                                    </div>
                                </div>    
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-2 col-form-label text-label">GPIO 1</label>
                                    <div class="col-sm-2">
                                        <div class="input-group">
                                              <input type="number" id="gpio1" name="gpio1" class="form-control form-control-user"></input>
                                        </div> 
                                    </div>
                                    <label class="col-sm-2 col-form-label text-label">GPIO 2</label>
                                    <div class="col-sm-2">
                                        <div class="input-group">
                                              <input type="number" id="gpio2" name="gpio2" class="form-control form-control-user"></input>
                                        </div> 
                                    </div>
                                    <label class="col-sm-2 col-form-label text-label">GPIO 3</label>
                                    <div class="col-sm-2">
                                        <div class="input-group">
                                              <input type="number" id="gpio3" name="gpio3" class="form-control form-control-user"></input>
                                        </div> 
                                    </div>
                                </div>  
                                <span style="color: grey;">*GPIO diisi dengan hanya angka</span>
    
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
                <form action="<?php echo base_url('Palet/editPaletCon')?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Ubah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" style="width: 450px;">
                            <div class="row match-height">
                                <div class="col-12">
                                <form role="form" action="<?php echo site_url('Palet/editPaletCon')?>" method="post" autocomplete="off" enctype="multipart/form-data">
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
                                                <input type="text" id="deskripsiPaletU" name="deskripsiPaletU" class="form-control form-control-user" placeholder="contoh : Z1.1" required></input>
                                              </div> 
                                          </div>
                                      </div>
                                      <div class="form-group row align-items-center">
                                        <label class="col-sm-5 col-form-label text-label">Rak</label>
                                        <div class="col-sm-7">
                                          <select class="form-control" name="idRakU" id="idRakU">
                                            <option disabled selected>-- Pilih Rak --</option>
                                            <?php
                                            foreach ($rak as $row) : 
                                            ?>
                                              <option
                                                value="<?= $row->idRak ?>" 
                                                <?= ($row->idRak == $data->idRak ? 'selected' : '') ?>
                                              >
                                                <?= $row->deskripsiRak ?>
                                              </option>
                                            <?php
                                            endforeach;
                                            ?>
                                          </select>
                                        </div>
                                      </div>       
                                      <div class="form-group row align-items-center">
                                        <label class="col-sm-5 col-form-label text-label">Maksimal Barang<span style="color: red">*</span></label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <input type="number" id="maxBarangU" name="maxBarangU" class="form-control form-control-user" placeholder="Masukkan Hanya Angka" required></input>
                                            </div> 
                                        </div>
                                      </div> 
                                      <div class="form-group row align-items-center">
                                          <label class="col-sm-5 col-form-label text-label">IP Address</label>
                                          <div class="col-sm-7">
                                              <div class="input-group">
                                                    <input type="text" id="ipAddressU" name="ipAddressU" class="form-control form-control-user" placeholder="contoh: 192.168.1.1"></input>
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
                                
                                        
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-2 col-form-label text-label">GPIO 1</label>
                                    <div class="col-sm-2">
                                        <div class="input-group">
                                              <input type="number" id="gpio1U" name="gpio1U" class="form-control form-control-user"></input>
                                        </div> 
                                    </div>
                                    <label class="col-sm-2 col-form-label text-label">GPIO 2</label>
                                    <div class="col-sm-2">
                                        <div class="input-group">
                                              <input type="number" id="gpio2U" name="gpio2U" class="form-control form-control-user"></input>
                                        </div> 
                                    </div>
                                    <label class="col-sm-2 col-form-label text-label">GPIO 3</label>
                                    <div class="col-sm-2">
                                        <div class="input-group">
                                              <input type="number" id="gpio3U" name="gpio3U" class="form-control form-control-user"></input>
                                        </div> 
                                    </div>
                                </div> 
                                <span style="color: grey;">*GPIO diisi dengan hanya angka</span>
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
                      <div class="modal-body" style="width: 450px;">
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
                                       <input type="text" id="deskripsiPaletD" name="deskripsiPaletD" class="form-control form-control-user" disabled required></input>
                                  </div> 
                              </div>
                          </div>
                          <!-- <div class="form-group row align-items-center">
                              <label class="col-sm-3 col-form-label text-label">Rak</label>
                            <div class="col-sm-9">
                              <select class="form-control" name="idRakD" id="idRakD" class="form-control form-control-user" disabled required>
                                <option disabled selected>-- Pilih Rak --</option>
                                <?php foreach ($rak as $row) { ?>
                                <option
                                  value="<?= $row->idRak ?>" 
                                  <?= ($row->idRak == $data->idRak ? 'selected' : '') ?>
                                >
                                  <?= $row->deskripsiRak ?>
                                </option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>       -->
                          <div class="form-group row align-items-center">
                            <label class="col-sm-5 col-form-label text-label">Rak</label>
                            <div class="col-sm-7">
                              <div class="input-group">
                                <input type="text" id="idRakD" name="idRakD" class="form-control form-control-user" style="justify-content: left;" disabled required></input>
                              </div> 
                            </div>
                          </div>
                          <div class="form-group row align-items-center">
                              <label class="col-sm-5 col-form-label text-label">Maksimal Barang<span style="color: red">*</span></label>
                              <div class="col-sm-7">
                                  <div class="input-group">
                                        <input type="number" id="maxBarangD" name="maxBarangD" class="form-control form-control-user" disabled required></input>
                                  </div> 
                              </div>
                          </div>  
                          <div class="form-group row align-items-center">
                              <label class="col-sm-5 col-form-label text-label">IP Address</label>
                              <div class="col-sm-7">
                                  <div class="input-group">
                                        <input type="text" id="ipAddressD" name="ipAddressD" class="form-control form-control-user" disabled required></input>
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
                          <div class="form-group row align-items-center">
                              <label class="col-sm-2 col-form-label text-label">GPIO 1</label>
                              <div class="col-sm-2">
                                  <div class="input-group">
                                        <input type="text" id="gpio1D" name="gpio1D" class="form-control form-control-user" disabled required></input>
                                  </div> 
                              </div>
                              <label class="col-sm-2 col-form-label text-label">GPIO 2</label>
                              <div class="col-sm-2">
                                  <div class="input-group">
                                        <input type="text" id="gpio2D" name="gpio2D" class="form-control form-control-user" disabled required></input>
                                  </div> 
                              </div>
                              <label class="col-sm-2 col-form-label text-label">GPIO 3</label>
                              <div class="col-sm-2">
                                  <div class="input-group">
                                        <input type="text" id="gpio3D" name="gpio3D" class="form-control form-control-user" disabled required></input>
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
                $('#deskripsiPaletU').val(data[1]);
                $('#maxBarangU').val(data[4]);
                $('#ipAddressU').val(data[5]);
                $('#gpio1U').val(data[6]);
                $('#gpio2U').val(data[7]);
                $('#gpio3U').val(data[8]);
                $('#statusU').val(data[10]);
                $('#idRakU').val(data[15]);     
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
                $('#deskripsiPaletD').val(data[1]);
                $('#maxBarangD').val(data[4]);
                $('#ipAddressD').val(data[5]);
                $('#gpio1D').val(data[6]);
                $('#gpio2D').val(data[7]);
                $('#gpio3D').val(data[8]);
                $('#statusD').val(data[10]); 
                $('#creadateD').val(data[12]); 
                $('#modidateD').val(data[14]); 
                $('#idRakD').val(data[2]); 
            });
        });

        $('#btnPrint').on("click", function(e) {
            var count = 0;
            var listPrint = [];
            var print = "";
            $('input[type="checkbox"]:checked').each(function() {
                if ($(this).prop('checked', true)) {
                    listPrint.push($(this).val());
                    if ($(this).val() != 0) {
                        count++;
                        print += $(this).val() + "|";
                    }
                }
            });
            if (listPrint.length > 0) {
                if (count > 100) {
                    Swal.fire({
                        title: 'Print QR Code tidak bisa dilakukan',
                        text: 'Maksimal memilih 100 data untuk melakukan print',
                        icon: 'warning'
                    });
                } else {
                txtPrint.value = print;
                $("#formPrint").submit();
                }
            } else {
                Swal.fire({
                    title: 'Pilih data terlebih dahulu',
                    text: '',
                    icon: 'warning'
                });
            }
        });

        var btncheck = document.getElementById('btnCheck');
        var btnuncheck = document.getElementById('btnUncheck');

        window.onload = function () {
            restore_records.style.display = "none";
            btncheck.style.display = "block";
            btnuncheck.style.display = "none";
        }

        function check() {
            $("input:checkbox").prop("checked", true);
            btncheck.style.display = "none";
            btnuncheck.style.display = "block";
        }

        function uncheck() {
            $("input:checkbox").prop("checked", false);
            btncheck.style.display = "block";
            btnuncheck.style.display = "none";
        }

        var oTable; //global variable to hold reference to dataTables
        var oSettings; //global variable to hold reference to dataTables settings

        $(document).ready(function(){
            oTable=$('#dataTable').DataTable( {
                "bSort": false,
                "pagingType": "full_numbers",
                "dom": 'T<"clear">lfrtip',
            }); //store reference of your table in oTable
            oSettings = oTable.settings(); //store its settings in oSettings
        });

        $("#show_all_records").on('click',function(){
           show_all_records.style.display = "none";
           restore_records.style.display = "block";
           oSettings[0]._iDisplayLength = oSettings[0].fnRecordsTotal();
           //set display length of dataTables settings to the total records available
           oTable.draw();  //draw the table
        });

        $("#restore_records").on('click',function(){
            show_all_records.style.display = "block";
            restore_records.style.display = "none";
            oSettings[0]._iDisplayLength=10;
           //set it back to 10
            oTable.draw();//again draw the table
        });
    </script>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- END SCRIPT -->

<?php
$script = ob_get_clean();
include('master_page.php');
ob_flush();
?>