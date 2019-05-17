<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    include 'items.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Inici</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo base_url();?>/js/script.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Cabin+Condensed:700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url();?>/css/estil.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/css/estilo.css">

</head>

<body>

    <div id="container">
        <div class="container register" style="max-width:100%">
            <div class="row">
                <div class="col-md-3 register-left">
                    <div class="row bombolles">
                    </div>
                    <div class="row ampolles">
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
                    <div class="row">
                        <div class="missatge">
                           <?php echo $welcome;?>
                        </div>
                    </div>

                </div>
                <div class="col-md-9 register-right">
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Usuari</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Empresa</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <h3 class="register-heading">Perfil usuari</h3>
                            <div class="row register-form">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="user_nom" placeholder="Nom *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Last Name *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control inputMajus" placeholder="Contrasenya *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Confirm Password *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <div class="maxl">
                                            <label class="radio inline">
                                                <input type="radio" name="gender" value="male" checked>
                                                <span> Male </span>
                                            </label>
                                            <label class="radio inline">
                                                <input type="radio" name="gender" value="female">
                                                <span>Female </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Correu electrònic *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" minlength="10" maxlength="10" name="txtEmpPhone" class="form-control" placeholder="Your Phone *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control">
                                            <option class="hidden" selected disabled>Please select your Sequrity Question</option>
                                            <option>What is your Birthdate?</option>
                                            <option>What is Your old Phone Number</option>
                                            <option>What is your Pet Name?</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter Your Answer *" value="" />
                                    </div>
                                    <input type="submit" class="btnRegister" value="Register" />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <h3 class="register-heading">Perfil Empresa</h3>
                            <div class="row register-form">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="user" placeholder="Nom d'usuari *" />
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control inputMajus" name="pass" placeholder="Contrasenya *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Correu electrònic *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text"  class="form-control" name="nom" placeholder="Nom comercial *" value="" />
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control" name="tipusVia">
                                            <option class="hidden" selected disabled>Tipus via *</option>
                                            <option value="Avinguda">Avinguda</option>
                                            <option value="Carrer">Carrer</option>
                                            <option value="Via">Via</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="direccio" placeholder="Nom del carrer" />
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="num" placeholder="Número" value="" />
                                    </div>
                                    
                                    <div class="form-group">
                                        <select class="form-control" id="comarca" name="comarca">
                                            
                                        </select>
                                    </div>
                                    <input type="submit" class="btnRegister" value="Register" />
                                    <input type="submit" class="btnRegister" value="Login" /><br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
