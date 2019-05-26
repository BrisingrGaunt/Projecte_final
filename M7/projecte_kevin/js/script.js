window.addEventListener('load', function () {
    inputs = document.getElementsByClassName('inputMajus');
    for (let i = 0; i < inputs.length; i++) {
        inputs[i].addEventListener('keyup', comprovarMajuscula);
        inputs[i].addEventListener('keyup', comprovarSeguretat);
    }
    
    document.getElementById('home-tab').addEventListener('click', function () {
        login_usuari.style.display = 'block';
    });
    
    let botons=document.getElementsByClassName('btnRegister');
    
    for(let i=0;i<botons.length;i++){
        botons[i].addEventListener('click', validarCamps);
    }
    
    document.getElementById('profile-tab').addEventListener('click', function () {
        login_empresa.style.display = 'block';
    });
    
    checks = document.getElementsByName("mostrarPass");
    for (let i = 0; i < checks.length; i++) {
        checks[i].addEventListener('click', mostrarContrasenya);
    }
    //mostrarPass.addEventListener('click', mostrarContrasenya);
    // contrasenya.addEventListener('keyup', comprovarSeguretat);
    //cred.addEventListener('click',desarCredencials);
    let ruta = 'https://api.idescat.cat/emex/v1/nodes.json?tipus=mun';
    let peticio = $.post(ruta);
    peticio.done(exit);
    peticio.fail(fracas);
    tabs = document.getElementsByClassName("opcio_inici");
    for (let i = 0; i < tabs.length; i++) {
        tabs[i].addEventListener('click', obrirPestanya);
    }
    barres = document.getElementsByTagName('progress');
    for (let i = 0; i < barres.length; i++) {
        barres[i].value = 0;
    }
});

function validarCamps(){
    //Ens quedem amb el formulari al qual pertany el botó que ha sigut clicat
    let form=this.parentElement; 
    //El nom del formulari ens indicarà el tipus de validació que aplicarem:
    // Valors:
    // 0 - Login (només es comprovarà que els inputs no siguin buits)
    // 1 - Registre d'usuari (es comprova llargades, seguretat de password, i email correcte)
    // 2 - Registre d'empresa (es comprova llargades, seguretat de password, email correcte i la resta de dades del formulari)
    
    let validacions=[[/\w{6,}/],[/\w{6,}/,/^[\w\.]{6,}@\w{4,}\.[a-z]{2,5}$/],[/\w{6,}/,/^[\w\.]{6,}@\w{4,}\.[a-z]{2,5}$/,/\w{6,}/,/^((?!Tipus via).)*$/,/\w{6,}/,/^\d{1,}$/,/^((?!Població).)*$/]];
    
    let errors_text=['Camp usuari',"Camp email","Camp nom", "Camp tipusVia", "Camp direccio","Camp num", "Camp comarca",'Contrasenya: mínim 8 caràcters, 1 núm, 1 majus, 1 minus i 1 símbol'];

    let elements_form=this.parentElement.elements;
    let valid=true;
    
    let index=0;
    let errors=[];
    for(let i=0;i<elements_form.length;i++){
        if(elements_form[i].type!='button' && elements_form[i].type!='checkbox' && elements_form[i].type!="hidden"){
            if(elements_form[i].type=="password"){
                //si existeix la barra de progrés
                let pass_correcte=true;
                if(typeof form.getElementsByTagName('progress')[0]!="undefined"){
                    form.getElementsByTagName('progress')[0].value==5?pass_correcte=pass_correcte:pass_correcte=false;
                }
                else{
                    //si no existeix barra de progrés només es comprova que el camp no vingui buit ja que la contrasenya que
                    //s'entra ha de ser vàlida (ja que ha passat previament pel formulari de registre)
                    elements_form[i].value.length>6?pass_correcte=pass_correcte:pass_correcte=false;
                }
                if(pass_correcte==false){
                    valid=false;
                    errors.push(7);
                }
            }
            else{
                if(validacions[form.name][index].test(elements_form[i].value)==false){
                    valid=false;
                    errors.push(index);
                }
                index++;
            }
        }
    }
    if(valid){
        form.submit();
    }
    else{
        let cadena="Revisa els següents camps:<br>"
        for(let i=0;i<errors.length;i++){
            //es recorren tots els errors
            cadena+="- "+errors_text[errors[i]]+"<br>";
        }
        info.innerHTML=cadena;
    }
}

let tabs;
let barres;
let inputs;
let checks;

function obrirPestanya(evt) {
    // console.info(inputs);
    for (let i = 0; i < inputs.length; i++) {
        inputs[i].value = "";
    }
    for (let i = 0; i < barres.length; i++) {
        barres[i].value = 0;
    }
    let id = evt.currentTarget.id.split("-")[0];
    //console.info(id);
    let opcions = document.getElementsByClassName("content");
    for (let i = 0; i < opcions.length; i++) {
        opcions[i].style.display = 'none';
    }

    for (let i = 0; i < tabs.length; i++) {
        tabs[i].className = tabs[i].className.replace("active", "");
    }
    document.getElementById(id).style.display = "block";
    evt.currentTarget.className += " active";
}

function exit(dades) {
    let cadena = "<option class='hidden' selected disabled>Població</option>";
    for (let i = 0; i < dades.fitxes.v.length; i++) {
        cadena += "<option value='" + dades.fitxes.v[i].content + "'>" + dades.fitxes.v[i].content + "</option>";
    }
    comarca.innerHTML = cadena;
}

function fracas() {
    console.info("Error al carregar el desplegable de comarques");
}

let pass = "";

function comprovarMajuscula(ev) {
    if (ev.getModifierState("CapsLock") == true) {
        console.info("Majúscules activades");
        info.innerHTML = "Majúscules activades";
    } else {
        console.info("Majúscules desactivades");
        info.innerHTML = "";
    }
}

function comprovarSeguretat() {
    pass = this.value;
    let expressions = [/\d/, /[A-Z]/, /[a-z]/, /(?=.*[@$!%*+_\-?&])/];
    let robustesa = 0;
    if (pass.length > 8) robustesa++;
    for (let i = 0; i < expressions.length; i++) {
        robustesa += comprovarPattern(expressions[i]);
    }
    for (let i = 0; i < barres.length; i++) {
        barres[i].value = robustesa;
    }
}

function desarCredencials() {
    let qt_storage = localStorage.getItem('qt_usuaris');
    qt_storage++;
    localStorage.setItem('username_' + qt_storage, pass);
    localStorage.setItem('pass_' + qt_storage, pass);
    localStorage.setItem('qt_usuaris', qt_storage);
}

function comprovarPattern(pattern) {
    if (pass.match(pattern)) {
        return 1;
    }
    return 0;
}

function mostrarContrasenya() {
    let contrasenya = document.getElementsByClassName('inputMajus');
    for (let i = 0; i < contrasenya.length; i++) {
        if (this.checked) {
            contrasenya[i].setAttribute("type", "text");
        } else {
            contrasenya[i].setAttribute("type", "password");
        }
    }
}
