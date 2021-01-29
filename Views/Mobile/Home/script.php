
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
<style type="text/css">
  #logSection{
    position:fixed;
    z-index: 1002 ;
    bottom:0;
    right:0;
    padding-bottom: 1.5rem;
    padding-right: .5rem;
  }

  #signout{
    height:36px;
    min-width:120px;
    display:inline-flex;
    justify-content: space-between;
    align-items: center;
    background-color: white;
    border-radius: 0 25px 25px 0 ;
    width: 100%;
  }

  #signout>span{

  }

  #signout>img{
    max-width: 50px;
    max-height: 50px;
    margin-top: -50%;
    margin-bottom: -50%;
    border-radius: 50%;
  }

  #map{ /* la carte DOIT avoir une hauteur sinon elle n'apparaît pas */
    height:100vh;
  }
  body{
    margin:0;
  }

  #search-bar{
    position:fixed;
    top: 2vh;
    left: 10vw;
    right: 10vw;
    height: 40px;
    z-index: 1002;
  }

  #search-bar>*{
    background-color: white;
    height:100%;
    width:800px;
    max-width: 80vw;
    border-radius: 20px;
    padding-left: 15px;
    padding-right: 15px;
    display: flex;
  }

  #search-bar>div>*{
    background-color: transparent;
    border: none;
  }
  #search-bar>div>#searchText{
    height:100%;
    width:800px;
  }
  #search-bar>div>#searchBtn{
    height:100%;
    width:40px;
  }

  #pinOption{
    position: fixed;
    top: 0;
    bottom: 0;
    min-width: 20px;
    max-width: 70vw;
    z-index: 1001;
    transition: .3s;
  }

  .pinOption{
    width: 15px;
    background-color: #FFFFFF01;
  }

  #pinOption::after{
    content: "";
    position: absolute;
    display: inline-block;

    background-color: #66666696;
    border-radius: 2px;

    width: 5px;
    height: 30px;

    right: 5px;
    top: 50%;
    bottom: 50%;
    margin-top: -50%;
    margin-bottom: -50%;
  }

  #pinOption:hover, .expandOption{
    width:600px;
    background-color: #FFFFFFEE;
  }

  #pinOption>*{
    transform: translateX(-600px);
    transition: .2s;
  }
  #pinOption:hover>*{
    transform: translateX(0);
  }
</style>

<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-client_id" content="732812529798-lq9el2petok7s998v71jrmrkmur6c61u.apps.googleusercontent.com">
<script type="text/javascript">
  var GUser = {id:"",name:"",avatar:"",mail:""} ;
</script>
<script src="/src/js/glog.js" charset="utf-8"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
