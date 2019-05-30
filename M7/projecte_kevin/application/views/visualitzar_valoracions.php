<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    include 'items.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Visualitzar cata</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Cabin+Condensed:700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url();?>/css/estilo.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/css/base.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/css/generic.css">
</head>
<body>
    <header>
          <?php echo $barra_empresa;?>  
    </header>
    <main class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-12 order-2 order-md-1">
                    <?php echo $esquerra;?>
        </div>
        <div class="col-md-9 principal order-md-2 order-1">
                        <div class="row">
                            <?php
                                    if(isset($info_cata_individual) && sizeof($info_cata_individual)>0){
                                ?>
                            <div class="col-md-2 d-none d-sm-block"></div>
                            <div class="col-md-8 col-12">
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
                                <h2 class="visualitzacio">Producte: <span><?php echo $i['nom'];?></span></h2>
                                <h2 class="visualitzacio">Data: <span><?php $newDate = date("d/m/Y H:i", strtotime($i['data'])); echo $newDate;?></span></h2>
                                <h2 class="visualitzacio">Adreça: <span><?php echo $info_empresa['tipusVia']." ".$info_empresa['direccio'].", ".$info_empresa['numDireccio']." (".$info_empresa['comarca'].")";?></span></h2>
                                <h2 class="visualitzacio">Estat: <span><?php $cadena=""; $i['estat']==0?$cadena="Oberta":$cadena="Finalitzada"; echo $cadena;?></span></h2>
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
                            
                            <div class="col-md-2 d-none d-sm-block"></div>
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


</body>

</html>
