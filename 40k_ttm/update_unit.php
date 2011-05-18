<?php
/***********************************************
File: update_unit.php
Author: Adam Krone
Description: Handles updating of unit information.
***********************************************/

	session_start();
	
	require "func.inc.php";
	include "auth.inc.php";
	
	$name = $_POST['name'];
	$type = $_POST['type'];
	if ( isset($_POST['upgrades']) ) {
		$upgrade = $_POST['upgrades'];
		$upgradenum = $_POST['upgrade_copies'];
	}
	$copies = $_POST['copies'];
	
	$upgrades = "";
	$upgradecopies = "";

	while (list ($key,$val) = @each ($upgrade)) {
		$upgrades .= "$val|";
	}
	
	while (list ($key,$val) = @each ($upgradenum)) {
		$upgradecopies .= "$val|";
	}
	
	$unit = new Unit();
	$output = $unit->update($_SESSION['army_id'], $_SESSION['unit_id'], $name, $type, $upgrades, $upgradecopies, $copies);
	$output .= redirect("manage_army.php");

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