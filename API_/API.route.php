<?php

if($CurrentURL->size() == 1){
  new Error404();
}
switch($CurrentURL->get(1)){
  case "markers":
    require("API_/Markers/markers.route.php") ;
    break ;
  case "users":
    require("API_/Users/users.route.php") ;
    break ;
  case "proximity" :
    die() ;
    break ;
  default:
    new Error404();
    break ;
}
