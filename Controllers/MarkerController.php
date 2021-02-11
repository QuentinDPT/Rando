<?php

require("Models/Marker.php");
require("Models/Marker.ViewModel.php");
require_once("Models/AccessDB.php");

class MarkerController{
  public function __construct(){

  }

  private static function GetBdd() {
    $bdd = new AccessDB();
    $bdd->connect();
    return $bdd;
  }

  public function getMarkers($MarkerType){
    $bdd = MarkerController::GetBdd();
    $request = "SELECT * FROM Markers WHERE CategoryID=(SELECT CategID from Categories where UPPER(DataName)=UPPER('". $MarkerType ."'))" ;
    $markers = $bdd->select($request, []);
    $list = [];
    for ($i=0; $i < count($markers); $i++) {
      $list[] = new Marker(
        $markers[$i]["MarkerID"],
        $markers[$i]["Name"],
        $markers[$i]["Description"],
        $markers[$i]["lat"],
        $markers[$i]["lon"],
        $markers[$i]["UID"],
        $markers[$i]["CategoryID"],
        $markers[$i]["ImageID"]
      );
    }
    return $list;
  }

  public function getMarkerViewModel($MarkerType){
    $bdd = MarkerController::GetBdd();
    $request = "SELECT * FROM ViewMarker WHERE UPPER(DataName)=UPPER('". $MarkerType ."')" ;
    $markers = $bdd->select($request, []);
    $list = [];
    for ($i=0; $i < count($markers); $i++) {
      $list[] = new MarkerViewModel(
        $markers[$i]["MarkerID"],
        $markers[$i]["Name"],
        $markers[$i]["Description"],
        $markers[$i]["CategoryID"],
        $markers[$i]["CategoryName"],
        $markers[$i]["DataName"],
        $markers[$i]["Color"],
        $markers[$i]["lat"],
        $markers[$i]["lon"],
        $markers[$i]["ImageID"],
        $markers[$i]["ImageURL"],
        $markers[$i]["UID"],
        $markers[$i]["nbVotes"],
        $markers[$i]["avgVotes"]
      );
    }
    return $list;
  }

  public function addMarker($CategoryID, $UID, $lat, $lon, $Name, $Description){
    $bdd = MarkerController::GetBdd();
    $req = "INSERT INTO Markers (CategoryID, UID, lat, lon, Name, Description)
            VALUES ($CategoryID, $UID, $lat, $lon, '$Name', '$Description')";
    $res = $bdd->insert($req, []);

    if ($res === false || $res == 0) {
      echo "Error while executing request";
      die();
    }
  }

}
