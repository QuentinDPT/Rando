<?php

class UserViewModel {
  public $UserID;
  public $GoogleUID;
  public $Name;
  public $EMail;
  public $Verrified;
  public $Image;

  public function __construct($UserID, $GoogleUID, $Name, $EMail, $Verrified, $Image){
    $this->UserID = $UserID;
    $this->GoogleUID = $GoogleUID;
    $this->Name = $Name;
    $this->EMail = $EMail;
    $this->Verrified = $Verrified;
    $this->Image = $Image;
  }
}
