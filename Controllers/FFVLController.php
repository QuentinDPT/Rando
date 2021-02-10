<?php

require_once("Models/Marker.php");

class FFVLController{
  public function __construct(){

  }

  public function getLiftOff(){
    $markers = [] ;
    $request = json_decode(file_get_contents("https://data.ffvl.fr/json/sites.json"));
    for($i=0 ; $i<count($request) ; $i++){
      if($request[$i]->site_sous_type == "Décollage")
        $markers[] = new Marker(
          0,
          $request[$i]->nom,
          $request[$i]->description,
          $request[$i]->lat,
          $request[$i]->lon,
          0,
          0,
          12
        );
    }

    return $markers ;
  }

  public function getLanding(){
    $markers = [] ;
    $request = json_decode(file_get_contents("https://data.ffvl.fr/json/sites.json"));
    for($i=0 ; $i<count($request) ; $i++){
      if($request[$i]->site_sous_type == "Atterrissage")
        $markers[] = new Marker(
          0,
          $request[$i]->nom,
          $request[$i]->description,
          $request[$i]->lat,
          $request[$i]->lon,
          0,
          0,
          13
        );
    }

    return $markers ;
  }

  public function getStructures(){
    $markers = [] ;
    $request = json_decode(file_get_contents("https://data.ffvl.fr/json/structures.json"));
    for($i=0 ; $i<count($request) ; $i++){
      $markers[] = new Marker(
        0,
        $request[$i]->STRU_NOM,
        $request[$i]->ACTIVITES,
        $request[$i]->STRU_LATITUDE,
        $request[$i]->STRU_LONGITUDE,
        0,
        0,
        15
      );
    }

    return $markers ;
  }

  public function getBeacons(){
    $markers = [] ;
    $request = json_decode(file_get_contents("https://data.ffvl.fr/json/balises.json"));
    for($i=0 ; $i<count($request) ; $i++){
      $markers[] = new Marker(
        0,
        $request[$i]->nom,
        $request[$i]->remarques,
        $request[$i]->latitude,
        $request[$i]->longitude,
        0,
        0,
        14
      );
    }

    return $markers ;
  }
}
