<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    include 'items.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Client</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo base_url();?>/js/script.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Cabin+Condensed:700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url();?>/css/estil.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/css/estilo.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/css/base.css">
</head>

<body>
     <header>
          <?php echo $barra_client;?>  
    </header>
    <main class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-12 order-2 order-md-1">
                    <?php echo $esquerra;?>
                </div>
                <div class="col-md-9 register-right principal order-md-2 order-1">
                    <div id='contingut' class="nota">
                        <h1>Benvolgut <?php echo $info_client['username']; ?></h1>
                        <h2>Estàs inscrit a <?php echo $qt_participacions; ?> events.</h2>
                        <h2>Pròxim event: </h2>
                        <h2>Quin producte? <?php echo $propera_cata['producte'];?></h2>
                        <h2>Quan? <?php echo date("d-m-Y H:i", strtotime($propera_cata['data']));?></h2>
                        <h2>On? <?php 
                                    echo $propera_cata['tipusVia']." ".$propera_cata['direccio'].", ".$propera_cata['numDireccio']." (".$propera_cata['comarca'].")";
                           ?></h2>
                        <h2>Qui ho organitza? <?php echo $propera_cata['empresa'];?></h2>
                    </div>
                </div>
            </div>
    </main>
    <!-- Footer -->
                    <footer class="page-footer font-small">
                        <!-- Copyright -->
                        <div class="footer-copyright text-center">© 2019 Copyright --
                            BrisingrGaunt Productions
                        </div>
                        <!-- Copyright -->
                    </footer>
                    <!-- Footer -->

</body>

</html>
