<?php
ini_set('display_errors', 1); error_reporting(~0);
require_once("main/drac-init.php");

if (file_exists("/opt/www-resources/header-footer4.php")) {
	require_once("/opt/www-resources/header-footer4.php");
	$footer = AU_headerfooter(
			"",  # blank string means use default placeholder
			array( '<!--Additional Scripts-->' =>
					'<script type="text/javascript" src="drac.js" ></script><link rel="stylesheet" media="screen" href="drac.css" />',
			)
	);
	require_once("main/drac-content.php");

//put what ever additional code you need here.

	echo $footer;		
} else {
	?>
	<html>
		<head>
			<meta charset="utf-8"><meta http-equiv="content-language" name="language" content="en">
		</head>
		<body>
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
			<?php require_once("main/drac-content.php"); ?>
			<script type="text/javascript" src="drac.js" ></script>
			<link rel="stylesheet" media="screen" href="drac.css" />
			<link rel="stylesheet" media="screen" href="app-v6.css" />
		</body>
	</html>
<?php
}
?>

