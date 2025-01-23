<!DOCTYPE html>
<html lang="en">

  <?php
    $activePage = basename($_SERVER['PHP_SELF'], ".php");
  ?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FIM Warehousing</title>

  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3.2/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3.2/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3.2/plugins/fontawesome/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3.2/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3.2/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3.2/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3.2/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3.2/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3.2/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3.2/plugins/summernote/summernote-bs4.min.css">

  <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url() ?>assets/adminlte3.2/dist/img/FIM_Logo.png">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3.2/dist/js/jquery-ui.css">

  <style type="text/css">
    .modal {
      text-align: center;
      padding: 0!important;
    }

    .hiddenField{
      display: none;
    }

    .modal:before {
      content: '';
      display: inline-block;
      height: 100%;
      vertical-align: middle;
      margin-right: -4px;
    }

    .modal-dialog {
      display: inline-block;
      text-align: left;
      vertical-align: middle;
    }
  </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo base_url() ?>assets/adminlte3.2/dist/img/FIM_Logo.png" alt="FIM Logo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a class="nav-link">Administrator</a>
          </li>
      </ul>


      <ul class="navbar-nav ml-auto">
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('Login') ?>" role="button">
                  <i class="fas fa-sign-out-alt"> Logout</i>
              </a>
          </li>
      </ul>
  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo site_url('Dashboard'); ?>" class="brand-link">
      <img src="<?php echo base_url() ?>assets/adminlte3.2/dist/img/FIM_Logo.png" alt="FIM Logo" class="brand-image" style="opacity: 1.0">
      <span class="brand-text font-weight-light">Warehousing</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">MENU</li>
          <li class="nav-item">
            <a href="<?php echo site_url('Dashboard'); ?>" class="nav-link <?= ($activePage == 'Dashboard') ? 'active':''; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>

          <li class="nav-item
            <?= ($activePage == 'Penyimpanan') ? 'menu-open':''; ?> 
            <?= ($activePage == 'Lemari') ? 'menu-open':''; ?> 
            <?= ($activePage == 'Rak') ? 'menu-open':''; ?> 
            <?= ($activePage == 'Palet') ? 'menu-open':''; ?>
            <?= ($activePage == 'Barang') ? 'menu-open':''; ?>">

            <a href="#" class="nav-link 
            <?= ($activePage == 'Penyimpanan') ? 'active':''; ?> 
            <?= ($activePage == 'Lemari') ? 'active':''; ?> 
            <?= ($activePage == 'Rak') ? 'active':''; ?> 
            <?= ($activePage == 'Palet') ? 'active':''; ?>
            <?= ($activePage == 'Barang') ? 'active':''; ?>">

              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Penyimpanan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('Lemari'); ?>" class="nav-link <?= ($activePage == 'Lemari') ? 'active':''; ?>">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Lemari
                    <span class="badge badge-info right"></span>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Rak'); ?>" class="nav-link <?= ($activePage == 'Rak') ? 'active':''; ?>">
                  <i class="nav-icon fas fa-columns"></i>
                  <p>
                    Rak
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Palet'); ?>" class="nav-link <?= ($activePage == 'Palet') ? 'active':''; ?>">
                  <i class="nav-icon fas fa-archive"></i>
                  <p>
                    Palet
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Barang'); ?>" class="nav-link <?= ($activePage == 'Barang') ? 'active':''; ?>">
                  <i class="nav-icon fas fa-cube"></i>
                  <p>
                    Barang
                  </p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item
            <?= ($activePage == 'MainItem') ? 'menu-open':''; ?> 
            <?= ($activePage == 'Item') ? 'menu-open':''; ?>">

            <a href="#" class="nav-link
            <?= ($activePage == 'MainItem') ? 'active':''; ?> 
            <?= ($activePage == 'Item') ? 'active':''; ?>">

              <i class="nav-icon fas fa-box"></i>
              <p>
                Master Barang
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('MainItem'); ?>" class="nav-link <?= ($activePage == 'MainItem') ? 'active':''; ?>">
                  <!-- <img src="<?php echo base_url() ?>assets/adminlte3.2/dist/img/<?= ($activePage == 'MainItem') ? 'piston-black.png':'piston.png'; ?>" class="brand-image" style="opacity: 1.0;height: 20px; margin-left: 4px;"> -->
                  <i class="nav-icon fas fa-pager"></i>
                  <p style="margin-left: 5px">
                    Main Item
                    <span class="badge badge-info right"></span>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Item'); ?>" class="nav-link <?= ($activePage == 'Item') ? 'active':''; ?>">
                  <i class="nav-icon fas fa-grip-horizontal"></i>
                  <p style="margin-left: 5px">
                    Item
                  </p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item
              <?= ($activePage == 'HistoryBarang') ? 'menu-open':'';?>
              <?= ($activePage == 'ItemHistory') ? 'menu-open':'';?>
              <?= ($activePage == 'CetakExcel') ? 'menu-open':'';?>
              <?= ($activePage == 'ExportExcelMasukCon') ? 'menu-open':'';?>
              <?= ($activePage == 'ExportExcelKeluarCon') ? 'menu-open':'';?>
              <?= ($activePage == 'CetakBarangMasuk') ? 'menu-open':'';?>
              <?= ($activePage == 'CetakBarangKeluar') ? 'menu-open':'';?>
            ">

            <a href="#" class="nav-link
                <?= ($activePage == 'HistoryBarang') ? 'active':''; ?>
                <?= ($activePage == 'ItemHistory') ? 'active':'';?>
                <?= ($activePage == 'CetakExcel') ? 'active':'';?>
                <?= ($activePage == 'ExportExcelMasukCon') ? 'active':'';?>
                <?= ($activePage == 'ExportExcelKeluarCon') ? 'active':'';?>
                <?= ($activePage == 'CetakBarangMasuk') ? 'active':''; ?>  
                <?= ($activePage == 'CetakBarangKeluar') ? 'active':'';?>
              ">

              <i class="nav-icon fas fa-book"></i>
              <p>
                Transaksi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo site_url('HistoryBarang'); ?>" class="nav-link <?= ($activePage == 'HistoryBarang') ? 'active':''; ?>">
                    <i class="nav-icon fas fa-laptop"></i>
                    <p>
                      Riwayat Barang
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="<?php echo site_url('ItemHistory'); ?>" class="nav-link <?= ($activePage == 'ItemHistory') ? 'active':''; ?>">
                    <i class="nav-icon fas fa-pen"></i>
                    <p>
                      Riwayat Item
                    </p>
                  </a>
                </li>

                <li class="nav-item
                      <?= ($activePage == 'CetakBarangMasuk') ? 'menu-open':'';?>
                      <?= ($activePage == 'CetakBarangKeluar') ? 'menu-open':'';?>
                      <?= ($activePage == 'ExportExcelMasukCon') ? 'menu-open':'';?>
                      <?= ($activePage == 'ExportExcelKeluarCon') ? 'menu-open':'';?>
                ">

                    <a href="#" class="nav-link
                      <?= ($activePage == 'CetakBarangMasuk') ? 'active':'';?>
                      <?= ($activePage == 'CetakBarangKeluar') ? 'active':'';?>
                      <?= ($activePage == 'ExportExcelMasukCon') ? 'active':'';?>
                      <?= ($activePage == 'ExportExcelKeluarCon') ? 'active':'';?>
                    ">
                      <i class="nav-icon fas fa-print"></i>
                        <p>
                          Cetak Excel
                          <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?php echo site_url('CetakBarangMasuk'); ?>" class="nav-link 
                          <?= ($activePage == 'CetakBarangMasuk') ? 'active':''; ?>
                          <?= ($activePage == 'ExportExcelMasukCon') ? 'active':'';?>
                        ">
                          <i class="nav-icon fas fa-arrow-down"></i>
                          <p>
                            Barang Masuk
                          </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url('CetakBarangKeluar'); ?>" class="nav-link 
                          <?= ($activePage == 'CetakBarangKeluar') ? 'active':''; ?>
                          <?= ($activePage == 'ExportExcelKeluarCon') ? 'active':'';?>
                        ">
                          <i class="nav-icon fas fa-arrow-up"></i>
                          <p>
                            Barang Keluar
                          </p>
                        </a>
                    </li>
                  </ul>

                </li>
              </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>




  <?php echo $data;?>


  <!-- /.content-wrapper -->
  <footer class="main-footer">
    ‎
    
    <div class="float-right d-none d-sm-inline-block">
      Designed By <a target="_blank" href="https://www.polman.astra.ac.id/"> Politeknik Astra</a> MI 19
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url() ?>assets/adminlte3.2/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url() ?>assets/adminlte3.2/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>assets/adminlte3.2/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url() ?>assets/adminlte3.2/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url() ?>assets/adminlte3.2/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url() ?>assets/adminlte3.2/plugins/jqvmap/jquery.vmap.min.js"></script>

