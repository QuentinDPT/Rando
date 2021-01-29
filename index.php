<?php

require("./Utils/URL.php");
require("./Utils/ClientType.php");
require("./Utils/Page.php");

$CurrentURL = new URL() ;
$Device = getClientType();

require("./router.php");
