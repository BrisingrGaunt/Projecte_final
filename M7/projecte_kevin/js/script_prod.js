window.addEventListener('load', function () {
    let boto=document.querySelector("input[type='button']");
    console.info(boto);
    boto.addEventListener('click', function () {
        let formulari=this.parentElement.parentElement.parentElement;
        let elements_form=formulari.elements;
        let errors=false;
        for(let i=0;i<elements_form.length;i++){
            if(elements_form[i].type!="button" || elements_form[i].type!="hidden"){
                if(elements_form[i].value.length==0){
                    errors=true;
                }
            }
        }
        if(errors){
            info.innerHTML="<br><b>Els camps no poden estar buits</b>";
        }
        else{
            info.innerHTML="";
            formulari.submit();
        }
    });
});
