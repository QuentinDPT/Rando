<script type="text/javascript">
  function optionChange(e){
    console.log(e);
    if(e.checked){
      setTimeout(() => { e.parentElement.classList.add("dataloaded"); }, 1000);
    }else{

    }
  }
</script>

<li class="option"><input type="checkbox" id="sitesCheckbox" name="sitesCheckbox"><label for="sitesCheckbox">Sites</label></li>
<li class="option"><input type="checkbox" id="structuresCheckbox" name="structuresCheckbox"><label for="structuresCheckbox">Structures</label></li>
<li class="option"><input type="checkbox" id="balisesCheckbox" name="balisesCheckbox" onchange="optionChange(this);"><label for="balisesCheckbox">Balises</label></li>
<?php for($i = 0;$i<72;$i++){?>
  <li class="option"><input type="checkbox" id="test<?php echo $i ?>" name="test<?php echo $i ?>" onchange="optionChange(this);"><label for="test<?php echo $i ?>">test <?php echo $i ?></label></li>
<?php } ?>
