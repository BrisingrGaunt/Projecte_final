<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>BrisingrGaunt Productions</title>
    <link rel="shortcut icon" href="<?php base_url();?>/pics/B.svg" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Cabin+Condensed:700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url();?>/css/base.css">
    <script src="<?php echo base_url();?>/js/script_base.js"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="<?php echo site_url('Inici');?>"><img src="<?php echo base_url();?>/pics/B.svg" class="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">BrisingrGaunt Productions SL <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item d-none">
                        <a class="nav-link" href="#">&nbsp;</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Accés empresa
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo site_url('Inici/login');?>">Registre</a>
                            <a class="dropdown-item" href="<?php echo site_url('Inici/login');?>">Iniciar Sessió</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Accés usuari
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo site_url('Inici/login');?>">Registre</a>
                            <a class="dropdown-item" href="<?php echo site_url('Inici/login');?>">Iniciar Sessió</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="animacio d-none d-sm-block">
                <img src="<?php echo base_url()."/pics/botella.png";?>" class="botella">
                <img src="<?php echo base_url()."/pics/botella.png";?>" class="botella">
                <img src="<?php echo base_url()."/pics/botella.png";?>" class="botella">
                <img src="<?php echo base_url()."/pics/botella.png";?>" class="botella">
            </div>
        </nav>
    </header>
    <main class="container-fluid">
        <div class="row">
            <div class="col-md-4  col-12">
                <h1>Els més valorats</h1>
                <table>
                    <?php
            foreach($productes->result_array() as $p){
                echo "<tr><tr><td>Organitza: ".$p['empresa']."</td><td><a href='".site_url('Inici/ubicar/?id='.$p['id'])."'>Ubicar</a></td><td></td></tr><td>Producte</td><td>".$p['nom'].":</td><td>";
                //echo $nom.": ";
                for($i=0;$i<intval($p['valoracio']);$i++){
                    echo "★";
                }
                for($i=intval($p['valoracio']);$i<5;$i++){
                    echo "☆";
                }
                echo "</td></tr>";
            }
            
        ?>
                </table>
            </div>
            <div class="col-md-1"></div>
            <div class="col-12 col-md-7">
                <h1>Les cates</h1>
                    <?php 
                    $i=0;
                    echo " <div class='row'>";
                    foreach($cates as $c){   
                        ?>
                    <div class="d-md-none col-1 d-block"></div>
                    <div class="nota col-md-5 col-10">
                        <i class="pin"></i>
                        <h2><?php echo $c['nom'];?></h2>
                        <p><span>Quan? </span> <?php $newDate = date("d/m/Y H:i", strtotime($c['data'])); echo $newDate;?></p>
                        <p><span>On? </span><?php echo $c['tipusVia']." ".$c['direccio'].", ".$c['numDireccio']." (".$c['comarca'].")";?></p>
                        <p><span>Estat: </span><?php if($c['estat']==0){
                                    $estat="Oberta";
                                }
                                else{
                                    $estat="Tancada";
                                }
                                echo $estat;?></p>
                        <p class="amagat"><span>Organitza: </span><?php echo $c['empresa'];?></p>
                        <p class="amagat"><span>Descripció del producte: </span><?php echo $c['descripcio'];?></p>
                    </div>
                <div class="d-md-none col-1 d-block"></div>
                    <div class="col-md-1"></div>
                    <?php
                       // var_dump($c);echo "<br>";
                        $i++;
                        if($i==2){
                                $i=0;
                                echo "</div><div class='row'>";
                            }
                    }
                echo "</div>";
                        
    ?>                </div>
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
