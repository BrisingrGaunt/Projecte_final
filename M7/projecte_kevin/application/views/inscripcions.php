<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    include 'items.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Inscripcions</title>
    <meta name="viewport" content="width=device-width">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
                <div class="col-md-9 col-12 order-1 order-md-2">
                        <h1>Totes les cates</h1>
                        <?php
                            $i=0;
                    $qt=0;
                        echo "<div class='row'>";
                            for($j=0;$j<sizeof($cates);$j++){
                                $trobat=false;
                                if($i==2){
                                    echo "</div><br><div class='row'>";
                                    $i=0;
                                }
                                if(isset($filtre)){
                                    while($j!=sizeof($cates) && gettype(array_search($cates[$j]['id'], explode(":",$participacions['cates'])))!="integer"){
                                        $j++;
                                    }
                                    if($j!=sizeof($cates)){
                                        //hi ha alguna coincidència
                                        $trobat=true;
                                    }
                                }
                                if(isset($filtre) && $trobat==true || !isset($filtre)){
                                    $qt++;
                                    //només es mostran les cates en cas que sigui el general o que sigui per usuari i hi hagen coincidències
                        ?>
                        <div class="col-md-1 col-1"></div>
                        <div class="cata col-md-4 col-10 nota">
                            <i class="pin"></i>
                            <h2><?php echo $cates[$j]['nom'];?></h2>
                            <p class="descripcio">"<?php echo $cates[$j]['descripcio'];?>"</p>
                            <p><b>On?</b> <?php echo $cates[$j]['tipusVia']." ".$cates[$j]['direccio'].", ".$cates[$j]['numDireccio']." (".$cates[$j]['comarca'].")";?></p>
                            <p><b>Quan?</b> <?php $newDate = date("d/m/Y H:i", strtotime($cates[$j]['data'])); echo $newDate;?></p>

                            <p><?php 
                                if($cates[$j]['estat']==0){
                                    $estat="Oberta";
                                }
                                else{
                                    $estat="Tancada";
                                }
                                echo "<b>Estat: </b>".$estat;?></p>
                            <p class="peu">

                                <?php
                                    echo "<a href='";
                                   if($cates[$j]['estat']==1 && gettype(array_search($cates[$j]['id'],explode(":",$participacions['cates'])))=="integer"){
                                       //si la cata està finalitzada i l'usuari ha participat
                                        echo site_url('Cliente/valora/?id='.$cates[$j]['id'])."'>Valorar cata</a>";
                                    }
                                    else if($cates[$j]['estat']==1 && array_search($cates[$j]['id'],explode(":",$participacions['cates']))==false){
                                        //si la cata està tancada i l'usuari NO ha participat
                                         echo site_url('Cliente')."'></a>";
                                    }
                                    else if($cates[$j]['estat']==0 && gettype(array_search($cates[$j]['id'],explode(":",$participacions['cates'])))=="integer"){
                                       //últim cas contemplat en el que l'usuari està registrat a una cata oberta i es pot desapuntar
                                        echo site_url('Cliente/gestio_inscripcio/?id='.$cates[$j]['id'].'&accio=desapuntar')."'>Desapuntar-se</a>";
                                    }
                                    else{
                                         //cata oberta usari NO apuntat 
                                        echo site_url('Cliente/gestio_inscripcio/?id='.$cates[$j]['id'].'&accio=apuntar')."'>Apuntar-se</a>";
                                    }

                                    ?>

                            </p>
                        </div>
                        <div class="col-md-1 col-1"></div>

                        <?php 
                                 $i++;   
                                }
                            }
                            if($qt==0){
                                echo "<h2>Encara no estàs apuntat a cap cata.</h2>";
                            }
                            echo " </div>";
                        ?>

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
