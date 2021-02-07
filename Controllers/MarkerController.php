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
    $Rando[] = new API("ViaFerrata","Via ferrata","#FF00FF");
    $Rando[] = new API("Compostelle","Compostelle","#FF00FF");

    $APIs[] = new APIsContainer("Randonné",$Rando);

    $Life = [];
    $Life[] = new API("Refuge","Refuge","#FF00FF");
    $Life[] = new API("Bivouac","Lieu de bivouac","#FF00FF");
    $Life[] = new API("Camp","Camping","#FF00FF");

    $APIs[] = new APIsContainer("Lieu de vie",$Life);

    $Monuments = [];
    $Monuments[] = new API("Ruine","Ruine","#FF00FF");
    $Monuments[] = new API("Chateau","Chateau","#FF00FF");
    $Monuments[] = new API("Bunker","Bunker","#FF00FF");

    $APIs[] = new APIsContainer("Monuments",$Monuments);

    $Water = [];
    $Water[] = new API("WaterDrinkable","Eau potable","#FF00FF");
    $Water[] = new API("WaterSpring","Source d'eau","#FF00FF");
    $Water[] = new API("WaterBathing","Lieu de baignade","#FF00FF");
    $Water[] = new API("WaterFalls","Cascade","#FF00FF");

    $APIs[] = new APIsContainer("Eau",$Water);

    $Weather = [] ;
    $Weather[] = new API("Temps","Températures","#FF00FF");
    $Weather[] = new API("Rain","Précipitations","#FF00FF");
    $Weather[] = new API("Wind","Vent","#FF00FF");

    $APIs[] = new APIsContainer("Météo",$Weather);

    $FFVL = [] ;
    $FFVL[] = new API("Sites","Sites","#0000FF","https://data.ffvl.fr/json/sites.json","lat","lon","nom");
    $FFVL[] = new API("Balises","Balises","#00FF00","https://data.ffvl.fr/json/balises.json","latitude","longitude","nom");
    $FFVL[] = new API("Structures","Structures","#FFA500","https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM");

    $APIs[] = new APIsContainer("FFVL",$FFVL);
    $APIs[] = new APIsContainer("Autre",[new API("Other","Autre","#FF00FF")]);

    return $APIs ;
  }

  public function getMarkers($MarkerType){
    $bdd = MarkerController::GetBdd();
    $request = "SELECT * FROM markers WHERE UPPER(MarkerType)=UPPER('". $MarkerType ."')" ;
    $markers = $bdd->select($request, []);
    $list = [];
    for ($i=0; $i < count($markers); $i++) {
        $list[] = new Marker(
            $markers[$i]["Name"],
            $markers[$i]["lat"],
            $markers[$i]["lon"]
        );
    }
    return $list;
  }

  public function addMarker($MarkerCategory, $MarkerType, $UID, $lat, $lon, $Name, $Description){
    $bdd = MarkerController::GetBdd();
    $req = "INSERT INTO markers (MarkerCategory, MarkerType, UID, lat, lon, Name, Description)
            VALUES ('$MarkerCategory', '$MarkerType', '$UID', $lat, $lon, '$Name', '$Description')";
    $res = $bdd->insert($req, []);
    var_dump($res);

    if ($res === false) {
      echo "Error while executing request";
      die();
    }
  }

  public function exist($markerString){
    $markers = $this->getAllMarkers();
    for ($i=0; $i < count($markers); $i++) {
      for ($j=0; $j < count($markers[$i]->APIs); $j++){
        if($markers[$i]->APIs[$j]->Name == $markerString)
          return true;
      }
    }
    return false;
  }
}
