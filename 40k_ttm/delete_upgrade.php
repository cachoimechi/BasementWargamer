<?php
/***********************************************
File: delete_upgrade.php
Author: Adam Krone
Description: Handles deletion of codex unit upgrades.
***********************************************/

	session_start();
	
	require "func.inc.php";
	include "auth.inc.php";
	
	$upgrade = new Upgrade();
	$details = $upgrade->id($_GET['upgrade_id']);
	
	if ( $_SESSION['uid'] != $details['user_id'] ) {
		header("Location:manage_codex.php");
	} else {
	
		$upgrade = new Upgrade();
		$output = $upgrade->delete($_GET['upgrade_id']);
		
		$string = $upgrade->makeString($_SESSION['unit_id']);
		$codex = new Codex();
		$codex->updateUpgrade($_SESSION['unit_id'], $string);
		$output .= redirect("edit_codex_unit.php");
	
	}


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