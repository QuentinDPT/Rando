<?php

$Location = "Views/" ;

switch($Device){
  case ClientType::Mobile :
    $Location .= "Mobile/" ;
    require("Mobile/router.php") ;
    break ;
  case ClientType::PC :
  default:
    $Location .= "PC/" ;
    require("PC/router.php") ;
    break ;
}
