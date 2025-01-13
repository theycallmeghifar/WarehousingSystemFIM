<?php ob_start();?>


<!-- HEADER -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Riwayat Item</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Menu</a></li>
              <li class="breadcrumb-item active">Transaksi</li>
              <li class="breadcrumb-item active">Riwayat Item</li>
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
      	   <div class="card-body">
                  <table id="dataTable" data-order='[[5, "desc"]]' class="display nowrap table-striped table" style="width:100%" >
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Item Code</th>
                              <th>Jumlah Sebelum</th>
                              <th>Jumlah Sesudah</th>                   
                              <th>Dibuat Oleh</th>
                              <th>Tanggal Dibuat</th>

                              <th hidden="true">Item Int</th>
                         </tr>
                      </thead>
                      <tbody>
                        <?php
                            foreach($getData as $data){
                        ?>
                        <tr>                             
                            <td><?php echo $data->id?></td>
                            <td><?php foreach ($item as $row) {
                                    if ($data->itemCode == $row->itemCode) {
                                    echo $row->itemCode;
                                    }
                            }
                            if ($data->itemCode == "" ){
                              echo "-";
                            }
                            ?></td>  
                            <td><?php echo $data->jumlahSebelum?></td>
                            <td><?php echo $data->jumlahSesudah?></td>
                            <td><?php echo $data->createdBy?></td>
                            <td><?php echo $data->createdDate?></td>
                            <td hidden="true"><?php 
                                if ($data->itemCode == "" ){
                                  echo "-";
                                }
                                else
                                {
                                  echo $data->itemCode;
                                }?></td>
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

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- END SCRIPT -->

<?php
$script = ob_get_clean();
include('master_page.php');
ob_flush();
?>