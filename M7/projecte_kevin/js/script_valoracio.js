window.addEventListener('load',function(){
    spans=document.getElementsByTagName('span');
    for(let i=0;i<spans.length;i++){
        spans[i].addEventListener('mouseenter',canvi_color);
        spans[i].addEventListener('mouseout',desmarcar);
        spans[i].addEventListener('click',seleccionar_valor);
    }
});
let spans;
function desmarcar(){
    for(let i=0;i<spans.length;i++){
        spans[i].style.color='black';
    }
}

function canvi_color(){
    let maxim=this.getAttribute('name');
    for(let i=0;i<maxim;i++){
        spans[i].style.color='red';
    }
    //console.info(this.getAttribute('name'));
}

function seleccionar_valor(){
    let maxim=this.getAttribute('name');
    for(let i=0;i<spans.length;i++){
        spans[i].style.color='black';
        if(i<maxim){
            spans[i].style.color='red';
        }
        spans[i].removeEventListener('mouseenter',canvi_color);
        spans[i].removeEventListener('mouseout',desmarcar);
    }
    document.getElementById('hidden_valoracio').value=maxim;
}