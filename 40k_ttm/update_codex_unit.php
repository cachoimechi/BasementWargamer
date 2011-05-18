<?php
/***********************************************
File: update_codex_unit.php
Author: Adam Krone
Description: Handles updating of codex unit information.
***********************************************/

	session_start();
	
	require "func.inc.php";
	include "auth.inc.php";
	
	$name = $_POST['name'];
	$type = $_POST['type'];
	$points = $_POST['points'];
	
	$codex = new Codex();
	$output = $codex->update($_SESSION['unit_id'], $name, $type, $points);
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