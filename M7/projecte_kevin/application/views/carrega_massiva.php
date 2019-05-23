<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    include 'items.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Afegir productes per XML</title>
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
                    <div id="contingut">
                        <br><br>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <h1>Càrrega de productes per XML</h1>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        
                        
                        <div class="row producte">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <p>L'XML que has de pujar ha de seguir el següent esquema: </p>
                                <img src="<?php echo base_url();?>/pics/exemple_xml.png">
                                <p>Consulta amb l'administrador quin es l'identificador de la teva empresa</p>
                                <form method="post" action="<?php echo site_url('Empresa/carregaXML');?>" enctype="multipart/form-data">
                                    <input type="hidden" name="empresa" value="<?php echo $info_empresa['id']?>" />
                                    <div class="form-group">
                                        <label for="file_xml">Fitxer XML</label>
                                        <input type="file" class="form-control" name="xml" id="file_xml" />
                                    </div>
                                    <input type="submit" id="carregaMassiva" name="xml" class="btnRegister" value="Pujar arxiu" />
                                </form>
                            </div>
                            <div class="col-md-2"></div>
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
                </div>
            </div>
        </div>
    </div>
</body>

</html>
