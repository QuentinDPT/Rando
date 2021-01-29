<?php
// PC router
echo $CurrentURL->get(0) ;

switch($CurrentURL->get(0)){
  case "home" :
    header("Location: ./");
    break ;
  case "" :
    new Page($Location,"Home");
    break ;
  default:
    header("Location: ./");
}
