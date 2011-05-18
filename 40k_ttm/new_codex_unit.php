<?php
/***********************************************
File: new_codex_unit.php
Author: Adam Krone
Description: Handles creation of codex units.
***********************************************/

	session_start();
	
	require "func.inc.php";
	include "auth.inc.php";
	
	$name = $_POST['name'];
	$type = $_POST['type'];
	$points = $_POST['points'];
	
	$codex = new Codex();
	$output = $codex->create($_SESSION['uid'], $_SESSION['codex'], $name, $type, $points);
	
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