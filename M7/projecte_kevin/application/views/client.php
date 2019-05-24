<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    include 'items.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Client</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo base_url();?>/js/script.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Cabin+Condensed:700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url();?>/css/estil.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/css/estilo.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/css/barra_nav.css">
</head>

<body>
    <div id="container">
        <div class="container register" style="max-width:100%">
            <div class="row">
                <div class="col-md-3 register-left">
                    <div class="row ampolles">
                        <div class="bottle1">
                            <?php
                            echo $ampolla;
                            ?>
                        </div>
                        <div class="bottle2">
                            <?php 
                            echo $ampolla;
                        ?>
                        </div>
                    </div>
                    <div class="row" id="avisos">
                        <i class="pin"></i>
                        <p id='info'></p>
                        <?php 
                            if(isset($info)){
                                echo $info;
                            }
                        ?>
                    </div>
                    <div class="row">
                        <div class="missatge">
                            <?php echo $welcome;?>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 register-right">
                    <?php echo $barra_client; ?>
                    <div id='contingut'>
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
                    <!-- Footer -->
                    <footer class="page-footer font-small">
                        <!-- Copyright -->
                        <div class="footer-copyright text-center">© 2019 Copyright --
                            BrisingrGaunt Productions
                        </div>
                        <!-- Copyright -->
                    </footer>
                    <!-- Footer -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>
