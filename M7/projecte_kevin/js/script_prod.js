window.addEventListener('load', function () {
    afegirProd.addEventListener('click', function () {
        if (descripcio_producte.value.length == 0 || nom_producte.value.length == 0) {
            info.innerHTML = "<br><b>Els camps no poden estar buits</b>";
        } else {
            info.innerHTML="";
            this.parentElement.submit();
        }
    });
});
