<?php

require_once("Models/AccessDB.php");
require_once("Models/User.ViewModel.php");

class UserController{

  private static function GetBdd() {
    $bdd = new AccessDB();
    $bdd->connect();
    return $bdd;
  }

  function logUser($Name, $EMail, $GoogleUID, $ImageURL){
    if($this->_userExist($GoogleUID)){
      return $this->_getUserVM($this->_getUIDFromGoogleUID($GoogleUID)) ;
    }else{
      $UID = $this->_addUser($Name,$EMail,$GoogleUID);
      $ImageID = $this->_addImage($UID,$ImageURL);
      $this->_updateImage($UID,$ImageID);
      return $this->_getUserVM($UID) ;
    }
  }

  private function _userExist($GoogleUID){
    $bdd = UserController::GetBdd();
    $request = "SELECT * FROM Users WHERE UPPER(GoogleUID)=UPPER('". $GoogleUID ."')" ;
    $result = $bdd->select($request, []);
    return count($result) != 0 ;
  }

  private function _getUIDFromGoogleUID($GoogleUID){
    $bdd = UserController::GetBdd();
    $request = "SELECT UserID FROM Users WHERE UPPER(GoogleUID)=UPPER('".$GoogleUID."')" ;
    $result = $bdd->select($request, []);
    return $result[0]["UserID"] ;
  }

  private function _getUserVM($ID){
    $bdd = UserController::GetBdd();
    $request = "SELECT * FROM ViewUser WHERE UserID=$ID" ;
    $result = $bdd->select($request, []);
    return new UserViewModel(
      $result[0]["UserID"],
      $result[0]["GoogleUID"],
      $result[0]["Name"],
      $result[0]["EMail"],
      $result[0]["Verrified"],
      $result[0]["ImageURL"]
    );
  }

  private function _addUser($Name, $EMail, $GoogleUID){
    $bdd = UserController::GetBdd();
    $request = "INSERT INTO Users (Name, EMail, GoogleUID)
                VALUES ('$Name', '$EMail', '$GoogleUID')" ;
    return $bdd->insert($request, []);
  }

  private function _updateImage($UID, $ImageID){
    $bdd = UserController::GetBdd();
    $request = "UPDATE Users SET ImageID=$ImageID WHERE UserID=$UID" ;
    return $bdd->update($request, []);
  }

  private function _addImage($UID, $URL){
    $bdd = UserController::GetBdd();
    $request = "INSERT INTO Images (UID, URL)
                VALUES ('".$UID."', '".$URL."')" ;
    return $bdd->insert($request, []);
  }
}
