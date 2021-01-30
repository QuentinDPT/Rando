
<div id="map">
</div>
<div id="search-bar">
  <div class="">
    <input id="searchText" type="text" name="" value="" placeholder="Search">
    <input id="searchBtn" type="button" name="" value="»">
  </div>
</div>
<div id="pinOption" class="pinOption">
  <div>
    <h2>Options</h2>
    <ul>
      <li><input type="checkbox" id="sitesCheckbox" name="sitesCheckbox"><label for="sitesCheckbox">Sites</label></li>
      <li><input type="checkbox" id="structuresCheckbox" name="structuresCheckbox"><label for="structuresCheckbox">Structures</label></li>
      <li><input type="checkbox" id="balisesCheckbox" name="balisesCheckbox"><label for="balisesCheckbox">Balises</label></li>
    </ul>
  </div>
</div>
<div id="logSection">
  <div id="recenterizeBtn" style="display:none;"><input type="button" name="" style="width:120px;height:36px;border:none;margin-bottom:.2rem; background-color:white;" value="Recentrer" onclick="centerize();"></div>
  <div id="signin" class="g-signin2" data-onsuccess="onSignIn"></div>
  <div id="signout" style="display:none;" onclick="signOut()"><span style="font-size: 13px; line-height: 34px;color: #757575;" class="abcRioButtonContents">Sign out</span><img src='/src/img/balise.png'></div>
</div>

<script src="/src/js/map.js" charset="utf-8"></script>
