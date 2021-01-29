<?php

if($CurrentURL->size() == 1){
  die() ;
}
switch($CurrentURL->get(1)){
  case "map":
    require("Controllers/MapController.php") ;
    break ;
  case "marker":
    require("Controllers/MarkerController.php") ;
    break ;
  default:
    die();
    break ;
}
