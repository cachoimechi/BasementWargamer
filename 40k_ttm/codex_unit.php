<?php
/***********************************************
File: codex_unit.php
Author: Adam Krone
Description: Handles creation of codex unit copies into an
army.
***********************************************/

	session_start();
	
	require "func.inc.php";
	include "auth.inc.php";
	
	if ( $_POST['unit'] == "no entry") {
		$output = "<h4>You have no codex unit of that type.</h4><div class=\"padding\">";
	} else {
		$unit = new Unit();
		$output = $unit->codexUnit($_SESSION['army_id'], $_POST['unit']);
	}
	
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