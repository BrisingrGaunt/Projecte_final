<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    include 'items.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Empresa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo base_url();?>/js/script.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Cabin+Condensed:700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url();?>/css/estilo.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/css/base.css">
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
                <div class="col-md-9 register-right principal order-md-2 order-1">
                    <div id="contingut">
                        <div class="row">
                            <div class="col-md-3 d-sm-block d-none"></div>
                            <div class="col-md-6 col-12">
                            <h1>Els teus events...</h1>
                            </div>
                            <div class="col-md-3 d-sm-block d-none"></div>
                        </div>
                        <?php
                            if(isset($cates)){
                               $i=0;
                                echo "<div class='row'>";
                                foreach($cates as $c){
                                        if($i==2){
                                            echo "</div><div class='row'>";
                                        }
                        ?>
                        <div class="col-md-1 col-1"></div>
                        <div class="cata col-md-4 col-10 nota">
                            <i class="pin"></i>
                            <h2><?php echo $c['nom'];?></h2>
                            <p class="descripcio">"<?php echo $c['descripcio'];?>"</p>
                            <p><b>On?</b> <?php echo $info_empresa['tipusVia']." ".$info_empresa['direccio'].", ".$info_empresa['numDireccio']." (".$info_empresa['comarca'].")";?></p>
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
                                    echo "<a href='";
                                   if($c['estat']==0){
                                        echo site_url('Empresa/modificar_cata/?id='.$c['id'])."'>Modificar cata</a>";
                                    }
                                    else{
                                         echo site_url('Empresa/veure_valoracions/?id='.$c['id'])."'>Veure valoracions</a>";
                                    }     

                                    ?>
                            
                            </p>
                                
                        </div>
                        <div class="col-md-1 col-1"></div>
                        <?php
                                    $i++;
                                    }

                                echo "</div>";
                            }
                            else{
                                echo "No tens cap event programat, planifica algun!!! >-<";
                            }
                        
                        ?>
                    </div>
                    
                </div>
            </div>

    </main>
    <footer class="page-footer font-small">
        <div class="footer-copyright text-center">© 2019 Copyright --
            BrisingrGaunt Productions
        </div>
    </footer>
</body>

</html>
