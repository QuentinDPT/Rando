<?php

  class API{
    public $URL;
    public $lat;
    public $lon;
    public $Name;
    public $DisplayName;
    public $dataName;
    public $Color ;

    public function __construct($URL, $lat, $lon, $dataName, $nom, $displayName){
      $this->URL = $URL;
      $this->lat = $lat;
      $this->lon = $lon;
      $this->Name = $nom;
      $this->DisplayName = $displayName;
      $this->dataName = $dataName;
      $this->Color = "#FF0000";
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

  $Life = [];
  $Life[] = new API("https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM","Refuge","Refuge");
  $Life[] = new API("https://data.ffvl.fr/json/balises.json","latitude","longitude","nom","Bivouac","Lieu de bivouac");
  $Life[] = new API("https://data.ffvl.fr/json/sites.json","lat","lon","nom","Camp","Camping");

  $APIs[] = new APIContainer("Lieu de vie",$Life);

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
  $FFVL[] = new API("https://data.ffvl.fr/json/sites.json","lat","lon","nom","Sites","Sites");
  $FFVL[] = new API("https://data.ffvl.fr/json/balises.json","latitude","longitude","nom","Balises","Balises");
  $FFVL[] = new API("https://data.ffvl.fr/json/structures.json","STRU_LATITUDE","STRU_LONGITUDE","STRU_NOM","Structures","Structures");

  $APIs[] = new APIContainer("FFVL",$FFVL);
 ?>
<script type="text/javascript">

  <?php
  foreach ($APIs as $apiContainer) {
    foreach ($apiContainer->APIs as $api) {
  ?>
  var <?php echo $api->Name ?> = null;

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
  }
  function option<?php echo $api->Name ?>Hide(){
    console.log("hide <?php echo $api->Name ?>") ;
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
