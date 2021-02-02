
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
