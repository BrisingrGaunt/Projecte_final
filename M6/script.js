window.addEventListener('load',function(){
    let inputs=document.getElementsByClassName('inputMajus');
    for(let i=0;i<inputs.length;i++)
    {
        inputs[i].addEventListener('keyup', comprovarMajuscula);
    }
    barra.value=0;
    mostrarPass.addEventListener('click', mostrarContrasenya);
    contrasenya.addEventListener('keyup', comprovarSeguretat);
    cred.addEventListener('click',desarCredencials);
});

let pass="";

function comprovarMajuscula(ev){
    if(ev.getModifierState("CapsLock")==true){
        info.innerHTML="Majúscules activades";
    }
    else{
        info.innerHTML="";
    }
}

function comprovarSeguretat(){
    pass=contrasenya.value;
    let expressions=[/\d/,/[A-Z]/,/[a-z]/,/(?=.*[@$!%*+_\-?&])/];
    let robustesa=0;
    if(pass.length>8)robustesa++;
    for(let i=0;i<expressions.length;i++){
        robustesa+=comprovarPattern(expressions[i]);
    }
    barra.value=robustesa;
}

function desarCredencials(){
    let qt_storage=localStorage.getItem('qt_usuaris');
    qt_storage++;
    localStorage.setItem('username_'+qt_storage,pass);
    localStorage.setItem('pass_'+qt_storage, pass);
    localStorage.setItem('qt_usuaris',qt_storage);
}

function comprovarPattern(pattern){
    if(pass.match(pattern)){
        return 1;
    }
    return 0;
}

function mostrarContrasenya(){
    if(this.checked){
        contrasenya.setAttribute("type","text");
    }
    else{
        contrasenya.setAttribute("type","password");
    }
}
