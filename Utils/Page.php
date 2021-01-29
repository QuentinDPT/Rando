<?php

class Page{
  private $PageName ;
  private $Layout ;
  private $Location ;
  private $InnerPage ;
  private $AdditionnalScripts;

  public function __construct($Location, $PageName, $Layout = ""){

    if($Layout == "")
      $this->Layout = $Location . "Common/layout.php" ;
    else
      $this->Layout = $Layout ;

    $this->AdditionnalScripts = $Location . $PageName . "/script.php" ;
    if(!file_exists($this->AdditionnalScripts))
      $this->AdditionnalScripts = null ;

    $this->Location = $Location;
    $this->PageName = $PageName ;

    $this->InnerPage = $Location . $PageName . "/".lcfirst($PageName).".php" ;

    if($this->Layout != null)
      require($this->Layout) ;
    else
      require($this->InnerPage) ;

    die() ;
  }
}
