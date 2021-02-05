<?php

class URL{
  private $URLArgs = [] ;
  private $Arguments = "";

  public function __construct($URLstring = null){
    $this->URLArgs = explode("/",$_SERVER['REQUEST_URI']) ;

    // Erase empty arguments
    $i = 0 ;
    while($i < count($this->URLArgs)){
      if($this->URLArgs[$i] == "")
        array_splice($this->URLArgs, $i, 1);
      else
        $i += 1 ;
    }

    // arguments
    if(count($this->URLArgs)>0){
      $last = $this->URLArgs[count($this->URLArgs)-1] ;
      $pos__ = strpos($last, '?') ;
      if($pos__ !== false){
        $this->Arguments = substr($last, $pos__+1) ;
        $this->URLArgs[count($this->URLArgs)-1] = substr($last, 0, $pos__);
        $this->Arguments = explode("&",$this->Arguments) ;
        $i = 0;
        while ($i < count($this->Arguments)) {
          $this->Arguments[$i] = explode("=",$this->Arguments[$i]) ;
          $i += 1 ;
        }
      }
    }
  }
  public function get($index){
    if($index < 0 || $index >= $this->size())
      return null;
    return $this->URLArgs[$index] ;
  }

  public function getParameter($param){
    foreach ($this->Arguments as $elem) {
      if($elem[0] == $param){
        if(count($elem) == 1)
          return true;
        return $elem[1] ;
      }
    }

    return null ;
  }

  public function size(){
    return count($this->URLArgs) ;
  }

  public function __toString()
  {
    $result = "";

    foreach ($this->URLArgs as $elem) {
      $result .= "/" . $elem ;
    }

    if($result == "")
      $result = "/" ;

    $args = "" ;
    if($this->Arguments != ""){
      foreach ($this->Arguments as $elem) {
        $args .= "&" . $elem[0] ;
        if(count($elem) != 1)
          $args .= "=" . $elem[1] ;

      }
    }

    if($args != "")
      $result .= "?" . substr($args, 1) ;

    return $result;
  }
}
