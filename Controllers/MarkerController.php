<?php

require("Models/MarkerResponse.php");
require("Models/AccessDB.php");

class MarkerController{
  public function __construct(){

  }

  private static function GetBdd() {
    $bdd = new AccessDB();
    $bdd->connect();
    return $bdd;
  }

  public function getAllMarkers(){
    $APIs = [];

    $Rando = [];
    $Rando[] = new API("ViaFerrata","Via ferrata","#FF00FF","https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM");
    $Rando[] = new API("Compostelle","Compostelle","#FF00FF","https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM");

    $APIs[] = new APIsContainer("Randonné",$Rando);

    $Life = [];
    $Life[] = new API("Refuge","Refuge","#FF00FF","https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM");
    $Life[] = new API("Bivouac","Lieu de bivouac","#FF00FF","https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM");
    $Life[] = new API("Camp","Camping","#FF00FF","https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM");

    $APIs[] = new APIsContainer("Lieu de vie",$Life);

    $Monuments = [];
    $Monuments[] = new API("Ruine","Ruine","#FF00FF","https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM");
    $Monuments[] = new API("Chateau","Chateau","#FF00FF","https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM");
    $Monuments[] = new API("Bunker","Bunker","#FF00FF","https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM");

    $APIs[] = new APIsContainer("Monuments",$Monuments);

    $Water = [];
    $Water[] = new API("WaterDrinkable","Eau potable","#FF00FF","https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM");
    $Water[] = new API("WaterSpring","Source d'eau","#FF00FF","https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM");
    $Water[] = new API("WaterBathing","Lieu de baignade","#FF00FF","https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM");
    $Water[] = new API("WaterFalls","Cascade","#FF00FF","https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM");

    $APIs[] = new APIsContainer("Eau",$Water);

    $Weather = [] ;
    $Weather[] = new API("Temps","Températures","#FF00FF","https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM");
    $Weather[] = new API("Rain","Précipitations","#FF00FF","https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM");
    $Weather[] = new API("Wind","Vent","#FF00FF","https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM");

    $APIs[] = new APIsContainer("Météo",$Weather);

    $FFVL = [] ;
    $FFVL[] = new API("Sites","Sites","#0000FF","https://data.ffvl.fr/json/sites.json","lat","lon","nom");
    $FFVL[] = new API("Balises","Balises","#00FF00","https://data.ffvl.fr/json/balises.json","latitude","longitude","nom");
    $FFVL[] = new API("Structures","Structures","#FFA500","https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM");

    $APIs[] = new APIsContainer("FFVL",$FFVL);
    $APIs[] = new APIsContainer("Autre",[]);

    return $APIs ;
  }

  public function addMarker($MarkerCategory, $MarkerType, $UID, $lat, $lon, $Name, $Description){
      $bdd = MarkerController::GetBdd();
      $req = "INSERT INTO Markers (MarkerCategory, MarkerType, UID, lat, lon, Name, Description)
              VALUES ('$MarkerCategory', '$MarkerType', '$UID', $lat, $lon, '$Name', '$Description')";
      $res = $bdd->insert($req, []);
      var_dump($res);
      var_dump($bdd);

      if ($res === false) {
        echo "Error while executing request";
        die();
      }
  }

  public function exist($markerString){
    return in_array($markerString,$this->getAllMarkerTypes());
  }
}
