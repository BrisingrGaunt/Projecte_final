window.addEventListener('load',function(){
    let inputs=document.getElementsByClassName('inputMajus');
    for(let i=0;i<inputs.length;i++)
    {
        inputs[i].addEventListener('keyup', comprovarMajuscula);
    }
    //barra.value=0;
    //mostrarPass.addEventListener('click', mostrarContrasenya);
    //contrasenya.addEventListener('keyup', comprovarSeguretat);
    //cred.addEventListener('click',desarCredencials);
    let ruta='https://api.idescat.cat/emex/v1/nodes.json?tipus=com';
    let peticio = $.post(ruta);  
    peticio.done(exit);
    peticio.fail(fracas);
});

function exit(dades){
    let cadena="<option class='hidden' selected disabled>Comarca *</option>";
    for(let i=0;i<dades.fitxes.v.length;i++){
        cadena+="<option value='"+dades.fitxes.v[i].content+"'>"+dades.fitxes.v[i].content+"</option>";
    }
    comarca.innerHTML=cadena;
}

function fracas(){
    console.info("Error al carregar el desplegable de comarques");
}

let pass="";

function comprovarMajuscula(ev){
    if(ev.getModifierState("CapsLock")==true){
        console.info("Majúscules activades");
        //info.innerHTML="Majúscules activades";
    }
    else{
        console.info("Majúscules desactivades");
        //info.innerHTML="";
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
