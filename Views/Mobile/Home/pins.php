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
  };

  class APIContainer{
    public $Name;
    public $APIs;

    public function __construct($Name, $APIs){
      $this->Name = $Name;
      $this->APIs = $APIs;
    }
  }
  $APIs = [];

  $Rando = [];
  $Rando[] = new API("https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM","ViaFerrata","Via ferrata");
  $Rando[] = new API("https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM","ViaFerrata","Chemin de compostelle");

  $APIs[] = new APIContainer("Randonné",$Rando);

  $Life = [];
  $Life[] = new API("https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM","Refuge","Refuge");
  $Life[] = new API("https://data.ffvl.fr/json/balises.json","latitude","longitude","nom","Bivouac","Lieu de bivouac");
  $Life[] = new API("https://data.ffvl.fr/json/sites.json","lat","lon","nom","Camp","Camping");

  $APIs[] = new APIContainer("Lieu de vie",$Life);

  $Monuments = [];
  $Monuments[] = new API("https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM","Ruine","Ruine");

  $APIs[] = new APIContainer("Monuments",$Monuments);

  $Water = [];
  $Water[] = new API("https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM","WaterDrinkable","Robinet d'eau potable");
  $Water[] = new API("https://data.ffvl.fr/json/balises.json","latitude","longitude","nom","WaterSpring", "Source d'eau");
  $Water[] = new API("https://data.ffvl.fr/json/sites.json","lat","lon","nom","WaterBathing","Lieu de baignade");

  $APIs[] = new APIContainer("Eau",$Water);

  $Weather = [] ;
  $Weather[] = new API("https://data.ffvl.fr/json/sites.json","lat","lon","nom","Temps","Températures");
  $Weather[] = new API("https://data.ffvl.fr/json/balises.json","latitude","longitude","nom","Rain","Précipitations");
  $Weather[] = new API("https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM","Wind","Vent");

  $APIs[] = new APIContainer("Météo",$Weather);

  $FFVL = [] ;
  $FFVL[] = new API("https://data.ffvl.fr/json/sites.json","lat","lon","nom","Sites","Sites", "#0000FF");
  $FFVL[] = new API("https://data.ffvl.fr/json/balises.json","latitude","longitude","nom","Balises","Balises", "#00FF00");
  $FFVL[] = new API("https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM","Structures","Structures","#FFA500");

  $APIs[] = new APIContainer("FFVL",$FFVL);
  $APIs[] = new APIContainer("Autre",[]);
 ?>
<script type="text/javascript">

  <?php
  foreach ($APIs as $apiContainer) {
    foreach ($apiContainer->APIs as $api) {
  ?>
  var <?php echo $api->Name ?> = null;
  var <?php echo $api->Name ?>Pins = [];

  function option<?php echo $api->Name ?>Change(e){
    if(e.checked){
      if(<?php echo $api->Name ?> == null){
        $.ajax({
          url:"<?php echo $api->URL ?>",
          success: function(result){
            e.parentElement.classList.add("dataloaded");
            <?php echo $api->Name ?> = result;
            option<?php echo $api->Name ?>Show();
          }
        }) ;
      }else{
        option<?php echo $api->Name ?>Show();
      }
    }else{
      option<?php echo $api->Name ?>Hide();
    }
  }

  function option<?php echo $api->Name ?>Show(){
    console.log("show <?php echo $api->Name ?>") ;
    if(<?php echo $api->Name ?>Pins.length != 0)
      return;

    var sites = <?php echo $api->Name ?> ;

    for (site in sites) {
      var marker = L.circleMarker(
        [sites[site].<?php echo $api->lat ?>, sites[site].<?php echo $api->lon ?>],
        {
          color: "<?php echo $api->Color ?>"
        })
        .addTo(macarte)
        .bindPopup("<?php echo $api->Name ?><br>" + sites[site].<?php echo $api->dataName ?>);

      <?php echo $api->Name ?>Pins.push(marker);
    }
  }
  function option<?php echo $api->Name ?>Hide(){
    console.log("hide <?php echo $api->Name ?>") ;
    for (var pin of <?php echo $api->Name ?>Pins) {
      pin.remove();
    }
    <?php echo $api->Name ?>Pins = [] ;
  }
  <?php
    }
  }
  ?>

</script>

<?php
foreach ($APIs as $apiContainer) {
?>
<li>
  <span class="optionSubmenuTitle"><?php echo $apiContainer->Name ?></span>
  <ul style="padding:0;margin-top: -.5rem;margin-bottom: .5rem;">
    <?php
    foreach ($apiContainer->APIs as $api) {
    ?>
    <li class="option">
      <input type="checkbox" id="<?php echo $api->Name ?>" name="<?php echo $api->Name ?>" onchange="option<?php echo $api->Name ?>Change(this);">
      <label for="<?php echo $api->Name ?>"><?php echo $api->DisplayName ?></label>
    </li>
    <?php
    }
    ?>
  </ul>
</li>
<?php
}
?>
