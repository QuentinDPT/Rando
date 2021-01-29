<?php

$token = 'pk.eyJ1Ijoia3J5cHRvcyIsImEiOiJja2tmcW94YmswZmtlMm9teXh0b2oyd200In0.WyYX3XtfCzn7-IoNJHQnHw';
$last = $CurrentURL->get(4) ;
$pos__ = strpos($last, '?') ;
if($pos__ !== false)
  $last = substr($last, 0, $pos__) ;
$name = './src/maps/'.$CurrentURL->get(2).'-'.$CurrentURL->get(3).'-'.$last.'.png';

$arg = substr($CurrentURL->get(4), $pos__+1);

if($arg == "reload" && file_exists($name)){
  unlink( $name ) ;
}

if($CurrentURL->get(2) > 11){
  header("Location: https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/".$CurrentURL->get(2)."/".$last."/".$CurrentURL->get(3));
  die();
}


if(!file_exists($name)){
  $url = 'https://api.mapbox.com/styles/v1/mapbox/satellite-v9/tiles/'.$CurrentURL->get(2).'/'.$CurrentURL->get(3).'/'.$last.'?access_token='.$token;
  $data = array('name' => $name);

  file_put_contents($name, file_get_contents($url));
}

$fp = fopen($name, 'rb');

// send the right headers
header("Content-Type: image/png");
header("Content-Length: " . filesize($name));

// dump the picture and stop the script
fpassthru($fp);
exit;
