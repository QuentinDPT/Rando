<?php
$PageTitle = "Rando" ;
$UrlHashed = explode("/",$_SERVER['REQUEST_URI']) ;

require("app.config.php") ;

$ProjectForder = "hey" ;
$FolderFilter = "" ;

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
    if(count($UrlHashed) == 2){
      header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
      $PageTitle .= " - Il est où ?" ;
      $ErrorMsg = "<h1>404</h1>Allo chef ? Je suis perdu.." ;
      require("./Views/Error.php") ;
      die() ;
    }
    switch($UrlHashed[2]){
      default:
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
        $PageTitle .= " - Il est où ?" ;
        $ErrorMsg = "<h1>404</h1>Allo chef ? Je suis perdu.." ;
        require("./Views/Error.php") ;
        die();
        break ;
    }
    break ;
  case "error" :
  default :
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
    $PageTitle .= " - Il est où ?" ;
    $ErrorMsg = "<h1>404</h1>Allo chef ? Je suis perdu.." ;
    require("./Views/Error.php") ;
    break ;
}
