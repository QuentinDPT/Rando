<?php

$token = 'pk.eyJ1Ijoia3J5cHRvcyIsImEiOiJja2tmcW94YmswZmtlMm9teXh0b2oyd200In0.WyYX3XtfCzn7-IoNJHQnHw';
$name = './src/maps/'.$UrlHashed[3].'-'.$UrlHashed[4].'-'.$UrlHashed[5].'.png';

if(!file_exists($name)){
  $url = 'https://api.mapbox.com/styles/v1/mapbox/satellite-v9/tiles/'.$UrlHashed[3].'/'.$UrlHashed[4].'/'.$UrlHashed[5].'?access_token='.$token;
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
