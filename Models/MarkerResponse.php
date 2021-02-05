<?php

class API{
  public $URL;
  public $lat;
  public $lon;
  public $Name;
  public $DisplayName;
  public $dataName;
  public $Color ;

  public function __construct($URL, $lat, $lon, $dataName, $nom, $displayName, $Color = "#FF0000"){
    $this->URL = $URL;
    $this->lat = $lat;
    $this->lon = $lon;
    $this->Name = $nom;
    $this->DisplayName = $displayName;
    $this->dataName = $dataName;
    $this->Color = $Color;
  }

  public function getClientFunctions(){
    return
    "var ".$this->Name." = null;
    var ".$this->Name."Pins = [];

    function option".$this->Name."Change(e){
      if(e.checked){
        if(".$this->Name." == null){
          $.ajax({
            url:'".$this->URL."',
            success: function(result){
              e.parentElement.classList.add('dataloaded');
              ".$this->Name." = result;
              option".$this->Name."Show();
            }
          }) ;
        }else{
          option".$this->Name."Show();
        }
      }else{
        option".$this->Name."Hide();
      }
    }

    function option".$this->Name."Show(){
      console.log('show ".$this->Name."') ;
      if(".$this->Name."Pins.length != 0)
        return;

      var sites = ".$this->Name." ;

      for (site in ".$this->Name.") {
        var marker = L.circleMarker(
          [".$this->Name."[site].".$this->lat.", ".$this->Name."[site].".$this->lon."],
          {
            color: '".$this->Color."'
          })
          .addTo(macarte)
          .bindPopup('".$this->Name."<br>' + ".$this->Name."[site].".$this->dataName.");

        ".$this->Name."Pins.push(marker);
      }
    }
    function option".$this->Name."Hide(){
      console.log('hide ".$this->Name."') ;
      for (var pin of ".$this->Name."Pins) {
        pin.remove();
      }
      ".$this->Name."Pins = [] ;
    }" ;
  }
};




class APIsContainer{
  public $Name;
  public $APIs;

  public function __construct($Name, $APIs){
    $this->Name = $Name;
    $this->APIs = $APIs;
  }
}
