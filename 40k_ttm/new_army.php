<?php
/***********************************************
File: new_army.php
Author: Adam Krone
Description: Handles creation of new armies.
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
	$output = $army->create($_SESSION['uid'], $name, $codex, $points, $comments, $public);
	$output .= redirect("armies.php");
	
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