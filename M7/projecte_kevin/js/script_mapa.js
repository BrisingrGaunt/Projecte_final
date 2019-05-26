$('document').ready(function(){
    let info=document.querySelector('#coordenades').value;
    coordenades=info.split(",");
    mapa.style.width='500px';
    mapa.style.height='400px';
    console.info(coordenades);
    initMap();
});

let coordenades;

function initMap(){
        let latitud = coordenades[0];
        let longitud = coordenades[1];
        let latlon = new google.maps.LatLng(latitud, longitud); 
        
        let myOptions = {
          center: latlon, // centre de myOptions, la posició actual
          zoom: 19, // Nivell de zoom
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          mapTypeControl: false, 
          navigationControl: true, 
          // Mostrar o no els botons de navegació.
          navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL} 
          // Estil dels botons de navegació.
        }

        let map = new google.maps.Map(document.getElementById('mapa'), myOptions);//es crea el objecte map
        console.info(map);
        let marker = new google.maps.Marker(//primer marcador amb els valors del formulari
				{
				position:latlon,
				map:map,
				label: "Aquí ens trobem!"
				}); 
}