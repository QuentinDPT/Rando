<?php
  require("Controllers/MarkerController.php");
  $APIs = (new MarkerController())->getAllMarkers();
 ?>
<script type="text/javascript">
  <?php
  foreach ($APIs as $apiContainer) {
    foreach ($apiContainer->APIs as $api) {
      echo $api->getClientFunctions();
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
