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
    <span>90% (x votes)</span>
    <img src="">
  </div>
  <div>

  </div>
</div>
<script type="text/javascript">
  function initMenu(e){
    /*
    document.getElementById("pinMenuTitles").innerHTML +=
      document.getElementById("pinMenuTitles").innerHTML
        .replace("markerMenuTitle","markerMenuTitle2")
        .replace("mapMenuTitle","mapMenuTitle2")
        .replace("advanturesMenuTitle","advanturesMenuTitle2")
        .replace("accountMenuTitle","accountMenuTitle2") ;
    //*/
    document.getElementById("pinMenuTitles").innerHTML += "<div id='markerMenuTitle2' onclick='showMenu(this)'>Retour</div>" ;
    document.getElementById("markerMenuTitle").style = "transform:scale(1)" ;
  }

  function showMenu(e){
    console.log(e) ;
    if(e.id.includes('2')){
      showMenu(document.getElementById(e.id.substr(0,e.id.length-1)));
      return;
    }
    document.getElementById("markerMenuTitle").style = "" ;
    document.getElementById("mapMenuTitle").style = "" ;
    document.getElementById("advanturesMenuTitle").style = "" ;
    document.getElementById("accountMenuTitle").style = "" ;

    e.style.transform = "scale(1)" ;

    document.getElementById("pinMenuTitles").style = "transform:translateX(-"+e.offsetLeft+"px)";
  }
</script>
<div id="pinOption" class="pinOption">
  <div>
    <div class="" style="max-height: 100%;display:flex;flex-direction:column;overflow-y:auto;overflow-x:hidden;">
      <div id="pinMenuTitles" class="pinMenuTitles">
        <div id="markerMenuTitle" onclick="showMenu(this)">Marqueurs</div>
        <div id="mapMenuTitle" onclick="showMenu(this)">Cartes</div>
        <div id="advanturesMenuTitle" onclick="showMenu(this)">Aventures</div>
        <div id="accountMenuTitle" onclick="showMenu(this)">Compte</div>
      </div>
      <script type="text/javascript">
        initMenu();
      </script>
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
