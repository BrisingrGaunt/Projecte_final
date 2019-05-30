<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    include 'items.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Valoració</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo base_url();?>/js/script_valoracio.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Cabin+Condensed:700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url();?>/css/base.css">
</head>

<body>
    <header>
        <?php echo $barra_client;?>
    </header>
    <main>
        <div class="container-fluid">
            <br><br>
            <div class="row">
                <div class="col-md-2 col-1"></div>
                <div class="col-md-8 col-10 nota desactivat">
                    <form method='post' action="<?php site_url('Cliente/valorar')?>">
                        <input type="hidden" name="cata" value="<?php echo $valoracio['cata'];?>">
                        <input type="hidden" name="valoracio" id="hidden_valoracio" value="<?php echo $valoracio['valoracio']==0?"0":$valoracio['valoracio'];?>"/>
                        <input type="hidden" name="client" value="<?php echo $valoracio['client'];?>">
                        <div class="row">
                            <div class="col-md-2 d-sm-block d-none"></div>
                            <div class="col-md-8 col-12"><h1><?php echo $valoracio['nom'];?></h1><h2>Valora la teva experiència del dia <?php $newDate = date("d/m/Y H:i", strtotime($valoracio['data'])); echo $newDate; ?></h2></div>
                        
                            <div class="col-md-2 d-sm-block d-none"></div>                        
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-1 d-none"></div>
                        <div class="formulari_element col-md-10 col-12 text-center">
                            <label for="comentari">A <b><?php echo $valoracio['empresa'];?></b> els agradaria conèixer la teva opinió:</label><br><br>
                            <div class="row">
                            <div class="col-md-3 col-1"></div>
                            <div class="col-md-6 col-12">
                                <textarea id="comentari" rows="4" cols="50"></textarea><br>
                            </div>
                            <div class="col-md-3 d-none col-1"></div>
                            </div>
                            <label for="hidden_valoracio">Puntua la cata</label>
                            <p class="estrelles">
                                <?php 
    for($i=1;$i<6;$i++){
        echo "<span name='".$i."' class='estrella'>★</span>";
    }  
    ?>
                            </p>
                            <input type="submit" value="Puntuar">
                        </div>
                            <div class="col-md-1 d-none"></div>
                        </div>
                        

                    </form>
                    <div class="row">
                        <div class="col-md-3 col-1 d-md-block"></div>
                        <div class="col-md-6 col-10">
                        <?php if(isset($info)){echo "<p>Resultat de l'operació: ".$info."</p>";}?>
                        </div>
                        <div class="col-md-3 col-1 d-md-block"></div>
                    </div>
                   
                </div>
                <div class="col-md-2 col-1"></div>

            </div>
        </div>
    </main>
    <!-- Footer -->
    <footer class="page-footer">
        <!-- Copyright -->
        <div class="footer-copyright text-center">© 2019 Copyright --
            BrisingrGaunt Productions
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
</body>

</html>
