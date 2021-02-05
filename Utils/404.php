<?php

class Error404{
  public function __construct($URL = ""){
    http_response_code(404);
    echo $URL ;
    echo "<br>page non trouvée" ;

    die() ;
  }
}
