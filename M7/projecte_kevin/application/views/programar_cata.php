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
                    <div id="contingut">
                        <br><br>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <h1>Programació de cata</h1>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <form method="post" action="<?php if(isset($editar_cata)){echo site_url('Empresa/modificar_cata');}else{echo site_url('Empresa/programar_cata');}?>">
                                    <input type="hidden" name="empresa" value="<?php echo $info_empresa['id']?>" />
                                    <?php if(isset($editar_cata)){?>
                                    <input type="hidden" name='id' value="<?php echo $editar_cata['id'];?>" />
                                    <input type="hidden" name='producte_vell' value="<?php echo $editar_cata['codi'];?>"/>
                                    <input type="hidden" name="data_vella" value="<?php echo $editar_cata['data'];?>"/>
                                    <?php } ?>
                                    <div class="form-group">
                                        <label for="nom_producte">Producte *</label><br>
                                        <select name="producte" id="nom_producte">
                                            <option value="-1">Selecciona un producte</option>
                                            <?php 
                                                foreach($productes as $p){
                                                    echo "<option value='".$p['codi']."'";
                                                    if(isset($editar_cata)){
                                                        if($editar_cata['codi']==$p['codi']){
                                                            echo " selected ";
                                                        }
                                                    }
                                                    echo ">".$p['nom']."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="data_event">Data i hora *</label><br>
                                        <input type="datetime-local" name="data" id="data_event" <?php if(isset($editar_cata)){                                           
                                        echo "value='".str_replace(" ","T",$editar_cata['data'])."'";}?> />
                                    </div>
                                    <?php if(isset($editar_cata)){ ?>
                                        <input type='submit' id="eliminarCata" class="btnRegister"  style="margin-left:35px;width:175px;" value="Eliminar cata" name='eliminar'>
                                        <input type='button' id='modificarCata' class="btnRegister" style="width:175px;" value="Modificar cata" name="modificar">
                                    <?php }else{?>
                                    <input type="button" id="afegirCata" class="btnRegister" value="Afegir">
                                    <?php }?>
                                </form>
                            </div>
                            <div class="col-md-3"></div>
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
