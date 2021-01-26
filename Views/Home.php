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

      #search-bar{
        position:fixed;
        top: 2vh;
        left: 10vw;
        right: 10vw;
        height: 40px;
        z-index: 1002;
      }

      #search-bar>*{
        background-color: white;
        height:100%;
        <?php
        if(!$isMobile){
        ?>
        width:800px;
        <?php
        }
        ?>
        max-width: 80vw;
        border-radius: 20px;
        padding-left: 15px;
        padding-right: 15px;
        display: flex;
      }

      #search-bar>div>*{
        background-color: transparent;
        border: none;
      }
      #search-bar>div>#searchText{
        height:100%;
        width:800px;
      }
      #search-bar>div>#searchBtn{
        height:100%;
        width:40px;
      }

      #pinOption{
        position: fixed;
        top: 0;
        bottom: 0;
        min-width: 15px;
        max-width: 70vw;
        z-index: 1001;
        transition: .3s;
      }

      .pinOption{
        width: 15px;
        background-color: #FFFFFF00;
      }

      #pinOption::after{
        content: "";
        position: absolute;
        display: inline-block;

        background-color: #66666696;
        border-radius: 2px;

        width: 5px;
        height: 30px;

        right: 5px;
        top: 50%;
        bottom: 50%;
        margin-top: -50%;
        margin-bottom: -50%;
      }

      #pinOption:hover, .expandOption{
        width:600px;
        background-color: #FFFFFFEE;
      }

      #pinOption>*{
        transform: translateX(-600px);
        transition: .2s;
      }
      #pinOption:hover>*{
        transform: translateX(0);
      }
    </style>
    <title>Rando</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body id="page">
  <div id="map">
  </div>
  <div id="search-bar">
    <div class="">
      <input id="searchText" type="text" name="" value="" placeholder="Search">
      <input id="searchBtn" type="button" name="" value="»">
    </div>
  </div>
  <div id="pinOption" class="pinOption">
    <h2>Options</h2>
    <ul>
      <li><label for="sitesCheckbox">Sites</label><input type="checkbox" id="sitesCheckbox" name="sitesCheckbox"></li>
      <li><label for="structuresCheckbox">Structures</label><input type="checkbox" id="structuresCheckbox" name="structuresCheckbox"></li>
      <li><label for="balisesCheckbox">Balises</label><input type="checkbox" id="balisesCheckbox" name="balisesCheckbox"></li>
    </ul>
  </div>

    <!-- Fichiers Javascript -->
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
    <!-- Map Init data fetch -->
    <script type="text/javascript">
      // On initialise la latitude et la longitude de Paris (centre de la carte)
      var macarte = null;

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
        L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
          // Il est toujours bien de laisser le lien vers la source des données
          attribution: 'rendu <a href="//openstreetmap.fr">OSM France</a>',
          minZoom: 1,
          maxZoom: 17
        }).addTo(macarte);
        macarte.removeControl(macarte.zoomControl);

        getLocation(function(position){
          macarte.setView([position.coords.latitude, position.coords.longitude], 11);
        });

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
              /*
              var marker = L.marker(
                  [balises[balise].latitude, balises[balise].longitude],
                  {icon:myIcon}
                )
                .addTo(macarte)
                .bindPopup('Balise');;
              //*/
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
        //*
      	// Nous parcourons la liste des villes
        //*/
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
    </script>
    <!-- Pin actions -->
    <script type="text/javascript">
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
    </script>
    <!-- Search engine initialisation -->
    <script type="text/javascript">
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
    </script>
    <!-- Option menu -->
    <script type="text/javascript">
      /*
      var option = document.getElementById("pinOption");
      var optionInit = function(){
        option.onclick = function(e){
          console.log(e) ;
          if(option.classList.contains("expandOption"))
            option.retract() ;
          else
            option.expand() ;
        }

        option.expand = function(){
          this.classList.add("expandOption");
        }

        option.retract = function(){
          this.classList.remove("expandOption");
        }
      }
      optionInit() ;
      */
    </script>


    <?php
    if($isMobile){
    ?>
      <script type="text/javascript">
        var elem = document.getElementById("page");
        function openFullscreen() {
          if (elem.requestFullscreen) {
            elem.requestFullscreen();
          } else if (elem.webkitRequestFullscreen) { /* Safari */
            elem.webkitRequestFullscreen();
          } else if (elem.msRequestFullscreen) { /* IE11 */
            elem.msRequestFullscreen();
          }
        }
        document.onmousedown = function(){
          openFullscreen();
        }
      </script>
    <?php }else{ ?>
    <?php } ?>
  </body>
</html>