<script src="<?php echo base_url() ?>assets/adminlte3.2/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url() ?>assets/adminlte3.2/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url() ?>assets/adminlte3.2/plugins/moment/moment.min.js"></script>

<script src="<?php echo base_url() ?>assets/adminlte3.2/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url() ?>assets/adminlte3.2/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url() ?>assets/adminlte3.2/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url() ?>assets/adminlte3.2/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/adminlte3.2/dist/js/adminlte.js"></script>

<script src="<?php echo base_url() ?>assets/adminlte3.2/dist/js/pages/dashboard.js"></script> 

<script src="<?php echo base_url() ?>assets/adminlte3.2/plugins/datatables-bs4/js/jquery.dataTables.min.js"></script> 

<script src="<?php echo base_url() ?>assets/adminlte3.2/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script> 

<script src="<?php echo base_url() ?>assets/adminlte3.2/plugins/fontawesome/js/fontawesome.js"></script> 
<script src="<?php echo base_url('assets/sweetalert/sweetalert2.all.min.js') ?>"></script>
<script src="<?php echo base_url() ?>assets/adminlte3.2/dist/js/jquery.min"></script>
<script src="<?php echo base_url() ?>assets/adminlte3.2/dist/js/jquery-ui.min"></script>

<?php echo $script;?>

<script type="text/javascript">
  $(document).ready( function () {
    $('#dataTable').DataTable();
  } );
</script>

</body>
</html>