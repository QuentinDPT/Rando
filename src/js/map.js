// On initialise la latitude et la longitude de Paris (centre de la carte)
var macarte = null;

var userMarker = null;
var userLocation = {lat:0,lon:0};

// Fonction d'initialisation de la carte
function initMap() {
  // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
  macarte = L.map('map').setView([46.976752, 2.650834], 6);

  // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
  satNormalLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    minZoom: 3,
    maxZoom: 16
  }).addTo(macarte);

  var Stamen_TonerHybrid = L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/toner-hybrid/{z}/{x}/{y}{r}.{ext}', {
    subdomains: 'abcd',
    minZoom: 3,
    maxZoom: 16,
    ext: 'png'
  }).addTo(macarte);
  macarte.removeControl(macarte.zoomControl);

  centerize();
}


function centerize(){
  if(userLocation.lat != 0 && userLocation.lon != 0)
    macarte.setView([userLocation.lat, userLocation.lon]);

  getLocation(function(position){
    document.getElementById("recenterizeBtn").style.display = "flex" ;
    if(userLocation.lat == 0 && userLocation.lon == 0)
      macarte.setView([position.coords.latitude, position.coords.longitude], 14);
    userLocation.lat = position.coords.latitude;
    userLocation.lon = position.coords.longitude;
    if(userMarker == null || userMarker == undefined){
      var userIcon ;
      if(GUser != null && GUser.avatar != null && GUser.avatar != ""){
        userIcon = L.icon({
          iconUrl: GUser.avatar,
          iconSize: [60, 60],
          iconAnchor: [30, 30],
          popupAnchor: [0, 0],
        });
      }else{
        userIcon = L.icon({
          iconUrl: "/src/img/bobby.png",
          iconSize: [60, 60],
          iconAnchor: [30, 30],
          popupAnchor: [0, 0],
        });
      }
      userMarker = L.marker(
          [userLocation.lat, userLocation.lon],
          {icon:userIcon}
        )
        .addTo(macarte);
      userMarker._icon.style.borderRadius = "50%" ;
    }else{
      userMarker.setLatLng([userLocation.lat, userLocation.lon]);
    }
  });
}

function getLocation(fct) {
 if (navigator.geolocation) {
   navigator.geolocation.getCurrentPosition(fct);
 } else {
   alert("Geolocation is not supported by this browser.");
 }
}

window.onload = function(){
  // Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
  initMap();
};

function searchEngines(){
  var searchText = document.getElementById("searchText");
  var searchBtn = document.getElementById("searchBtn");

  var search = function(){
    $.ajax({
      url:"https://api-adresse.data.gouv.fr/search/?q="+searchText.value.replace(" ","+"),
      success: function(result){
        macarte.setView([result.features[0].geometry.coordinates[1], result.features[0].geometry.coordinates[0]], 12);
      }
    }) ;

  }

  searchBtn.onclick = search ;
  searchText.onchange = search ;
  searchText.onkeydown = function(e){ if(e.key == 13){ search(); } } ;
}
searchEngines() ;
