<?php

require("Controllers/WaterController.php");

if($CurrentURL->size() == 3){
  new Error404();
}

$WaterController = new WaterController();

switch(lcfirst($CurrentURL->get(3))){
  case "drinkable":
    if($CurrentURL->size() == 4){
      header('Content-type: application/json');
      echo json_encode( $WaterController->getWaterDrinkable() );
      die();
    }
    switch(lcfirst($CurrentURL->get(3))){
      case "add":
        $WaterController->
    };
    die();
    break ;
  default:
    new Error404();
    break ;
}
