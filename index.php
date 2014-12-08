<?php
//ini_set('display_errors', 1); error_reporting(~0);
require_once("main/drac-init.php");

require_once("/aber/www/webapps/resources/header-footer4.php");
$footer = AU_headerfooter(
        "",  # blank string means use default placeholder
        array( '<!--Additional Scripts-->' =>
                '<script type="text/javascript" src="drac.js" ></script><link rel="stylesheet" media="screen" href="drac.css" />',
        )
);

require_once("main/drac-content.php");

//put what ever additional code you need here.

echo $footer;