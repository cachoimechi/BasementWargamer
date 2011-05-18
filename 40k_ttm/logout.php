<?php
/***********************************************
File: logout.php
Author: Adam Krone
Description: Handles user logout.
***********************************************/

	session_start();
	
	require "func.inc.php";
	
	$user = new User();
	$output = $user->logout();
	
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