<?php

$welcome="<svg version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0' y='0'  xml:space='preserve'>
                                <pattern id='water' width='.25' height='1.1' patternContentUnits='objectBoundingBox'>
                                    <path fill='#054669' d='M0.25,1H0c0,0,0-0.659,0-0.916c0.083-0.303,0.158,0.334,0.25,0C0.25,0.327,0.25,1,0.25,1z' />
                                </pattern>
                                <g>
                                    <text id='text' x='0' y='100' style='font-weight:bold;font-size: 48pt; font-family:helvetica'>Welcome</text>
                                </g>

                                <mask id='text-mask'>
                                    <use x='0' y='0' xlink:href='#text' opacity='1' fill='#69a8c9' />
                                </mask>
                                <g id='eff'>
                                    <use x='0' y='0' xlink:href='#text' fill='#ffffff' />
                                    <rect class='water-fill' mask='url(#text-mask)' fill='url(#water)' x='-300' y='60' width='1200' height='120' opacity='0.3'>
                                        <animate attributeType='xml' attributeName='x' from='-300' to='0' repeatCount='indefinite' dur='3s' />
                                    </rect>

                                    <rect class='water-fill' mask='url(#text-mask)' fill='url(#water)' y='75' width='1600' height='120' opacity='0.3'>
                                        <animate attributeType='xml' attributeName='x' from='-400' to='0' repeatCount='indefinite' dur='4s' />
                                    </rect>

                                    <rect class='water-fill' mask='url(#text-mask)' fill='url(#water)' y='85' width='800' height='120' opacity='0.3'>
                                        <animate attributeType='xml' attributeName='x' from='-200' to='0' repeatCount='indefinite' dur='2.4s' />
                                    </rect>

                                    <rect class='water-fill' mask='url(#text-mask)' fill='url(#water)' y='105' width='2000' height='120' opacity='0.3'>
                                        <animate attributeType='xml' attributeName='x' from='-500' to='0' repeatCount='indefinite' dur='3.8s' />
                                    </rect>
                                </g>

                                <use xlink:href='#eff' opacity='0.9' />
                            </svg>";

$ampolla="<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 249 959'><path fill='#42bc38' d='M165.624 52.13c.055.575.108 1.223.108 1.555 1.052 61.053 12.631 107.369 22.105 141.053 23.157 78.948 46.315 156.843 54.736 195.79 3.158 17.894-2.106 46.315-4.21 54.736-2.106 8.422-8.421 23.158-9.474 31.579-1.053 12.631-1.053 30.526 12.631 50.526 6.317 8.421 6.317 28.421 6.317 38.947 1.053 13.684 0 28.421 0 50.526 0 95.79-1.053 185.264-2.106 247.369 0 21.052 4.211 32.631-1.053 56.842-2.105 8.421-7.368 15.789-14.736 21.053-13.684 9.474-32.632 12.631-71.579 15.789-4.211 0-21.053 1.053-33.685 1.053-12.632 0-29.474-1.053-33.685-1.053-38.947-3.158-57.894-6.315-71.578-15.789-7.369-4.211-12.632-12.632-14.737-21.053-5.263-25.264-1.053-35.79-1.053-56.842C2.573 802.105 1.52 713.685.468 616.841c0-22.105-1.052-36.841 0-50.526 0-10.526 0-30.526 6.316-38.947 13.684-21.052 13.684-38.947 12.632-50.526-1.053-8.421-7.37-22.104-9.474-31.579-2.106-7.368-8.422-36.841-4.211-54.736 8.421-37.895 32.632-116.843 54.736-195.79 10.526-33.684 22.105-80 22.105-141.053 0-.254.033-.787.07-1.312a8.814 8.814 0 0 0 2.038.258c13.684 1.052 29.474 1.052 38.947 1.052 9.473 0 25.263 1.053 38.947-1.052.906 0 2.006-.195 3.05-.5z'/><path fill='#000000' d='M78.363 37.895c1.053-3.158 3.157-2.105 3.157-5.263 0-1.053-3.157-1.053-3.157-5.264 0-2.105 2.104-3.158 3.157-5.263 0-1.053-1.053-2.105-1.053-2.105-1.052-1.053-3.157-1.053-2.104-5.263 0-1.053 2.104-3.158 3.157-5.263 1.053-1.053 0-1.053 0-2.105V4.211c0-1.053 0-2.105 1.053-2.105S113.099 0 123.625 0s40 1.053 41.053 2.105c1.053 0 1.053 1.052 1.053 2.105v5.263c2.105 2.105 3.158 4.21 3.158 5.263 0 4.21-1.053 4.21-2.105 5.263 0 0-1.053 1.053-1.053 2.105 0 2.105 2.105 2.105 3.158 5.263 0 4.211-2.105 4.211-2.105 6.316 0 3.158 2.105 2.105 3.158 5.263 1.052 3.158 1.052 5.263 1.052 6.316 0 2.105 0 4.21-2.104 5.263-1.053 1.053-4.211 2.105-6.316 2.105-13.684 2.105-29.474 1.052-38.947 1.052-9.473 0-25.263 0-38.947-1.052-3.158 0-6.315-2.105-6.315-2.105-1.053-2.105-1.053-4.21-1.053-6.316-1.055-1.051-1.055-3.156 1.051-6.314z'/></svg>";

