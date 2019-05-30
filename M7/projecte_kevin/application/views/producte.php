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
    <script src="<?php echo base_url();?>/js/script_prod.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Cabin+Condensed:700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url();?>/css/estil.css">
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
        <div class="col-md-9 order-md-2 order-1">
                        <div class="row">
                            <div class="col-md-2 d-none d-sm-block"></div>
                            <div class="col-md-8 col-12">
                                <h1>Amplia la teva selecció de productes...</h1>
                            </div>
                            <div class="col-md-2 d-none d-sm-block"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <form method="post" action="<?php echo site_url('Empresa/pujar_producte');?>">
                                    <input type="hidden" name="empresa" value="<?php echo $info_empresa['id']?>" />
                                    <div class="form-group">
                                        <label for="nom_producte">Producte *</label>
                                        <input type="text" class="form-control" name="nom" id="nom_producte" placeholder="Nom" value="" />
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcio_producte">Descripció *</label>
                                        <textarea class="form-control" name="descripcio" id="descripcio_producte" rows="3" placeholder="Descripció del producte"></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1 d-sm-block d-none"></div>
                                        <div class="col-md-5 col-12"><input type="button" id="afegirProd" class="btnRegister" value="Afegir producte" /></div>
                                        <div class="col-md-5 col-12">
                                        <input type="submit" id="carregaMassiva" name="xml" class="btnRegister" value="Realitzar carrega XML" /></div>
                                        <div class="col-md-1 d-sm-block d-none"></div>
                                    </div>
                                    
                                    
                                </form>
                                
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>
    </main>             <!-- Footer -->
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
