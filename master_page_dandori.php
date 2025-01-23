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
              <a class="nav-link">Administrator Dandori</a>
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
            <a href="<?php echo site_url('Dandori'); ?>" class="nav-link <?= ($activePage == 'Dashboard') ? 'active':''; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo site_url('Item'); ?>" class="nav-link <?= ($activePage == 'Item') ? 'active':''; ?>">
            <i class="nav-icon fas fa-box"></i>
              <p>
                Item
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo site_url('Lokasi'); ?>" class="nav-link <?= ($activePage == 'Lokasi') ? 'active':''; ?>">
            <i class="nav-icon fas fa-map"></i>
              <p>
                Lokasi
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo site_url('TransaksiDandori'); ?>" class="nav-link <?= ($activePage == 'TransaksiDandori') ? 'active':''; ?>">
            <i class="nav-icon fas fa-book"></i>
              <p>
                Histori Item
                <span class="badge badge-info right"></span>
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
                      Item Masuk
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
                      Item Keluar
                    </p>
                  </a>
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