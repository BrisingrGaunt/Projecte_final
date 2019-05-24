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
        <div class="container" style="max-width:100%">
            <div class="row">
                <div class="col-md-12 register-right">
                    <?php echo $barra_client; ?>
                    <div id='contingut'>
                        <h1>Cates</h1>
                        
                        <?php
                            $i=0;
                        echo "<div class='row'>";
                            foreach($cates as $c){
                                if($i==2){
                                    echo "</div><br><div class='row'>";
                                    $i=0;
                                }
                        ?>
                            <div class="col-md-1"></div>
                        <div class="cata col-md-4 avisos">
                            <i class="pin"></i>
                            <h2><?php echo $c['nom'];?></h2>
                            <p class="descripcio">"<?php echo $c['descripcio'];?>"</p>
                            <p><b>On?</b> <?php echo $c['tipusVia']." ".$c['direccio'].", ".$c['numDireccio']." (".$c['comarca'].")";?></p>
                            <p><b>Quan?</b> <?php $newDate = date("d/m/Y H:i", strtotime($c['data'])); echo $newDate;?></p>

                            <p><?php 
                                if($c['estat']==0){
                                    $estat="Oberta";
                                }
                                else{
                                    $estat="Tancada";
                                }
                                echo "<b>Estat: </b>".$estat;?></p>
                            <p class="peu">
                                
                                <?php
                                //var_dump(gettype(array_search($c['id'],explode(":",$participacions['cates']))));
                                //exit;
                                    echo "<a href='";
                                   if($c['estat']==1 && gettype(array_search($c['id'],explode(":",$participacions['cates'])))=="integer"){
                                       //si la cata està finalitzada i l'usuari ha participat
                                        echo site_url('Cliente/valora/?id='.$c['id'])."'>Valorar cata</a>";
                                    }
                                    else if($c['estat']==1 && array_search($c['id'],explode(":",$participacions['cates']))==false){
                                        //si la cata està tancada i l'usuari NO ha participat
                                         echo site_url('Cliente')."'></a>";
                                    }
                                    else if($c['estat']==0 && gettype(array_search($c['id'],explode(":",$participacions['cates'])))=="integer"){
                                       //últim cas contemplat en el que l'usuari està registrat a una cata oberta i es pot desapuntar
                                        echo site_url('Cliente/gestio_inscripcio/?id='.$c['id'].'&accio=desapuntar')."'>Desapuntar-se</a>";
                                    }
                                    else{
                                        
                                        
                                         //cata oberta usari NO apuntat 
                                        echo site_url('Cliente/gestio_inscripcio/?id='.$c['id'].'&accio=apuntar')."'>Apuntar-se</a>";
                                    }

                                    ?>
                            
                            </p>     
                        </div>
                        <div class="col-md-1"></div>
                            
                        <?php 
                             $i++;   
                            }
        
                            echo " </div>";
                        ?>
                       
                    </div>
                </div>
            </div>
        </div>
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
</body>

</html>
