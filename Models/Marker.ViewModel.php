<?php

class MarkerViewModel{
  public $ID;
  public $Name;
  public $Description;
  public $lat;
  public $lon;
  public $nbVotes;
  public $Note;
  public $Image;

  public function __construct($ID, $Name, $Description, $lat, $lon, $nbVotes, $Note, $Image){
    $this->ID = $ID;
    $this->Name = $Name;
    $this->Description = $Description;
    $this->lat = $lat;
    $this->lon = $lon;
    $this->nbVotes = $nbVotes;
    $this->Note = $Note;
    $this->Image = $Image;
  }
}
