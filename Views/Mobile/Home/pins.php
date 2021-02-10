<?php
  require_once("Controllers/CategoriesController.php");
  require_once("Models/Category.php");
  $APIs = (new CategoriesController())->getCategories();
 ?>
<script type="text/javascript">
  <?php
  foreach ($APIs as $apiContainer) {
    foreach ($apiContainer->APIs as $api) {
      echo getCategoriesClientFunction($api);
    }
  }
  ?>
</script>

<?php
foreach ($APIs as $apiContainer) {
?>
<li>
  <span class="optionSubmenuTitle"><?php echo $apiContainer->CategoryName ?></span>
  <ul style="padding:0;margin-top: -.5rem;margin-bottom: .5rem;">
    <?php
    foreach ($apiContainer->APIs as $api) {
    ?>
    <li class="option">
      <input type="checkbox" id="<?php echo $api->DataName ?>" name="<?php echo $api->DataName ?>" onchange="option<?php echo $api->DataName ?>Change(this);">
      <label for="<?php echo $api->DataName ?>"><?php echo $api->DisplayName ?></label>
    </li>
    <?php
    }
    ?>
  </ul>
</li>
<?php
}
?>
