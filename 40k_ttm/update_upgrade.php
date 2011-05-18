<?php
/***********************************************
File: update_upgrade.php
Author: Adam Krone
Description: Handles updates to upgrades.
***********************************************/

	session_start();
	
	require "func.inc.php";
	include "auth.inc.php";
	
	$upgrade = new Upgrade();
	$output = $upgrade->update($_SESSION['upgrade_id'], $_POST['name'], $_POST['points']);
	$output .= redirect("edit_codex_unit.php");
	
	$string = $upgrade->makeString($_SESSION['unit_id']);
	$codex = new Codex();
	$codex->updateUpgrade($_SESSION['unit_id'], $string);

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