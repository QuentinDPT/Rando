
var XOffset = 0 ;
var XOffset2 = 0 ;
var touchinitiated = false;


window.addEventListener("load", function(e) {
  document.getElementById("pinOption").ontouchstart = function(e){
    touchinitiated = true;
    XOffset = -(window.innerWidth - e.changedTouches[0].clientX - document.getElementById("pinOption").offsetWidth);
    XOffset2 = e.changedTouches[0].clientX ;
    document.getElementById("pinOption").style.transition = "" ;
    document.ontouchmove = function(ev){
      //document.getElementById("pinOption").classList.add("expandOption");
      document.getElementById("pinOption").style.width = (window.innerWidth - ev.changedTouches[0].clientX + XOffset) + "px" ;
    }
  }
  document.ontouchend = function(ev){
    if(!touchinitiated)
      return ;

    document.getElementById("pinOption").style.transition = ".7s" ;

    if(XOffset2 - ev.changedTouches[0].clientX > 10)
      document.getElementById("pinOption").classList.add("expandOption");
    else if(XOffset2 - ev.changedTouches[0].clientX < -25)
      document.getElementById("pinOption").classList.remove("expandOption");

    document.getElementById("pinOption").style.width = "" ;
    touchinitiated = false;
  }
});
