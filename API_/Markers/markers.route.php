<?php

require("Controllers/MarkerController.php") ;

if($CurrentURL->size() == 2){
  header('Content-type: application/json');
  echo json_encode( (new MarkerController())->getAllMarkers() );
  die();
}

if($CurrentURL->get(2) == "add"){
  $data = json_decode(file_get_contents('php://input'), true);
  (new MarkerController())->addMarker(
    $data["category"],
    $data["category"],
    $data["uid"],
    $data["location"]["lat"],
    $data["location"]["lon"],
    $data["name"],
    $data["description"]
  );
  die();
}

if(!(new MarkerController())->exist(ucfirst($CurrentURL->get(2))))
  new Error404($CurrentURL);

require("API_/Markers/" . lcfirst($CurrentURL->get(2)) . ".route.php") ;
