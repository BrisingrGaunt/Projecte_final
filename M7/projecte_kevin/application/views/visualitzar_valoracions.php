<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    include 'items.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Programar cata</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo base_url();?>/js/script_prod.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Cabin+Condensed:700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url();?>/css/estil.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/css/estilo.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/css/barra_nav.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/css/generic.css">
</head>

<body>
    <div id="container">
        <div class="container register" style="max-width:100%">
            <div class="row">
                <?php echo $esquerra;?>
                <div class="col-md-9 register-right principal">
                    <?php echo $barra_empresa;?>
                    <div id="contingut" class="participacio">
                        <br><br>
                        <div class="row">
                            <?php
                                    if(isset($info_cata_individual) && sizeof($info_cata_individual)>0){
                                ?>
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        <div class="row ">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 info_cata">
                                <?php 
                                    $cata=$info_cata_individual[0]['cata'];
                                    echo "<div class='valoracio'><h1>Valoració de la cata # ".$cata."</h1>";
                                    $aux=1;
                                    foreach($info_cata_individual as $i){
                                        if($cata!=$i['cata']){
                                            echo "</table></div><div class='valoracio'><h1>Valoració de la cata # ".$i['cata']."</h1>";
                                            $aux=1;
                                        }
                                        if($aux==1){
                                        ?>
                                <h2>Producte: <?php echo $i['nom'];?></h2>
                                <h2>Data: <?php $newDate = date("d/m/Y H:i", strtotime($i['data'])); echo $newDate;?></h2>
                                <h2>Adreça: <?php echo $info_empresa['tipusVia']." ".$info_empresa['direccio'].", ".$info_empresa['numDireccio']." (".$info_empresa['comarca'].")";?></h2>
                                <h2>Estat: <?php $cadena=""; $i['estat']==0?$cadena="Oberta":$cadena="Finalitzada"; echo $cadena;?></h2>
                                <h2>Participants</h2>
                                <table class="valoracions" colspan="3">
                                    <th>&nbsp;&nbsp;</th>
                                    <th>Usuari</th>
                                    <th>Valoració</th>
                                    <?php
                                        }
                                        echo "<tr><td>".$aux."</td><td>".$i['username']."</td><td>";
                                        if($i['estat']=="1"){
                                        echo "<p class='estrelles'>";
                                        for($j=0;$j<$i['valoracio'];$j++){
                                                        echo "★";
                                                    }
                                                echo "<span class='estrelles'>";
                                                for($j=$i['valoracio'];$j<5;$j++){
                                                    echo "✩";
                                                }
                                                    
                                                    echo "</span></p>";
                                        }
                                        else{
                                            echo "<p>Pròximament</p>";
                                        }
                                        echo "</td></tr>";
                                        $aux++;
                                        $cata=$i['cata'];
                                    }
                                   
                                   
                                ?>
                                </table></div>
                                    <?php }else{
                                        echo "<h1>No tens events disponibles o no hi ha cap usuari interesat</h1>";
                                    } ?>
                            
                            <div class="col-md-2"></div>
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
    </div>

</body>

</html>
