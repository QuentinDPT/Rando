<?php

require_once("Models/AccessDB.php");
require("Models/Category.php");

class CategoriesController{
  public function __construct(){

  }

  private static function GetBdd() {
    $bdd = new AccessDB();
    $bdd->connect();
    return $bdd;
  }

  public function getCategories(){
    $bdd = CategoriesController::GetBdd();
    $request = "SELECT * FROM Categories GROUP BY CategoryName" ;
    $CategoryList = $bdd->select($request, []);
    $list = [];

    for ($i=0; $i < count($CategoryList); $i++) {
      $request = "sELECT * FROM Categories WHERE CategoryName='".$CategoryList[$i]["CategoryName"]."'";
      $elements = $bdd->select($request, []);
      $apis = [] ;
      for($j=0; $j < count($elements); $j++){
        $apis[] = new Category(
          $elements[$j]["CategID"],
          $elements[$j]["CategoryName"],
          $elements[$j]["DataName"],
          $elements[$j]["DisplayName"],
          $elements[$j]["Color"]
        );
      }
      $list[] = new CategoryContainer($CategoryList[$i]["CategoryName"],$apis) ;
    }
    //*/
    return $list;
  }

  public function exist($markerString){
    $bdd = CategoriesController::GetBdd();
    $request = "sELECT count(*) FROM Categories WHERE UPPER(DataName)=UPPER('".$markerString."')" ;
    $count = $bdd->select($request, []);
    return $count[0]["count(*)"] != "0";
  }
}
