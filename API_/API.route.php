<?php

if($CurrentURL->size() == 1){
  new Error404();
}
switch($CurrentURL->get(1)){
  case "markers":
    require("API_/Markers/markers.route.php") ;
    break ;
  default:
    new Error404();
    break ;
}