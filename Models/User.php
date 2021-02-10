<?php

class User {
  public $UID;
  public $GoogleUID;
  public $ImageID;
  public $Name;
  public $EMail;
  public $Verrified;

  public function __construct($UID, $GoogleUID, $ImageID, $Name, $EMail, $Verrified){
    $this->UID = $UID;
    $this->GoogleUID = $GoogleUID;
    $this->ImageID = $ImageID;
    $this->Name = $Name;
    $this->EMail = $EMail;
    $this->Verrified = $Verrified;
  }
}
