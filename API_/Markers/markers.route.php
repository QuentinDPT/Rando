<?php

require("Controllers/MarkerController.php") ;
require("Controllers/CategoriesController.php") ;

if($CurrentURL->size() == 2){
  header('Content-type: application/json');
  echo json_encode( (new CategoriesController())->getCategories() );
  die();
}

if($CurrentURL->get(2) == "add"){
  $data = json_decode(file_get_contents('php://input'), true);
  (new MarkerController())->addMarker(
    $data["category"],
    $data["uid"],
    $data["location"]["lat"],
    $data["location"]["lon"],
    $data["name"],
    $data["description"]
  );
  die();
}

if(!(new CategoriesController())->exist(ucfirst($CurrentURL->get(2))))
  new Error404($CurrentURL);

require("Controllers/FFVLController.php") ;
switch($CurrentURL->get(2)){
  case "LiftOff":
    header('Content-type: application/json');
    echo json_encode( (new FFVLController())->getLiftOff() );
    die();
    break ;
  case "Landing":
    header('Content-type: application/json');
    echo json_encode( (new FFVLController())->getLanding() );
    die();
    break ;
  case "Beacons":
    header('Content-type: application/json');
    echo json_encode( (new FFVLController())->getBeacons() );
    die();
    break ;
  case "Structures":
    header('Content-type: application/json');
    echo json_encode( (new FFVLController())->getStructures() );
    die();
    break ;
}

header('Content-type: application/json');
echo json_encode( (new MarkerController())->getMarkerViewModel($CurrentURL->get(2)) );
