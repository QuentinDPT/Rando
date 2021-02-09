<div id="map">
</div>
<div id="search-bar">
  <div class="">
    <input id="searchText" type="text" name="" value="" placeholder="Search">
    <input id="searchBtn" type="button" name="" value="»">
  </div>
</div>
<div id="pinDescription">
  <div>
    <span id="pinDescriptionTitle">NOM</span><span id="pinDescriptionCategory">CATEG</span><br>
    <span id="pinDescriptionDescription">DESCRIPTION</span><br>
    <span>Recommandations 90% (x votes)</span><br>
    <span>Plus d'informations >></span>
  </div>
</div>
<div id="pinOption" class="pinOption">
  <div>
    <div class="" style="max-height: 100%;display:flex;flex-direction:column;overflow-y:auto;overflow-x:hidden;">
      <div style="margin-top:0;margin-left:1rem;margin-bottom:1rem;">
        <span style="font-size:24px;font-weight: 600;margin-right:2rem;">Marqueurs</span>
        <span style="margin-right:2rem;">Cartes</span>
        <span style="margin-right:2rem;">Aventures</span>
        <span style="margin-right:2rem;">Compte</span>
      </div>
      <ul id="optionsContainer" class="optionsContainer">
        <?php require("pins.php") ?>
      </ul>
    </div>
    <div class="additionnalMenu">
      <div id="report" onclick="document.getElementById('addPinSection').style = '';" class="button" style="width:100%; margin-right:.5rem;min-width:120px;">
        <span style="padding-left:.4rem">🗺️</span>
        <span class='abcRioButtonContents'>Report</span>
      </div>
      <div id="signin" class="g-signin2" data-onsuccess="onSignIn"></div>
      <div id="signout" style="display:none;" class="button" onclick="signOut()"><span class="abcRioButtonContents">Sign out</span><img src='/src/img/balise.png'></div>
    </div>
  </div>
</div>
<div>
  <?php require("addPin.php") ?>
</div>
<div style="position:fixed;bottom:0;left:0;z-index:1000; margin-left:.5rem;margin-bottom:.5rem;" onclick="centerize();">
  <div class="button" id="recenterizeBtn" style="display:none;width:36px;height:36px;border:none;margin-bottom:.2rem; margin:0; display:none;justify-content:center;">
    <span style="text-align: center;">🛰️</span>
  </div>
</div>


<script src="/src/js/map.js" charset="utf-8"></script>
