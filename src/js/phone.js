
var XOffset = 0 ;
var XOffset2 = 0 ;
var touchinitiated = false;


window.addEventListener("load", function(e) {
  document.getElementById("pinOption").ontouchstart = function(e){
    touchinitiated = true;
    XOffset = -(window.innerWidth - e.changedTouches[0].clientX - document.getElementById("pinOption").offsetWidth);
    XOffset2 = e.changedTouches[0].clientX ;
    document.getElementById("pinOption").style.transition = "" ;
    //document.getElementById("pinOption").classList.remove("optionShow");
    document.ontouchmove = function(ev){
      if(!touchinitiated)
        return ;

      if(XOffset2 - ev.changedTouches[0].clientX < -25){
        document.getElementById("pinOption").classList.remove("optionShow");
      }
      //document.getElementById("pinOption").classList.remove("optionShow");
      document.getElementById("pinOption").classList.add("pinOptionMove");
      document.getElementById("pinOption").style.width = (window.innerWidth - ev.changedTouches[0].clientX + XOffset) + "px" ;
    }
  }
  document.ontouchend = function(ev){
    if(!touchinitiated)
      return ;

    document.getElementById("pinOption").style.transition = ".3s ease-out" ;
    document.getElementById("pinOption").ontransitionend = function(e){
      if(e.propertyName == "width"){
        document.getElementById("pinOption").classList.remove("pinOptionMove");
        if(document.getElementById("pinOption").offsetWidth == 20){
        }else{
          document.getElementById("pinOption").classList.add("optionShow");
        }
        document.getElementById("pinOption").style.transition = "" ;
      }
    }


    if(XOffset2 - ev.changedTouches[0].clientX > 10){
      document.getElementById("pinOption").classList.add("expandOption");
    }else if(XOffset2 - ev.changedTouches[0].clientX < -25){
      document.getElementById("pinOption").classList.remove("expandOption");
    }else if(document.getElementById("pinOption").classList.contains("expandOption")){
      document.getElementById("pinOption").classList.add("optionShow");
    }

    document.getElementById("pinOption").style.width = "" ;
    touchinitiated = false;
  }
});
