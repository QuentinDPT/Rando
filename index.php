<?php

require("./Utils/URL.php");
require("./Utils/ClientType.php");
require("./Utils/Page.php");
require("./Utils/404.php");

$CurrentURL = new URL() ;
$Device = getClientType();

require("./router.php");
