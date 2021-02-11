<?php

class MarkerViewModel{
  public $ID;
  public $Name;
  public $Description;
  public $CategID;
  public $CategoryName;
  public $DataName;
  public $Color;
  public $lat;
  public $lon;
  public $Image;
  public $UID;
  public $nbVotes;
  public $avgVotes;

  public function __construct($ID, $Name, $Description, $CategID, $CategoryName, $DataName, $Color, $lat, $lon, $ImageID, $Image, $UID, $nbVotes, $avgVotes){
    $this->ID = intval($ID);
    $this->Name = $Name;
    $this->Description = $Description;
    $this->CategID = intval($CategID);
    $this->CategoryName = $CategoryName;
    $this->DataName = $DataName;
    $this->Color = $Color;
    $this->lat = floatval($lat);
    $this->lon = floatval($lon);
    $this->ImageID = intval($ImageID);
    $this->Image = $Image;
    $this->UID = intval($UID);
    $this->nbVotes = intval($nbVotes);
    $this->avgVotes = floatval($avgVotes);
  }
}
