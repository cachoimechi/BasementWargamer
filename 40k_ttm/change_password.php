<?php
/***********************************************
File: change_password.php
Author: Adam Krone
Description: Handles user password changes.
***********************************************/

	session_start();
	
	require "func.inc.php";
	include "auth.inc.php";
	
	$oldpassword = $_POST['old_password'];
	$newpassword = $_POST['new_password'];
	$repeatpassword = $_POST['repeat_password'];
	
	if ( $newpassword == $repeatpassword ) {
		$user = new User();
		$output = $user->changePassword($_SESSION['uid'], $oldpassword, $newpassword);
	} else {
		$output = "<h4>New passwords do not match.</h4><div class=\"padding\">";
	}
	
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