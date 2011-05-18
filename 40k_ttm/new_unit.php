<?php
/***********************************************
File: new_unit.php
Author: Adam Krone
Description: Handles creation of new units.
***********************************************/

	session_start();
	
	require "func.inc.php";
	include "auth.inc.php";
	
	$name = $_POST['name'];
	$type = $_POST['type'];
	$points = $_POST['points'];
	$upgrades = $_POST['upgrades'];
	$copies = $_POST['copies'];
	
	$unit = new Unit();
	$output = $unit->create($_SESSION['army_id'], $_SESSION['uid'], $name, $_SESSION['codex'], $type, $points, $upgrades, $copies);
	$output = $output . redirect("manage_army.php");
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include "head_tags.php"; ?>
	</head>
	<body>
	
		<div id="redirect" class="box_shadow">
				<?php echo $output; ?>
		</div>
		
	</body>
</html>	