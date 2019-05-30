window.addEventListener('load', function () {
    spans = document.getElementsByClassName('estrella');
    primer_cop = true;
    if (primer_cop == true) {
        //&& document.getElementById('hidden_valoracio').value!=0
        console.info(document.getElementById('hidden_valoracio').value);
        canvi_color();
    }
    for (let i = 0; i < spans.length; i++) {
        spans[i].addEventListener('mouseenter', canvi_color);
        spans[i].addEventListener('mouseout', desmarcar);
        spans[i].addEventListener('click', seleccionar_valor);
    }
});
let primer_cop;
let spans;

function desmarcar() {
    for (let i = 0; i < spans.length; i++) {
        spans[i].style.color = 'black';
    }
}

function canvi_color() {
    let maxim;
    if (primer_cop) {
        maxim = document.getElementById('hidden_valoracio').value;
        primer_cop = false;
    } else {
        maxim = this.getAttribute('name');
    }

    console.info("estas entrant " + maxim);
    for (let i = 0; i < maxim; i++) {
        spans[i].style.color = 'orange';
    }
}

function seleccionar_valor() {
    let maxim = this.getAttribute('name');
    console.info(maxim);
    for (let i = 0; i < spans.length; i++) {
        spans[i].style.color = 'black';
        if (i < maxim) {
            spans[i].style.color = 'orange';
        }
        spans[i].removeEventListener('mouseenter', canvi_color);
        spans[i].removeEventListener('mouseout', desmarcar);
    }
    document.getElementById('hidden_valoracio').value = maxim;
}
