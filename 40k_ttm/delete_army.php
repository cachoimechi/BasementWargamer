<?php
/***********************************************
File: delete_army.php
Author: Adam Krone
Description: Handles deletion of armies.
***********************************************/

	session_start();
	
	require "func.inc.php";
	include "auth.inc.php";
	
	$army = new Army();
	$details = $army->getDetails($_GET['army_id']);
	
	if ( $_SESSION['uid'] != $details['user_id'] ) {
		header("Location:manage_army.php");
	} else {
	
		$army = new Army();
		$output = $army->delete($_GET['army_id']);
		$output .= redirect("armies.php");
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