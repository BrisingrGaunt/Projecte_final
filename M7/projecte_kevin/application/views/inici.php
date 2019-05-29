<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    include 'items.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Inici</title>
    <meta name="viewport" content="width=device-width">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo base_url();?>/js/script.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Cabin+Condensed:700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url();?>/css/estil.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/css/estilo.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/css/base.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="<?php echo site_url('Inici/login');?>"><img src="<?php echo base_url();?>/pics/Bwhite.svg"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo site_url('Inici/login');?>">BrisingrGaunt Productions SL <span class="sr-only">(current)</span></a>
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
                    <li nav-item active>
                        <a href="<?php site_url('Inici/login/');?>?idioma=spanish">
                            <img src="../../pics/espanya.jpg" class="flag">
                        </a>
                    </li>
                    <li nav-item active>
                        <a href="<?php site_url('Inici/login/');?>?idioma=english">
                            <img src="../../pics/catalunya.png" class="flag">
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <div>
            <div class="register">
                <div class="row">
                    <div class="col-md-3 col-12">
                        <div class="row ampolles d-none d-md-flex">
                            <div class="bottle1">
                                <?php
                            echo $ampolla;
                            ?>
                            </div>
                            <div class="bottle2">
                                <?php 
                            echo $ampolla;
                        ?>
                            </div>
                        </div>
                        <div class="row nota" id="avisos">
                            <i class="pin"></i>
                            <p id='info'></p>
                            <?php 
                            if(isset($info)){
                                echo $info;
                            }
                        ?>
                        </div>
                    </div>
                    <div class="col-md-9 col-12">
                        <div class="row">
                            <div class="col-md-1 d-none d-sm-block"></div>
                            <div class="col-md-10 col-12">
                                <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active opcions" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Usuari</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link opcions" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Empresa</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
<div class="row">
<div class="tab-content col-md-12" id="myTabContent">
<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
<h3 class="register-heading"><?php echo $lang->language['perfilUsuari'] ?></h3>
<div class="content" id="registre_usuari" role="tabpanel" aria-labelledby="register-tab">
<div class="row register-form">
    <div class="col-md-2 d-none d-sm-block"></div>
    <div class="col-md-8 col-12">
        <form method="post" action="<?php echo site_url('Inici/accio');?>" name="1">
            <input type="hidden" name="accio" value="registre_client">
            <div class="form-group">
                <label for="user_registre_usuari"><?php echo $lang->language['identificador_login'];?> *</label>
                <input type="text" class="form-control" name="username" id="user_registre_usuari" placeholder="<?php echo $lang->language['identificador_login'];?>" value="" />
            </div>
            <div class="form-group">
                <label for="email_registre_usuari">
                    <?php echo $lang->language['mail'];?> *</label>
                <input type="text" class="form-control" id="email_registre_usuari" name="email" placeholder="<?php echo $lang->language['mail'];?>" value="" />
            </div>
            <div class="form-group">
                <label for="contrasenya_registre_usuari"><?php echo $lang->language['password'];?> *</label>
                <input type="password" class="form-control inputMajus" name="password" id="contrasenya_registre_usuari" placeholder="<?php echo $lang->language['password'];?>" value="" /><br>
                <input type="checkbox" name="mostrarPass" id="mostrarPass"> <label for="mostrarPass"><?php echo $lang->language['mostrarPass'];?></label><br>
                <progress id='barra' min="0" max="5"></progress>
            </div>
            <div class="row">
                <div class="col-md-4 col-1"></div>
                <div class="col-md-4 col-10">
                    <input type="button" class="btnRegister" value="<?php echo $lang->language['botoRegister'];?>" />
                </div>
                <div class="col-md-4 col-1"></div>
            </div>
        </form>
    </div>
    <div class="col-md-2 d-none d-sm-block"></div>
</div>
</div>
<div class="content" id="login_usuari" role="tabpanel" aria-labelledby="login-tab">
<div class="row register-form">
    <div class="col-md-2 d-none d-sm-block"></div>
    <div class="col-md-8 col-12">
        <form method="post" action="<?php echo site_url('Inici/accio');?>" name="0">
            <input type="hidden" name="accio" value="login_client">
            <div class="form-group">
                <label for="user_login_empresa"><?php echo $lang->language['identificador_login'];?> *</label>
                <input type="text" class="form-control" name="username" id="user_login_empresa" placeholder="<?php echo $lang->language['identificador_login'];?>" value="" />
            </div>
            <div class="form-group">
                <label for="pass_login_empresa"><?php echo $lang->language['password'];?> *</label>
                <input type="password" class="form-control inputMajus" id="pass_login_empresa" name="password" placeholder="<?php echo $lang->language['password'];?>" value="" />
                <br>
                <input type="checkbox" name="mostrarPass" id="mostrarPass"> <label for="mostrarPass"> <?php echo $lang->language['mostrarPass'];?></label><br>
            </div>
            <div class="row">
                <div class="col-md-4 d-sm-block d-none"></div>
                <div class="col-md-4 col-12">
                    <input type="button" class="btnRegister" value="<?php echo $lang->language['botoLogin'];?>" />
                </div>
                <div class="col-md-4 d-sm-block d-none"></div>
            </div>
        </form>
    </div>
    <div class="col-md-2 d-none d-sm-block"></div>
