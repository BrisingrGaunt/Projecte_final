<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    include 'items.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Empresa</title>
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
                    <?php //var_dump($info_client);?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
