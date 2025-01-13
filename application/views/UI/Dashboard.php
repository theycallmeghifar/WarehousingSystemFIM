<?php ob_start();?>

<!-- HEADER -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

  <div class="content-wrapper">
	<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
		<div class="col-sm-6">
			<h1 class="m-0">Dashboard</h1>
		</div><!-- /.col -->
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item active">Menu</a></li>
			<li class="breadcrumb-item active">Dashboard</li>
			</ol>
		</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
	</div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
		
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- END HEADER -->

    <div class="col-lg-18">

			<div class="card bg-gradient">
				<div class="card-header border-0">
					<h3 class="card-title">
						<i class="nav-icon fas fa-warehouse"></i>
						Penyimpanan
					</h3>
				</div>
				<div class="card-body d-flex">
					<div class="col-lg-3">
						<div class="small-box bg-primary">
							<div class="inner">
								<?php $i = 0; ?>
								<?php foreach ($dash_lemari as $d) { ?>
									<?php $i++; ?>
								<?php } ?>
								<h3><?php echo $i; ?></h3>
								<p>Total Lemari</p>
							</div>
							<div class="icon">
								<i class="nav-icon fas fa-table"></i>
							</div>
							<a href="<?php echo site_url('Lemari') ?>" class="small-box-footer">Lihat Lemari <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="small-box bg-warning">
							<div class="inner" style="color:white">
								<?php $i = 0; ?>
								<?php foreach ($dash_rak as $d) { ?>
									<?php $i++; ?>
								<?php } ?>
								<h3><?php echo $i; ?></h3>
								<p style="color:white">Total Rak</p>
							</div>
							<div class="icon">
								<i class="nav-icon fas fa-columns"></i>
							</div>
							<p style="color:white;" class="small-box-footer">
								<a href="<?php echo site_url('Rak') ?>" style="color:white">Lihat Rak<i class="fas fa-arrow-circle-right" style="color:white"></i></a>
							</p>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="small-box bg-success">
							<div class="inner">
								<?php $i = 0; ?>
								<?php foreach ($dash_palet as $d) { ?>
									<?php $i++; ?>
								<?php } ?>
								<h3><?php echo $i; ?></h3>
								<p>Total Palet</p>
							</div>
							<div class="icon">
								<i class="nav-icon fas fa-archive"></i>
							</div>
							<a href="<?php echo site_url('Palet') ?>" class="small-box-footer">Lihat Palet<i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="small-box bg-secondary">
							<div class="inner">
								<?php $i = 0; ?>
								<?php foreach ($dash_barang as $d) { ?>
									<?php $i++; ?>
								<?php } ?>
								<h3><?php echo $i; ?></h3>
								<p>Total Barang</p>
							</div>
							<div class="icon">
								<i class="nav-icon fas fa-cube"></i>
							</div>
							<a href="<?php echo site_url('Barang') ?>" class="small-box-footer">Lihat Barang<i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>	
				</div>
			</div>

			<div class="card bg-gradient">
				<div class="card-header border-0">
					<h3 class="card-title">
						<i class="nav-icon fas fa-box"></i>
						Master Barang
					</h3>
				</div>
				<div class="card-body d-flex">
					<div class="col-lg-3">
						<div class="small-box bg-info">
							<div class="inner">
								<?php $i = 0; ?>
								<?php foreach ($dash_mainitem as $d) { ?>
									<?php $i++; ?>
								<?php } ?>
								<h3><?php echo $i; ?></h3>
								<p>Total Main Item</p>
							</div>
							<div class="icon">
								<i class="nav-icon fas fa-pager"></i>
							</div>
							<a href="<?php echo site_url('MainItem') ?>" class="small-box-footer">Lihat Main Item <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="small-box bg-secondary">
							<div class="inner">
								<?php $i = 0; ?>
								<?php foreach ($dash_item as $d) { ?>
									<?php $i++; ?>
								<?php } ?>
								<h3><?php echo $i; ?></h3>
								<p>Total Item</p>
							</div>
							<div class="icon">
								<i class="nav-icon fas fa-grip-horizontal"></i>
							</div>
							<a href="<?php echo site_url('Item') ?>" class="small-box-footer">Lihat Item<i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
			</div>

	</div>		

    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php
	$data = ob_get_clean();
	$script = ob_get_clean();
	include('master_page.php');
	ob_flush();
?>