<?php

if($CurrentURL->get(0) == "api"){
  require("./API/API.route.php") ;
}else{
  require("./Views/Devices.route.php") ;
}


/*
switch($UrlHashed[1]){
  case "home" :
    header("Location: ./");
    break ;
  case "" :
    require("./Views/Home.php") ;
    break ;
  case "projects" :
    require("./Models/Project.php") ;
    require("./Views/Projects.php") ;
    break ;
  case "api" :
    require("./Routers/API.router") ;
    break ;
  case "error" :
  default :
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
    $PageTitle .= " - Il est où ?" ;
    $ErrorMsg = "<h1>404</h1>Allo chef ? Je suis perdu.." ;
    require("./Views/Error.php") ;
    break ;
}
*/
