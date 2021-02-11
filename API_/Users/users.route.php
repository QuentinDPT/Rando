<?php

require("Controllers/UserController.php");

if($CurrentURL->size() == 2){
  new Error404($CurrentURL);
  die() ;
}

if($CurrentURL->get(2) == "log"){
  $data = json_decode(file_get_contents('php://input'), true);
  header('Content-type: application/json');
  echo json_encode(
    (new UserController())->logUser(
      $data["Name"],
      $data["EMail"],
      $data["GoogleUID"],
      $data["ImageURL"]
    )
  );
  die();
}
