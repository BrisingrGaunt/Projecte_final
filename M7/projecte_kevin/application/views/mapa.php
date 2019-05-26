<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Ubícate</title>
    <link rel="shortcut icon" href="<?php base_url();?>/pics/B.svg" />
    <script async defer src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBhIshCfsCDpxZj2EmDQcyRUw3sczEiTJE"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Cabin+Condensed:700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url();?>/css/base.css">
    <script src="<?php echo base_url();?>/js/script_mapa.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"><img src="<?php echo base_url();?>/pics/B.svg"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo site_url('Inici');?>">BrisingrGaunt Productions SL <span class="sr-only">(current)</span></a>
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
        </nav>
    </header>
    <main class="container-fluid">
        <input type="hidden" id='coordenades' value="<?php echo $coordenades;?>">
        <br>
        <h1>Ubicació de <?php echo $nom;?></h1>
        <br>
        <div class="row">
            <div class="col-md-2 col-1"></div>
            <div class="col-md-8 col-10" id="mapa"></div>
            <div class="col-md-2 col-1"></div>    
        </div>
        <br>
         <h2><?php echo $direccio;?></h2>
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
