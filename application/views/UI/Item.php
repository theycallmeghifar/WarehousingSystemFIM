<?php ob_start();?>


<!-- HEADER -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

  <div class="content-wrapper">
    <div class="content-header">
        <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
            <?= $this->session->flashdata('success'); ?>
            <button type="button" class="close" aria-label="Close" onclick="closeAlert('alert-success')">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-danger">
            <?= $this->session->flashdata('error'); ?>
            <button type="button" class="close" aria-label="Close" onclick="closeAlert('alert-danger')">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Item</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Menu</a></li>
                    <?php if ($this->session->userdata('role') == 0): ?>
                    <li class="breadcrumb-item active">Master Barang</li>
                    <?php endif; ?>
                    <li class="breadcrumb-item active">Item</li>
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
                    <!-- <h3 class="card-title">Daftar Lemari</h3> -->
                    </div>
                    <button type="button" id="btnTambah" style="margin-top: 10px;" class="btn btn-primary pull-right" data-toggle="modal" data-target="#tambahData">Tambah Data</button>
                    <form id="formPrint" target="_blank" method="post" role="form" action="<?php echo site_url('Item/printQRCodeItemCon') ?>">
                        <input hidden="true" id="txtPrint" name="listPrint" />
                        <button class="btn btn-success pull-left" style="margin-top: 10px; margin-right: 5px;" id="btnPrint" type="button" class="btn btn-info">
                            Print QR Code Item
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

                <div class="row" style="margin-left:20px;">
                    </form>
                    <form id="formExportExcel" target="_blank" method="post" role="form" action="<?php echo site_url('Item/ExportExcelItemCon') ?>">
                        <button class="btn btn-success pull-left" style="margin-right:5px;" id="btnExportExcel" type="submit">
                        <i style="margin-right: 8px;" class="fas fa-arrow-up"></i>Export Excel
                        </button>
                    </form>
                    <button class="btn btn-success pull-left" id="btnImport" type="button" class="btn btn-info" data-toggle="modal" data-target="#importData"><i style="margin-right: 8px;" class="fas fa-arrow-down"></i>Import Excel</button>
                    </div>

                <div class="card-body">
                    <table id="dataTable" class="display nowrap table-striped table" style="width:100%" >
                        <thead>
                            <tr>
                                <th>Item Code</th>
                                <th>Item Name</th>
                                <th>Jumlah Item</th>
                                <th>Net Quantity</th>
                                <th>Status</th>
                                <th hidden="true">Status Int</th>
                                <th hidden="true">Created By</th>
                                <th hidden="true">Created Date</th>
                                <th hidden="true">Modified By</th>
                                <th hidden="true">Modified Date</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($getData as $data){
                            ?>
                            <tr>                             
                                <td><?php echo $data->itemCode?></td>
                                <td><?php echo $data->itemName?></td>
                                <td><?php echo $data->jumlahItem?></td>
                                <td><?php echo $data->netQuantity?></td>                        
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
                                    <input class='form-check-input' type='checkbox' id='checkPrint' value='<?php echo $data->itemCode?>'/>
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
                <form action="<?php echo base_url('Item/saveItemCon')?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" style="width: 400px;">
                              <form role="form" action="<?php echo site_url('Item/saveItemCon')?>" method="post" autocomplete="off">
                                  <div class="form-group row align-items-center">
                                      <label class="col-sm-4 col-form-label text-label">Item Code<span style="color: red">*</span></label>
                                      <div class="col-sm-8">
                                          <div class="input-group">
                                               <input type="text" id="itemCode" name="itemCode" class="form-control form-control-user" required></input>
                                          </div> 
                                      </div>
                                  </div>

                                  <div class="form-group row align-items-center">
                                      <label class="col-sm-4 col-form-label text-label">Item Name<span style="color: red">*</span></label>
                                      <div class="col-sm-8">
                                          <div class="input-group">
                                               <input type="text" id="itemName" name="itemName" class="form-control form-control-user" required></input>
                                          </div> 
                                      </div>
                                  </div>   
                                  <div class="form-group row align-items-center">
                                      <label class="col-sm-4 col-form-label text-label">Jumlah Item<span style="color: red">*</span></label>
                                      <div class="col-sm-8">
                                          <div class="input-group">
                                               <input type="number" id="jumlahItem" name="jumlahItem" class="form-control form-control-user" placeholder="Masukkan Hanya Angka" required></input>
                                          </div> 
                                      </div>
                                    </div>  
                                  <div class="form-group row align-items-center">
                                      <label class="col-sm-4 col-form-label text-label">Net Quantity<span style="color: red">*</span></label>
                                      <div class="col-sm-8">
                                          <div class="input-group">
                                               <input type="number" id="netQuantity" name="netQuantity" class="form-control form-control-user" placeholder="Masukkan Hanya Angka" required></input>
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

        <!-- IMPORT DATA -->
        <div class="modal fade" id="importData" tabindex="-1" role="dialog" aria-labelledby="tambahData" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <form action="<?php echo base_url('Item/importExcelItemCon') ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Import Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="width:350px;">
                            <div class="form-group row align-items-center">
                                <label class="col-sm-5 col-form-label text-label">Pilih File<span style="color: red">*</span></label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <input type="file" id="file" name="file" class="form-control form-control-user" accept=".xlsx, .xls" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" id="submit" name="submit" class="btn btn-primary shadow-sm">Import</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
          <!-- end IMPORT DATA-->

        <!-- UBAH DATA -->
        <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" >
                <form action="<?php echo base_url('Item/editItemCon')?>" method="POST" enctype="multipart/form-data">
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
                                <form role="form" action="<?php echo site_url('Item/editItemCon')?>" method="post" autocomplete="off" enctype="multipart/form-data">
                                  <div class="form-group row align-items-center">
                                        <label class="col-sm-4 col-form-label text-label">Item Code<span style="color: red">*</span></label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                 <input type="text" id="itemCodeU" name="itemCodeU" class="form-control form-control-user" readonly required></input>
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-4 col-form-label text-label">Item Name<span style="color: red">*</span></label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                 <input type="text" id="itemNameU" name="itemNameU" class="form-control form-control-user" required></input>
                                            </div> 
                                        </div>
                                    </div>   

                                    <div class="form-group row align-items-center">
                                      <label class="col-sm-4 col-form-label text-label">Jumlah Item<span style="color: red">*</span></label>
                                      <div class="col-sm-8">
                                          <div class="input-group">
                                               <input type="number" id="jumlahItemU" name="jumlahItemU" class="form-control form-control-user" placeholder="Masukkan Hanya Angka" required></input>
                                          </div> 
                                      </div>
                                    </div> 

                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-4 col-form-label text-label">Net Quantity<span style="color: red">*</span></label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                 <input type="number" id="netQuantityU" name="netQuantityU" class="form-control form-control-user" placeholder="Masukkan Hanya Angka" required></input>
                                            </div> 
                                        </div>
                                    </div>   

                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-4 col-form-label text-label">Status<span style="color: red">*</span></label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                              <select name="statusU" id="statusU" class="form-control form-control-user" style="width: 180px;">
                                                <option value='1'>Aktif</option>
                                                <option value='0'>Tidak Aktif</option>
                                              </select>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group row align-items-center" hidden="true">
                                      <label class="col-sm-4 col-form-label text-label">Jumlah Sebelum<span style="color: red">*</span></label>
                                      <div class="col-sm-8">
                                          <div class="input-group">
                                               <input type="number" id="jumlahSebelum" name="jumlahSebelum" class="form-control form-control-user" placeholder="Masukkan Hanya Angka" required></input>
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
                      <div class="modal-body" style="width: 400px;">
                                  <div class="form-group row align-items-center">
                                      <label class="col-sm-4 col-form-label text-label">Item Code<span style="color: red">*</span></label>
                                      <div class="col-sm-8">
                                          <div class="input-group">
                                               <input type="text" id="itemCodeD" name="itemCodeD" class="form-control form-control-user" disabled required></input>
                                          </div> 
                                      </div>
                                  </div>

                                  <div class="form-group row align-items-center">
                                      <label class="col-sm-4 col-form-label text-label">Item Name<span style="color: red">*</span></label>
                                      <div class="col-sm-8">
                                          <div class="input-group">
                                               <input type="text" id="itemNameD" name="itemNameD" class="form-control form-control-user" disabled required></input>
                                          </div> 
                                      </div>
                                  </div>   

                                  <div class="form-group row align-items-center">
                                      <label class="col-sm-4 col-form-label text-label">Jumlah Item<span style="color: red">*</span></label>
                                      <div class="col-sm-8">
                                          <div class="input-group">
                                               <input type="number" id="jumlahItemD" name="jumlahItemD" class="form-control form-control-user" disabled required></input>
                                          </div> 
                                      </div>
                                    </div> 

                                  <div class="form-group row align-items-center">
                                      <label class="col-sm-4 col-form-label text-label">Net Quantity<span style="color: red">*</span></label>
                                      <div class="col-sm-8">
                                          <div class="input-group">
                                               <input type="number" id="netQuantityD" name="netQuantityD" class="form-control form-control-user" disabled required></input>
                                          </div> 
                                      </div>
                                  </div>   

                                  <div class="form-group row align-items-center">
                                      <label class="col-sm-4 col-form-label text-label">Status<span style="color: red">*</span></label>
                                      <div class="col-sm-8">
                                          <div class="input-group">
                                          <select disabled name="statusD" id="statusD" class="form-control form-control-user" style="width: 180px;">
                                            <option value='1'>Aktif</option>
                                            <option value='0'>Tidak Aktif</option>
                                          </select>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group row align-items-center">
                                      <label class="col-sm-4 col-form-label text-label">Tanggal dibuat</label>
                                      <div class="col-sm-8">
                                          <div class="input-group">
                                               <input type="text" id="creadateD" name="creadateD" class="form-control form-control-user" disabled required></input>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group row align-items-center">
                                      <label class="col-sm-4 col-form-label text-label">Tanggal diubah</label>
                                      <div class="col-sm-8">
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

        <!-- IMPORT DATA -->
        <div class="modal fade" id="importData" tabindex="-1" role="dialog" aria-labelledby="importData" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" >
                <form action="<?php echo base_url('Item/saveItemCon')?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" style="width: 400px;">
                              <form role="form" action="<?php echo site_url('Item/saveItemCon')?>" method="post" autocomplete="off">
                                  <div class="form-group row align-items-center">
                                      <label class="col-sm-4 col-form-label text-label">Item Code<span style="color: red">*</span></label>
                                      <div class="col-sm-8">
                                          <div class="input-group">
                                               <input type="text" id="itemCode" name="itemCode" class="form-control form-control-user" required></input>
                                          </div> 
                                      </div>
                                  </div>

                                  <div class="form-group row align-items-center">
                                      <label class="col-sm-4 col-form-label text-label">Item Name<span style="color: red">*</span></label>
                                      <div class="col-sm-8">
                                          <div class="input-group">
                                               <input type="text" id="itemName" name="itemName" class="form-control form-control-user" required></input>
                                          </div> 
                                      </div>
                                  </div>   
                                  <div class="form-group row align-items-center">
                                      <label class="col-sm-4 col-form-label text-label">Jumlah Item<span style="color: red">*</span></label>
                                      <div class="col-sm-8">
                                          <div class="input-group">
                                               <input type="number" id="jumlahItem" name="jumlahItem" class="form-control form-control-user" placeholder="Masukkan Hanya Angka" required></input>
                                          </div> 
                                      </div>
                                    </div>  
                                  <div class="form-group row align-items-center">
                                      <label class="col-sm-4 col-form-label text-label">Net Quantity<span style="color: red">*</span></label>
                                      <div class="col-sm-8">
                                          <div class="input-group">
                                               <input type="number" id="netQuantity" name="netQuantity" class="form-control form-control-user" placeholder="Masukkan Hanya Angka" required></input>
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
        <!-- end IMPORT DATA-->

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

                $('#itemCodeU').val(data[0]);
                $('#itemNameU').val(data[1]);
                $('#jumlahItemU').val(data[2]);
                $('#netQuantityU').val(data[3]);
                $('#statusU').val(data[5]); 
                $('#jumlahSebelum').val(data[2]);           
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

                $('#itemCodeD').val(data[0]);
                $('#itemNameD').val(data[1]);
                $('#jumlahItemD').val(data[2]);
                $('#netQuantityD').val(data[3]);
                $('#statusD').val(data[5]);       
                $('#creadateD').val(data[7]); 
                $('#modidateD').val(data[9]); 
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

        document.getElementById('file').addEventListener('change', function(event) {
            const allowedExtensions = ['xlsx', 'xls'];
            const fileInput = event.target;
            const fileName = fileInput.value.split('.').pop().toLowerCase();

            if (!allowedExtensions.includes(fileName)) {
                Swal.fire({
                    title: 'File tidak valid',
                    text: 'File yang diunggah harus dalam format .xlsx atau .xls.',
                    icon: 'warning'
                });

                fileInput.value = ''; 
            }
        });

        document.getElementById('importForm').addEventListener('submit', function(event) {
            const fileInput = document.getElementById('file');
            const allowedExtensions = ['xlsx', 'xls'];
            const fileName = fileInput.value.split('.').pop().toLowerCase();

            if (fileInput.value === '' || !allowedExtensions.includes(fileName)) {
                event.preventDefault();
                Swal.fire({
                    title: 'File tidak valid',
                    text: 'Silakan pilih file dengan format .xlsx atau .xls.',
                    icon: 'warning'
                });
            }
        });

        function closeAlert(alertId) {
            const alertElement = document.getElementById(alertId);
            if (alertElement) {
                alertElement.style.display = 'none';
            }
        }
    </script>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- END SCRIPT -->

<?php
$script = ob_get_clean();

if ($this->session->userdata('role') == 0) {
    include('master_page.php');
} elseif ($this->session->userdata('role') == 2) {
    include('master_page_dandori.php');
} else {
    redirect(site_url('Login'));
}

ob_flush();
?>