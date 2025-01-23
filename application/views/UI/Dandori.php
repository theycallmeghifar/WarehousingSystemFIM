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

		<!-- Alert Danger -->
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
					<?php if ($this->session->userdata('role') == 2) { ?>
						<h1 class="m-0">Dashboard</h1>
					<?php } ?>
					<?php if ($this->session->userdata('role') == 3) { ?>
						<h1 class="m-0">Transaksi</h1>
					<?php } ?>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item active">Menu</a></li>
						<?php if ($this->session->userdata('role') == 2) { ?>
							<li class="breadcrumb-item active">Dashboard</li>
						<?php } ?>
						<?php if ($this->session->userdata('role') == 3) { ?>
							<li class="breadcrumb-item active">Transaksi</li>
						<?php } ?>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
    <!-- /.content-header -->
		
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- END HEADER -->

<!-- Main content -->
	<section class="content">
    	<div class="container-fluid">
    		<div class="col-lg-18">
				<?php if ($this->session->userdata('role') == 2) { ?>
				<div class="card bg-gradient">
					<div class="card-header border-0">
						<h3 class="card-title">
							<i class="nav-icon fas fa-box"></i>
							Master Barang
						</h3>
					</div>
					<div class="card-body d-flex">
						<div class="col-lg-3">
							<div class="small-box bg-secondary">
								<div class="inner">
									<?php $i = 0; ?>
									<?php foreach ($item as $d) { ?>
										<?php $i++; ?>
									<?php } ?>
									<h3><?php echo $i; ?></h3>
									<p>Total Item</p>
								</div>
								<div class="icon">
									<i class="nav-icon fas fa-cube"></i>
								</div>
								<a href="<?php echo site_url('Item') ?>" class="small-box-footer">Lihat Item <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="small-box bg-info">
								<div class="inner">
									<?php $i = 0; ?>
									<?php foreach ($lokasi as $d) { ?>
										<?php $i++; ?>
									<?php } ?>
									<h3><?php echo $i; ?></h3>
									<p>Total Lokasi</p>
								</div>
								<div class="icon">
									<i class="nav-icon fas fa-map"></i>
								</div>
								<a href="<?php echo site_url('Lokasi') ?>" class="small-box-footer">Lihat Lokasi <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			
				<div class="card bg-gradient">
					<div class="card-header border-0">
						<h3 class="card-title">
							<i class="nav-icon fas fa-book"></i>
							Transaksi
						</h3>
					</div>
					<div class="card-body d-flex">
					<div class="col-lg-3">
							<div class="small-box bg-primary">
								<div class="inner">
									<h3>Item Masuk</h3>
									<br/>
								</div>
								<div class="icon">
									<i class="nav-icon fas fa-arrow-down"></i>
								</div>
								<a type="button" class="small-box-footer" data-toggle="modal" data-target="#inputItemMasuk">Input Item Masuk <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="small-box bg-warning">
								<div class="inner" style="color:white">
									<h3>Item Keluar</h3>
									<br/>
								</div>
								<div class="icon">
									<i class="nav-icon fas fa-arrow-up"></i>
								</div>
								<p style="color:white;" class="small-box-footer" data-toggle="modal" data-target="#inputItemKeluar">
									<a type="button" style="color:white">Input Item Keluar <i class="fas fa-arrow-circle-right" style="color:white"></i></a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- INPUT ITEM KELUAR -->
			<div class="modal fade" id="inputItemKeluar" tabindex="-1" role="dialog" aria-labelledby="inputItemKeluar" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
					<form action="<?php echo base_url('Dandori/itemKeluarCon')?>" method="POST" enctype="multipart/form-data">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Input Item Keluar</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body" style="width: 400px;">
								<div class="form-group">
									<table id="ItemTable" class="table">
										<thead>
											<tr>
												<th>Item Code<span style="color: red">*</span></th>
												<th>Jumlah<span style="color: red">*</span></th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><input type="text" name="itemCode[]" class="form-control" required></td>
												<td><input type="number" name="qty[]" class="form-control" required min="1"></td>
												<td><button type="button" class="btn btn-danger btn-sm removeRow"><i class="fas fa-trash" style="color:white"></i></button></td>
											</tr>
										</tbody>
									</table>
									<button type="button" class="btn btn-primary" id="addRow">Tambah Baris</button>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<button id="submit" name="submit" class="btn btn-primary shadow-sm">Simpan</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- end INPUT ITEM KELUAR-->

			<!-- INPUT ITEM MASUK -->
			<div class="modal fade" id="inputItemMasuk" tabindex="-1" role="dialog" aria-labelledby="inputItemMasuk" aria-hidden="true">
          		<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            		<form action="<?php echo base_url('Dandori/itemMasukCon')?>" method="POST" enctype="multipart/form-data">
              			<div class="modal-content">
                			<div class="modal-header">
                  				<h5 class="modal-title">Input Item Masuk</h5>
                  				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    				<span aria-hidden="true">&times;</span>
                  				</button>
                			</div>
                			<div class="modal-body" style="width: 400px;">
                  				<div class="form-group">
                    				<table id="itemTable" class="table">
                      					<thead>
                        					<tr>
                          						<th>Item Code<span style="color: red">*</span></th>
                          						<th>Jumlah<span style="color: red">*</span></th>
                          						<th>Aksi</th>
                        					</tr>
                      					</thead>
                      					<tbody>
                        					<tr>
                          						<td><input type="text" name="itemCode[]" class="form-control" required></td>
                          						<td><input type="number" name="qty[]" class="form-control" required min="1"></td>
                          						<td><button type="button" class="btn btn-danger btn-sm removeRow"><i class="fas fa-trash" style="color:white"></i></button></td>
                        					</tr>
                      					</tbody>
                    				</table>
                    				<button type="button" class="btn btn-primary" id="addRow">Tambah Baris</button>
								</div>
                  			</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<button id="submit" name="submit" class="btn btn-primary shadow-sm">Simpan</button>
							</div>
						</div>
            		</form>
          		</div>
        	</div>
        	<!-- end INPUT ITEM MASUK-->

    	</div><!-- /.container-fluid -->
    </section>
<!-- /.content -->
</div>

<!-- jQuery -->
<script src="<?php echo base_url() ?>assets/adminlte3.2/plugins/jquery/jquery.min.js"></script>

<!-- Script Tambahan -->
<script>
    $(document).ready(function () {
        // Fokus pada input pertama saat modal dibuka
        $('.modal').on('shown.bs.modal', function () {
            $(this).find('input[name="itemCode[]"]').first().focus();
        });

        // Tambah baris baru
        $(document).on('click', '#addRow', function () {
            const activeModal = $(this).closest('.modal'); // Cari modal aktif
            const tableBody = activeModal.find('table tbody'); // Cari tbody di dalam modal aktif
            const newRow = `
                <tr>
                    <td><input type="text" name="itemCode[]" class="form-control" required></td>
                    <td><input type="number" name="qty[]" class="form-control" required min="1"></td>
                    <td><button type="button" class="btn btn-danger btn-sm removeRow"><i class="fas fa-trash" style="color:white"></i></button></td>
                </tr>
            `;
            tableBody.append(newRow);
        });

        // Hapus baris
        $(document).on('click', '.removeRow', function () {
            $(this).closest('tr').remove();
        });

        // Proses input itemCode
        $(document).on('input keypress', 'input[name="itemCode[]"]', function (e) {
            const inputField = $(this);
            const currentRow = inputField.closest('tr');
            let typingTimer;
            const TYPING_DELAY = 50;

            // Jika tombol Enter ditekan
            if (e.type === 'keypress' && e.which === 13) {
                processInput(inputField, currentRow);
                e.preventDefault();
                return;
            }

            // Deteksi input cepat dari scanner
            clearTimeout(typingTimer);
            typingTimer = setTimeout(function () {
                if (inputField.val().length > 0) {
                    processInput(inputField, currentRow);
                }
            }, TYPING_DELAY);
        });

        // Fungsi untuk memproses input itemCode
        function processInput(inputField, currentRow) {
			const audio = new Audio('assets/other/audio/wrong_buzzer.mp3');
            const currentItemCode = inputField.val();
            const activeModal = inputField.closest('.modal'); // Modal aktif
            const tableBody = activeModal.find('table tbody'); // Tbody di dalam modal aktif

            // Pengecekan ke database menggunakan AJAX
            $.ajax({
                url: '<?= base_url() ?>/Dandori/checkItemCode', // Endpoint sesuai
                method: 'POST',
                data: { itemCode: currentItemCode },
                success: function (response) {
                    try {
                        const data = JSON.parse(response);
                        if (data.exists) {
                            let isDuplicate = false;

                            // Cek duplikasi di semua baris dalam modal aktif
                            tableBody.find('tr').each(function () {
                                const row = $(this);
                                if (row[0] !== currentRow[0]) {
                                    const itemCode = row.find('input[name="itemCode[]"]').val();
                                    if (itemCode === currentItemCode) {
                                        const qtyInput = row.find('input[name="qty[]"]');
                                        const qty = parseInt(qtyInput.val()) || 0;
                                        qtyInput.val(qty + 1);
                                        inputField.val('').focus();
                                        isDuplicate = true;
                                        return false;
                                    }
                                }
                            });

                            if (!isDuplicate) {
                                currentRow.find('input[name="qty[]"]').val(1);
                                const newRow = `
                                    <tr>
                                        <td><input type="text" name="itemCode[]" class="form-control" required></td>
                                        <td><input type="number" name="qty[]" class="form-control" required min="1"></td>
                                        <td><button type="button" class="btn btn-danger btn-sm removeRow"><i class="fas fa-trash" style="color:white"></i></button></td>
                                    </tr>
                                `;
                                tableBody.append(newRow);
                                currentRow.next().find('input[name="itemCode[]"]').focus();
                            }
                        } else {
							audio.play();
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'ItemCode tidak ditemukan atau tidak aktif di database!',
                                confirmButtonText: 'OK',
                            }).then(() => {
                                inputField.val('').focus();
                            });
                        }
                    } catch (e) {
						audio.play();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Kesalahan dalam response server.',
                            confirmButtonText: 'OK',
                        });
                    }
                },
                error: function () {
					audio.play();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Kesalahan saat memeriksa ItemCode.',
                        confirmButtonText: 'OK',
                    });
                    inputField.val('').focus();
                },
            });
        }

        // Reset modal saat ditutup
        $('.modal').on('hidden.bs.modal', function () {
            const tableBody = $(this).find('table tbody');
            tableBody.html(`
                <tr>
                    <td><input type="text" name="itemCode[]" class="form-control" required></td>
                    <td><input type="number" name="qty[]" class="form-control" required min="1"></td>
                    <td><button type="button" class="btn btn-danger btn-sm removeRow"><i class="fas fa-trash" style="color:white"></i></button></td>
                </tr>
            `);
        });
    });

    function closeAlert(alertId) {
      const alertElement = document.getElementById(alertId);
      if (alertElement) {
          alertElement.style.display = 'none';
      }
    }
</script>

<?php
	$data = ob_get_clean();
	$script = ob_get_clean();
	
	if ($this->session->userdata('role') == 2) {
		include('master_page_dandori.php');
	} elseif ($this->session->userdata('role') == 3) {
		include('master_page_operator.php');
	} else {
		redirect(site_url('Login'));
	}

	ob_flush();
?>