<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    include 'items.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Programar cata</title>
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
        <div class="col-md-9 principal order-md-2 order-1">
                        <div class="row">
                            <div class="col-md-3 col-1"></div>
                            <div class="col-md-7 col-10">
                                <h1>Programació de cata</h1>
                            </div>
                            <div class="col-md-2 col-1"></div>
                        </div>
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
                                    <div class="form-group row">
                                        <div class="col-md-3 col-1"></div>
                                        <div class="col-md-5 col-10"><label for="nom_producte">Producte *</label><br>
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
                                        <div class="col-md-4 col-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3 col-1"></div>
                                        <div class="col-md-5 col-10"><label for="data_event">Data i hora *</label><br>
                                        <input type="datetime-local" name="data" id="data_event" <?php if(isset($editar_cata)){                                           
                                        echo "value='".str_replace(" ","T",$editar_cata['data'])."'";}?> /></div>
                                        <div class="col-md-4 col-1"></div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-1"></div>
                                        <div class="col-md-4 col-10">
                                            <?php if(isset($editar_cata)){ ?>
                                        <input type='submit' id="eliminarCata" class="btnRegister"  value="Eliminar cata" name='eliminar'>
                                        <input type='button' id='modificarCata' class="btnRegister" value="Modificar cata" name="modificar">
                                    <?php }else{?>
                                    <input type="button" id="afegirCata" class="btnRegister" value="Afegir">
                                    <?php }?>
                                        
                                        </div>
                                        <div class="col-md-4 col-1"></div>
                                    
                                    </div>
                                    
                                </form>
                            </div>
                            <div class="col-md-3"></div>
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
