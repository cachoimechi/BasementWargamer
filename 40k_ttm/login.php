<?php
/***********************************************
File: login.php
Author: Adam Krone
Description: Handles user login.
***********************************************/

	require "func.inc.php";
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$user = new User();
	$output = $user->login($username, $password);

	
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