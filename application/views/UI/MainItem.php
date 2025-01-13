<?php ob_start();?>


<!-- HEADER -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Main Item
            
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Menu</a></li>
              <li class="breadcrumb-item active">Master Barang</li>
              <li class="breadcrumb-item active">Main Item</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

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
               <!-- <h3 class="card-title">Daftar Lemari</h3> -->
             </div>
                <button type="button" id="btnTambah" style="margin-top: 10px;" class="btn btn-primary pull-right addData" 
                  data-toggle="modal" data-target="#tamData">Tambah Data
                </button>
                <form id="formPrint" target="_blank" method="post" role="form" action="<?php echo site_url('MainItem/printQRCodeMainItemCon') ?>">
                    <input hidden="true" id="txtPrint" name="listPrint" />
                    <button class="btn btn-success pull-left" style="margin-top: 10px; margin-right: 5px;" id="btnPrint" type="button" class="btn btn-info">
                         Print QR Code Main Item
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
                              <th hidden="true">ID</th>
                              <th>Main Item Code</th>
														  <th>Main Item Name</th>
														  <th>Item Code</th>
														  <th>Position</th>
                              <th>Status</th>
                              <th hidden="true">Status Int</th>
                              <th hidden="true">Created By</th>
                              <th hidden="true">Created Date</th>
                              <th hidden="true">Modified By</th>
                              <th hidden="true">Modified Date</th>
                              <th>Action</th>
                         </tr>
                      </thead>
                      <tbody>
                        <?php
                            foreach($getData as $data){
                        ?>
                        <tr>                             
                            <td hidden="true"><?php echo $data->id?></td>
         										<td><?php echo $data->mainItemCode?></td>
         										<td><?php echo $data->mainItemName?></td>
         										<td><?php echo $data->itemCode?></td>
         										<td><?php echo $data->position?></td>
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
                            <td>
                                <input class='form-check-input' type='checkbox' id='checkPrint' value='<?php echo $data->id?>'/>
                                <a href="javascript:void(0);" class="fa fa-pencil-square-o color-muted editbtn" style="margin-left: 15px;" title="Ubah Data"></a>
                                <a href="javascript:void(0);" class="fa fa-tasks color-muted detailbtn" style="margin-left: 15px;" title="Detail Data"></a>
                            </td>
                          </tr>
                          <?php } ?>
                      </tbody>
                  </table>
                  </br>
           </div>

           <br/><br/><br/>

         </div>
        </div>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- END TABLE -->


