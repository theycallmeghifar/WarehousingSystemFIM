<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FIM Warehousing QR Item</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4 -->
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url() ?>assets/adminlte3.2/dist/img/FIM_Logo.png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/other/all.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/other/adminlte.min.css') ?>">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <style>
        @page { size: auto;  margin: 8mm; }
    </style>

    <style>
        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin: auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <section class="invoice">
            <div class="card-body">
                <h1 class="d-flex justify-content-center" style="margin-top:20px;margin-bottom: 5px;font-weight:bold">FIM WAREHOUSING</h1>
                <h2 class="d-flex justify-content-center" style="margin-top:8px;margin-bottom:30px;">PT FEDERAL IZUMI MANUFACTURING</h2>
                <hr color="black" width="90%">
                <h3 class="d-flex justify-content-center" style="margin-top:42px;margin-bottom: 20px;">DAFTAR ITEM SUPPLIER</h3>
                    
                <div class="column">
                    <?php
                    $i = 1;
                    foreach ($print as $m) {
                        $data = json_decode($m);
                            if (is_array($data) || is_object($data)) {
                                foreach ($data as $d) { ?>
                                    <div class="col-sm-12">
                                    </br>                                       
                                        <div class="card-header border-0">
                                            <div class="d-flex justify-content-between">
                                            
                                            <h4 style="font-weight: bold; text-align: left;margin-left: 50px;margin-top: 23px;"><?php echo $i?>.</h4>
                                                <div style="margin-left: 30px;">
                                                    </br>
                                                    
                                                    <h4 style="font-weight: bold; text-align: left;">Item Code</h4>
                                                    <h5 style="text-align: left;"><?php echo $d->itemCode ?></h5>
                                                    <h4 style="font-weight: bold; text-align: left;">Item Name</h4>
                                                    <h5 style="text-align: left;">
                                                        <?php echo $d->itemName ?>
                                                    </h5>
                                                </div>
                                            <img style="margin-right: 60px;margin-bottom:3px;" height="187" width="187" id="qrcode" src="<?php echo site_url('Supplier/qrCodeCon/' . $d->itemCode) ?>" alt="">                                        
                                            </div>
                                        </div>
                                    </div>
                    <?php       }    
                            $i++;
                        }
                    } ?>
                    </div>
            </div>
        </section>
    </div>

    <script type="text/javascript">
        window.addEventListener("load", window.print());
        redirect(base_url('./Supplier'));
    </script>
</body>

</html>