
var XOffset = 0 ;

window.addEventListener("load", function(e) {
  document.getElementById("pinOption").onmousedown = function(e){
    XOffset = e.layerX ;
    document.getElementById("pinOption").style.transition = "" ;
    document.onmousemove = function(ev){
      document.getElementById("pinOption").classList.add("expandOption");
      document.getElementById("pinOption").style.width = (window.innerWidth - ev.clientX + XOffset) + "px" ;
    }
  }
  document.onmouseup = function(ev){
    console.log(ev) ;
    document.getElementById("pinOption").style.transition = ".7s" ;

    console.log(document.getElementById("pinOption").offsetWidth) ;

    if(window.innerWidth - ev.clientX < XOffset + 50)
      document.getElementById("pinOption").classList.remove("expandOption");
    else
      document.getElementById("pinOption").classList.add("expandOption");

    document.getElementById("pinOption").style.width = "" ;
    document.onmousemove = null ;
  }
});
