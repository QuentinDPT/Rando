<?php

require("Models/AccessDB.php");

class CategoriesController{
  public function __construct(){

  }

  private static function GetBdd() {
    $bdd = new AccessDB();
    $bdd->connect();
    return $bdd;
  }


}
