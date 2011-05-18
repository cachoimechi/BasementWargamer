<?php
/***********************************************
File: update_army.php
Author: Adam Krone
Description: Handles updates made to an army.
***********************************************/

	session_start();
	
	require "func.inc.php";
	include "auth.inc.php";
	
	
	
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