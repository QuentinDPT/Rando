<?php

class Marker{
  public $Name;
  public $lat;
  public $lon;

  public function __construct($Name, $lat, $lon){
    $this->Name = $Name;
    $this->lat = $lat;
    $this->lon = $lon;
  }
}

class API{
  public $Name;
  public $DisplayName;
  public $Color ;
  public $DataNameLat;
  public $DataNameLon;
  public $DataNameTitle;
  public $URL;

  public function __construct($Name,$DisplayName,$Color,$URL="",$DataNameLat="lat",$DataNameLon="lon",$DataNameTitle="Name"){
    $this->Name           = $Name;
    $this->DisplayName    = $DisplayName;
    $this->Color          = $Color;
    $this->URL            = $URL;
    $this->DataNameLat    = $DataNameLat;
    $this->DataNameLon    = $DataNameLon;
    $this->DataNameTitle  = $DataNameTitle;

    if($this->URL == ""){
      $this->URL = "/api/markers/".$this->Name;
    }
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
      function popupOpen(e) {
        console.log(e) ;
        console.log(".$this->Name."[e.target.index]) ;
        var pinSelected = ".$this->Name."[e.target.index];
        macarte.setView([e.target._latlng.lat, e.target._latlng.lng]);
        document.getElementById('pinDescription').style.transform = 'translate(0)' ;
        document.getElementById('pinDescriptionTitle').innerHTML = pinSelected.Name ;
        document.getElementById('pinDescriptionCategory').innerHTML = '".$this->Name."' ;
        document.getElementById('pinDescriptionDescription').innerHTML = pinSelected.Description ;
      }

      function popupClose(e) {
        console.log(e) ;
        document.getElementById('pinDescription').style.transform = '' ;
      }

      console.log('show ".$this->Name."') ;
      if(".$this->Name."Pins.length != 0)
        return;

      var sites = ".$this->Name." ;

      for (site in ".$this->Name.") {
        var marker = L.circleMarker(
          [".$this->Name."[site].".$this->DataNameLat.", ".$this->Name."[site].".$this->DataNameLon."],
          {
            color: '".$this->Color."'
          })
          .addTo(macarte)
          .bindPopup('".$this->Name."<br>' + ".$this->Name."[site].".$this->DataNameTitle.")
          .on('popupopen', popupOpen)
          .on('popupclose', popupClose);
        marker.index = site ;
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