<!-- MODAL -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

        <!-- TAMBAH DATA -->
        <div class="modal fade" id="tamData" tabindex="-1" role="dialog" aria-labelledby="tamData" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" >
                
                <form id="addData" action="<?php echo base_url('MainItem/saveMainItemCon')?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" style="width: 380px;">
						                <form role="form" action="<?php echo site_url('MainItem/saveMainItemCon')?>" method="post" autocomplete="off"> 
													  	
													  	<div class="form-group row align-items-center">
																<label class="col-sm-5 col-form-label text-label">Main Item Code<span style="color: red">*</span></label>
																<div class="col-sm-7">
																	<div class="input-group">
																		<input type="text" id="mainItemCode" name="mainItemCode" class="form-control form-control-user" required></input>
																	</div> 
																</div>
															</div>

															<div class="form-group row align-items-center">
																<label class="col-sm-5 col-form-label text-label">Main Item Name<span style="color: red">*</span></label>
																<div class="col-sm-7">
																	<div class="input-group">
																		<input type="text" id="mainItemName" name="mainItemName" class="form-control form-control-user" required></input>
																	</div> 
																</div>
															</div>

															<div class="form-group row align-items-center">
																<label class="col-sm-5 col-form-label text-label">Item Code<span style="color: red">*</span></label>
																<div class="col-sm-7">
																	<div class="input-group">
																		<input type="text" id="itemCode" name="itemCode" class="form-control form-control-user" required></input>
																	</div> 
																</div>
															</div>

															<div class="form-group row align-items-center" id="txtPosition">
																<label class="col-sm-5 col-form-label text-label">Position<span style="color: red">*</span></label>
																<div class="col-sm-7">
																	<div class="input-group">
																		<input type="number" id="position" name="position" class="form-control form-control-user" placeholder="Masukkan Hanya Angka" required></input>
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
              
                <form action="<?php echo base_url('MainItem/editMainItemCon')?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Ubah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" style="width: 400px;">
                            <div class="row match-height">
                                <div class="col-12">
                                <form role="form" action="<?php echo site_url('MainItem/editMainItemCon')?>" method="post" autocomplete="off" enctype="multipart/form-data">
                                    <div hidden="true" class="form-group row align-items-center">
                                        <label class="col-sm-5 col-form-label text-label">ID</label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                 <input type="text" id="idU" name="idU" class="form-control form-control-user" readonly required></input>
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">
																			<label class="col-sm-5 col-form-label text-label">Main Item Code<span style="color: red">*</span></label>
																			<div class="col-sm-7">
																				<div class="input-group">
																					<input type="text" id="mainItemCodeU" name="mainItemCodeU" class="form-control form-control-user" readonly required></input>
																				</div> 
																			</div>
																		</div>

																		<div class="form-group row align-items-center">
																			<label class="col-sm-5 col-form-label text-label">Main Item Name<span style="color: red">*</span></label>
																			<div class="col-sm-7">
																				<div class="input-group">
																					<input type="text" id="mainItemNameU" name="mainItemNameU" class="form-control form-control-user" required></input>
																				</div> 
																			</div>
																		</div>

																		<div class="form-group row align-items-center">
																			<label class="col-sm-5 col-form-label text-label">Item Code<span style="color: red">*</span></label>
																			<div class="col-sm-7">
																				<div class="input-group">
																					<input type="text" id="itemCodeU" name="itemCodeU" class="form-control form-control-user" required></input>
																				</div> 
																			</div>
																		</div>

																		<div class="form-group row align-items-center">
																			<label class="col-sm-5 col-form-label text-label">Position<span style="color: red">*</span></label>
																			<div class="col-sm-7">
																				<div class="input-group">
																					<input type="number" id="positionU" name="positionU" class="form-control form-control-user" placeholder="Masukkan Hanya Angka" required></input>
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
                      <div class="modal-body" style="width: 380px;">
					                         	<div hidden="true" class="form-group row align-items-center">
					                              <label class="col-sm-5 col-form-label text-label">ID</label>
					                              <div class="col-sm-7">
					                                  <div class="input-group">
					                                       <input type="text" id="idD" name="idD" class="form-control form-control-user" disabled required></input>
					                                  </div> 
					                              </div>
					                          </div>
						  											<div class="form-group row align-items-center">
																			<label class="col-sm-5 col-form-label text-label">Main Item Code<span style="color: red">*</span></label>
																			<div class="col-sm-7">
																				<div class="input-group">
																					<input type="text" id="mainItemCodeD" name="mainItemCodeD" class="form-control form-control-user" disabled required></input>
																				</div> 
																			</div>
																		</div>

																		<div class="form-group row align-items-center">
																			<label class="col-sm-5 col-form-label text-label">Main Item Name<span style="color: red">*</span></label>
																			<div class="col-sm-7">
																				<div class="input-group">
																					<input type="text" id="mainItemNameD" name="mainItemNameD" class="form-control form-control-user" disabled required></input>
																				</div> 
																			</div>
																		</div>

																		<div class="form-group row align-items-center">
																			<label class="col-sm-5 col-form-label text-label">Item Code<span style="color: red">*</span></label>
																			<div class="col-sm-7">
																				<div class="input-group">
																					<input type="text" id="itemCodeD" name="itemCodeD" class="form-control form-control-user" disabled required></input>
																				</div> 
																			</div>
																		</div>

																		<div class="form-group row align-items-center">
																			<label class="col-sm-5 col-form-label text-label">Position<span style="color: red">*</span></label>
																			<div class="col-sm-7">
																				<div class="input-group">
																					<input type="number" id="positionD" name="positionD" class="form-control form-control-user" placeholder="Masukkan Hanya Angka" disabled required></input>
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
            $('.editbtn').on('click', function(){
                $('#editmodal').modal('show');
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();
                console.log(data);

                $('#idU').val(data[0]);
                $('#mainItemCodeU').val(data[1]);
                $('#mainItemNameU').val(data[2]);
								$('#itemCodeU').val(data[3]);
								$('#positionU').val(data[4]);
                $('#statusU').val(data[6]);

            $( "#itemCodeU").autocomplete({
                appendTo: "#editmodal",
                source: function( request, response ) {
                  // Fetch data
                  $.ajax({
                    url: "<?=base_url()?>MainItem/ItemAutoCon",
                    type: 'post',
                    dataType: "json",
                    data: {
                      search: request.term
                    },
                    success: function( data ) {
                      response( data );
                    }
                  });
                },
                
                select: function (event, ui) {
                  // Set selection
                  $('#itemCodeU').val(ui.item.label); // display the selected text
                  return false;
                }
              });
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
                $('#mainItemCodeD').val(data[1]);
                $('#mainItemNameD').val(data[2]);
								$('#itemCodeD').val(data[3]);
								$('#positionD').val(data[4]);
                $('#statusD').val(data[6]);
                $('#creadateD').val(data[8]); 
                $('#modidateD').val(data[10]); 
            });
        });
    </script>

    <script type='text/javascript'>
        $(document).ready(function(){
          // Initialize 
          $( "#itemCode").autocomplete({
            appendTo: "#tamData",
            source: function( request, response ) {
              // Fetch data
              $.ajax({
                url: "<?=base_url()?>MainItem/ItemAutoCon",
                type: 'post',
                dataType: "json",
                data: {
                  search: request.term
                },
                success: function( data ) {
                  response( data );
                }
              });
            },
            
            select: function (event, ui) {
              // Set selection
              $('#itemCode').val(ui.item.label); // display the selected text
              return false;
            }
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