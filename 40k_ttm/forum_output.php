<?php
/***********************************************
File: forum_output.php
Author: Adam Krone
Description: Handles generation of forum formatted output.
***********************************************/

	session_start();
	
	require "func.inc.php";
	include "auth.inc.php";
	
	$armyid = $_GET['army_id'];
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Tabletop Manager | Forum Output</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="robots" content="" />
	</head>
	<body>
	
		<?php 
		
			$display = new Display();
			$display->forumOutput($armyid);
		
		?>
	
	</body>
</html>