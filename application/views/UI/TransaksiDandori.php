<?php ob_start();?>

<!-- HEADER -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

  <div class="content-wrapper">
	  <div class="content-header">
	    <div class="container-fluid">
		    <div class="row mb-2">
		      <div class="col-sm-6">
			      <h1 class="m-0">History Item</h1>
		      </div><!-- /.col -->
		      <div class="col-sm-6">
			      <ol class="breadcrumb float-sm-right">
			        <li class="breadcrumb-item active">Menu</a></li>
			        <li class="breadcrumb-item active">History Item</li>
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
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header border-0">
              <form method="post" action="<?php echo base_url(); ?>TransaksiDandori/filterHistoryItemCon" class="d-flex flex-column" style="padding-top: 10px;">
                    <div class="form-row" style="margin-bottom: 15px; margin-right: 50%;">
                      <!-- Input Tanggal Awal dan Akhir -->
                      <div class="form-row">
                        <div class="form-group col-md-5">
                          <label for="fromDate">Tanggal Awal</label>
                          <input type="date" name="fromDate" class="form-control" id="fromDate"
                            value='<?php echo isset($_POST['fromDate']) ? $_POST['fromDate'] : date("Y-m-d"); ?>'>
                        </div>
                        <div class="form-group col-md-5" style="margin-left: 20px;">
                          <label for="endDate">Tanggal Akhir</label>
                          <input type="date" name="endDate" class="form-control" id="endDate"
                            value='<?php echo isset($_POST['endDate']) ? $_POST['endDate'] : date("Y-m-d"); ?>'>
                        </div>
                      </div>

                      <!-- Radio Button Status -->
                      <div class="form-row align-items-center">
                        <label for="status" style="margin-right: 10px;">Status:</label>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="status" id="statusSelesai" value="0">
                          <label class="form-check-label" for="statusSelesai">
                            <i class="fas fa-check"></i> Selesai
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="status" id="statusBatal" value="1">
                          <label class="form-check-label" for="statusBatal">
                            <i class="fas fa-times"></i> Batal
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="status" id="statusDicetak" value="2">
                          <label class="form-check-label" for="statusDicetak">
                            <i class="fas fa-print"></i> Dicetak
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="status" id="statusSemua" value="">
                          <label class="form-check-label" for="statusSemua">
                            <i class="fas fa-tasks"></i> Semua
                          </label>
                        </div>
                      </div>

                      <!-- Tombol Filter Data -->
                      <div class="form-group" style="margin-top: 20px;">
                        <input type="submit" name="btnCari" value="Filter Data" class="btn btn-primary">
                      </div>
                    </div>
                  </form>
                </div>
              <div class="card-body">
                <table id="dataTable" class="display nowrap table-striped table" style="width:100%" >
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Item Code</th>
                      <th>Jumlah</th>
                      <th>Tanggal</th>
                      <th>Keterangan</th>
                      <th>Status</th>
                      <th hidden="true">Created Date</th>
                      <th hidden="true">Modifieded Date</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        foreach($getData as $data) {
                    ?>
                    <tr>                             
                        <td><?php echo $data->idHistory?></td>
                        <td><?php 
                          foreach ($item as $row) {
                            if ($data->itemCode == $row->itemCode) {
                              echo $row->itemName;
                            }  
                          }                               
                          if ($data->itemCode == "" ){
                            echo "-";
                          }                       
                          ?></td>
                        <td><?php
                          if($data->jumlahMasuk == 0){
                            echo $data->jumlahKeluar;
                          }
                          else{
                            echo $data->jumlahMasuk;
                        }?></td>
                        <td><?php 
                          echo date('m-d-Y', strtotime($data->tanggal))
                        ?></td>
                        <td><?php echo $data->keterangan?></td>                     
                        <td><?php 
                          if($data->status == 'Selesai'){
                            echo "Selesai";
                          }else if($data->status == 'Batal'){
                            echo "Batal";
                          }else if($data->status == 'Dicetak'){
                            echo "Dicetak";
                        }?></td>
                        <td hidden="true"><?php echo $data->createdDate?></td>
                        <td hidden="true"><?php echo $data->modifiedDate?></td>
                        <td>
                          <a href="javascript:void(0);" class="fa fa-tasks color-muted detailbtn" title="Detail"></a>
                        </td>
                      </tr>
                      <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- INPUT ITEM MASUK -->
        <div class="modal fade" id="inputItemMasuk" tabindex="-1" role="dialog" aria-labelledby="inputItemMasuk" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <form action="<?php echo base_url('TransaksiDandori/itemMasukCon')?>" method="POST" enctype="multipart/form-data">
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
                          <th>Qty<span style="color: red">*</span></th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><input type="text" name="itemCode[]" class="form-control" required></td>
                          <td><input type="number" name="qty[]" class="form-control" required></td>
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

        <!-- INPUT ITEM KELUAR -->
        <div class="modal fade" id="inputItemKeluar" tabindex="-1" role="dialog" aria-labelledby="inputItemKeluar" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <form action="<?php echo base_url('TransaksiDandori/itemKeluarCon')?>" method="POST" enctype="multipart/form-data">
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
                          <th>Qty<span style="color: red">*</span></th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><input type="text" name="itemCode[]" class="form-control" required></td>
                          <td><input type="number" name="qty[]" class="form-control" required></td>
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
                <label class="col-sm-3 col-form-label text-label">ID</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <input type="text" id="idD" name="idD" class="form-control form-control-user" disabled required></input>
                  </div> 
                </div>
              </div> 
              <div class="form-group row align-items-center">
                <label class="col-sm-3 col-form-label text-label">Item Code</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <input type="text" id="itemCodeD" name="itemCodeD" class="form-control form-control-user" style="justify-content: left;" disabled required></input>
                  </div> 
                </div>
              </div>
              <div class="form-group row align-items-center">
                <label class="col-sm-3 col-form-label text-label">Jumlah</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <input type="number" id="jumlahD" name="jumlahD" class="form-control form-control-user" style="justify-content: left;" disabled required></input>
                  </div> 
                </div>
              </div> 
              <div class="form-group row align-items-center">
                <label class="col-sm-3 col-form-label text-label">Tanggal</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <input type="text" id="tanggalD" name="tanggalD" class="form-control form-control-user" disabled required></input>
                  </div> 
                </div>
              </div> 
              <div class="form-group row align-items-center">
                <label class="col-sm-3 col-form-label text-label">Keterangan</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <input type="text" id="keteranganD" name="keteranganD" class="form-control form-control-user" style="justify-content: left;" disabled required></input>
                  </div> 
                </div>
              </div>  
              <div class="form-group row align-items-center">
                <label class="col-sm-3 col-form-label text-label">Status</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <input type="text" id="statusD" name="statusD" class="form-control form-control-user" style="justify-content: left;" disabled required></input>
                  </div> 
                </div>
              </div>  
              <div class="form-group row align-items-center">
                <label class="col-sm-3 col-form-label text-label">Tanggal dibuat</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <input type="text" id="createdDateD" name="createdDateD" class="form-control form-control-user" disabled required></input>
                  </div>
                </div>
              </div>
              <div class="form-group row align-items-center">
                <label class="col-sm-3 col-form-label text-label">Tanggal diubah</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <input type="text" id="modifiedDateD" name="modifiedDateD" class="form-control form-control-user" disabled required></input>
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

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<!-- jQuery -->
<script src="<?php echo base_url() ?>assets/adminlte3.2/plugins/jquery/jquery.min.js"></script>

<!-- Script Tambahan -->
<script>
    $(document).ready(function() {
        // Fokus pada input itemCode ketika modal ditampilkan
        $('#inputItemMasuk').on('shown.bs.modal', function () {
            $(this).find('input[name="itemCode[]"]').first().focus();
        });

		$('#inputItemKeluar').on('shown.bs.modal', function () {
            $(this).find('input[name="itemCode[]"]').first().focus();
        });

        let typingTimer; // Timer untuk mendeteksi input scanner
        const TYPING_DELAY = 50; // Delay dalam milidetik (scanner biasanya lebih cepat dari ini)

        // Fokus pada input itemCode ketika modal ditampilkan
        $('#inputItemMasuk').on('shown.bs.modal', function () {
            $(this).find('input[name="itemCode[]"]').first().focus();
        });

        // Menambah baris
        $('#addRow').click(function () {
            var newRow = `
                <tr>
                    <td><input type="text" name="itemCode[]" class="form-control" required></td>
                    <td><input type="number" name="qty[]" class="form-control" required></td>
                    <td><button type="button" class="btn btn-danger btn-sm removeRow"><i class="fas fa-trash" style="color:white"></i></button></td>
                </tr>
            `;
            $('#itemTable tbody').append(newRow);
        });

        // Menghapus baris
        $(document).on('click', '.removeRow', function () {
            $(this).closest('tr').remove();
        });

        // Deteksi input scanner atau Enter
        $(document).on('input keypress', 'input[name="itemCode[]"]', function (e) {
            const inputField = $(this);
            const currentRow = inputField.closest('tr');

            // Jika tombol Enter ditekan
            if (e.type === 'keypress' && e.which === 13) {
                processInput(inputField, currentRow);
                e.preventDefault(); // Mencegah form submit saat Enter
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

        function processInput(inputField, currentRow) {
            const currentItemCode = inputField.val();

            // Pengecekan ke database menggunakan AJAX
            $.ajax({
                url: '<?= base_url() ?>/TransaksiDandori/checkItemCode', // Ganti dengan URL endpoint yang sesuai
                method: 'POST',
                data: { itemCode: currentItemCode },
                success: function (response) {
                    try {
                        const data = JSON.parse(response);
                        if (data.exists) {
                            let isDuplicate = false;

                            // Iterasi semua baris untuk cek duplikasi
                            $('#itemTable tbody tr').each(function () {
                                const row = $(this);
                                if (row[0] !== currentRow[0]) {
                                    const itemCode = row.find('input[name="itemCode[]"]').val();
                                    if (itemCode === currentItemCode) {
                                        // Tambahkan qty jika duplikasi ditemukan
                                        const qtyInput = row.find('input[name="qty[]"]');
                                        const qty = parseInt(qtyInput.val()) || 0;
                                        qtyInput.val(qty + 1);

                                        // Kosongkan input field
                                        inputField.val('').focus();
                                        isDuplicate = true;
                                        return false; // Hentikan iterasi
                                    }
                                }
                            });

                            if (!isDuplicate) {
                                // Jika tidak ada duplikasi
                                currentRow.find('input[name="qty[]"]').val(1);

                                // Tambahkan baris baru
                                const newRow = `
                                    <tr>
                                        <td><input type="text" name="itemCode[]" class="form-control" required></td>
                                        <td><input type="number" name="qty[]" class="form-control" required></td>
                                        <td><button type="button" class="btn btn-danger btn-sm removeRow"><i class="fas fa-trash" style="color:white"></i></button></td>
                                    </tr>
                                `;
                                $('#itemTable tbody').append(newRow);

                                // Fokus pada baris baru
                                currentRow.next().find('input[name="itemCode[]"]').focus();
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'ItemCode tidak ditemukan di database!',
                                confirmButtonText: 'OK',
                            }).then(() => {
                                inputField.val('').focus();
                            });
                        }
                    } catch (e) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan dalam pemrosesan response dari server.',
                            confirmButtonText: 'OK',
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat memeriksa ItemCode di database.',
                        confirmButtonText: 'OK',
                    });
                    inputField.val('').focus();
                },
            });
        }

        $('#inputItemMasuk').on('hidden.bs.modal', function () {
            $('#itemTable tbody').html(`
                <tr>
                    <td><input type="text" name="itemCode[]" class="form-control" required></td>
                    <td><input type="number" name="qty[]" class="form-control" required></td>
                    <td><button type="button" class="btn btn-danger btn-sm removeRow"><i class="fas fa-trash" style="color:white"></i></button></td>
                </tr>
            `);
        });

		$('#inputItemMasuk').on('hidden.bs.modal', function () {
            // Reset baris
            $('#itemTable tbody').html(`
                <tr>
                    <td><input type="text" name="itemCode[]" class="form-control" required></td>
                    <td><input type="number" name="qty[]" class="form-control" required></td>
                    <td><button type="button" class="btn btn-danger btn-sm removeRow"><i class="fas fa-trash" style="color:white"></i></button></td>
                </tr>
            `);
        });

		$('#inputItemKeluar').on('hidden.bs.modal', function () {
            // Reset baris
            $('#itemTable tbody').html(`
                <tr>
                    <td><input type="text" name="itemCode[]" class="form-control" required></td>
                    <td><input type="number" name="qty[]" class="form-control" required></td>
                    <td><button type="button" class="btn btn-danger btn-sm removeRow"><i class="fas fa-trash" style="color:white"></i></button></td>
                </tr>
            `);
        });

        $('.detailbtn').on('click', function(){
                $('#detailData').modal('show');
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();
                console.log(data);

                $('#idD').val(data[0]);
                $('#itemCodeD').val(data[1]);
                $('#jumlahD').val(data[2]);
                $('#tanggalD').val(data[3]);
                $('#keteranganD').val(data[4])
                $('#statusD').val(data[5]); 
                $('#createdDateD').val(data[6]); 
                $('#modifiedDateD').val(data[7]);
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