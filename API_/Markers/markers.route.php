<?php

require("Controllers/MarkerController.php") ;

if($CurrentURL->size() == 2){
  header('Content-type: application/json');
  echo json_encode( (new MarkerController())->getAllMarkers() );
  die();
}

if($CurrentURL->get(2) == "add"){
  var_dump((new MarkerController())->addMarkerType($CurrentURL->get(2)));
  die();
}

if(!(new MarkerController())->exist(ucfirst($CurrentURL->get(2))))
  new Error404($CurrentURL);

require("API_/Markers/" . lcfirst($CurrentURL->get(2)) . ".route.php") ;
