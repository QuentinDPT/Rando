<?php

class Marker{
  public $ID;
  public $Name;
  public $Description;
  public $lat;
  public $lon;
  public $UID;
  public $ImageID;
  public $CategoryID;

  public function __construct($ID, $Name, $Description, $lat, $lon, $UID, $ImageID, $CategoryID){
    $this->ID = $ID;
    $this->Name = $Name;
    $this->Description = $Description;
    $this->lat = $lat;
    $this->lon = $lon;
    $this->UID = $UID;
    $this->ImageID = $ImageID;
    $this->CategoryID = $CategoryID;
  }
}
