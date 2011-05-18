<?php
/***********************************************
File: delete_codex_unit.php
Author: Adam Krone
Description: Handles deletion of codex units.
***********************************************/

	session_start();
	
	require "func.inc.php";
	include "auth.inc.php";
	
	$codex = new Codex();
	$output = $codex->delete($_GET['unit_id']);
	$output .= redirect("manage_codex.php");

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