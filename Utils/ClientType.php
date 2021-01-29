<?php

abstract class ClientType{
  const Unknown = "all";
  const PC = "pc";
  const Mobile = "mobile";
  const Tablet = "tablet";
  const Bot = "bot";
}

function getClientType(){
  $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
  if(is_numeric(strpos($ua, "mobile")))
    return ClientType::Mobile ;

  return ClientType::Unknown ;
}
