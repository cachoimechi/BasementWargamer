<?php
/***********************************************
File: update_army.php
Author: Adam Krone
Description: Handles updates made to an army.
***********************************************/

	session_start();
	
	require "func.inc.php";
	include "auth.inc.php";
	
	$name = $_POST['army_name'];
	$codex = $_POST['codex'];
	$points = $_POST['points'];
	$comments = $_POST['comments'];
	if ( isset($_POST['public']) ) {
		$public = "yes";
	} else {
		$public = "no";
	}
	
	$army = new Army();
	$output = $army->update($_SESSION['army_id'], $name, $codex, $points, $comments, $public);
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