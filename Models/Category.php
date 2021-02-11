<?php

class Category{
  public $ID;
  public $CategoryName;
  public $DataName;
  public $DisplayName;
  public $Color;

  public function __construct($ID, $CategoryName, $DataName, $DisplayName, $Color){
    $this->ID = $ID ;
    $this->CategoryName = $CategoryName ;
    $this->DataName = $DataName ;
    $this->DisplayName = $DisplayName ;
    $this->Color = $Color ;
  }
};

class CategoryContainer{
  public $APIs;
  public $CategoryName;

  public function __construct($CategoryName, $APIs){
    $this->APIs = $APIs ;
    $this->CategoryName = $CategoryName ;
  }
}


function getCategoriesClientFunction($category){
  return
  "var ".$category->DataName." = null;
  var ".$category->DataName."Pins = [];

  function option".$category->DataName."Change(e){
    if(e.checked){
      if(".$category->DataName." == null){
        $.ajax({
          url:'/api/markers/".$category->DataName."',
          success: function(result){
            e.parentElement.classList.add('dataloaded');
            ".$category->DataName." = result;
            option".$category->DataName."Show();
          }
        }) ;
      }else{
        option".$category->DataName."Show();
      }
    }else{
      option".$category->DataName."Hide();
    }
  }

  function option".$category->DataName."Show(){
    function popupOpen(e) {
      var pinSelected = ".$category->DataName."[e.target.index];
      macarte.setView([e.target._latlng.lat, e.target._latlng.lng]);
      document.getElementById('pinDescription').style.transform = 'translate(0)' ;
      document.getElementById('pinDescriptionTitle').innerHTML = pinSelected.Name ;
      document.getElementById('pinDescriptionCategory').innerHTML = '".$category->DataName."' ;
      document.getElementById('pinDescriptionDescription').innerHTML = pinSelected.Description ;
      document.getElementById('pinDescriptionVotes').innerHTML = 'Votes : ' + (pinSelected.avgVotes*100) + '% (' + pinSelected.nbVotes + ')';
    }

    function popupClose(e) {
      document.getElementById('pinDescription').style.transform = '' ;
    }

    console.log('show ".$category->DataName."') ;
    if(".$category->DataName."Pins.length != 0)
      return;

    var sites = ".$category->DataName." ;

    for (site in ".$category->DataName.") {
      var marker = L.circleMarker(
        [".$category->DataName."[site].lat, ".$category->DataName."[site].lon],
        {
          color: '".$category->Color."'
        })
        .addTo(macarte)
        .bindPopup('".$category->DataName."<br>' + ".$category->DataName."[site].Name)
        .on('popupopen', popupOpen)
        .on('popupclose', popupClose);
      marker.index = site ;
      ".$category->DataName."Pins.push(marker);
    }
  }
  function option".$category->DataName."Hide(){
    for (var pin of ".$category->DataName."Pins) {
      pin.remove();
    }
    ".$category->DataName."Pins = [] ;
  }" ;
}
