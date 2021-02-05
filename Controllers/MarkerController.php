<?php

require("Models/MarkerResponse.php");

class MarkerController{
  public function __construct(){

  }

  public function getAllMarkers(){
    $APIs = [];

    $Rando = [];
    $Rando[] = new API("https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM","ViaFerrata","Via ferrata");
    $Rando[] = new API("https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM","ViaFerrata","Chemin de compostelle");

    $APIs[] = new APIsContainer("Randonné",$Rando);

    $Life = [];
    $Life[] = new API("https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM","Refuge","Refuge");
    $Life[] = new API("https://data.ffvl.fr/json/balises.json","latitude","longitude","nom","Bivouac","Lieu de bivouac");
    $Life[] = new API("https://data.ffvl.fr/json/sites.json","lat","lon","nom","Camp","Camping");

    $APIs[] = new APIsContainer("Lieu de vie",$Life);

    $Monuments = [];
    $Monuments[] = new API("https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM","Ruine","Ruine");
    $Monuments[] = new API("https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM","Bunker","Bunker");

    $APIs[] = new APIsContainer("Monuments",$Monuments);

    $Water = [];
    $Water[] = new API("https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM","WaterDrinkable","Robinet d'eau potable");
    $Water[] = new API("https://data.ffvl.fr/json/balises.json","latitude","longitude","nom","WaterSpring", "Source d'eau");
    $Water[] = new API("https://data.ffvl.fr/json/sites.json","lat","lon","nom","WaterBathing","Lieu de baignade");
    $Water[] = new API("https://data.ffvl.fr/json/sites.json","lat","lon","nom","WaterFalls","Cascade");

    $APIs[] = new APIsContainer("Eau",$Water);

    $Weather = [] ;
    $Weather[] = new API("https://data.ffvl.fr/json/sites.json","lat","lon","nom","Temps","Températures");
    $Weather[] = new API("https://data.ffvl.fr/json/balises.json","latitude","longitude","nom","Rain","Précipitations");
    $Weather[] = new API("https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM","Wind","Vent");

    $APIs[] = new APIsContainer("Météo",$Weather);

    $FFVL = [] ;
    $FFVL[] = new API("https://data.ffvl.fr/json/sites.json","lat","lon","nom","Sites","Sites", "#0000FF");
    $FFVL[] = new API("https://data.ffvl.fr/json/balises.json","latitude","longitude","nom","Balises","Balises", "#00FF00");
    $FFVL[] = new API("https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM","Structures","Structures","#FFA500");

    $APIs[] = new APIsContainer("FFVL",$FFVL);
    $APIs[] = new APIsContainer("Autre",[]);

    return $APIs ;
  }


  public function addMarker($MarkerCategory, $MarkerType, $UID, $lat, $lon, $Name){

  }

  public function exist($markerString){
    return in_array($markerString,$this->getAllMarkerTypes());
  }
}
