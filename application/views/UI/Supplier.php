<?php ob_start();?>


<!-- HEADER -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Item</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Menu Supplier</a></li>
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

        <div class="col-lg-8">
         <div class="card">

           <div class="card-header border-0">
             <div class="d-flex justify-content-between">
               <!-- <h3 class="card-title">Daftar Lemari</h3> -->
             </div>
                <form id="formPrint" target="_blank" method="post" role="form" action="<?php echo site_url('Supplier/printQRCodeSupplierCon') ?>">
                    <input hidden="true" id="txtPrint" name="listPrint" />
                    <button class="btn btn-success pull-left" style="margin-top: 10px; margin-right: 5px;" id="btnPrint" type="button" class="btn btn-info pull-left">
                        <i style="margin-right: 8px;" class="fas fa-print"></i>
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

           <div class="card-body">
                  <table id="dataTable" class="display nowrap table-striped table" style="width:100%" >
                      <thead>
                          <tr>
                              <th>Item Code</th>
                              <th>Item Name</th>
                              <th hidden="true">Net Quantity</th>
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
                            <td><?php echo $data->itemCode?></td>
                            <td><?php echo $data->itemName?></td>
                            <td hidden="true"><?php echo $data->netQuantity?></td>                        
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
                                <a href="javascript:void(0);" class="fa fa-tasks color-muted detailbtn" title="Detail Data" style="margin-left: 15px;"></a>
                                <a href="<?php echo base_url('Supplier/plusbtn/'. $data->itemCode); ?>" class="fa fa-plus color-muted plusbtn" style="margin-left: 15px;" title="Tambah ke keranjang"></a>
                            </td>
                          </tr>
                          <?php } ?>
                      </tbody>
                  </table>
           </div>

           <br/><br/><br/>

         </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header border-0">Keranjang Item
                    <div class="card-body">
                    <form id="formPrintx" target="_blank" method="post" role="form" action="<?php echo site_url('Supplier/printQRCodeSupplierCart') ?>">
                        <input hidden="true" id="txtPrintx" name="listPrintx" />
                        <button style="margin-bottom: 15px; width: 200px;" id="btnPrintx" type="button" class="btn btn-success pull-left">
                            <i style="margin-right: 8px;" class="fas fa-print"></i>    
                            Print Item Keranjang
                        </button>
                    </form>
                    <form id="formPrintClear" method="post" role="form" action="<?php echo site_url('Supplier/resetbtn') ?>">
                        <input hidden="true" id="txtPrintClear" name="listPrintClear" />
                        <button style="margin-bottom: 15px; width: 200px" id="btnClear" type="button" class="btn btn-danger pull-left">
                            <i style="margin-right: 8px;" class="fas fa-trash"></i>    
                            Kosongkan Keranjang
                        </button>
                    </form>
                        <div class="">
                            <table class="table table-hover" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="">
                                        <th>Item Code</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($getDataCart as $data){
                                    ?>
                                    <tr>                             
                                        <td><?php echo $data->itemCode?></td>                                        
                                        <td>
                                            <input hidden="true" checked="checked" class='form-check-input' type='checkbox' id='checkPrint' value='<?php echo $data->itemCode?>'/>
                                            <a href="<?php echo base_url('Supplier/minusbtn/'. $data->itemCode); ?>" class="fa fa-minus color-muted minusbtn" style="margin-left: 15px;" title="Hapus dari keranjang"></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>


                    </div>
                </div>              
            </div>
        </div>


<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- END TABLE -->


<!-- MODAL -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

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
                                      <label class="col-sm-3 col-form-label text-label">Item Code</label>
                                      <div class="col-sm-9">
                                          <div class="input-group">
                                               <input type="text" id="itemCodeD" name="itemCodeD" class="form-control form-control-user" disabled required></input>
                                          </div> 
                                      </div>
                                  </div>

                                  <div class="form-group row align-items-center">
                                      <label class="col-sm-3 col-form-label text-label">Item Name</label>
                                      <div class="col-sm-9">
                                          <div class="input-group">
                                               <input type="text" id="itemNameD" name="itemNameD" class="form-control form-control-user" disabled required></input>
                                          </div> 
                                      </div>
                                  </div>   

                                  <!-- <div class="form-group row align-items-center">
                                      <label class="col-sm-3 col-form-label text-label">Jumlah Item</label>
                                      <div class="col-sm-9">
                                          <div class="input-group">
                                               <input type="number" id="jumlahItemD" name="jumlahItemD" class="form-control form-control-user" disabled required></input>
                                          </div> 
                                      </div>
                                    </div>  -->

                                  <div class="form-group row align-items-center">
                                      <label class="col-sm-3 col-form-label text-label">Net Quantity</label>
                                      <div class="col-sm-9">
                                          <div class="input-group">
                                               <input type="number" id="netQuantityD" name="netQuantityD" class="form-control form-control-user" disabled required></input>
                                          </div> 
                                      </div>
                                  </div>   

                                  <div class="form-group row align-items-center">
                                      <label class="col-sm-3 col-form-label text-label">Status</label>
                                      <div class="col-sm-9">
                                          <div class="input-group">
                                          <select disabled name="statusD" id="statusD" class="form-control form-control-user" style="width: 180px;">
                                            <option value='1'>Aktif</option>
                                            <option value='0'>Tidak Aktif</option>
                                          </select>
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
            $('.detailbtn').on('click', function(){
                $('#detailData').modal('show');
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();
                console.log(data);

                $('#itemCodeD').val(data[0]);
                $('#itemNameD').val(data[1]);
                $('#netQuantityD').val(data[2]);
                $('#statusD').val(data[4]);       
                $('#creadateD').val(data[6]); 
                $('#modidateD').val(data[8]); 
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

        $('#btnPrintx').on("click", function(e) {
            var count = 0;
            var listPrintx = [];
            var print = "";
            $('input[type="checkbox"]:checked').each(function() {
                if ($(this).prop('checked', true)) {
                    listPrintx.push($(this).val());
                    if ($(this).val() != 0) {
                        count++;
                        print += $(this).val() + "|";
                    }
                }
            });
            if (listPrintx.length > 0) {
                if (count > 100) {
                    Swal.fire({
                        title: 'Print QR Code tidak bisa dilakukan',
                        text: 'Maksimal memilih 100 data untuk melakukan print',
                        icon: 'warning'
                    });
                } else {
                txtPrintx.value = print;
                $("#formPrintx").submit();
                }
            } else {
                Swal.fire({
                    title: 'Pilih data terlebih dahulu',
                    text: '',
                    icon: 'warning'
                });
            }
        });

        $('#btnClear').on("click", function(e) {
            var count = 0;
            var listPrintClear = [];
            var print = "";
            $('input[type="checkbox"]:checked').each(function() {
                if ($(this).prop('checked', true)) {
                    listPrintClear.push($(this).val());
                    if ($(this).val() != 0) {
                        count++;
                        print += $(this).val() + "|";
                    }
                }
            });
            txtPrintClear.value = print;
            $("#formPrintClear").submit();
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
include('master_page_supplier.php');
ob_flush();
?>