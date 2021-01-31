<li class="option"><input type="checkbox" id="sitesCheckbox" name="sitesCheckbox"><label for="sitesCheckbox">Sites</label></li>
<li class="option"><input type="checkbox" id="structuresCheckbox" name="structuresCheckbox"><label for="structuresCheckbox">Structures</label></li>
<li class="option"><input type="checkbox" id="balisesCheckbox" name="balisesCheckbox"><label for="balisesCheckbox">Balises</label></li>
<?php for($i = 0;$i<72;$i++){?>
  <li class="option"><input type="checkbox" name="test<?php echo $i ?>"><label for="test<?php echo $i ?>">test <?php echo $i ?></label></li>
<?php } ?>
