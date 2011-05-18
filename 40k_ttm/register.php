<?php
/***********************************************
File: register.php
Author: Adam Krone
Description: Handles user registration.
***********************************************/

	require "func.inc.php";
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$passwordVal = $_POST['passwordVal'];
	$email = $_POST['email'];
	
	//check if passwords match
	if ( $password != $passwordVal ) {
	
		$output = "<h3>Passwords do not match.</h3><div class=\"padding\">" . redirect("register_form.php");
	
	} else {
				$user = new User();
				$output = $user->create($username, $password, $email);
				if ($output == "<h3>User created successfully!</h3>") {
					$output .= $user->login($username, $password);
				}
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