<script type="text/javascript">
  function optionChange(e){
    console.log(e);
    if(e.checked){
      setTimeout(() => { e.parentElement.classList.add("dataloaded"); }, 1000);
    }else{

    }
  }
</script>

<li>
  <span class="optionSubmenuTitle">Lieu de vie</span>
  <ul style="padding:0">
    <li class="option"><input type="checkbox" id="refuge" name="refuge" onchange="optionChange(this);"><label for="refuge">Refuge</label></li>
    <li class="option"><input type="checkbox" id="bivouac" name="bivouac" onchange="optionChange(this);"><label for="bivouac">Lieu de bivouac</label></li>
    <li class="option"><input type="checkbox" id="camping" name="camping" onchange="optionChange(this);"><label for="camping">Camping</label></li>
  </ul>
</li>
<li>
  <span class="optionSubmenuTitle">Eau</span>
  <ul style="padding:0">
    <li class="option"><input type="checkbox" id="water-drinkable" name="water-drinkable" onchange="optionChange(this);"><label for="water-drinkable">Robinet d'eau potable</label></li>
    <li class="option"><input type="checkbox" id="water-spring" name="water-spring" onchange="optionChange(this);"><label for="water-spring">Source d'eau</label></li>
    <li class="option"><input type="checkbox" id="water-bathing" name="water-bathing" onchange="optionChange(this);"><label for="water-bathing">Lieu de baignade</label></li>
  </ul>
</li>
<li>
  <span class="optionSubmenuTitle">FFVL</span>
  <ul style="padding:0">
    <li class="option"><input type="checkbox" id="sitesCheckbox" name="sitesCheckbox" onchange="optionChange(this);"><label for="sitesCheckbox">Sites</label></li>
    <li class="option"><input type="checkbox" id="structuresCheckbox" name="structuresCheckbox" onchange="optionChange(this);"><label for="structuresCheckbox">Structures</label></li>
    <li class="option"><input type="checkbox" id="balisesCheckbox" name="balisesCheckbox" onchange="optionChange(this);"><label for="balisesCheckbox">Balises</label></li>
  </ul>
</li>

<li>
  <span class="optionSubmenuTitle">Test zone</span>
  <ul style="padding:0">
    <?php for($i = 0;$i<72;$i++){?>
    <li class="option"><input type="checkbox" id="test<?php echo $i ?>" name="test<?php echo $i ?>" onchange="optionChange(this);"><label for="test<?php echo $i ?>">test <?php echo $i ?></label></li>
    <?php } ?>
  </ul>
</li>
