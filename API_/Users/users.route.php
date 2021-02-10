<?php

if($CurrentURL->size() == 2){
  new Error404($CurrentURL);
  die() ;
}

if($CurrentURL->get(2) == "log"){
  $data = json_decode(file_get_contents('php://input'), true);
  (new UserController())->logUser(
    $data["category"],
    $data["category"],
    $data["uid"],
    $data["location"]["lat"],
    $data["location"]["lon"],
    $data["name"],
    $data["description"]
  );
  die();
}
