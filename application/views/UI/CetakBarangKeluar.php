<?php ob_start();?>


<!-- HEADER -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Cetak Barang Keluar</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Menu</a></li>
              <li class="breadcrumb-item active">Transaksi</li>
              <li class="breadcrumb-item active">Cetak Excel</li>
              <li class="breadcrumb-item active">Barang Keluar</li>
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
              <div style="margin-bottom: 20px;">
                  <form method='post' action="<?php echo base_url(); ?>CetakBarangKeluar/ExportExcelKeluarCon" class="d-flex justify-content-flex-start">  
                      <div class="form-group">
                        <label>Tanggal Awal</label>
                        <input type="date" name="fromDate" class="form-control"
                              value='<?php if(isset($_POST['fromDate'])) echo $_POST['fromDate']; ?>'> 	
                      </div>	

                      <div class="form-group" style="margin-left: 20px;">
                        <label>Tanggal Akhir</label>
                        <input type="date" name="endDate" class="form-control"
                              value='<?php if(isset($_POST['endDate'])) echo $_POST['endDate']; ?>'>	
                      </div>
                  
                      <div class="form-group" style="margin-left: 20px;margin-top: 32px;">
                        <input type='submit' name='btnCari' value='Filter Data' class="btn btn-primary pull-right row-sm">
                      </div>  
                    
                      <div class="form-group" style="justify-content:flex-end;margin-left: 20px;margin-top: 32px;">
                        <input type='submit' name='export' value='Cetak Data' class="btn btn-success pull-right row-sm">
                      </div>  
                      
                  </form>
              </div>

            <div style='height: 80%;' > <!-- overflow: auto;  -->
                <table id="dataTable" data-order='[[0, "desc"]]' width='100%' class="display table-striped table" style='margin-top: 20px;'>
                    <thead>
                        <tr>
                          <th>ID</th>
                          <th>Tanggal</th>
                          <th>Main Item Code</th>
                          <th>Main Item Name</th>
                          <th>Item Code</th>
                          <th>Item Name</th> 
                          <th>whFrom</th>
                          <th>whTo</th>                        
                          <th>Qty</th>
                      </tr>
                    </thead>

                  <?php
                    foreach($getData as $data){
                  ?>
                      <tr>
                        <td><?php echo $data->idHistory?></td>
                        <td><?php echo date('Y-m-d H:i:s', strtotime($data->tanggal))?></td>
                        <td><?php echo $data->mainItemCode?></td>
                        <td><?php echo $data->mainItemName?></td>      
                        <td><?php echo $data->itemCode?></td>
                        <td><?php echo $data->itemName?></td>
                        <td><?php echo $data->whFrom?></td>
                        <td><?php echo $data->whTo?></td>
                        <td><?php echo $data->qty?></td>
                      </tr>
                  <?php 
                    } 
                  ?>
                </table>
            </div>
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

<?php
    $script = ob_get_clean();
    include('master_page.php');
    ob_flush();
?>