$esquerra="<div class='col-md-3 register-left'>
                    <div class='row ampolles'>
                        <div class='bottle1'>".$ampolla."
                            
</div>
<div class='bottle2'>
    ".$ampolla."
</div>
</div>
<div class='row' id='avisos'>
    <i class='pin'></i>
    <p id='info'></p>
    ";

                            if(isset($info)){
                                $esquerra.=$info;
                            }

$esquerra.="</div>
<div class='row'>
    <div class='missatge'>
        ".$welcome."
    </div>
</div>
</div>";
if(isset($info_empresa)){
$barra_empresa="<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
                        <a class='navbar-brand' href='#'></a>
                        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarText' aria-controls='navbarText' aria-expanded='false' aria-label='Toggle navigation'>
                            <span class='navbar-toggler-icon'></span>
                        </button><div class='collapse navbar-collapse' id='navbarText'>
                            <ul class='navbar-nav mr-auto'>
                                <li class='nav-item active'>
                                    <a class='nav-link' href='".site_url('Empresa')."'>".$info_empresa['nom']."<span class='sr-only'>(current)</span></a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='".site_url('Empresa/Pujar_producte')."'>Pujar producte</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='".site_url('Empresa/Programar_cata')."'>Programar cata</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='".site_url('Empresa/Veure_valoracions')."'>Visualitzar events</a>
                                </li>
                            </ul>
                            <a class='nav-link nav-item' href='".site_url('Inici/logout')."'>
                                Sortir
                            </a>
                        </div></nav>";
}

if(isset($info_client)){
    $barra_client="<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
                        <a class='navbar-brand' href='#'></a>
                        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarText' aria-controls='navbarText' aria-expanded='false' aria-label='Toggle navigation'>
                            <span class='navbar-toggler-icon'></span>
                        </button><div class='collapse navbar-collapse' id='navbarText'>
                            <ul class='navbar-nav mr-auto'>
                                <li class='nav-item active'>
                                    <a class='nav-link' href='".site_url('Cliente')."'>".$info_client['username']."<span class='sr-only'>(current)</span></a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='".site_url('Cliente/apuntar')."'>Apuntar-se a un event</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='".site_url('Cliente/meusEvents')."'>Els meus events</a>
                                </li>
                            </ul>
                            <a class='nav-link nav-item' href='".site_url('Inici/logout')."'>
                                Sortir
                            </a>
                        </div></nav>";
}
?>
