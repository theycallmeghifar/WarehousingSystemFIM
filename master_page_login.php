<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata("flash") ?>"></div>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FIM Warehousing</title>

        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/login/font-awesome.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/login/googleapis.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/login/style.css') ?>">

        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url() ?>assets/adminlte3.2/dist/img/FIM_Logo.png">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte3.2/dist/js/jquery-ui.css">
    </head>

<!-- //////////////////////////////////////// -->

  <body style="background-color:#383c44;">

  <?php echo $data;?>


<!-- //////////////////////////////////////// -->

<!-- jQuery -->
  <script src="<?php echo base_url('assets/plugins/login/jquery.min.js')?>"></script>
  <script src="<?php echo base_url('assets/plugins/login/bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('assets/plugins/login/main.js')?>"></script>
  <script src="<?php echo base_url('assets/plugins/login/popper.js')?>"></script>

<script>

    $(document).ready(function() {

        var mod = document.getElementById("modal-menu");
        var txtMsg = document.getElementById("msg");

        $('#uname').keyup(function(e) {
            if (e.keyCode == '13') //Keycode for "Return"
                $('#login').click();
        })

        $('#password').keyup(function(e) {
            if (e.keyCode == '13') //Keycode for "Return"
                $('#login').click();
        })

        $("#login").on("click", function(e) {
            var uname = document.getElementById("uname").value;
            var password = document.getElementById("password").value;

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Login/getLogin') ?>",
                data: {
                    uname: uname,
                    password: password
                },
                success: (function(data) {
                    var obj = jQuery.parseJSON(data);
                    if (obj.cek > 0) {
                        txtMsg.style.color = "green";
                        txtMsg.innerHTML = obj.msg;
                        if (obj.role == 0) {
                            window.location.replace("<?php echo site_url('Dashboard') ?>");
                        } else if (obj.role == 1) {
                            window.location.replace("<?php echo site_url('Supplier') ?>");
                        } else if (obj.role == 2) {
                            window.location.replace("<?php echo site_url('Dandori') ?>");
                        } else if (obj.role == 3) {
                            window.location.replace("<?php echo site_url('Dandori') ?>");
                        }
                    } else {
                        txtMsg.style.color = "red";
                        txtMsg.innerHTML = obj.msg;
                    }
                }),
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        const flashdata = $('.flash-data').data('flashdata');
        if (flashdata) {
            Swal.fire({
                title: 'Berhasil ' + flashdata,
                text: '',
                icon: 'success'
            });
        }
    });
</script>

</body>

</html>s