<?php
/***********************************************
File: 
Author: Adam Krone
Last Edited:
Description:
***********************************************/

	session_start();
	
	require "func.inc.php";
	include "auth.inc.php";
	
	$unit = new Unit();
	$details = $unit->getDetails($_GET['unit_id']);
	
	if ( $_SESSION['uid'] != $details['user_id'] ) {
		header("Location:manage_army.php");
	} else {

		$unit = new Unit();
		$output = $unit->delete($_GET['unit_id']);
		$output .= redirect("manage_army.php");
	
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