</div>
</div>
</div>
<div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
<h3 class="register-heading">Perfil Empresa</h3>
<div class="content" id="registre_empresa" role="tabpanel" aria-labelledby="register-tab">
<form method="post" action="<?php echo site_url('Inici/accio');?>" name="2">
    <input type="hidden" name="accio" value="registre_empresa">
    <div class="row register-form">
        <div class="col-md-6">
            <div class="form-group">
                <label for="user_registre_empresa"><?php echo $lang->language['identificador'];?> *</label>
                <input type="text" class="form-control" id="user_registre_empresa" name="username" placeholder="<?php echo $lang->language['identificador'];?>" />
            </div>
            <div class="form-group">
                <label for="pass_registre_empresa"><?php echo $lang->language['password'];?> *</label>
                <input type="password" class="form-control inputMajus" id="pass_registre_empresa" name="password" placeholder="<?php echo $lang->language['password'];?>" value="" /><br>
                <input type="checkbox" name="mostrarPass" id="mostrarPass"> <label for="mostrarPass"> <?php echo $lang->language['mostrarPass'];?></label><br>
                <progress id='barra' min="0" max="5"></progress>
            </div>
            <div class="form-group">
                <label for="mail_registre_empresa"><?php echo $lang->language['mail'];?> *</label>
                <input type="email" class="form-control" name="email" id="mail_registre_empresa" placeholder="<?php echo $lang->language['mail'];?>" value="" />
            </div>
            <div class="form-group">
                <label for="nom_comercial"><?php echo $lang->language['nomComercial'];?> *</label>
                <input type="text" class="form-control" name="nom" id="nom_comercial" placeholder="<?php echo $lang->language['nomComercial'];?>" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="tipusVia"><?php echo $lang->language['tipusVia'];?> *</label>
                <select class="form-control" name="tipusVia" id="tipusVia">
                    <option class="hidden" selected disabled><?php echo $lang->language['tipusVia'];?></option>
                    <option value="Avinguda"><?php echo $lang->language['avinguda'];?></option>
                    <option value="Carrer"><?php echo $lang->language['carrer'];?></option>
                    <option value="Via">Via</option>
                </select>
            </div>
            <div class="form-group">
                <label for="direccio"><?php echo $lang->language['nomVia'];?> *</label>
                <input type="text" class="form-control" name="direccio" id="direccio" placeholder="<?php echo $lang->language['nomVia'];?>" />
            </div>
            <div class="form-group">
                <label for="num"> Número *</label>
                <input type="number" class="form-control" name="numDireccio" id="num" placeholder="Número" value="" />
            </div>
            <div class="form-group">
                <label for="comarca"><?php echo $lang->language['poblacio'];?> *</label>
                <select class="form-control" id="comarca" name="comarca">
                </select>
            </div>
            <div class="form-group">
                <div class="col-md-8">
                    <input type="button" class="btnRegister" value="<?php echo $lang->language['botoRegister'];?>" name="registre_emp" />
                </div>

            </div>
        </div>
    </div>


</form>
</div>
<div class="content" id="login_empresa" role="tabpanel" aria-labelledby="login-tab">
<div class="row register-form center">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form method="post" action="<?php echo site_url('Inici/accio');?>" name="0">
            <input type="hidden" name="accio" value="login_empresa">
            <div class="form-group">
                <label for="id_emp"><?php echo $lang->language['identificador_login'];?> *</label>
                <input type="text" class="form-control" id="id_emp" name="username" placeholder="<?php echo $lang->language['identificador_login'];?>" />
            </div>
            <div class="form-group">
                <label for="contrasenya_emp"><?php echo $lang->language['password'];?> *</label>
                <input type="password" class="form-control inputMajus" id="contrasenya_emp" name="password" placeholder="<?php echo $lang->language['password'];?>" value="" /><br>
                <input type="checkbox" name="mostrarPass" id="mostrarPass1"> <label for="mostrarPass1"><?php echo $lang->language['mostrarPass'];?></label><br>
            </div>
            <div class="row">
                <div class="col-md-4 col-1"></div>
                <div class="col-md-4 col-10">
                    <input type="button" class="btnRegister" value="<?php echo $lang->language['botoLogin'];?>" /><br />
                </div>
                <div class="col-md-4 col-1"></div>

            </div>
        </form>
    </div>
    <div class="col-md-2"></div>
</div>
</div>
</div>
</div>
</div>
<div class="row pestanya">
<div class="col-md-12 col-12">
<ul class="nav nav-tabs nav-justified" id="tabEmpresa" role="tablist">
<li class="nav-item">
<a class="nav-link active opcio_inici" id="login_empresa-tab" data-toggle="tab" href="#login_usuari" role="tab" aria-controls="home" aria-selected="true">Iniciar sessió</a>
</li>
<li class="nav-item">
<a class="nav-link opcio_inici" id="registre_empresa-tab" data-toggle="tab" href="#registre_usuari" role="tab" aria-controls="profile" aria-selected="false">Registrar-se</a>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</main>

</body>

</html>
