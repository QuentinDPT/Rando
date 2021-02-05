<div id="addPinSection" class="addPinSection" style="display:none;">

  <div>
    <div>

    </div>
    <div>
      <input type="text" id="reportPointName" name="" value="" placeholder="Nom">
    </div>
    <div>
      <input type="text" id="reportPointDesc" name="" value="" placeholder="Description">
    </div>
    <input type="button" value="Signaler" onclick="reportPoint()">
    <input type="button" value="Fermer" onclick="document.getElementById('addPinSection').style = 'display:none';">
  </div>

  <script type="text/javascript">
    function reportPoint(){
      var categ = "Other";
      var _name = document.getElementById("reportPointName").value;
      var _desc = document.getElementById("reportPointDesc").value;
      var loc = {lat:"",lon:""};
      var _uid = GUser.id;

      // get location
      function getLocation(){
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(e){
            loc = {lat:e.coords.latitude,lon:e.coords.longitude}
            sendToServer() ;
          });
        } else {
          console.log("marche pas");
        }
      }

      // send to server
      function sendToServer(){
        var request = {
          location:loc,
          category:categ,
          name:_name,
          description:_desc,
          uid:_uid
        };

        console.log(request);

        $.ajax({
          type: "POST",
          url:'/api/markers/add',
          contentType: 'application/json',
          data: JSON.stringify(request),
          dataType: 'json',
          success: function(result){
            document.getElementById('addPinSection').style = 'display:none';
          },
          error : function(resultat, statut, erreur){
            console.log(resultat);
            console.log(statut);
            console.log(erreur);
            alert('error');
          }
        }) ;
      }

      // save for later
      //if(_uid != "")
        getLocation();
    }
  </script>
</div>
