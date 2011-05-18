<?php
/***********************************************
File: add_upgrade.php
Author: Adam Krone
Description: Handles adding new unit upgrades.
***********************************************/

	session_start();
	
	require "func.inc.php";
	include "auth.inc.php";
	
	$name = $_POST['name'];
	$points = $_POST['points'];
	
	$upgrade = new Upgrade();
	$output = $upgrade->add($_SESSION['uid'], $_SESSION['unit_id'], $name, $points);
	$output .= redirect("edit_codex_unit.php");
	
	$string = $upgrade->makeString($_SESSION['unit_id']);
	$codex = new Codex();
	$codex->updateUpgrade($_SESSION['unit_id'], $string);
	
?>
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