<?php
/***********************************************
File: change_email.php
Author: Adam Krone
Description: Handles changes to user email.
***********************************************/

	session_start();
	
	require "func.inc.php";
	include "auth.inc.php";
	
	$email = $_POST['email'];
	
	$user = new User();
	$output = $user->changeEmail($_SESSION['uid'], $email);
	$output .= redirect("user_settings.php");

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