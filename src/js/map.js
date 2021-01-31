// On initialise la latitude et la longitude de Paris (centre de la carte)
var macarte = null;

var userMarker = null;
var userLocation = {lat:0,lon:0};
var balises = [] ;
var balisesPin = [];
var structures = [] ;
var structuresPin = [];
var sites = [] ;
var sitesPin = [];

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

  // Balises
  $.ajax({
    url:"https://data.ffvl.fr/json/balises.json",
    success: function(result){
      balises = result;
    }
  }) ;

  // Structures
  $.ajax({
    url:"https://data.ffvl.fr/json/structures.json",
    success: function(result){
      structures = result;
    }
  }) ;

  // Sites
  $.ajax({
    url:"https://data.ffvl.fr/json/sites.json",
    success: function(result){
      sites = result;
    }
  }) ;
}


function centerize(){
  if(userLocation.lat != 0 && userLocation.lon != 0)
    macarte.setView([userLocation.lat, userLocation.lon]);

  getLocation(function(position){
    document.getElementById("recenterizeBtn").style.display = "" ;
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

document.getElementById("sitesCheckbox").onclick = toggleSites ;
document.getElementById("structuresCheckbox").onclick = toggleStructures ;
document.getElementById("balisesCheckbox").onclick = toggleBalises ;

function toggleStructures(){
  if(structuresPin.length != 0)
    hideStructures();
  else
    showStructures();
}

function toggleBalises(){
  if(balisesPin.length != 0)
    hideBalises();
  else
    showBalises();
}

function toggleSites(){
  if(sitesPin.length != 0)
    hideSites();
  else
    showSites();
}


function showStructures(){
  if(structuresPin.length != 0)
    return ;
  var materiel = L.icon({
    iconUrl: "/src/img/sac2.png",
    iconSize: [30, 30],
    iconAnchor: [15, 30],
    popupAnchor: [0, -30],
  });
  for (structure in structures) {
    switch(structures[structure].TYPE){
      case "ECOLE":
        var marker = L.marker(
            [structures[structure].STRU_LATITUDE, structures[structure].STRU_LONGITUDE],
            {icon:materiel}
          )
          .addTo(macarte)
          .bindPopup("École<br>" + structures[structure].STRU_NOM);
        structuresPin.push(marker) ;
        break ;
      case "CLUB":
        var marker = L.marker(
            [structures[structure].STRU_LATITUDE, structures[structure].STRU_LONGITUDE],
            {icon:materiel}
          )
          .addTo(macarte)
          .bindPopup("Club<br>" + structures[structure].STRU_NOM);
        structuresPin.push(marker) ;
        break ;
      case "CLUB-ECOLE":
        var marker = L.marker(
            [structures[structure].STRU_LATITUDE, structures[structure].STRU_LONGITUDE],
            {icon:materiel}
          )
          .addTo(macarte)
          .bindPopup("Club & école<br>" + structures[structure].STRU_NOM);
        structuresPin.push(marker) ;
        break ;
      case "EDUCATION NATIONALE":
        var marker = L.marker(
            [structures[structure].STRU_LATITUDE, structures[structure].STRU_LONGITUDE],
            {icon:materiel}
          )
          .addTo(macarte)
          .bindPopup("École scolaire<br>" + structures[structure].STRU_NOM);
        structuresPin.push(marker) ;
        break ;
      default:
        var marker = L.marker(
            [structures[structure].STRU_LATITUDE, structures[structure].STRU_LONGITUDE],
            {icon:materiel}
          )
          .addTo(macarte)
          .bindPopup(structures[structure].TYPE + "<br>" +structures[structure].STRU_NOM);
        structuresPin.push(marker) ;
    }
  }
}

function hideStructures(){
  for (var pin of structuresPin) {
    pin.remove();
  }
  structuresPin = [] ;
}

function showBalises(){
  if(balisesPin.length != 0)
    return;
  var myIcon = L.icon({
    iconUrl: "/src/img/balise.png",
    iconSize: [30, 30],
    iconAnchor: [15, 30],
    popupAnchor: [0, -30],
  });
  for (balise in balises) {
    var marker = L.marker(
        [balises[balise].latitude, balises[balise].longitude],
        {icon:myIcon}
      )
      .addTo(macarte)
      .bindPopup('Balise');
    balisesPin.push(marker);
  }
}

function hideBalises(){
  for (var pin of balisesPin) {
    pin.remove();
  }
  balisesPin = [] ;
}

function showSites(){
  if(sitesPin.length != 0)
    return;

  var iconSimple = L.icon({
    iconUrl: "/src/img/site.png",
    iconSize: [30, 30],
    iconAnchor: [15, 30],
    popupAnchor: [0, -30],
  });
  var iconDeco = L.icon({
    iconUrl: "/src/img/site-deco.png",
    iconSize: [30, 30],
    iconAnchor: [15, 30],
    popupAnchor: [0, -30],
  });
  var iconAttero = L.icon({
    iconUrl: "/src/img/site-attero.png",
    iconSize: [30, 30],
    iconAnchor: [15, 30],
    popupAnchor: [0, -30],
  });

  for (site in sites) {
    if(sites[site].site_sous_type == "Décollage"){
      var marker = L.marker(
          [sites[site].lat, sites[site].lon],
          {icon:iconDeco}
        )
        .addTo(macarte)
        .bindPopup(sites[site].nom + "<br>" + sites[site].pratiques);
      sitesPin.push(marker);
    }else if(sites[site].site_sous_type == "Atterrissage"){
      var marker = L.marker(
          [sites[site].lat, sites[site].lon],
          {icon:iconAttero}
        )
        .addTo(macarte)
        .bindPopup(sites[site].nom + "<br>" + sites[site].pratiques);
      sitesPin.push(marker);
    }else{
      var marker = L.marker(
          [sites[site].lat, sites[site].lon],
          {icon:iconSimple}
        )
        .addTo(macarte)
        .bindPopup(sites[site].site_sous_type + "<br>" + sites[site].nom + "<br>" + sites[site].pratiques);
      sitesPin.push(marker);
    }
  }
}

function hideSites(){
    for (var pin of sitesPin) {
      pin.remove();
    }
    sitesPin = [] ;
}


function searchEngines(){
  var searchText = document.getElementById("searchText");
  var searchBtn = document.getElementById("searchBtn");

  var search = function(){
    $.ajax({
      url:"https://api-adresse.data.gouv.fr/search/?q="+searchText.value.replace(" ","+"),
      success: function(result){
        console.log(result);
        macarte.setView([result.features[0].geometry.coordinates[1], result.features[0].geometry.coordinates[0]], 12);
      }
    }) ;

  }

  searchBtn.onclick = search ;
  searchText.onchange = search ;
  searchText.onkeydown = function(e){ if(e.key == 13){ search(); } } ;
}
searchEngines() ;
