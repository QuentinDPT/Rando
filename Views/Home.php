<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <!-- Nous chargeons les fichiers CDN de Leaflet. Le CSS AVANT le JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
    <style type="text/css">
      #map{ /* la carte DOIT avoir une hauteur sinon elle n'apparaît pas */
        height:100vh;
      }
      body{
        margin:0;
      }
    </style>
    <title>Carte</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>


    <div id="map">
    </div>

    <!-- Fichiers Javascript -->
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
    <script type="text/javascript">
      // On initialise la latitude et la longitude de Paris (centre de la carte)
      var lat = 48.852969;
      var lon = 2.349903;
      var macarte = null;


      var balises = [] ;
      var structures = [] ;
      var sites = [] ;

      // Fonction d'initialisation de la carte
      function initMap() {
        // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
        macarte = L.map('map').setView([lat, lon], 11);
        // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
        L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
          // Il est toujours bien de laisser le lien vers la source des données
          attribution: 'rendu <a href="//openstreetmap.fr">OSM France</a>',
          minZoom: 1,
          maxZoom: 20
        }).addTo(macarte);


        //*
        // Balises
        $.ajax({
          url:"https://data.ffvl.fr/json/balises.json",
          success: function(result){

            var myIcon = L.icon({
              iconUrl: "/src/img/balise.png",
              iconSize: [30, 30],
              iconAnchor: [15, 30],
              popupAnchor: [0, -30],
            });

            balises = result;
          	for (balise in balises) {

              var marker = L.marker(
                  [balises[balise].latitude, balises[balise].longitude],
                  {icon:myIcon}
                )
                .addTo(macarte)
                .bindPopup('Balise');;

              /*
              $.ajax({
                url:"https://data.ffvl.fr/php/historique_relevesmeteo.php?idbalise=83&heures=3" + balises[balise].idBalise + "&heures=3",
                success: function(result){
                  let r = JSON.parse(result) ;
                  var marker = L.marker([balises[balise].latitude, balises[balise].longitude])
                    .addTo(macarte)
                    .bindPopup('A pretty CSS3 popup.<br> Easily customizable.');
                }
              }) ;
              //*/
          	}
          }
        }) ;

        // Structures
        $.ajax({
          url:"https://data.ffvl.fr/json/structures.json",
          success: function(result){
            var materiel = L.icon({
              iconUrl: "/src/img/sac2.png",
              iconSize: [30, 30],
              iconAnchor: [15, 30],
              popupAnchor: [0, -30],
            });
            structures = result;
          	for (structure in structures) {
              switch(structures[structure].TYPE){
                case "ECOLE":
                  var marker = L.marker(
                      [structures[structure].STRU_LATITUDE, structures[structure].STRU_LONGITUDE],
                      {icon:materiel}
                    )
                    .addTo(macarte)
                    .bindPopup("École<br>" + structures[structure].STRU_NOM);
                  break ;
                case "CLUB":
                  var marker = L.marker(
                      [structures[structure].STRU_LATITUDE, structures[structure].STRU_LONGITUDE],
                      {icon:materiel}
                    )
                    .addTo(macarte)
                    .bindPopup("Club<br>" + structures[structure].STRU_NOM);
                  break ;
                case "CLUB-ECOLE":
                  var marker = L.marker(
                      [structures[structure].STRU_LATITUDE, structures[structure].STRU_LONGITUDE],
                      {icon:materiel}
                    )
                    .addTo(macarte)
                    .bindPopup("Club & école<br>" + structures[structure].STRU_NOM);
                  break ;
                case "EDUCATION NATIONALE":
                  var marker = L.marker(
                      [structures[structure].STRU_LATITUDE, structures[structure].STRU_LONGITUDE],
                      {icon:materiel}
                    )
                    .addTo(macarte)
                    .bindPopup("École scolaire<br>" + structures[structure].STRU_NOM);
                  break ;
                default:
                  var marker = L.marker(
                      [structures[structure].STRU_LATITUDE, structures[structure].STRU_LONGITUDE],
                      {icon:materiel}
                    )
                    .addTo(macarte)
                    .bindPopup(structures[structure].TYPE + "<br>" +structures[structure].STRU_NOM);
              }
          	}
          }
        }) ;

        // Sites
        $.ajax({
          url:"https://data.ffvl.fr/json/sites.json",
          success: function(result){
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

            sites = result;
          	for (site in sites) {
              if(sites[site].site_sous_type == "Décollage"){
                var marker = L.marker(
                    [sites[site].lat, sites[site].lon],
                    {icon:iconDeco}
                  )
                  .addTo(macarte)
                  .bindPopup(sites[site].nom + "<br>" + sites[site].pratiques);
              }else if(sites[site].site_sous_type == "Atterrissage"){
                var marker = L.marker(
                    [sites[site].lat, sites[site].lon],
                    {icon:iconAttero}
                  )
                  .addTo(macarte)
                  .bindPopup(sites[site].nom + "<br>" + sites[site].pratiques);
              }else{
                var marker = L.marker(
                    [sites[site].lat, sites[site].lon],
                    {icon:iconSimple}
                  )
                  .addTo(macarte)
                  .bindPopup(sites[site].site_sous_type + "<br>" + sites[site].nom + "<br>" + sites[site].pratiques);
              }
          	}
          }
        }) ;
        //*
      	// Nous parcourons la liste des villes
        //*/
      }

      window.onload = function(){
        // Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
        initMap();
      };
    </script>
  </body>
</html>
